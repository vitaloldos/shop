Laravel PHP Framework

Build Status Total Downloads Latest Stable Version Latest Unstable Version License

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

Official Documentation

Documentation for the framework can be found on the Laravel website.

Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the Laravel documentation.

Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

License

The Laravel framework is open-sourced software licensed under the MIT license

Установка:

1. Переименовать .env.example в .env
2. Установить ключ командой php artisan key:generate
3. В файле .env заполнить поля 
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
5. Прописать хосты (до папки public включтельно).
6. Открыть доступ к папкам (с попдпапками и файлами) public и storage.
7. Таблицы в базе создаются миграциями: команда php artisan migrate

