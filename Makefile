prepare:
	docker-compose run --rm php82 composer prepare

commit:
	docker-compose run --rm php82 git commit

.PHONY: prepare, commit