FROM vorrarit/php:5.6.21-apache-mysql

RUN pecl install redis-2.2.8

#ENV REDIS_SAVE_PATH="tcp://redis:6379"

RUN { \
		echo 'extension=redis.so'; \
    echo 'session.save_handler = redis'; \
    echo 'session.save_path = tcp://session-store:6379'; \
} >> /usr/local/etc/php/conf.d/docker-php-ext-redis.ini

VOLUME [/var/www/html]

EXPOSE 80
