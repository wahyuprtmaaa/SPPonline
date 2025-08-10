# 🏫 SPP Online - Sistem Pembayaran SPP Berbasis Laravel  

## 📌 Deskripsi  
**SPP Online** adalah aplikasi berbasis **Laravel 10** yang memungkinkan siswa untuk melakukan pembayaran SPP secara online. Sistem ini dirancang untuk mempermudah administrasi sekolah dalam mengelola pembayaran SPP, mencatat transaksi, serta memberikan notifikasi kepada siswa atau wali murid.  

## 🚀 Fitur Utama  
✅ **Manajemen Pengguna** (Admin, Operator, Siswa)  
✅ **Pembayaran SPP Online** (Metode pembayaran digital)  
✅ **Riwayat Transaksi** (Laporan pembayaran per siswa)  
✅ **Notifikasi Pembayaran** (WhatsApp)
✅ **Dashboard Statistik** (Grafik pemasukan sekolah)  
✅ **Role-Based Access Control** (Spatie Laravel Permission)  

## 🛠 Teknologi yang Digunakan  
- ⚡ **Laravel 10** – Framework PHP yang modern dan powerful  
- ⚡ **MySQL** – Database untuk menyimpan data pembayaran  
- ⚡ **Bootstrap – Tampilan UI yang responsif
- ⚡ **Larapex Charts** – Visualisasi laporan transaksi  

## 📥 Instalasi dan Penggunaan  

### **1. Clone Repository**  
```bash
git clone https://github.com/wahyuprtmaaa/SPP-Online.git
cd SPP-Online
```

### **2. Instal Dependensi**  
```bash
composer install
npm install
```

### **3. Konfigurasi Environment**  
```bash
cp .env.example .env
php artisan key:generate
```
Sesuaikan konfigurasi database di file `.env`.

### **4. Jalankan Migrasi dan Seeder**  
```bash
php artisan migrate --seed
```
Seeder akan membuat akun admin default.

### **5. Jalankan Aplikasi**  
```bash
php artisan serve
```

### **6. Login Admin (Default Credentials)**  
- **Email**: `admin@gmail.com`  
- **Password**: `admin123`  

## 📊 Tampilan Aplikasi  
![Dashboard](https://raw.githubusercontent.com/wahyuprtmaaa/SPPonline/main/public/assets/images/screenshoot.png)


## 🤝 Kontribusi  
Jika Anda ingin berkontribusi, silakan fork repository ini dan buat pull request!  

## 📜 Lisensi  
Proyek ini dilisensikan di bawah **MIT License**.
