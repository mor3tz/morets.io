Untuk yang baru clone repo berikut cara menjalankan app nya

1. composer install
2. cp .env.example .env  (ganti db_connection menjadi mysql dan atur koneksi databasenya)
3. php artisan migrate --seed
4. php artisan key:generate
5. npm install
6. php artisan serve dan npm run dev (harus jalan bersamaan)

username dan password buat akun admin :
-   username : admin
-   password : 12345678