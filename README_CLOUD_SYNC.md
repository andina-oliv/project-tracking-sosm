# Panduan Sinkronisasi Multi-User PT SOSM Dashboard

Dashboard Tracking PT SOSM sekarang sudah dilengkapi fitur **Team Cloud Sync**, sehingga seluruh anggota tim (Dina, Ingga, Herindra, Lifia, dan tim lainnya) dapat:
1. Membuka dashboard dari laptop masing-masing.
2. Mengisi dan mengupdate data proyek (menambah proyek, mencentang tahapan pipeline, mengubah remark, menghapus proyek).
3. Melihat data yang otomatis tersinkronisasi dan terupdate secara bersamaan (Multi-User Collaboration).

---

## 🚀 Cara Setup Menggunakan Google Sheets (Paling Mudah, Gratis & Tanpa Server)

Hanya perlu waktu **2 menit** dan dapat digunakan oleh seluruh anggota tim kantor selamanya:

### Langkah 1: Buat Google Spreadsheet
1. Buka [Google Drive](https://drive.google.com/) menggunakan akun Google kantor / pribadi.
2. Buat Spreadsheet baru, beri nama misalnya: **`PT SOSM - Live Project Tracking 2026`**.

### Langkah 2: Pasang Skrip Backend
1. Di Google Sheets tersebut, klik menu **Extensions (Ekstensi)** > **Apps Script**.
2. Hapus semua teks yang ada di editor tersebut.
3. Buka file [google-apps-script.js](file:///Users/andina/Desktop/Coding%201/google-apps-script.js) di folder ini, lalu **salin (copy) seluruh kodenya** dan paste ke editor Google Apps Script.
4. Klik ikon **Save (Simpan / Ctrl+S)**.

### Langkah 3: Deploy sebagai Web App
1. Di kanan atas editor Apps Script, klik tombol biru **Deploy** > **New deployment**.
2. Klik ikon gerigi di sebelah kiri "Select type", lalu pilih **Web app**.
3. Isi konfigurasi sebagai berikut:
   - **Description**: `PT SOSM Dashboard Backend`
   - **Execute as**: `Me (email Anda)`
   - **Who has access**: `Anyone` *(PENTING: Pilih "Anyone" agar seluruh anggota tim dapat membaca & menulis ke dashboard tanpa perlu login API yang rumit)*.
4. Klik tombol **Deploy**.
5. Jika Google meminta izin (*Authorization Required*):
   - Klik **Authorize access**.
   - Pilih akun Google Anda.
   - Klik **Advanced (Lanjutan)** di pojok kiri bawah > klik **Go to Untitled project (unsafe)**.
   - Klik **Allow**.
6. Salin **Web app URL** yang muncul (URL berakhiran `/exec`, contoh: `https://script.google.com/macros/s/AKfycbx.../exec`).

### Langkah 4: Hubungkan ke Dashboard
1. Buka file `index.html` dashboard di browser.
2. Di header bagian atas, klik tombol **Team Cloud** (atau *Connect Cloud*).
3. Paste URL Web App yang tadi disalin ke kolom **Google Apps Script Web App URL**.
4. Klik tombol **Test Connection** (akan muncul notifikasi hijau jika berhasil).
5. Klik **Save & Connect**.
6. Selesai! Indikator di header akan berubah menjadi **🟢 Sheets Cloud**.

---

## 👥 Cara Tim Lain Menggunakannya
Cukup bagikan URL Web App atau file `index.html` ini ke tim SOSM:
- Setiap kali ada anggota tim yang mencentang tahapan atau menambah proyek baru, data akan otomatis terkirim ke Google Spreadsheet dalam kurun waktu < 1 detik.
- Dashboard seluruh anggota tim akan otomatis menyinkronkan data terbaru setiap 15 detik (atau bisa klik ikon putar **Sync Now** di header untuk update seketika).
- Riwayat perubahan juga tersimpan aman di menu **File > Version history** pada Google Spreadsheet tersebut.
