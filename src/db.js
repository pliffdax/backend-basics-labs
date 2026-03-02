import mongoose from "mongoose";

export async function connectDb(mongoUri) {
  if (!mongoUri) throw new Error("MONGO_URI is missing in .env");

  mongoose.set("strictQuery", true);

  await mongoose.connect(mongoUri);

  console.log("MongoDB connected");
}
