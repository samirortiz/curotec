npm install && npm run build && docker compose up -d --build && docker exec -it laravel-app /bin/bash -c 'php artisan migrate --seed'
