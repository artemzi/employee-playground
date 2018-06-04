# check tabs cat -e -t -v  Makefile
docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

test:
	./vendor/bin/phpunit