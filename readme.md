## Webshop - Webshoporder Package
A Laravel 4 package for webshoporder

## Installation

Add the following to you composer.json file

    "agriya/webshoporder": "dev-master"

Run
    composer update

Add the following to app/config/app.php

    'Agriya\Webshoporder\WebshoporderServiceProvider',

Publish the config

    php artisan config:publish agriya/webshoporder

Run the migration

    php artisan migrate --package="agriya/webshoporder"

Add the following to app/routes.php

	Route::any('checkout', 'CheckOutController@populateCheckOutItems');
	Route::any('checkout/proceed', 'CheckOutController@doCheckOut');