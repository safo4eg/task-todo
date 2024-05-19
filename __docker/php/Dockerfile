FROM php:8.2-fpm-alpine

WORKDIR /var/www/task-todo/api

#установка пакетов (apk тк linux alpine)
RUN apk update && apk add \
    bash \
    curl

#установка расширений php
RUN docker-php-ext-install pdo pdo_mysql

## очистка кеша
RUN rm -rf /var/cache/apk/* && docker-php-source delete

# создаем юзера www (1000 как и локально)
RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

# смена текущего юзера с root на www
USER www

EXPOSE 9000