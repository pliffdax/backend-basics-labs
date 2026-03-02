import Subscriber from "../models/Subscriber.js";
import Topic from "../models/Topic.js";
import Newsletter from "../models/Newsletter.js";

export const resolvers = {
  Query: {
    subscribers: async () => Subscriber.find().sort({ createdAt: -1 }),
    subscriber: async (_, { id }) => Subscriber.findById(id),

    topics: async () => Topic.find().sort({ createdAt: -1 }),
    topic: async (_, { id }) => Topic.findById(id),

    newsletters: async () => Newsletter.find().sort({ createdAt: -1 }),
    newsletter: async (_, { id }) => Newsletter.findById(id),
  },

  Mutation: {
    createSubscriber: async (_, args) => Subscriber.create(args),
    updateSubscriber: async (_, { id, ...patch }) =>
      Subscriber.findByIdAndUpdate(id, patch, {
        new: true,
        runValidators: true,
      }),
    deleteSubscriber: async (_, { id }) => {
      await Subscriber.findByIdAndDelete(id);
      return true;
    },

    createTopic: async (_, { title }) => Topic.create({ title }),
    updateTopic: async (_, { id, title }) =>
      Topic.findByIdAndUpdate(
        id,
        { title },
        { new: true, runValidators: true },
      ),
    deleteTopic: async (_, { id }) => {
      await Topic.findByIdAndDelete(id);
      return true;
    },

    createNewsletter: async (_, { topic_id, subject, body, sent_at }) =>
      Newsletter.create({
        topic_id,
        subject,
        body,
        sent_at: sent_at ? new Date(sent_at) : null,
      }),

    updateNewsletter: async (_, { id, sent_at, ...patch }) =>
      Newsletter.findByIdAndUpdate(
        id,
        {
          ...patch,
          ...(sent_at !== undefined
            ? { sent_at: sent_at ? new Date(sent_at) : null }
            : {}),
        },
        { new: true, runValidators: true },
      ),

    deleteNewsletter: async (_, { id }) => {
      await Newsletter.findByIdAndDelete(id);
      return true;
    },
  },
};
