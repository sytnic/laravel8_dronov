# Study project

- Laravel 8.83.27 
- PHP 7.4.32
- Apache 
- MySQL 5.7.39
- Bootstrap 5
- Adminer
- Docker
- 2 контейнера (1 - app, 2 - db)

## Клон

Для новых проектов

- создать папку
- в ней совершить

    git clone this_project_url

- вырезать из автоматически созданной подпапки все файлы
- и вставить их в текущую рабочую папку
- пустую автоматически созданную папку удалить (на самом деле в ней хранятся скрытые папки, включая этот git-репозиторий).

Это создаст новый чистый проект без коммитов и без git-репозитория.

Вариант с 

    git clone   this_project_url   my_new_folder_for_new_project
    
создаст новый проект c коммитами из этого git-репозитория.

## Запуск Docker & Laravel

> !! Подготовить env, ориентируясь на ".env copy" и docker-compose.yml 

Запуск контейнеров

    docker-compose build
    docker-compose up -d

Вход в контейнер

    cd /d E:\
    cd E:\Projects_greycrud\template_docker
    dir
    docker ps
    docker exec -it container_id bash 
    (не работает в GitBash, работает в cmd)

    // установка nano, если необходима
    # apt-get install nano

    // иногда может понадобиться переписывание прав на файлы
    chown -R www-data:www-data *

В терминале в папке с проектом

    ls -la
    composer -v
    // установка composer, если необходимо

    // установка зависимостей Laravel
    composer install

Установка ключа для запуска Laravel

    php artisan key:generate

> Запуск Laravel в браузере

    127.0.0.1:8080

## Выяснение ошибок (если необходимо)

Для выяснения ошибок
  
    docker-compose logs

Остановка и Удаление контейнеров

    docker-compose down 

Вход в контейнер и миграция

    docker ps
    docker exec -it container_id bash

## Запуск миграций

! Остановить и запустить контейнеры, затем:

    php artisan migrate

> Проверка в браузере

    127.0.0.1:8080/adminer.php

## Остановка контейнеров

    docker-compose stop
