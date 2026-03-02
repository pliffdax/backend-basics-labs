import express from "express";
import Topic from "../models/Topic.js";

const router = express.Router();

router.get("/", async (_req, res) => {
  const items = await Topic.find().sort({ createdAt: -1 });
  res.render("topics/index", { items });
});

router.get("/new", (_req, res) => {
  res.render("topics/new");
});

router.post("/", async (req, res) => {
  try {
    const { title } = req.body;
    await Topic.create({ title });
    res.redirect("/topics");
  } catch (e) {
    res.status(400).render("error", {
      title: "Помилка",
      message: "Не вдалося створити тему (можливо, така тема вже існує).",
    });
  }
});

router.get("/:id/edit", async (req, res) => {
  const item = await Topic.findById(req.params.id);
  if (!item)
    return res
      .status(404)
      .render("error", { title: "Помилка", message: "Тему не знайдено." });
  res.render("topics/edit", { item });
});

router.put("/:id", async (req, res) => {
  try {
    const { title } = req.body;
    await Topic.findByIdAndUpdate(
      req.params.id,
      { title },
      { runValidators: true },
    );
    res.redirect("/topics");
  } catch (e) {
    res.status(400).render("error", {
      title: "Помилка",
      message: "Не вдалося оновити тему.",
    });
  }
});

router.delete("/:id", async (req, res) => {
  await Topic.findByIdAndDelete(req.params.id);
  res.redirect("/topics");
});

export default router;
