# Gudang Penyimpanan
---
Aplikasi ini dirancang untuk membantu pencatatan dan pengelolaan stok barang masuk dan keluar dari gudang.
url webiste gudang 
```
https://rivaldi.mangaverse.my.id/
```
## Youtube
- [link youtube](https://youtu.be/NvdsuokticE)

## 💻 Sistem

1. XAMPP: versi 3.3.0
2.  Web Server Apache: versi 8.0.30 
3. PHP: Versi 8.0.30
4. MySQL: Versi 10.4.32 MariaDB

## 🔑Akses Login
- __Admin__
  Username: <span style="color: #e47e3aff;">remi</span>
  Password: <span style="color: #e47e3aff;">admin</span>

- __Staff__
  Username: <span style="color: #e47e3aff;">regi</span>
  Password: <span style="color: #e47e3aff;">1234</span>


## 📂Project File
- Salin [folder src](https://github.com/desinxcy/projectUasPemrograman/tree/src) ke direktori htdocs dan beri nama _guda_ 
```
xampp\htdocs\guda
```

- Download file [guda.sql](https://raw.githubusercontent.com/desinxcy/Pemro_web/main/sql/guda.sql)
- kemudian klik tombol "ctrl + s" untuk menyimpan file

## 🖥️ Lokal Server

- Buka aplikasi XAMPP 
- Aktifkan layanan _Apache_ dan _Mysql_

## 🗄️Buat Database 

- Buka _phpmyadmin_ di browser dengan menggunakan url:
```
  http://localhost/phpmyadmin
```
- Import file __guda.sql__ untuk membuat database
## 🧩Skema Alur Penggunaan

klik link ini untuk melihat [Penjelasan lebih lengkap tentang cara penggunaan](https://github.com/desinxcy/Pemro_web/blob/main/docs/caraPenggunaan.md)
```
[Login] --> [Dashboard]
              ↓
     [Barang] → [Stok Masuk]
              → [Stok Keluar]
              → [Kategori | Supplier | Gudang] ← (Admin Only)
              → [User Management] ← (Admin Only)
              → [Log Aktivitas] ← (Admin Only)
              ↓
            [Logout]
```
## Diagram ERD

![FOTO](sql/foto.png)



