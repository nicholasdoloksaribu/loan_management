# Loan Management System

Aplikasi manajemen pinjaman berbasis web yang dibangun menggunakan Laravel dan MySQL.

## Teknologi yang Digunakan

- **PHP** 8.4
- **Laravel** 13
- **MySQL**
- **Bootstrap** 5.3

## Fitur Aplikasi

### Master

- **User** — Manajemen data pengguna
- **Currency** — Manajemen data mata uang
- **Customer** — Manajemen data nasabah

### Transaction

- **Loan** — Manajemen data pinjaman
- **Payment** — Manajemen data pembayaran

## Cara Menjalankan Aplikasi

1. Extract file zip
2. Buat database MySQL sesuai dengan nama yang ada di file `.env`
3. Jalankan perintah berikut di terminal:

```bash
php artisan migrate
```

```bash
php artisan serve
```

4. Buka browser dan akses `http://localhost:8000/users`
