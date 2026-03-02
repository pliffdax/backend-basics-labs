import express from "express";
import dotenv from "dotenv";
import path from "path";
import { fileURLToPath } from "url";
import methodOverride from "method-override";

import { connectDb } from "./db.js";

import homeRouter from "./routes/home.js";
import weatherRouter from "./routes/weather.js";
import subscribersRouter from "./routes/subscribers.js";
import topicsRouter from "./routes/topics.js";
import newslettersRouter from "./routes/newsletters.js";

dotenv.config();

const app = express();
const PORT = process.env.PORT || 3000;

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const ROOT_DIR = path.join(__dirname, "..");

app.set("view engine", "ejs");
app.set("views", path.join(ROOT_DIR, "views"));

app.use(express.static(path.join(ROOT_DIR, "public")));
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(methodOverride("_method"));

app.use("/", homeRouter);
app.use("/weather", weatherRouter);

app.use("/subscribers", subscribersRouter);
app.use("/topics", topicsRouter);
app.use("/newsletters", newslettersRouter);

await connectDb(process.env.MONGO_URI);

app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
