## About

A basic e-commerce/shopping system. That user can purchase things by topping up an amount (in the currency of their choice).
An admin user can enter the products and prices into the database. At any given time, a user can only buy one thing.

## Architecture

1. **FRONT-END Application**: Powered by **VUE JS & VUEX & Tailwindcss**
   The Client application is used by customer users to :
   - register
   - login
   - top up their account
   - perform purchases
   - View their transactions

# Install & Run Vue Front-End App

- Step 1

  `Make sure the backend is up and running

- Step 2

  `cd eshop/frontend_vue`

- Step 3

  `npm install`

- Step 4: Update the backend URL endpoint in the eshop/frontend_vue/.env file

  `VUE_APP_API_URL=http://localhost:8000/api`

- Step 5

  `npm run serve`

- Step 6

  Navigate to your default Url to view the Frontend-App `http://localhost:8080`

- Step 7 `Register an account and start your using all features`

  Default Credentials: email: `user@auser.com `password:`password`

# Insight

I began this project by assessing the requirements and developing related migration, models, and relationships for the backend side, after which I implemented the REST API to serve the frontend app. To create the backend, I used Event-Driven (Model Observers for example) and TDD approach.

The following stage was to write all Feature Tests and Unit Tests using PHPUnit, however, time ran out. I opted to write only a few tests.

With the Frontend app, I began by developing all of the associated services that I had used to consume the Backend API, and then I began implementing Vuex stuff (States, Actions, Mutations Actions, and getters). Then I finished by constructing all related components and routes.

These are some things I could improve or added if I had more time:

1. Apply Repository Pattern for the Laravel Backend app.
2. Write all Features Test and Unit Test
3. Handle all API REST Errors for the Backend
4. Handle Errors and validation on the Frontend Application
5. Deep Code Refactoring
6. Caching API Resources for the Backend for better performance
7. Security
8. and much more etc.
