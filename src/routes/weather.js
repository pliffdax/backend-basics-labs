import express from "express";
import axios from "axios";

const router = express.Router();

router.get("/", (_req, res) => {
  res.render("weather/index");
});

router.get("/city/:city", async (req, res) => {
  const { city } = req.params;

  try {
    const apiKey = process.env.OPENWEATHER_API_KEY;
    if (!apiKey) {
      return res.render("error", {
        title: "Помилка",
        message: "Не задано OPENWEATHER_API_KEY у файлі .env.",
      });
    }

    const response = await axios.get(
      "https://api.openweathermap.org/data/2.5/weather",
      {
        params: { q: city, units: "metric", appid: apiKey },
      },
    );

    const data = response.data;

    res.render("weather/show", {
      city: data.name,
      temp: data.main.temp,
      feels: data.main.feels_like,
      humidity: data.main.humidity,
      wind: data.wind.speed,
      description: data.weather?.[0]?.description ?? "",
    });
  } catch (error) {
    const status = error?.response?.status;
    const apiMsg = error?.response?.data?.message;

    console.error("Weather error:", status, apiMsg);

    let message =
      "Не вдалося отримати погоду. Перевірте назву міста або спробуйте пізніше.";
    if (status === 401)
      message =
        "Ключ API ще не активовано або він некоректний. Спробуйте пізніше.";
    if (status === 429)
      message = "Перевищено ліміт запитів. Спробуйте пізніше.";

    res.render("error", { title: "Помилка", message });
  }
});

router.get("/api/:city", async (req, res) => {
  const { city } = req.params;

  try {
    const apiKey = process.env.OPENWEATHER_API_KEY;
    if (!apiKey)
      return res.status(500).json({ error: "OPENWEATHER_API_KEY is missing" });

    const response = await axios.get(
      "https://api.openweathermap.org/data/2.5/weather",
      {
        params: { q: city, units: "metric", appid: apiKey },
      },
    );

    res.json(response.data);
  } catch (error) {
    const status = error?.response?.status || 400;
    const apiMsg = error?.response?.data?.message;
    res
      .status(status)
      .json({ status, error: apiMsg || "City not found or API error" });
  }
});

export default router;
