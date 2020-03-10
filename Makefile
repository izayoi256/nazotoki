up:
	docker-compose up -d --build
down:
	docker-compose down
ssh:
	docker-compose exec -u www-data app bash
init:
	docker-compose exec -u www-data app ./init.sh
