# Lilypad Assessment Test

## Installation

1. clone the repository
2. Run `docker compose up --build -d`
3. Run `docker exec -it laravel-php composer install -o`
4. Run `docker exec -it laravel-php php artisan migrate`
5. Run `docker exec -it laravel-php php artisan db:seed`
6. CD `frontend`
7. RUN `npm install`
8. RUN `npm run dev`
9. Load in browser: http://localhost:5173/
