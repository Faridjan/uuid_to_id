#######################  DOCKER  ##########################
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
	docker-compose run --rm api-php-cli composer require ${arg}

composer-rm:
	docker-compose run --rm api-php-cli composer remove ${arg}


#######################  CODE STYLE  ####################
lint:
	docker-compose run --rm api-php-cli vendor/bin/phplint
	docker-compose run --rm api-php-cli vendor/bin/phpcs
cs-fix:
	docker-compose run --rm api-php-cli vendor/bin/phpcbf
psalm:
	docker-compose run --rm api-php-cli vendor/bin/psalm


#######################  TESTs  ####################
test:
	docker-compose run --rm api-php-cli vendor/bin/phpunit --color=always --coverage-html var/coverage ${arg}
phpunit:
	docker-compose run --rm api-php-cli vendor/bin/phpunit --color=always --coverage-html var/coverage --testsuite=unit ${arg}
phpunit-functional:
	docker-compose run --rm api-php-cli vendor/bin/phpunit --color=always --coverage-html var/coverage --testsuite=functional ${arg}


#######################  BASH COMMANDS  ####################
sudo-var:
	sudo find api/var -type d -print0 | xargs -0 chmod 0755 && find api/var -type f -print0 | xargs -0 chmod 0644


#######################  CLI  ####################
php-cli:
	docker-compose run --rm api-php-cli php cli.php ${arg}

app-cli:
	docker-compose run --rm api-php-cli php bin/app.php --ansi ${arg}
