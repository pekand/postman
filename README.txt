# postman


##################################################################################

-frontent > login page

-project > add > edit > delete (soft)
-request > add > edit > delete (soft)
-request call > add > edit > delete (soft)


-frontend > tree > projects > request > view request

-view request > view request history
-make call > curl
-create post to url 
-api curl
-store request

-multiple users roles
-vue frontend
-vue production https://vuejs.org/v2/guide/deployment.html

-postman application for testng requests

##################################################################################

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
npm run watch

#database (credential set in .env file)
create database IF NOT EXISTS postman character set utf8 collate utf8_general_ci;
create user 'postman'@'%' identified by 'postman';
grant all privileges on postman.* to 'postman'@'%' identified by 'postman' require none with grant option max_queries_per_hour 0 max_connections_per_hour 0 max_updates_per_hour 0 max_user_connections 0;
grant all privileges on `postman`.* to 'postman'@'%';

https://dbadmin.pekand.dev/phpMyAdmin-5.0.4-all-languages/db_structure.php?server=1&db=postman

php artisan key:generate

#list of urls
php artisan route:list

php artisan make:migration create_access_tokens_table --create=access_tokens
php artisan make:migration create_projects_table --create=projects
php artisan make:migration create_request_table --create=requests
php artisan make:migration create_call_table --create=calls
php artisan make:model AccessTokens
php artisan make:model Project
php artisan make:model Request
php artisan make:model Call
php artisan migrate --force
php artisan migrate --force --seed


php artisan migrate:reset --force
php artisan migrate --force --seed

.\vendor\bin\phpunit

php artisan make:test AuthTest
php artisan make:test ProjectTest
php artisan make:test RequestTest
php artisan make:test CallTest

php artisan make:test AuthTest --unit
php artisan make:test ProjectTest --unit
php artisan make:test RequestTest --unit
php artisan make:test CallTest --unit
