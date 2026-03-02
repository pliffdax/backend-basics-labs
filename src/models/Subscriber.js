import mongoose from "mongoose";

const subscriberSchema = new mongoose.Schema(
  {
    name: { type: String, required: true, trim: true },
    email: { type: String, required: true, trim: true, unique: true },
    login: { type: String, required: true, trim: true, unique: true },
    password_hash: { type: String, required: true },
  },
  { timestamps: true },
);

export default mongoose.model("Subscriber", subscriberSchema);
