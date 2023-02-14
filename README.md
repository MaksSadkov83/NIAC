<p align="center"<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></p>

## Инструкци по разворачиванию системы "Тестирование" с помощью docker

1. На вашем компьютере должен быть установлен docker.
2. Создайте папку с лююбым именем. В ней будет развернута система.
3. В созданной папке создайте файлик .env. В ней пропишите переменные.
4. В папке создайте еще подпапки с именами web и databases.
5. В файле .env пропишите переменные:
    * DB_PATH_HOST=./databases
    * APP_PATH_HOST=./NIAC
    * APP_PATH_CONTAINER=/var/www/html/
    
6. В корне папки (не в подпапках) создайте файл docker-compose.yml
7. В созданном файле docker-compose.yml пропишите:

    version: '3.8'

    services:

      web:
        build: ./web
        environment:
          - APACHE_RUN_USER=#1000
        volumes:
          - ${APP_PATH_HOST}:${APP_PATH_CONTAINER}
        ports:
          - 8080:80
        working_dir: ${APP_PATH_CONTAINER}

      db:
        image: mariadb:10.6
        restart: always
        environment:
          MYSQL_ROOT_PASSWORD: 123456
        volumes:
          - ${DB_PATH_HOST}:/var/lib/mysql

      phpmyadmin:
        image: phpmyadmin
        restart: always
        ports:
          - 6080:80
        environment:
          - PMA_ARBITRARY=1

      composer:
        image: composer:2.5.3
        volumes:
          - ${APP_PATH_HOST}:${APP_PATH_CONTAINER}
        working_dir: ${APP_PATH_CONTAINER}
        command: composer install
  
8. Запустите терминал и перейдите в папку с проектом.
9. В корень папки клонируйте проект
10. В запустите терминале, перейдите в папку с проектом и запустите комнаду docker-compose up --build.
11. Перейдите в папку NIAC продублируйте папку .env.example, переминуйте его на .env.
12. В терминале (в другой вкладке) запустите команду docker-compose exec web bash.
13. В терминале запустите команду php artisan key:generate. exit
14. Перейдите в папку NIAC в файлике .env пропишите:

    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=niac_test
    DB_USERNAME=root
    DB_PASSWORD=123456
    
15. Запустите браузер, в адресной строке введите http://127.0.0.1:6080
16. Создайте базу данных с названием niac_test (ОБЯЗАТЕЛЬНО!!!!)
17. Импортируйте базу данных (в группе лежит скачайте).
18. В адресной строке браузера введите http://127.0.0.1:8080.
19. УРА!!! Ситема развернута (Идентифиционные номер: 5; пароль: 123456)
