prepare:
	docker-compose run --rm php82 composer prepare

psalm:
	docker-compose run --rm php82 composer psalm

init-dev:
	docker-compose run --rm php82 composer install
	$(MAKE) install-hook

install-hook:
	docker-compose run --rm php82 ./vendor/bin/captainhook install --only-enabled --run-mode=docker --run-exec="docker-compose run --rm  -T php82"

.PHONY: prepare, psalm, init-dev, install-hook