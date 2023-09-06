<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></p>

## Инструкци по разворачиванию системы "Тестирование" с помощью docker

* Перейдите в папку с проектом и создайте в корне файлик `.env` и папку `databases`
* В файле `.env`  пропишите переменные
  
1. У вас должен быть установлен докер
2. Клонируйте проект
3. Перейдите в папку с проектом и создайте в корне файлик `.env` и папку `databases`
4. В файле .env  пропишите переменные
```
DB_PATH_HOST=./databases
APP_PATH_HOST=./NIAC
APP_PATH_CONTAINER=/var/www/html/
```
* Перейдите в папку `NIAC`, продублируйте файл `.env.example` и переименуйте его в `.env`
* В файле `NIAC\.env` замените строки:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=niac_test
DB_USERNAME=root
DB_PASSWORD=123456
```
* Откройте терминал в папке проекта (в корне, где `docker-compose.yml`) и выпоните команду:
```
docker-compose up --build
```
* Откройте другую вкладку в терминале и выполните:
```
docker-compose exec web bash
```
* Выполните команду ``` php artisan key:generate ```, затем exit
* Откройте браузер, в адресной строке введите [http://127.0.0.1:6080](http://127.0.0.1:6080)
* Введите 
```
Сервер: db
Пользователь: root
Пароль: 123456
```
* Создайте базу данных `niac_test` и импортируйте в нее `niac_test.sql`
* В адресной строке браузера введите [http://127.0.0.1:8080](http://127.0.0.1:8080)
* **УРА!!!** Вы в системе, теперь введите идентивиционные номер `1` и пароль `123456`
