# Auth

Sandbox playground 2/3: Rest server

This is a testing environment for trying out new concepts and to play around. However if you were inclined 
to use it for production or to modify it for your own need i would advise refactoring. For the most part i tried to keep to 
all the best practices, but since this is only in the "playing around phase" and i still have no idea of what i am making i do not 
advise using this "as is".


Docker: This build comes with a docker image. The image requires the .env file to hold the following:
(The following setup comes as default in the .env file)
``` 
MYSQL_ROOT_PASSWORD=root
MYSQL_DATABASE=rest
MYSQL_USER=root
MYSQL_PASSWORD=root
RABBITMQ_DEFAULT_HOSTNAME=rabbit1
RABBITMQ_DEFAULT_USER=rabbitmq
RABBITMQ_DEFAULT_PASS=rabbitmq
RABBITMQ_DEFAULT_STATUSLAYER_VHOST=/
```
How to use:

```
To build and run images:

docker-compose build
docker-comopose up -d
docker exec -it auth-php-fpm bash
composer install
```
```
To set up doctrine and rabbit:

docker exec -it auth-php-fpm bash
-- TO SET UP DB--
php bin/console doctrine:schema:create
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate

-- TO SET UP BASE DATA FOR TESTING --
php bin/console doctrine:fixtures:load

-- TO RUN TESTS --
php bin/phpunit

-- TO SET UP RABBIT--
php bin/console rabbitmq:setup-fabric
```

#API



#COMMANDS

If you are adding routes you have to add them to your permissions list so you can give roles access to them
```
-- TO DUMP THE WHOLE PERMISSIONS TABLE AND REIMPORT ALL ROUTES --
php bin/console security:import:routes

-- TO JUST UPDATE THE PERMISSIONS TABLE WITH NEW ROUTES --
php bin/console security:import:routes --update

-- TO REMOVE ANY ROUTES THAT NO LONGER EXIST --
php bin/console security:import:routes --clean
```




