# Installation

1. clone repository
```
git clone git@github.com:devluk2/esprzedaz.git
cd esprzedaz
```

2. install dependencies, setup .env
```
npm install && npm run build
composer install
cp .env.example .env
php artisan key:generate
```

3. create database and run migrations
```
touch database/database.sqlite
php artisan migrate
```

4. run app
```
composer run dev
```

5. open in browser
```
http://localhost:8000
```