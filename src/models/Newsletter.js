import mongoose from "mongoose";

const newsletterSchema = new mongoose.Schema(
  {
    topic_id: {
      type: mongoose.Schema.Types.ObjectId,
      ref: "Topic",
      required: true,
      index: true,
    },
    subject: { type: String, required: true, trim: true },
    body: { type: String, required: true },
    sent_at: { type: Date, default: null, index: true },
  },
  { timestamps: true },
);

newsletterSchema.index({ topic_id: 1, sent_at: 1 });

export default mongoose.model("Newsletter", newsletterSchema);
