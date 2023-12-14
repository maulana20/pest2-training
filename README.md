# pest2-training
laravel pest2 training

install
```
$ docker-compose build
$ docker-compose up -d
```

run `init.bat`

pest2 test
```
$ docker-compose exec web ./vendor/bin/pest
```

dusk test
```
$ docker-compose exec web php artisan dusk
```

selenium stream
```
url      : http://localhost:7900
password : secret
```
