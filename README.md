# Best car hire service
## Чтобы запустить проект локально:
1. Склонировать проект с репозиторий:

    ```
    git clone https://github.com/kaharlykskyi/bsa-php-2017-laravel-5
    ```
2. Подключить зависимости проекта с помощью composer:

    ```
    composer install
    ```
3. Создать файл .env 

    ```
    cp .env.example .env
    ```
4. Сгенерировать ключ приложения с помощью ``artisan``

    ```
    php artisan key:generate
    ```
5. Создать базу данных, сконфигурировать .env и запустить:

    ```
    php artisan migrate
    ```
6. Для настройки авторизации через соц. сети (Google+, Github):
    - **для Github**
    
        1. Перейти на ``https://github.com/settings/profile`` в раздел `OAuth applications`
        
        2. Добавить новое приложение, заполнить поля `Application name`, `Homepage URL`, `Authorization callback URL`
        
        3. Полученные `client_id` и `client_secret` записать в .env (`GITHUB_ID`, `GITHUB_ID`)
        
    - **для Google**
    
        1. Перейти на ``https://console.developers.google.com/apis/credentials``
        
        2. Добавить новое приложение, заполнить поля `Application name`, `Homepage URL`, `Authorization callback URL`
        
        3. Полученные `client_id` и `client_secret` записать в .env (`GOOGLE_ID`, `GOOGLE_ID`)
        
    - Сформировать ``callback`` роуты в ``routes/web.php``
    - Добавить их в .env ``GITHUB_CALLBACK``, ``GOOGLE_CALLBACK`` соотвественно.
7. Запустить приложение на локальном веб-сервер или через встроенный в laravel:

    ```
    php artisan serve
    ```
8. Приложение доступно по адресу  ``http://127.0.0.1:8000/``&nbsp; \\~о_о~/


## Запуск тестов
1. Создайте APP_URL в .env, например (``http://127.0.0.1:8000``)
2. Запустите тесты

    ```
    php artisan dusk
    ```

