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

# Фикстуры

## Юзеры

``` php
DB::table('users')->insert([
    'id' => 1,
    'login' => 'user1',
    'password' => Hash::make('1234'),
]);
```
``` php
DB::table('users')->insert([
    'id' => 2,
    'login' => 'user2',
    'password' => Hash::make('1234'),
]);
```
``` php
DB::table('users')->insert([
    'id' => 3,
    'login' => 'user3',
    'password' => Hash::make('1234'),
]);
```
## Компании

``` php
DB::table('companies')->insert([
    'id' => 1,
    'user_id' => 1,
    
    'phone' => '+7 (911) 999-12-71',
    'site' => 'https://test.com',
    'email' => 'test@test.com',
    
    'name' => 'Компания 1',
    'full_name' => 'Полное название компании 1',

    'owner' => 'Владелец',
    'responsible' => 'Ответственный',
    'responsible_phone' => '+7 (911) 281-15-75',

    'organization_type_id' => 1,
    'district_id' => 1,

    'education_license' => json_encode([
        'number' => 1,
        'date' => Carbon::now()->toDateString(),
        'type' => 'Дошкольное образование',
    ]),
    'medical_license' => json_encode([
        'number' => 2,
        'date' => Carbon::now()->toDateString(),
    ]),
    'is_has_innovative_platform' => true,

    'status' => CompanyStatus::ACCEPTED,
]);
```
``` php
DB::table('companies')->insert([
    'id' => 2,
    'user_id' => 2,
    
    'phone' => '+7 (911) 999-12-71',
    'site' => 'https://test2.com',
    'email' => 'test@test2.com',
    
    'name' => 'Компания 2',
    'full_name' => 'Полное название компании 2',

    'owner' => 'Владелец 2',
    'responsible' => 'Ответственный 2',
    'responsible_phone' => '+7 (911) 281-15-75',

    'organization_type_id' => 2,
    'district_id' => 2,

    'education_license' => null,
    'medical_license' => null,
    'is_has_innovative_platform' => false,

    'status' => CompanyStatus::ACCEPTED,
]);
```

## Категории словарей

``` php
DB::table('dictionary_categories')->insert([
    'id' => 1,
    'name' => 'Тип организации',
    'slug' => 'organization-type',
]);
```
``` php
DB::table('dictionary_categories')->insert([
    'id' => 2,
    'name' => 'Район',
    'slug' => 'district',
]);
```

## Словари

``` php
$dictionary_categories = DictionaryCategory::all();

// create dictionary item for each category
foreach ($dictionary_categories as $category) {
    // 5 times
    for ($i = 0; $i < 5; $i++) {
        Dictionary::create([
            'category_id' => $category->id,
            'label' => strtolower($category->name . ' №' . $i+1) 
        ]);
    }
}
```

# CORS

Добавлен пакет ```fruitcake/laravel-cors```
<br>
Сейчас доступны любые адреса 

# API

```/docs```
