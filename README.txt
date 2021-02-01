# postman

[] create post to url 
[] api curl
[] store request
[] login 
[] multiple users roles

https://postman.project.dev/

#download composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

#start project
php composer.phar create-project --prefer-dist laravel/laravel postman
php composer.phar install
php composer.phar install --dev
php composer.phar require laravel/ui

#install vue
php artisan ui vue --auth
npm install vue-loader@^15.9.5 --save-dev --legacy-peer-deps

#bild frontend
npm install && npm run dev
