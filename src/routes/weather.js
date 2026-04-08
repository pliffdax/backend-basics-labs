import express from "express";
import axios from "axios";

const router = express.Router();

const CITIES = [
  { label: "Київ", value: "Kyiv", isAuthorLocation: true },
  { label: "Львів", value: "Lviv" },
  { label: "Одеса", value: "Odesa" },
  { label: "Тернопіль", value: "Ternopil" },
  { label: "Черкаси", value: "Cherkasy" },
];

async function requestWeather(params) {
  const apiKey = process.env.OPENWEATHER_API_KEY;

  if (!apiKey) {
    throw new Error("OPENWEATHER_API_KEY is not set");
  }

  const response = await axios.get(
    "https://api.openweathermap.org/data/2.5/weather",
    {
      params: {
        ...params,
        units: "metric",
        lang: "ua",
        appid: apiKey,
      },
    },
  );

  return response.data;
}

function renderWeather(res, data, sourceLabel) {
  res.render("weather/show", {
    sourceLabel,
    city: data.name,
    temp: data.main.temp,
    feels: data.main.feels_like,
    humidity: data.main.humidity,
    pressure: data.main.pressure,
    wind: data.wind.speed,
    description: data.weather?.[0]?.description ?? "Немає опису",
  });
}

function renderError(res, message, status = 400) {
  res.status(status).render("error", {
    title: "Помилка",
    message,
  });
}

router.get("/api/current", async (req, res) => {
  const { lat, lon } = req.query;

  if (!lat || !lon) {
    return res.status(400).json({ error: "lat and lon are required" });
  }

  try {
    const data = await requestWeather({ lat, lon });
    return res.json(data);
  } catch {
    return res.status(400).json({ error: "Unable to get weather data" });
  }
});

router.get("/api/:city", async (req, res) => {
  try {
    const data = await requestWeather({ q: req.params.city });
    return res.json(data);
  } catch {
    return res.status(400).json({ error: "City not found or API error" });
  }
});

router.get("/", async (req, res) => {
  const { city, lat, lon } = req.query;

  if (!city && !(lat && lon)) {
    return res.render("weather/index", {
      cities: CITIES,
    });
  }

  try {
    if (city) {
      const data = await requestWeather({ q: city.trim() });
      return renderWeather(res, data, "Запит через параметр city");
    }

    const data = await requestWeather({ lat, lon });
    return renderWeather(res, data, "Поточне місцезнаходження користувача");
  } catch {
    return renderError(
      res,
      "Не вдалося отримати погоду. Перевірте назву міста або спробуйте ще раз.",
    );
  }
});

router.get("/:city", async (req, res) => {
  const city = req.params.city?.trim();

  if (!city) {
    return renderError(res, "Назву міста не передано.");
  }

  try {
    const data = await requestWeather({ q: city });
    return renderWeather(res, data, "Маршрут /weather/:city");
  } catch {
    return renderError(
      res,
      "Не вдалося отримати погоду. Перевірте назву міста або спробуйте ще раз.",
    );
  }
});

export default router;
