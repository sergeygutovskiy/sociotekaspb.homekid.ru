# Команды

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
    'name' => 'Компания 1',
    'full_name' => 'Полное название компании',

    'owner' => 'Владелец',
    'responsible_for_providing_information' => 'Ответственный',

    'organization_type_id' => 1,
    'district_id' => 1,

    'is_has_education_license' => true,
    'is_has_mdedical_license' => true,
    'is_has_innovative_platform' => false,

    'status' => 'confirmed'
]);
```
``` php
DB::table('companies')->insert([
    'id' => 2,
    'user_id' => 2,
    'name' => 'Компания 2',
    'full_name' => 'Полное название компании',

    'owner' => 'Владелец',
    'responsible_for_providing_information' => 'Ответственный',

    'organization_type_id' => 4,
    'district_id' => 1,

    'is_has_education_license' => true,
    'is_has_mdedical_license' => true,
    'is_has_innovative_platform' => true,

    'status' => 'pending'
]);
```
``` php
DB::table('companies')->insert([
    'id' => 3,
    'user_id' => 3,
    'name' => 'Компания 3',
    'full_name' => 'Полное название компании',

    'owner' => 'Владелец',
    'responsible_for_providing_information' => 'Ответственный',

    'organization_type_id' => 3,
    'district_id' => 2,

    'is_has_education_license' => false,
    'is_has_mdedical_license' => false,
    'is_has_innovative_platform' => false,

    'status' => 'rejected',
    'rejected_status_description' => 'Говно съело мочу.'
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
for ( $i = 1; $i <= 5; $i++ )
{
    DB::table('dictionaries')->insert([
        'category_id' => 1,
        'label' => 'Тип огранизации №' . $i,
    ]);
}
```
``` php
for ( $i = 1; $i <= 5; $i++ )
{
    DB::table('dictionaries')->insert([
        'category_id' => 2,
        'label' => 'Район №' . $i,
    ]);
}
```

# CORS

Добавлен пакет ```fruitcake/laravel-cors```
<br>
Сейчас доступны любые адреса 