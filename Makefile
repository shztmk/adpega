pc:=`docker ps --format "{{.ID}}" --filter "name=php"`

psalm:
	if [ -n $(pc) ]; then\
		docker exec $(pc) sh -c "./vendor/bin/psalm --no-cache";\
	else\
		docker-compose run --rm php82 sh -c "./vendor/bin/psalm --no-cache";\
    fi

phpcs:
	if [ -n $(pc) ]; then\
		docker exec $(pc) sh -c "./vendor/bin/phpcs -ps --standard=./phpcs.xml";\
	else\
		docker-compose run --rm php82 sh -c "./vendor/bin/phpcs -ps --standard=./phpcs.xml";\
    fi

phpcbf:
	if [ -n $(pc) ]; then\
		docker exec $(pc) sh -c "./vendor/bin/phpcbf -p --standard=./phpcs.xml";\
	else\
		docker-compose run --rm php82 sh -c "./vendor/bin/phpcbf -p --standard=./phpcs.xml";\
    fi

phpmd:
	if [ -n $(pc) ]; then\
		docker exec $(pc) sh -c "./vendor/bin/phpmd ./ text ruleset.xml";\
	else\
		docker-compose run --rm php82 sh -c "./vendor/bin/phpmd ./ text ruleset.xml";\
    fi

deptrac:
	if [ -n $(pc) ]; then\
		docker exec $(pc) sh -c "./vendor/bin/deptrac";\
	else\
		docker-compose run --rm php82 sh -c "./vendor/bin/deptrac";\
    fi

codecept-clean:
	if [ -n $(pc) ]; then\
		docker exec $(pc) sh -c "./vendor/bin/codecept clean";\
	else\
		docker-compose run --rm php82 sh -c "./vendor/bin/codecept clean";\
    fi

test:
	$(MAKE) unit-test
	$(MAKE) acceptance-test

unit-test:
	docker-compose exec -T php82-test sh -c "./vendor/bin/phpunit"

acceptance-test:
	docker-compose exec -T php82-test sh -c "./vendor/bin/codecept run acceptance"

ci:
	if [ -n $(pc) ]; then\
        docker-compose stop;\
    fi;\
    docker-compose up -d nginx-test
	$(MAKE) test
	$(MAKE) psalm
	$(MAKE) phpcs
	$(MAKE) phpmd
	$(MAKE) deptrac

prepare:
	docker-compose run --rm php82 sh -c "./vendor/bin/conventional-commits prepare"

install-hook:
	docker-compose run --rm php82 sh -c "./vendor/bin/captainhook install --only-enabled --run-mode=docker --run-exec='docker-compose run --rm -T php82'"

.PHONY: psalm, phcs, phpcbf, phpmd, codecept-clean, test, unit-test, acceptance-test, ci, prepare, install-hook