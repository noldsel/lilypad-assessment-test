# Lilypad Assessment Test

## Installation

1. clone the repository
2. Run `docker compose up --build -d`
3. Run `docker exec -it laravel-php composer install -o`
4. Run `docker exec -it laravel-php bash`
  1. Run `php artisan migrate`
  2. Run `php artisan db:seed`
  3. exit
7. CD `frontend`
8. RUN `npm install`
9. RUN `npm run dev`
10. Load in browser: http://localhost:5173/
