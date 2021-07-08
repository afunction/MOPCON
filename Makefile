.PHONY: main init install update composerInstall composerDumpAutoload composerUpdate

BRANCH := $(shell cat .git/HEAD | awk -F/ '{ print $$3 }')

main: update

init:
	-curl -sS https://getcomposer.org/installer | php
	-sudo mv composer.phar /usr/local/bin/composer

install:
	-composer install

update:
	-git pull origin ${BRANCH}
	-composer install

upgrade:
	-composer self-update

# composer
#
composerInstall:
	-composer install

composerDumpAutoload:
	-composer dump-autoload

composerUpdate:
	-composer update

#test:
#	vendor/bin/phpunit

