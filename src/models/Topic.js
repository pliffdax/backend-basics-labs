import mongoose from "mongoose";

const topicSchema = new mongoose.Schema(
  {
    title: { type: String, required: true, trim: true, unique: true },
  },
  { timestamps: true },
);

export default mongoose.model("Topic", topicSchema);
