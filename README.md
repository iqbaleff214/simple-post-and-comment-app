# Laravel Test

Aplikasi ini adalah media sosial sederhana untuk mem-posting apapun yang pengguna inginkan dan orang lain dapat memberikan komentar atas postingan tersebut. Aplikasi ini bukan sekadar aplikasi CRUD yang menambahkan semua fungsionalitas CRUD pada semua table di database, melainkan hanya memanfaatkan beberapa fungsi CRUD sesuai dengan kebutuhan fitur.

## Fitur

Terdapat dua hak akses pada aplikasi ini, yakni: Pengguna(_user_) dan Admin(_admin_)

- Pengguna dapat melakukan log in, register, verifikasi email, dan reset password jika lupa
- Pengguna dapat melihat, mencari, memilah, dan mengurutkan postingannya sendiri maupun postingan orang lain
- Pengguna dapat memberikan komentar pada postingannya sendiri maupun orang lain
- Pengguna hanya dapat mengedit dan menghapus postingan-nya sendiri
- Pengguna dapat mengganti nama, email, dan password-nya
- Pengguna dapat menghapus akunnya sendiri

Adapun jika log in sebagai Admin, maka:

- Admin dapat melihat, mencari, memilah, dan mengurutkan postingan pengguna
- Admin dapat memberikan komentar pada postingan Pengguna
- Admin dapat menghapus postingan Pengguna
- Admin dapat melihat, mencari, dan mengurutkan akun Pengguna
- Admin dapat menghapus akun Pengguna
- Admin dapat melihat, mencari, dan mengurutkan tag postingan
- Admin dapat menambahkan, mengedit, dan menghapus tag postingan

## Skema Database
<img src="https://github.com/okanemo/M.-Iqbal-Effendi/blob/main/docs/db.png" alt="database schema">

## Auth dan Pembatasan hak akses pengguna
Untuk fitur-fitur auth seperti login, register, dll pada proyek ini menggunakan Breeze. Adapun pembatasan hak akses hanya menggunakan middleware dan form request.

## Notifikasi Email dan Integrasinya
Secara default Laravel dan Breeze sudah mendukung notifikasi email, dan langsung bisa menggunakan mailtrap cukup dengan memasukkan kredensialnya di .env.
Pada proyek ini notifikasi email akan dikirim pada beberapa kejadian, yakni: verifikasi akun, komentar baru, dan penghapusan akun oleh admin.

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
