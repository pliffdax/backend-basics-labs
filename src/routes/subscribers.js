import express from "express";
import Subscriber from "../models/Subscriber.js";

const router = express.Router();

router.get("/", async (_req, res) => {
  const items = await Subscriber.find().sort({ createdAt: -1 });
  res.render("subscribers/index", { items });
});

router.get("/new", (_req, res) => {
  res.render("subscribers/new");
});

router.post("/", async (req, res) => {
  try {
    const { name, email, login, password_hash } = req.body;
    await Subscriber.create({ name, email, login, password_hash });
    res.redirect("/subscribers");
  } catch (e) {
    res.status(400).render("error", {
      title: "Помилка",
      message:
        "Не вдалося створити передплатника (можливо, email/login вже існує).",
    });
  }
});

router.get("/:id/edit", async (req, res) => {
  const item = await Subscriber.findById(req.params.id);
  if (!item)
    return res.status(404).render("error", {
      title: "Помилка",
      message: "Передплатника не знайдено.",
    });
  res.render("subscribers/edit", { item });
});

router.put("/:id", async (req, res) => {
  try {
    const { name, email, login, password_hash } = req.body;
    await Subscriber.findByIdAndUpdate(
      req.params.id,
      { name, email, login, password_hash },
      { runValidators: true },
    );
    res.redirect("/subscribers");
  } catch (e) {
    res.status(400).render("error", {
      title: "Помилка",
      message: "Не вдалося оновити передплатника.",
    });
  }
});

router.delete("/:id", async (req, res) => {
  await Subscriber.findByIdAndDelete(req.params.id);
  res.redirect("/subscribers");
});

// JSON route
router.get("/api/list", async (_req, res) => {
  const items = await Subscriber.find().sort({ createdAt: -1 });
  res.json(items);
});

export default router;
