import express from "express";
import Newsletter from "../models/Newsletter.js";
import Topic from "../models/Topic.js";

const router = express.Router();

router.get("/", async (_req, res) => {
  const items = await Newsletter.find()
    .populate("topic_id")
    .sort({ createdAt: -1 });
  res.render("newsletters/index", { items });
});

router.get("/new", async (_req, res) => {
  const topics = await Topic.find().sort({ title: 1 });
  res.render("newsletters/new", { topics });
});

router.post("/", async (req, res) => {
  try {
    const { topic_id, subject, body, sent_at } = req.body;
    await Newsletter.create({
      topic_id,
      subject,
      body,
      sent_at: sent_at ? new Date(sent_at) : null,
    });
    res.redirect("/newsletters");
  } catch (e) {
    res.status(400).render("error", {
      title: "Помилка",
      message: "Не вдалося створити лист.",
    });
  }
});

router.get("/:id/edit", async (req, res) => {
  const item = await Newsletter.findById(req.params.id);
  if (!item)
    return res
      .status(404)
      .render("error", { title: "Помилка", message: "Лист не знайдено." });
  const topics = await Topic.find().sort({ title: 1 });
  res.render("newsletters/edit", { item, topics });
});

router.put("/:id", async (req, res) => {
  try {
    const { topic_id, subject, body, sent_at } = req.body;
    await Newsletter.findByIdAndUpdate(
      req.params.id,
      { topic_id, subject, body, sent_at: sent_at ? new Date(sent_at) : null },
      { runValidators: true },
    );
    res.redirect("/newsletters");
  } catch (e) {
    res.status(400).render("error", {
      title: "Помилка",
      message: "Не вдалося оновити лист.",
    });
  }
});

router.delete("/:id", async (req, res) => {
  await Newsletter.findByIdAndDelete(req.params.id);
  res.redirect("/newsletters");
});

export default router;
