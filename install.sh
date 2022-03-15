#! /bin/bash

cp .env.example .env
composer update
php artisan key:generate
npm install
clear
echo "installed"
echo "------#####-------"
echo "now all you have to do is make a mysql database and add the credentials to the .env file"
echo "ohh right, you also have to add random stuff to all the PUSHER_APP stuff in the .env, doesnt matter what just somthing."
echo "Thanks for testing!!!"
