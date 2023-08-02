prepare:
	docker-compose run --rm php82 composer prepare

psalm:
	docker-compose run --rm php82 composer psalm

phpcbf:
	docvker-compose run --rm php82 composer phpcbf

phpmd:
	docker-compose run --rm php82 composer phpmd

init-dev:
	docker-compose run --rm php82 composer install
	$(MAKE) install-hook

install-hook:
	docker-compose run --rm php82 ./vendor/bin/captainhook install --only-enabled --run-mode=docker --run-exec="docker-compose run --rm  -T php82"

.PHONY: prepare, psalm, phpcbf, phpmd, init-dev, install-hook