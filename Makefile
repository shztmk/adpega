prepare:
	docker-compose run --rm php82 sh -c "./vendor/bin/conventional-commits prepare"

psalm:
	docker-compose run --rm php82 sh -c "./vendor/bin/psalm --no-cache"

phpcs:
	docker-compose run --rm php82 sh -c "./vendor/bin/phpcs -ps --standard=./phpcs.xml"

phpcbf:
	docker-compose run --rm php82 sh -c "./vendor/bin/phpcbf -p --standard=./phpcs.xml"

phpmd:
	docker-compose run --rm php82 sh -c "./vendor/bin/phpmd ./ text ruleset.xml"

test:
	docker-compose run --rm php82 sh -c "./vendor/bin/phpunit"

install-hook:
	docker-compose run --rm php82 sh -c "./vendor/bin/captainhook install --only-enabled --run-mode=docker --run-exec='docker-compose run --rm  -T php82'"

.PHONY: prepare, psalm, phcs, phpcbf, phpmd, test, install-hook