# NearbyShopsFront

This is a coding challenge for Hidden founders.
 
This is just the Back-Service using Laravel 5.7.
You can find the Front-Service [Here](https://github.com/karim88/nearby-shops-front-service).

# Prerequise

* You need PHP 7.1+
* Mysql
* Php Composer

# Installation

* Clone the project `git clone https://github.com/karim88/nearby-shops-back-service.git`
* Navigate to the project folder  `cd nearby-shops-back-service`
* Install dependencies `composer install`
* Clone the environement file `cp .env.example .env`, then change mysql connection information the database name, and APP_URL value too.
* Then run the migration `php artisan migrate`
* Seed the data (shops in this case) `php artisan db:seed`
* Generate auth keys `php artisan passport:install`
* Finally generate application key `php artisan key:generate`
* Now you are Ready To Go you can run `php artisan serve`.
