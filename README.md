To get working copy of the app you need run this commands:

git clone https://github.com/snoopsmk/test.git

cd test

composer install

cp .env.example .env

php artisan key:generate

create database

if SQLSTATE[HY000] [1045] run:
php artisan cache:clear
php artisan config:cache

php artisan storage:link
