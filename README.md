# RAIN - Aplikasi Magang untuk Mahasiswa Politeknik Negeri Batam

RAIN (Ready For An Internship) adalah platform berbasis web yang dirancang khusus untuk mahasiswa Politeknik Negeri Batam dan perusahaan yang bekerja sama dengan Politeknik Negeri Batam. Aplikasi ini bertujuan untuk mempermudah proses pengelolaan dan pencarian lowongan magang, serta meningkatkan kolaborasi antara kampus dan mitra perusahaan.

## Fitur Utama

### 1. Untuk Mahasiswa
- **Pendaftaran dan Login**: Mahasiswa Politeknik Negeri Batam dapat mendaftar menggunakan email.
- **Pencarian Lowongan**: Menampilkan daftar lowongan magang dari perusahaan mitra.
- **Pengajuan Lamaran**: Mahasiswa dapat langsung melamar ke lowongan yang tersedia.
- **Riwayat Lamaran**: Melacak status lamaran (Diterima, Ditolak, atau Dalam Proses).
- **Profile Pengguna**: Mahasiswa bisa menambahkan dan mengelola profile diri mereka sendiri.

### 2. Untuk Perusahaan
- **Pendaftaran dan Login**: Perusahaan mitra dapat mendaftar dan mengelola akun mereka.
- **Posting Lowongan**: Perusahaan dapat menambahkan lowongan magang baru.
- **Pengelolaan Pelamar**: Memantau daftar pelamar, melakukan seleksi, dan memberikan keputusan.
- **Profile Pengguna**: Perusahaan bisa menambahkan dan mengelola profile diri mereka sendiri.

### 3. Untuk Admin
- **Validasi Perusahaan**: Admin memverifikasi akun perusahaan.
- **Manajemen Data Pengguna**: Mengelola data mahasiswa dan perusahaan.
- **Mengelola Lowongan**: Mengelola lowongan yang telah di unggah.
- **Profile Pengguna**: Admin bisa menambahkan dan mengelola profile diri mereka sendiri.

## Teknologi yang Digunakan
- **Frontend**: HTML, CSS, JavaScript, Bootstrap.
- **Backend**: Laravel, PHP.
- **Database**: MySQL.
- **Deployment**: Local.

## Alur Pengguna

### Mahasiswa:
1. Login menggunakan email.
2. Mencari lowongan berdasarkan kategori atau perusahaan.
3. Melamar ke lowongan yang diinginkan.
4. Memantau status lamaran melalui dashboard.

### Perusahaan:
1. Login atau mendaftar sebagai mitra perusahaan.
2. Mengunggah lowongan baru.
3. Mengelola lowongan yang telah di unggah.
4. Meninjau daftar pelamar dan mengambil keputusan.

### Admin:
1. Mengelola akun mahasiswa dan perusahaan.
2. Mengelola lowongan yang telah di unggah.
2. Melakukan verifikasi pada akun perusahaan.

## Cara Menjalankan Proyek Secara Lokal

1. **Clone repository**:
   ```bash
   git clone https://github.com/username/RAIN.git
   cd RAIN
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Setup database**:
   - Buat database baru di MySQL.
   - Import file `rain_db.sql` yang ada di folder `database/`.
   - Update konfigurasi database di file `.env`.

4. **Jalankan server**:
   ```bash
   php artisan serve
   ```

5. **Akses aplikasi**:
   Buka browser dan akses `http://localhost:8000`.

## Struktur Folder
```
RAIN/
├── public/            # File static (CSS, JavaScript, images)
├── src/
│   ├── controllers/   # Logika aplikasi
│   ├── models/        # Model database
│   ├── routes/        # Definisi rute API
│   ├── views/         # Template halaman HTML
├── database/          # File SQL untuk inisialisasi database
├── .env               # Konfigurasi lingkungan
├── package.json       # Dependencies proyek
└── README.md          # Dokumentasi proyek
```

## Kontributor
1. **Eric Marchelino Hutbarat**
2. **Wasyn Sulaiman Siregar**
3. **Indria Bintani Aiska**
4. **Muhammad Aidil J. Saleh**
5. **Fito Desta Fabriansyah**
6. **Winda Tri Wulan Dari**