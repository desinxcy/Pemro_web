# 🧭 Alur Penggunaan Website – Sistem Manajemen Gudang
---
## 🧑‍💻 Login
1. Pengguna membuka website dan login dengan username & password.
2. Sistem mengecek role pengguna:
3. Admin → akses penuh.
4. Staff → akses terbatas ke: Tambah Barang, Stok Masuk, dan Stok Keluar.

## 🏠 Dashboard
- Menampilkan ringkasan:
- Jumlah Jenis Barang
- Stok Masuk 
- Stok Keluar 


## 📦 Manajemen Barang
__(Hanya Admin & Staff)__

- Tambah Barang Baru

- Edit Informasi Barang

- Hapus Barang

- Melihat daftar barang lengkap (kategori, stok, supplier, gudang)

## ➕ Stok Masuk
__(Admin & Staff)__
- Pilih barang
- Input jumlah masuk dan tanggal
- Sistem otomatis menambahkan ke stok

## ➖ Stok Keluar
__(Admin & Staff)__

- Pilih barang

- Input jumlah keluar dan tanggal

- Sistem otomatis mengurangi stok

- Validasi stok agar tidak negatif

## 📂 Kategori / Supplier / Gudang
__(Hanya Admin)__

- Tambah, ubah, atau hapus kategori barang

- Kelola data supplier

- Kelola daftar gudang penyimpanan

## 👥 Manajemen Pengguna
__(Hanya Admin)__

- Tambah pengguna baru

- Atur role: admin atau staff

- Hapus atau ubah data pengguna

## 🕵️‍♂️ Log Aktivitas
__(Hanya Admin)__

- Melihat semua aktivitas sistem:

- Siapa login

- Tambah/edit barang

- Aksi stok masuk & keluar

- Data tersimpan otomatis di activity_log

## 🚪 Logout
- Pengguna dapat logout untuk mengakhiri sesi.