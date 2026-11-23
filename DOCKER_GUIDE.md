# Panduan Mengonlinekan Dashboard PT SOSM dengan Docker & Cloud

Panduan ini menjelaskan cara membuat dashboard dan database Anda bisa diakses dan diedit oleh seluruh tim.

---

## 💡 Memahami Cara Kerja Docker

Docker membungkus 3 komponen aplikasi Anda ke dalam container:
1. **Container Web (Nginx)**: Menyajikan `index.html` pada port `8080`.
2. **Container Backend (Laravel 11)**: Menyediakan REST API data proyek pada port `8000`.
3. **Container Database (MySQL 8.0)**: Menyimpan database `pt_sosm_tracking` secara terpusat dan permanen.

Dengan Docker, Anda **tidak perlu lagi membuka XAMPP secara manual**. Cukup 1 perintah, seluruh sistem langsung aktif!

---

## 🛠️ Langkah 1: Buka & Selesaikan Setup Docker Desktop

Karena Anda baru saja mendownload Docker di Mac:
1. Buka **Finder** > **Applications** (Aplikasi).
2. Klik ganda ikon **Docker** (atau Docker Desktop).
3. Jika muncul pertanyaan *"Docker wants to make changes"*, masukkan password Mac Anda untuk mengizinkan instalasi komponen command line.
4. Tunggu sampai ikon ikan paus Docker di menu bar atas Mac Anda statusnya **"Docker Desktop is running"** (ikon paus tidak bergerak lagi).

---

## 🚀 Langkah 2: Jalankan Aplikasi Menggunakan Docker

Buka aplikasi **Terminal** di Mac Anda, lalu ketik perintah:

```bash
# 1. Masuk ke folder proyek Anda
cd "/Users/andina/Desktop/Coding 1"

# 2. Jalankan seluruh container (Web, Laravel & MySQL) di background
docker compose up -d
```

> **Catatan Pertama Kali**: Docker akan mendownload image dan melakukan build (sekitar 1-2 menit). Setelah selesai, ketiga container (`pt_sosm_mysql`, `pt_sosm_backend`, `pt_sosm_web`) akan berstatus **running**.

Untuk mengecek statusnya kapan saja:
```bash
docker compose ps
```

---

## 🌐 Skenario A: Tim Membuka di Jaringan Kantor (Satu Wi-Fi / LAN)

Jika tim Anda bekerja di kantor yang sama dan terhubung ke Wi-Fi / kabel LAN yang sama:

1. **Alamat untuk Anda sendiri**:
   Buka browser di Mac Anda:
   👉 `http://localhost:8080`

2. **Alamat untuk Anggota Tim (Dina, Ingga, Herindra, dll.)**:
   Kirimkan alamat IP Anda ke tim:
   👉 `http://192.168.0.110:8080`

3. **Kelebihan**:
   - Anggota tim langsung bisa melihat dashboard dan mengedit data tanpa perlu download Docker atau salin file HTML lagi.
   - Dashboard sudah otomatis terhubung ke database MySQL di container Docker Anda.
   - Sangat cepat dan tidak membutuhkan kuota internet luar.

---

## 🌍 Skenario B: Mengonlinekan ke Internet Publik (Bisa Diakses dari Luar Kantor / WFH / HP)

Jika anggota tim sedang WFH, dinas luar, atau tidak satu Wi-Fi dengan laptop Anda, gunakan **Cloudflare Tunnel (Gratis, Resmi & Aman)**:

### Cara Menggunakan Cloudflare Tunnel (1 Menit):
1. Install Cloudflared via Terminal:
   ```bash
   brew install cloudflared
   ```
2. Jalankan tunnel ke container web Anda (port 8080):
   ```bash
   cloudflared tunnel --url http://localhost:8080
   ```
3. Terminal akan menampilkan link publik HTTPS resmi, contoh:
   ```text
   https://random-name-subdomain.trycloudflare.com
   ```
4. **Bagikan link HTTPS tersebut ke tim Anda via WhatsApp / Email**.
5. Siapapun yang membuka link tersebut di HP atau laptopnya bisa langsung melihat, mengedit, mencentang checklist, dan menambah data proyek. Semua perubahan otomatis masuk ke database di laptop Anda!

---

## ⏹️ Cara Mematikan & Menyalakan Kembali Docker

- **Untuk mematikan saat selesai kerja**:
  ```bash
  cd "/Users/andina/Desktop/Coding 1"
  docker compose down
  ```
  *(Data database tidak akan hilang karena tersimpan aman di volume Docker).*

- **Untuk menyalakan kembali esok hari**:
  ```bash
  cd "/Users/andina/Desktop/Coding 1"
  docker compose up -d
  ```
