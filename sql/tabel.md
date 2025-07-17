# Dokumentasi Struktur Tabel Database
---

## ✅ `users`
**Primary Key:** `id`

| Nama Kolom | Key       | Keterangan Singkat                |
|------------|-----------|----------------------------------|
| `id`       | pk        | ID unik pengguna                 |
| `username` | none      | Nama akun pengguna               |
| `password` | none      | Password dalam bentuk hash       |
| `role`     | none      | Hak akses: admin atau staff      |


## ✅ `categories`
**Primary Key:** `id`

| Nama Kolom | Key   | Keterangan Singkat           |
|------------|--------|------------------------------|
| `id`       | pk     | ID unik kategori             |
| `name`     | none   | Nama kategori barang         |


## ✅ `suppliers`
**Primary Key:** `id`

| Nama Kolom | Key   | Keterangan Singkat         |
|------------|--------|----------------------------|
| `id`       | pk     | ID unik supplier           |
| `name`     | none   | Nama perusahaan supplier   |


## ✅ `warehouses`
**Primary Key:** `id`

| Nama Kolom | Key   | Keterangan Singkat       |
|------------|--------|--------------------------|
| `id`       | pk     | ID gudang penyimpanan    |
| `name`     | none   | Nama gudang              |


## ✅ `items`
**Primary Key:** `id`

| Nama Kolom     | Key    | Keterangan Singkat                        |
|----------------|--------|-------------------------------------------|
| `id`           | pk     | ID barang                                 |
| `name`         | none   | Nama barang                               |
| `category_id`  | fk     | Kategori barang (relasi ke `categories`)  |
| `supplier_id`  | fk     | Supplier barang (relasi ke `suppliers`)   |
| `warehouse_id` | fk     | Gudang tempat barang disimpan             |
| `unit`         | none   | Satuan barang (pcs, kg, liter)            |
| `quantity`     | none   | Jumlah stok tersedia                      |


## ✅ `stock_in`
**Primary Key:** `id`

| Nama Kolom | Key   | Keterangan Singkat                         |
|------------|--------|--------------------------------------------|
| `id`       | pk     | ID transaksi barang masuk                 |
| `item_id`  | fk     | Barang yang masuk (relasi ke `items`)     |
| `quantity` | none   | Jumlah barang yang masuk                  |
| `date`     | none   | Tanggal masuk                             |
| `user_id`  | fk     | Penginput data (relasi ke `users`)        |


## ✅ `stock_out`
**Primary Key:** `id`

| Nama Kolom | Key   | Keterangan Singkat                         |
|------------|--------|--------------------------------------------|
| `id`       | pk     | ID transaksi barang keluar                |
| `item_id`  | fk     | Barang yang keluar (relasi ke `items`)    |
| `quantity` | none   | Jumlah barang keluar                      |
| `date`     | none   | Tanggal keluar                            |
| `user_id`  | fk     | Penginput data (relasi ke `users`)        |


## ✅ `activity_log`
**Primary Key:** `id`

| Nama Kolom   | Key   | Keterangan Singkat                      |
|--------------|--------|------------------------------------------|
| `id`         | pk     | ID log aktivitas                        |
| `user_id`    | fk     | Pengguna yang melakukan aktivitas       |
| `action`     | none   | Deskripsi aktivitas                     |
| `created_at` | none   | Waktu aktivitas dilakukan               |


## ✅ `settings`
**Primary Key:** `id`

| Nama Kolom | Key   | Keterangan Singkat           |
|------------|--------|------------------------------|
| `id`       | pk     | ID setting                   |
| `key`      | none   | Nama pengaturan              |
| `value`    | none   | Nilai pengaturan             |

## ✅ `logs`
**Primary Key:** `id`

| Nama Kolom   | Key   | Keterangan Singkat                |
|--------------|--------|------------------------------------|
| `id`         | pk     | ID log                            |
| `message`    | none   | Isi pesan log                     |
| `log_type`   | none   | Jenis log: login, error, update   |
| `created_at` | none   | Waktu pencatatan log              |
