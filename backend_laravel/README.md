## About

A basic e-commerce/shopping system. That user can purchase things by topping up an amount (in the currency of their choice).
An admin user can enter the products and prices into the database. At any given time, a user can only buy one thing.

## Architecture

1. **BACK-END Application**: Powered by **Laravel 8 & Blade with Tailwindcss**.
   The Backed is used to handle administration features by an admin user:

    - Load Products in the database with prices
    - Apply related Discounts
    - Audit Trail
    - API (REST) to interact with a client
      application in order to serve products, prices, discount settings, user logins, and registrations,
      purchases, top-ups.
    - User API Authentication using Laravel Sanctum

## Install & Run Laravel Back-End App

-   Step 1

    `git clone https://github.com/mnsuccess/eshop`

-   Step 2

    `cd eshop/backend_laravel`

-   Step 3

    `composer install`

-   Step 4

    `npm install && npm run dev`

-   Step 5

    In Windows:

    `copy .env.example .env`

    In Linux/Mac:

    `cp .env.example .env`

-   Step 6

    `php artisan key:generate`

-   Step 7

    `Create a database and apply related config to the .env file`

-   Step 8

    `php artisan migrate`

-   Step 9 (Optional) run Feature and Unit Test to verify | if in any case this failed just continue with the next step
    `php artisan test`

-   Step 10

    `php artisan db:seed`

-   Step 11
    Sanctum needs some specific setup to enable it to work with a separate SPA. Add the following in your .env file:

    `SANCTUM_STATEFUL_DOMAINS=localhost:8080` The stateful domain tells Sanctum which domain you are using for the SPA.

    `SPA_URL=http://localhost:8080`

    `SESSION_DOMAIN=localhost`

-   Step 12

    `php artisan serve`

    Navigate to the admin URL: `http://localhost:8000/`

    NB: Ascertain that the backend is hosted on a web server. ( Nginx, Apache, etc) or local development environment like Valet, etc.
    here I simply used a laravel artisan serve to host that. you free to use any Webserver

    Default Credentials: email: `admin@admin.com `password:`password`

-   If you wish to test the REST API endpoints, you can do so with the Postman tool.

    `POST http://localhost:8000/api/users/register ` Register a new user | params { name, email,password, password_confirmation}

    `POST http://localhost:8000/api/users/login` Login User and get The ApiToken | param {email,password}

    `GET http://localhost:8000/api/users/view-profile` View User profile | param {ApinToken}

    `POST http://localhost:8000/api/users/wallet-topup` Topup user wallet | param {Amount}

    `POST http://localhost:8000/api/transaction/purchase` Purchase a product | param {product_id}

    `GET http://localhost:8000/api/transaction` view User Transactions | param {ApinToken}

    `GET http://localhost:8000/api/product` View all Products

    `GET http://localhost:8000/api/product/:id` View specific product
