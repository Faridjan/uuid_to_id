#######################  DOCKER  ##########################
php-cli:
	docker-compose run --rm api-php-cli php cli.php ${args}
init:
	docker-compose up -d
down:
	docker-compose down
pure-docker:
	docker system prune -af


#######################  COMPOSER  ##########################
composer-i:
	docker-compose run --rm api-php-cli composer install

composer-da:
	docker-compose run --rm api-php-cli composer dump-autoload

composer-u:
	docker-compose run --rm api-php-cli composer update

composer-rq:
	docker-compose run --rm api-php-cli composer require ${arg} ${dev}

composer-rm:
	docker-compose run --rm api-php-cli composer remove ${arg}


#######################  PRETTY  ####################
phpcbf:
	docker-compose run --rm api-php-cli vendor/bin/phpcbf src
phpcs:
	docker-compose run --rm api-php-cli vendor/bin/phpcs src


#######################  BASH COMMANDS  ####################
sudo-var:
	chmod api/var 0755 && find api/var -type d -print0 | xargs -0 chmod 0755 && find api/var -type f -print0 | xargs -0 chmod 0644


#######################  APP CLI  ####################
app-cli:
	docker-compose run --rm api-php-cli bin/app.php ${arg}
