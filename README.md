# Up and running
./run.sh

# Acessing
http://localhost:8000/login

username: example@test.com
password: test

OR

http://localhost:8000/register
and create your own


# Testing
docker exec -it laravel-app /bin/bash -c "./vendor/bin/pest"

# API documentation
https://documenter.getpostman.com/view/3547764/2sB2x8FWuV

# Search project by Artisan command
docker exec -it laravel-app /bin/bash -c "php artisan app:search-projects"
 
