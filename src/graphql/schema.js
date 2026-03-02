export const typeDefs = /* GraphQL */ `
  type Subscriber {
    _id: ID!
    name: String!
    email: String!
    login: String!
    password_hash: String!
    createdAt: String
    updatedAt: String
  }

  type Topic {
    _id: ID!
    title: String!
    createdAt: String
    updatedAt: String
  }

  type Newsletter {
    _id: ID!
    topic_id: ID!
    subject: String!
    body: String!
    sent_at: String
    createdAt: String
    updatedAt: String
  }

  type Query {
    subscribers: [Subscriber!]!
    subscriber(id: ID!): Subscriber

    topics: [Topic!]!
    topic(id: ID!): Topic

    newsletters: [Newsletter!]!
    newsletter(id: ID!): Newsletter
  }

  type Mutation {
    createSubscriber(
      name: String!
      email: String!
      login: String!
      password_hash: String!
    ): Subscriber!
    updateSubscriber(
      id: ID!
      name: String
      email: String
      login: String
      password_hash: String
    ): Subscriber!
    deleteSubscriber(id: ID!): Boolean!

    createTopic(title: String!): Topic!
    updateTopic(id: ID!, title: String!): Topic!
    deleteTopic(id: ID!): Boolean!

    createNewsletter(
      topic_id: ID!
      subject: String!
      body: String!
      sent_at: String
    ): Newsletter!
    updateNewsletter(
      id: ID!
      topic_id: ID
      subject: String
      body: String
      sent_at: String
    ): Newsletter!
    deleteNewsletter(id: ID!): Boolean!
  }
`;
