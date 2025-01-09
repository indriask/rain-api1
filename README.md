# RAIN - Aplikasi Magang untuk Mahasiswa Politeknik Negeri Batam

RAIN (Ready For An Internship) adalah platform berbasis web yang dirancang khusus untuk mahasiswa Politeknik Negeri Batam dan perusahaan yang bekerja sama dengan Politeknik Negeri Batam. Aplikasi ini bertujuan untuk mempermudah proses pengelolaan dan pencarian lowongan magang, serta meningkatkan kolaborasi antara kampus dan mitra perusahaan.

## Fitur Utama

### 1. Untuk Mahasiswa
- **Pendaftaran dan Login**: Mahasiswa Politeknik Negeri Batam dapat mendaftar menggunakan akun kampus mereka.
- **Pencarian Lowongan**: Menampilkan daftar lowongan magang dari perusahaan mitra.
- **Pengajuan Lamaran**: Mahasiswa dapat langsung melamar ke lowongan yang tersedia.
- **Riwayat Lamaran**: Melacak status lamaran (Diterima, Ditolak, atau Dalam Proses).

### 2. Untuk Perusahaan
- **Pendaftaran dan Login**: Perusahaan mitra dapat mendaftar dan mengelola akun mereka.
- **Posting Lowongan**: Perusahaan dapat menambahkan lowongan magang baru.
- **Pengelolaan Pelamar**: Memantau daftar pelamar, melakukan seleksi, dan memberikan keputusan.

### 3. Untuk Admin
- **Validasi Lowongan**: Admin memverifikasi lowongan yang diunggah oleh perusahaan.
- **Manajemen Data Pengguna**: Mengelola data mahasiswa dan perusahaan.

## Teknologi yang Digunakan
- **Frontend**: HTML, CSS, JavaScript, Bootstrap.
- **Backend**: Node.js dengan Express.
- **Database**: MySQL.
- **Authentication**: JWT (JSON Web Token).
- **Deployment**: Platform seperti Vercel atau Heroku.

## Alur Pengguna

### Mahasiswa:
1. Login menggunakan email kampus.
2. Mencari lowongan berdasarkan kategori atau perusahaan.
3. Melamar ke lowongan yang diinginkan.
4. Memantau status lamaran melalui dashboard.

### Perusahaan:
1. Login atau mendaftar sebagai mitra perusahaan.
2. Mengunggah lowongan baru.
3. Meninjau daftar pelamar dan mengambil keputusan.

### Admin:
1. Memvalidasi lowongan yang diunggah oleh perusahaan.
2. Mengelola data mahasiswa dan perusahaan.

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