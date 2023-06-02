<h1 align="center">Kania Booking System</h1>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<hr>

## Requirements

Install requirements dibawah ini:

- PHP >= 8.1.10
- MySql >= 8.0.30
- Composer >= 2.4.1
- NodeJS >= 18.8.0
- NPM >= 8.18.0

Disarankan menggunakan Laragon untuk memudahkan develop pada local environment.

<hr>

## Deployment

### Local

Install dependensi laravel:

```composer install```

Install dependensi frontend:

```npm install```

Link storage laravel

```php artisan storage:link```

Migrasi database (pastikan settingan database sudah sesuai pada file .env)

```php artisan migrate --seed```

Build library frontend

```npm run build```

Jalankan server laravel

```php artisan serve```

<br>

Akun default admin adalah sebagai berikut:

Email: ```admin@admin.com``` | Password: ```admin```