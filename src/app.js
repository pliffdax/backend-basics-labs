import express from "express";
import dotenv from "dotenv";
import path from "path";
import { fileURLToPath } from "url";
import weatherRouter from "./routes/weather.js";

dotenv.config();

const app = express();
const PORT = process.env.PORT || 3000;

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const ROOT_DIR = path.join(__dirname, "..");

app.set("view engine", "ejs");
app.set("views", path.join(ROOT_DIR, "views"));

app.use(express.static(path.join(ROOT_DIR, "public")));

app.get("/", (_req, res) => {
  res.render("home");
});

app.use("/weather", weatherRouter);

app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
