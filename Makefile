# check tabs cat -e -t -v  Makefile
docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

test:
	./vendor/bin/phpunit

log-clear:
	cat /dev/null > storage/logs/laravel.log

db-backup:
	docker exec onlineemployeedirectory_mysql_1 /usr/bin/mysqldump -u artem --password=secret employee > backup.sql

db-restore:
	cat backup.sql | docker exec -i onlineemployeedirectory_mysql_1 /usr/bin/mysql -u artem --password=secret employee