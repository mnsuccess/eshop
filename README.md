## About

A basic e-commerce/shopping system. That user can purchase things by topping up an amount (in the currency of their choice).
An admin user can enter the products and prices into the database. At any given time, a user can only buy one thing.

## Architecture

This application is split into two Apps:

1. **BACK-END Application**: Powered by **Laravel 8 & Blade with Tailwindcss**.
   The Backed is used to handle administration features by an admin user:

   - Load Products in the database with prices
   - Apply related Discounts
   - Audit Trail
   - API (REST) to interact with a client
     application in order to serve products, prices, discount settings, user logins, and registrations,
     purchases, top-ups.
   - User API Authentication using Laravel Sanctum

1. **FRONT-END Application**: Powered by **VUE JS & VUEX & Tailwindcss**
   The Client application is used by customer users to :
   - register
   - login
   - top up their account
   - perform purchases
   - View their transactions

NB: I decided to keep the frontend and backend folder projects in the same directory and repository for simplicity.
However, in a serious version, this should be done in two separate repositories: ).
To maintain track of the commits, I prefixed all of my backend commits with [B] and all of my frontend commits with [F].
I realize it's not the best practice, but it was useful since I used the unique Repo for both backend and frontend. 😊

## Install & Run Laravel Back-End App

- Step 1

  `git clone https://github.com/mnsuccess/eshop`

- Step 2

  `cd eshop/backend_laravel`

- Step 3

  `composer install`

- Step 4

  `npm install && npm run dev`

- Step 5

  In Windows:

  `copy .env.example .env`

  In Linux/Mac:

  `cp .env.example .env`

- Step 6

  `php artisan key:generate`

- Step 7

  `Create a database and apply related config to the .env file`

- Step 8

  `php artisan migrate`

- Step 9 (Optional) run Feature and Unit Test to verify | if in any case this failed just continue with the next step
  `php artisan test`

- Step 10

  `php artisan db:seed`

- Step 11
  Sanctum needs some specific setup to enable it to work with a separate SPA. Add the following in your .env file:

  `SANCTUM_STATEFUL_DOMAINS=localhost:8080` The stateful domain tells Sanctum which domain you are using for the SPA.

  `SPA_URL=http://localhost:8080`

  `SESSION_DOMAIN=localhost`

- Step 12

  `php artisan serve`

  Navigate to the admin URL: `http://localhost:8000/`

  NB: Ascertain that the backend is hosted on a web server. ( Nginx, Apache, etc) or local development environment like Valet, etc.
  here I simply used a laravel artisan serve to host that. you free to use any Webserver

  Default Credentials: email: `admin@admin.com `password:`password`

- If you wish to test the REST API endpoints, you can do so with the Postman tool.

  `POST http://localhost:8000/api/users/register ` Register a new user | params { name, email,password, password_confirmation}

  `POST http://localhost:8000/api/users/login` Login User and get The ApiToken | param {email,password}

  `GET http://localhost:8000/api/users/view-profile` View User profile | param {ApinToken}

  `POST http://localhost:8000/api/users/wallet-topup` Topup user wallet | param {Amount}

  `POST http://localhost:8000/api/transaction/purchase` Purchase a product | param {product_id}

  `GET http://localhost:8000/api/transaction` view User Transactions | param {ApinToken}

  `GET http://localhost:8000/api/product` View all Products

  `GET http://localhost:8000/api/product/:id` View specific product

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
