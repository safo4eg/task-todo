# Инструкция по разворачиванию проекта

Для начала клонируем сам проект в любое место, в примере создается папка task-todo.

```
    git clone https://github.com/safo4eg/task-todo.git task-todo
```

***Все дальнейшие команды должны выполняться из корня с файлом docker-compose.yml***

## Устанавка зависимостей

Устанавливаем необходиме зависимости с помощью контейнера с composer:

```
    docker compose run composer install
```

## Поднятие основных контейнеров

Поднимаем контейнеры, неоходимые для работы приложения.

```
    docker compose up nginx -d
```

## Подключение к контейнеру приложения

Для того чтобы выполнить необходимые команды для работы приложения laravel, нужно подключиться
к контейнеру task-todo-api через bash-оболочку

```
    docker exec -it task-todo-api bash
```

## Настройка Laravel приложения

Все эти команды выполняются последовательно внутри контейнера task-todo-api

```
    cp .env.example .env
```

```
    php artisan key:generate
```

```
    php artisan migrate --seed
```

## Необходимые ресурсы

1. [Документация API](http://localhost:8888/api/documentation)
2. [Phpmyadmin](http://localhost:9999/)