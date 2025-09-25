# ShopSync
Syncing products between Shopify and your app, with a shopping cart and checkout integration.

## Features
	•	Display products from Shopify.
	•	Add products to cart with variant selection.
	•	Checkout via Shopify store.
	•	Persistent cart using Pinia.
	•	Fixed header with cart dropdown.

## Demo

[Live Link](https://www.loom.com/share/002a27e753a14d27ae32ae26d4e94dea?sid=9a05a816-e457-456a-a8e5-980ba0c05cae)

## Requirements
	•	PHP >= 8.1
	•	Composer
	•	Node.js >= 18
	•	NPM/Yarn
	•	Laravel 10
	•	MySQL or any supported database (optional, for persistence)

## Environment Variables

Create a .env file (or update) with your Shopify store credentials or with .env.example data

## Installation

	1.	Clone the repository:
```
    git clone <your-repo-url>
    cd shopify-integration
```
	2.	Install PHP dependencies:

    `composer install`

	3.	Install Node dependencies:

    `npm install`

	4.	Build frontend assets:

    ```npm run dev```

## or for production

    `npm run build`

	5.	Generate application key:

    `php artisan key:generate`

	6.	Run database migrations (optional, if using DB):

    `php artisan migrate`

## Running the App

Start the Laravel development server:

`php artisan serve`

By default, it runs at: http://127.0.0.1:8000

Start the Vite development server for Vue:

`npm run dev`

Now your frontend and backend are running. Visit http://127.0.0.1:8000 to see your ShopSync app.

## Usage
	1.	Browse products from Shopify on the /products page.
	2.	Add products to the cart.
	3.	Open cart from the header, remove items, or clear.
	4.	Click Checkout to go to Shopify with cart items.