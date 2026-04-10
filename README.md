# PDF Reading Progress System

## Deskripsi

Sistem ini memungkinkan pengguna melanjutkan pembacaan file PDF dari halaman terakhir yang dibaca. File PDF disimpan di Google Drive, sementara sistem Laravel digunakan sebagai perantara untuk menampilkan dan mengontrol proses pembacaan.

## Fitur Utama

* Menampilkan file PDF dari Google Drive
* Menyimpan halaman terakhir yang dibaca
* Melanjutkan pembacaan secara otomatis saat file dibuka kembali

## Teknologi

* Laravel
* MySQL
* PDF.js
* Google Drive

## Cara Menjalankan

1. Install dependency:

   ```
   composer install
   ```
2. Jalankan server:

   ```
   php artisan serve
   ```
3. Akses melalui browser:

   ```
   http://127.0.0.1:8000/pdf/{file_id}
   ```

## Catatan

Sistem menggunakan pendekatan proxy untuk mengatasi pembatasan akses langsung (CORS) dari Google Drive.
