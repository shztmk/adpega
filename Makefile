prepare:
	docker-compose run --rm php82 composer prepare

commit:
	docker-compose run --rm php82 git commit

psalm:
	docker-compose run --rm php82 composer psalm

.PHONY: prepare, commit, psalm