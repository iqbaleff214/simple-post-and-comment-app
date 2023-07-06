# Laravel Test

---

## Skema Database
<img src="https://github.com/okanemo/M.-Iqbal-Effendi/blob/main/docs/db.png" alt="database schema">

## Auth dan Pembatasan hak akses pengguna
Untuk fitur-fitur auth seperti login, register, dll pada proyek ini menggunakan Breeze. Adapun pembatasan hak akses hanya menggunakan middleware dan form request.

## Notifikasi Email dan Integrasinya
Secara default Laravel dan Breeze sudah mendukung notifikasi email, dan langsung bisa menggunakan mailtrap cukup dengan memasukkan kredensialnya di .env

## Cara install
Untuk setup sama seperti app laravel pada umumnya, cukup jalankan beberapa perintah dibawah:
```shell
composer install
```

```shell
npm run build
```

```shell
php artisan migrate --seed
```

Dan untuk menjalankan mode development
```shell
php artisan serve
```

## Cara deployment/hosting
Sama seperti deployment laravel pada umumnya.

## Unit Test
```shell
php artisan test
```
