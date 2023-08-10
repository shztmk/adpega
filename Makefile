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

deptrac:
	docker-compose run --rm php82 sh -c "./vendor/bin/deptrac"

codecept-clean:
	docker-compose run --rm php82 sh -c "./vendor/bin/codecept clean"

test:
	$(MAKE) unit-test
	$(MAKE) acceptance-test

unit-test:
	docker-compose run --rm php82 sh -c "./vendor/bin/phpunit"

acceptance-test:
	docker-compose run --rm php82 sh -c "./vendor/bin/codecept run acceptance"

ci:
	$(MAKE) psalm
	$(MAKE) phpcs
	$(MAKE) phpmd
	$(MAKE) deptrac
	$(MAKE) test

install-hook:
	docker-compose run --rm php82 sh -c "./vendor/bin/captainhook install --only-enabled --run-mode=docker --run-exec='docker-compose run --rm  -T php82'"

.PHONY: prepare, psalm, phcs, phpcbf, phpmd, codecept-clean, test, unit-test, acceptance-test, ci, install-hook