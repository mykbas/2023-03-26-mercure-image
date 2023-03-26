# Issue with mercure images

When trying to publish via MercureHub via [IndexController.php](src/Controller/IndexController.php)  the messages are received only if `image: dunglas/mercure` is set in [docker-compose.yml](docker-compose.yml)

Setting exact versions `dunglas/mercure:v0.14.5` or `dunglas/mercure:latest` and publish an update via controller, the message will not be received in Mercure UI Subscribe section.
Yet, [PingCommand.php](src/Command/PingCommand.php) same code sends messages when using all images' versions.

## Steps to reproduce

```shell
# start mercure
docker-compose up

# visit http://127.0.0.1:8080/.well-known/mercure/ui/ and subscribe to topic
# this command works with all images
#./bin/console app:ping

# start server
symfony serve --no-tls
# works only with `dunglas/mercure` image and NOT with `dunglas/mercure:v0.14.5` or `dunglas/mercure:latest`, see docker-compose.yml
curl http://127.0.0.1:8000
```

Used with:

* Ubuntu 18.04
* Docker 23.0.1
* docker-compose version 1.29.1
* Symfony CLI version 5.5.2
* "symfony/mercure-bundle": "^0.3.6",
