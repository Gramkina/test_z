## Порядок установки

1. Создать базу данных в СУБД поддерживающей Laravel (MySQL, PostgreSQL и т.д.) (CREATE DATABASE db-name;)
2. Создать копию файл .env.example с название .env
3. Настроить .env (указать параметры подключения к базе данных и SMTP-сервер)
4. Выполнить команду composer install
5. Сгенерировать ключ (php artisan key:generate)
6. Выполнить миграцию (php artisan migrate)
7. Запустить сервер (php artisan serve)
