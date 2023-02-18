<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></p>

## Инструкци по разворачиванию системы "Тестирование" с помощью docker

1. На вашем компьютере должен быть установлен docker.
2. Создайте папку с любым именем. В ней будет развернута система.
3. Клонируйте проект ``` git clone https://github.com/MaksSadkov83/NIAC.git```
4. Перейдите в папку склонированного проекта
5. В корне папки создайте файлик .env и папку databases.
6. В файле .env пропишите переменные:
```
DB_PATH_HOST=./databases
APP_PATH_HOST=./NIAC
APP_PATH_CONTAINER=/var/www/html/
```
7. Перейдите в папку NIAC, продублируйте файл .env.example и переименуйте его в .env
8. В файлике .env пропишите следующие значения в полях:
```
DB_CONNECTION=bd
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=niac_test
DB_USERNAME=root
DB_PASSWORD=123456
```
9. откройте терминал (В корне папки) и выполните команду: 
``` 
docker-compose up --build 
``` 
10. В другой вкладке терминала выполните команду:
```
docker-compose exec web bash
```
11. Выполните команду:
```
php artisan key:generate
```
12. После генерации ключа и папки vendor выполните команду exit
13. Откройте браузер, в адресной строке введите 
```
http://127.0.0.1:6080
```
14. Введите следуюущее:
```
Сервер: db
Пользователь: root
Пароль: 123456
```
15. В phpmyadmin сосздайте базу данных niac_test и импортируйте базу данных niac_test.sql
16. В адресной строке браузера введите:
```
http://127.0.0.1:8080
```
16. Ура!! Вы на странице авторизации, теперь введите Идентифиционные номер: 1 и пароль 123456
                    