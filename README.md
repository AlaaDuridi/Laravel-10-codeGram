<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## OpenAI with Laravel 
<br>
[Core package]: (https://github.com/openai-php/client)
<br>
[Laravel package]: (https://github.com/openai-php/laravel)
<br>
>composer require openai-php/laravel <br>
>php artisan vendor:publish --provider="OpenAI\Laravel\ServiceProvider"<br>
- write example code, [example:](web.php, Route:/openai)<br>
- get authenticated by OpenAI, bring the  OPENAI_API_KEY and OPENAI_ORGANIZATION, and plce them in the .env file <br>
- [maybe] you need to install cacert.pem following the instructions at https://curl.se/docs/caextract.html .<br>
-save it on your filesystem somewhere (for example, XAMPP users might use C:\xampp\php\extras\ssl\cacert.pem)<br>
-in your php.ini, put this file location in the [curl] section 
(putting it in the [openssl] section is also a good idea):<br>

[curl]<br>
curl.cainfo = "C:\xampp\php\extras\ssl\cacert.pem"<br>
<br>

[openssl]<br>
openssl.cafile = "C:\xampp\php\extras\ssl\cacert.pem"<br>



