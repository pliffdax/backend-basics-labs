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

    const response = await axios.get(
      "https://api.openweathermap.org/data/2.5/weather",
      {
        params: {
          q: city,
          units: "metric",
          appid: apiKey,
        },
      },
    );

    const data = response.data;

    res.render("weather/show", {
      city: data.name,
      temp: data.main.temp,
      feels: data.main.feels_like,
      humidity: data.main.humidity,
      wind: data.wind.speed,
      description: data.weather[0].description,
    });
  } catch (error) {
    res.render("error", {
      title: "Помилка",
      message: "Не вдалося отримати погоду. Перевірте назву міста.",
    });
  }
});

router.get("/api/:city", async (req, res) => {
  try {
    const response = await axios.get(
      "https://api.openweathermap.org/data/2.5/weather",
      {
        params: {
          q: req.params.city,
          units: "metric",
          appid: process.env.OPENWEATHER_API_KEY,
        },
      },
    );

    res.json(response.data);
  } catch (error) {
    res.status(400).json({ error: "City not found or API error" });
  }
});

export default router;
