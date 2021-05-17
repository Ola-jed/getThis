#!/bin/sh
echo 'Make sure that you have created the database get-this in mysql'
composer install
mv .env.example .env
read -p "Do you want to configure the .env file ? y/N " rep
if [ "$rep" == "y" ] || [ "$rep" == "Y" ]
then
    vim .env
fi
php artisan key:generate
php artisan migrate
read -p "Do you want to seed the database ? y/N " rep
if [ "$rep" == "y" ] || [ "$rep" == "Y" ]
then
    php artisan db:seed
fi
php artisan serve
