## Автосклад

Реализовать веб-сервис "Автосклад" (json-апи, включая JWT)

### Запуск 

- PHP >= 7.4 (Ctype, iconv, JSON, PCRE, Session, SimpleXML, Tokenizer, php-pgsql)
- PostgreSQL >= 12
- Composer

Строку с подключением к БД нужно прописать в файле ```Config\db.php```

Закинуть в БД дамп из файла cars_rest.sql

```
composer install
php -S localhost:8888
```


#### Автомобили

id, марка, модель, год выпуска, комплектация, тех. характеристики - json-array с возможностью поиска по нему внутри базы
```https://cars.epictest.dev/cars/5```

#### Cклад

id, авто, статус ('на складе', 'продано', 'ожидаем поступления'), кол-во на складе.
```https://cars.epictest.dev/storage/1```

#### Пользователи (которые могут авторизоваться)

логин, пароль, роль

```
логин / пароль / роль
user / User123 / Пользователь, только просмотр админки
manager / Manager123 / Менеджер, добавление и изменение машин и склада
admin / Admin123 / Администратор, менеджер + удаление

http://localhost:8888/admin/login
```

### Возможные действия

- Получение списка всех авто: ```https://cars.epictest.dev/cars/list```
- Статистика склада по поступлениям/продажам: ```https://cars.epictest.dev/storage/status/(expected|onstock|sold)```
- Авторизация пользователей: через веб ```https://cars.epictest.dev/admin/login``` или через POSTMAN нужно отправить json ```{"login": "admin", "password": "Admin" } https://cars.epictest.dev/user/login``` 
- Добавление/Редактирование/Удаление автомобиля (для авторизованных пользователей с определенной ролью)
    через админку
    https://cars.epictest.dev/admin/cars/add
    https://cars.epictest.dev/admin/cars/edit/{id}
    https://cars.epictest.dev/admin/cars/delete/{id}
    или через POST запросы нужно отправить полные json сущности
    ['POST', 'https://cars.epictest.dev/cars/add']
    ['POST', 'https://cars.epictest.dev/cars/edit']
    ['POST', 'https://cars.epictest.dev/cars/delete/{id}']
    ```
    {
        "formData":[
            {"name":"id","value":"18"}, // ID нужно передать для изменения 
            {"name":"brand","value":"Lexus"},
            {"name":"model","value":"LX 500"},
            {"name":"year","value":"2019"},
            {"name":"equipment","value":"Superior"},
            {"name":"specifications","value":"{}"}
        ]
    }
    ```
- Добавление/Редактирование/Удаление в состоянии склада (для авторизованных пользователей с определенной ролью)
    через админку
    https://cars.epictest.dev/admin/cars/add
    https://cars.epictest.dev/admin/cars/edit/{id}
    https://cars.epictest.dev/admin/cars/delete/{id}
    или через POST запросы нужно отправить полные json сущности
    ['POST', 'https://cars.epictest.dev/cars/add']
    ['POST', 'https://cars.epictest.dev/cars/edit']
    ['POST', 'https://cars.epictest.dev/cars/delete/{id}']
    ```
    {
        "formData":[
            {"name":"id","value":"18"}, // ID нужно передать для изменения 
            {"name":"brand","value":"Lexus"},
            {"name":"model","value":"LX 500"},
            {"name":"year","value":"2019"},
            {"name":"equipment","value":"Superior"},
            {"name":"specifications","value":"{}"}
        ]
    }
    ```

### Технические требования

- База данных Postgresql
- Приложение должно быть написано на PHP
- Приложение не должно быть написано с помощью какого-либо фреймворка, однако можно устанавливать для него различные пакеты через compоser
- Результаты запросов должны быть представлены в формате JSON
- Результаты запросов могут быть закешированы, если в параметрах запроса передан cache: true.
- Результат задания должен быть выложен на github, должна быть инструкция по запуску проекта. Также необходимо - пояснить, сколько на каждую часть проекта ушло времени
