# postman

#todo
-why can login to api
-vue production https://vuejs.org/v2/guide/deployment.html
-move login to api
-create post to url 
-api curl
-store request
-login 
-multiple users roles
-make vua app default controller main
-api calls > password protected

#documentation
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
npm audit fix
npm install && npm run dev


#database (credential set in .env file)
create database IF NOT EXISTS postman character set utf8 collate utf8_general_ci;
create user 'postman'@'%' identified by 'postman';
grant all privileges on postman.* to 'postman'@'%' identified by 'postman' require none with grant option max_queries_per_hour 0 max_connections_per_hour 0 max_updates_per_hour 0 max_user_connections 0;
grant all privileges on `postman`.* to 'postman'@'%';

https://dbadmin.pekand.dev/phpMyAdmin-5.0.4-all-languages/db_structure.php?server=1&db=postman

php artisan migrate --force
php artisan migrate --force --seed

php artisan key:generate

php artisan route:list
