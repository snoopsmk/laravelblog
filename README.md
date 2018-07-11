## To get working copy of the app you need run few commands:

- First clone the app
```
git clone https://github.com/snoopsmk/test.git
```

- Go inside the app
```
cd laravelblog
```

- Install all necessary files
```
composer install
```

- Copy the .env file
```
cp .env.example .env
```

- Generate new aplication key
```
php artisan key:generate
```


- After that you need create database and connect it with the app


- And last, link the storage with the public folder
```
php artisan storage:link
```
- If there is error SQLSTATE[HY000] [1045] run:
```
php artisan cache:clear
php artisan config:cache
```
