## Тестовое задание компании "Жилфонд"

### Требования

- PHP >= 8.0
- Composer
- Node.js >= 14.x
- NPM или Yarn
- PostgresSQL
- Установленный и настроенный Nginx веб-сервер

### Установка

Перед установкой необходимо создать PostgresSQL базу данных и настроить файл `.env` в корне проекта. `.env` файл я добавил в git чтобы ускорить настройку проекта

#### 1. Клонирование репозитория

`https://github.com/TwinkleToesDev/jilfond`

#### 2. Установка зависимостей

`composer install`

#### 3. Миграции и сидеры

`php artisan migrate`

`php artisan db:seed`

#### 4. Запуск проекта

`npm run dev`

`php artisan serve`



Для теста я выставил 5000 клиентов в сидере, это значение можно поменять в файле `database/seeders/UsersTableSeeder.php` в переменной `$usersCount`

Поиск осуществляется по `username` и `name`

### GraphQL Query: `UserSearch`
Этот запрос позволяет вам искать пользователей по их ID, username или name.

#### Запрос

```graphql
query UserSearch($search: String!, $limit: Int!) {
  userSearch(search: $search, limit: $limit) {
    id
    username
    name
    about
    email
  }
}
```

#### Аргументы

| Аргумент | Тип    | Описание                                                                            |
|----------|--------|-------------------------------------------------------------------------------------|
| search   | String | Поисковый запрос для фильтрации пользователей по ID, username или name              |
| limit    | Int    | Лимит на кол-во пользователей в ответе на запрос                                    |
| id       | Int    | Поиск одного пользователя по ID |

#### Ответ

| Поле                 | Тип    | Описание                     |
|----------------------|--------|------------------------------|
| userSearch.id        | Int    | ID пользователя              |
| userSearch.username  | String | Username пользователя        |
| userSearch.name      | String | Имя пользователя             |
| userSearch.about     | String | Поле "О себе"                |
| userSearch.email     | String | Email пользователя           |
| userSearch.image_url | String | URL изображения пользователя |
| userSearch.phone     | String | Номер телефона пользователя  |

#### - Пример запроса на поиск пользователей по Username и Name

```graphql
query {
  userSearch(search: "test", limit: 10) {
    id
    username
    name
    about
    email
    image_url
    phone
  }
}
```

#### Пример ответа

```json
{
  "data": {
    "userSearch": [
      {
        "id": 1,
        "username": "test_user1",
        "name": "Test One",
        "about": "Some text",
        "email": "test1@example.com",
        "image_url": "http://localhost:8000/storage/images/1.jpg", 
        "phone": "1234567890"
      },
      {
        "id": 2,
        "username": "test_user2",
        "name": "Test Two",
        "about": "Some text",
        "email": "test2@example.com", 
        "image_url": "http://localhost:8000/storage/images/2.jpg",
        "phone": "1234567890"
      }
    ]
  }
}
```

#### - Пример запроса на поиск одного пользователя по ID

```graphql
query {
  userSearch(id: 1) {
    id
    username
    name
    about
    email
    image_url
    phone
  }
}
```

#### Пример ответа

```json
{
  "data": {
    "userSearch": [
      {
        "id": 1,
        "username": "test_user1",
        "name": "Test One",
        "about": "Some text",
        "email": "test1@example.com",
        "image_url": "http://localhost:8000/storage/images/1.jpg",
        "phone": "1234567890"
      }
    ]
  }
}
```


 

