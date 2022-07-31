# TODO
- Обновить список категорий справочников в доке

# Команды

Запуск с нуля
```
php artisan migrate:fresh
php artisan db:seed
php artisan test --env=testing --parallel --recreate-databases
php artisan serve --port=8081
```

Пересобрать миграции
```
php artisan migrate:fresh
```
Добавить фикстуры
```
php artisan db:seed
```
Запусить сервер
```
php artisan serve --port=8081
```
Запустить тесты
```
php artisan test --env=testing
```
Запустить тесты параллельно с пересозданием БД
```
php artisan test --env=testing --parallel --recreate-databases
```
Обновить документацию
```
php artisan scribe:generate
```
Обновить пакеты бекенда
```
composer install
composer update
```

# CORS

Добавлен пакет ```fruitcake/laravel-cors```
<br>
Сейчас доступны любые адреса 

# API

```/docs```
