# Panduan Setup Backend Laravel & XAMPP MySQL — PT SOSM Dashboard

Backend ini dibangun menggunakan **Laravel 11** dan terhubung ke database **MySQL di XAMPP**, sehingga seluruh tim PT SOSM di jaringan kantor dapat mengisi, mengedit, dan melihat data proyek yang langsung tersimpan di database MySQL Anda secara terpusat.

---

## 📋 Langkah 1: Jalankan Apache & MySQL di XAMPP

1. Buka aplikasi **XAMPP Control Panel**.
2. Klik tombol **Start** pada modul **Apache** dan **MySQL**.
3. Pastikan lampu indikator berwarna hijau (MySQL berjalan di port `3306`).

---

## 🗄️ Langkah 2: Buat Database di phpMyAdmin

1. Buka browser dan ketik alamat: [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Klik menu **Databases** (Basis Data) atau klik **New** di panel kiri.
3. Masukkan nama database:
   ```sql
   pt_sosm_tracking
   ```
4. Pilih collation: `utf8mb4_unicode_ci` (bawaan).
5. Klik tombol **Create** (Buat).

---

## ⚡ Langkah 3: Jalankan Migrasi & Data Excel Awal (Seed)

Buka aplikasi **Terminal** di Mac Anda, lalu jalankan perintah berikut:

```bash
# 1. Masuk ke folder backend
cd "/Users/andina/Desktop/Coding 1/backend"

# 2. Jalankan migrasi tabel dan masukkan data awal (23 recruitment + 15 ADM)
php artisan migrate --seed
```

Hasilnya akan membuat tabel `projects` dan otomatis mengisinya dengan seluruh proyek awal dari Excel PT SOSM 2026.

---

## 🌐 Langkah 4: Jalankan Server Laravel

Agar komputer Anda dan **laptop orang lain di tim kantor** bisa mengakses database ini, jalankan server dengan perintah:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

> **Tips Mengetahui IP Komputer Anda untuk Tim Kantor:**
> 1. Buka Terminal baru, ketik `ipconfig getifaddr en0` (misal muncul: `192.168.1.50`).
> 2. Laptop Anda bisa membuka dashboard dengan URL: `http://localhost:8000/api`.
> 3. Laptop anggota tim lain (Dina, Ingga, Herindra, dll.) cukup membuka dashboard dan menghubungkan ke URL IP Anda: `http://192.168.1.50:8000/api`.
> 4. Setiap kali mereka mengedit, datanya langsung masuk ke database MySQL XAMPP di komputer Anda!

---

## 🔗 Langkah 5: Hubungkan ke Dashboard (`index.html`)

1. Buka file `index.html` di browser.
2. Di header bagian atas, klik tombol **Team Cloud** / **Connect Cloud**.
3. Pilih tab **Laravel (XAMPP MySQL)**.
4. Masukkan URL: `http://localhost:8000/api` (atau `http://<IP_ANDA>:8000/api` untuk tim lain).
5. Klik **Test Connection** (akan muncul notifikasi hijau jika berhasil tersambung).
6. Klik **Save & Connect**.
7. Selesai! Indikator di header akan berubah menjadi **🟢 Laravel MySQL**.

---

## 🛠️ Endpoint REST API yang Tersedia:

| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/api/health` | Status server & koneksi database MySQL |
| `GET` | `/api/projects` | Mengambil seluruh data proyek (Recruitment & ADM) |
| `GET` | `/api/projects?division=recruitment` | Filter proyek berdasarkan divisi |
| `POST` | `/api/projects` | Menambah proyek baru ke database |
| `GET` | `/api/projects/{id}` | Mengambil detail 1 proyek |
| `PUT` | `/api/projects/{id}` | Mengupdate nama, PIC, activities, status, remark |
| `PATCH` | `/api/projects/{id}/toggle-stage` | Menchecklist/uncheck tahapan pipeline |
| `DELETE` | `/api/projects/{id}` | Menghapus proyek dari database |
| `POST` | `/api/projects/bulk-sync` | Sinkronisasi massal seluruh dashboard |
| `POST` | `/api/reset` | Mereset database kembali ke data awal file Excel |
