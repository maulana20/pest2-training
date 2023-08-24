docker-compose exec pair ./create.sh
docker compose cp pair:/app/pair.sec ./web
docker compose cp pair:/app/pair.pub ./web
