# Sistem Manajemen Inventaris & Logistik Barang (CRUD Web App)

Aplikasi web sederhana untuk pengelolaan data inventaris dan aset logistik kantor berbasis **Laravel v12** dan database **MySQL**. Proyek ini dikembangkan sebagai pemenuhan **Technical Test Program Praktik/Pemagangan (PPI)**.

---

## 📌 Fitur Aplikasi

Aplikasi ini mencakup fungsi pengelolaan data secara menyeluruh (CRUD) dengan fitur pendukung yang terstruktur:

1. **Manajemen Data Barang (CRUD Utama)**:
    - **Create**: Menambahkan barang baru dengan validasi form (kode unik, nama, kategori, stok, satuan, harga satuan, kondisi, lokasi gudang, dan unggah foto/gambar).
    - **Read**: Menampilkan tabel inventaris responsif lengkap dengan paginasi, pencarian cepat (nama, kode, atau lokasi), filter kategori, filter kondisi fisik, dan filter status ketersediaan stok.
    - **Update**: Memperbarui informasi barang beserta opsi mengganti atau mempertahankan foto yang sudah ada.
    - **Delete**: Menghapus data barang dengan modal konfirmasi aman dan otomatis membersihkan berkas foto terkait dari penyimpanan server.
    - **Detail / Show**: Halaman rincian spesifikasi barang, foto ukuran penuh, dan riwayat waktu pembaruan.

2. **Ringkasan Metrik Dashboard**:
    - Total jenis barang terdaftar.
    - Total kuantitas stok fisik.
    - Estimasi total nilai aset inventaris (dalam format mata uang Rupiah).
    - Jumlah barang dengan stok kritis/menipis (indikator otomatis).

3. **Manajemen Kategori Barang (Relasional)**:
    - CRUD data kategori (Elektronik, ATK, Furnitur, Logistik, Kebersihan, dll.) yang berelasi langsung (_One-to-Many_) dengan data barang.

4. **Validasi & Pengalaman Pengguna (UX)**:
    - Validasi menggunakan _Form Request_ dengan pesan berbahasa Indonesia.
    - _Client-side image preview_ sebelum foto diunggah.
    - Label badge dinamis untuk kondisi barang dan status ketersediaan stok.

---

## 🛠️ Tech Stack & Kebutuhan Sistem

- **PHP**: Versi >= 8.2 (Direkomendasikan PHP 8.3)
- **Framework**: Laravel 12.x
- **Database**: MySQL 8.x / MariaDB
- **Frontend / Styling**: Bootstrap 5.3 & Bootstrap Icons
- **Web Server Local**: Laragon / XAMPP / PHP Built-in Server

---

## 🗄️ Database & Berkas SQL

Sesuai ketentuan tes, berkas dump database MySQL telah disertakan di dalam repositori:

- **Lokasi Berkas**:
    - `db_inventaris_barang.sql` (di direktori root proyek)
    - `database/db_inventaris_barang.sql`

---

## 🚀 Panduan Instalasi & Menjalankan Proyek

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan lokal:

### 1. Clone Repositori

```bash
git clone https://github.com/haliza29/inventaris-barang-crud.git
cd inventaris-barang-crud
```

### 2. Install Dependensi Composer

```bash
composer install
```

### 3. Konfigurasi Environment (`.env`)

Salin berkas `.env.example` menjadi `.env`:

```bash
 cp.env.example .env
```

Pastikan pengaturan database pada `.env` telah disesuaikan dengan MySQL lokal Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_inventaris_barang
DB_USERNAME=root
DB_PASSWORD=
```

Generate application key:

```bash
php artisan key:generate
```

### 4. Setup Database

Anda dapat memilih salah satu dari dua cara berikut:

**Opsi A: Menggunakan Migration & Seeder Laravel (Praktis)**
Buat database baru dengan nama `db_inventaris_barang` di phpMyAdmin / MySQL CLI, lalu jalankan:

```bash
php artisan migrate:fresh --seed
```

**Opsi B: Import Berkas SQL Langsung**
Buat database baru bernama `db_inventaris_barang`, lalu import berkas `db_inventaris_barang.sql` melalui phpMyAdmin atau terminal:

```bash
mysql -u root db_inventaris_barang < db_inventaris_barang.sql
```

### 5. Buat Symbolic Link Storage

Perintah ini diperlukan agar foto barang yang diunggah dapat diakses oleh browser:

```bash
php artisan storage:link
```

### 6. Jalankan Server Aplikasi

```bash
php artisan serve
```

Buka browser Anda dan akses: **`http://127.0.0.1:8000`**

---

## 📂 Struktur Data Utama

### Tabel `kategoris`

| Kolom                       | Tipe Data    | Keterangan                         |
| --------------------------- | ------------ | ---------------------------------- |
| `id`                        | BigInt (PK)  | Auto increment ID                  |
| `kode_kategori`             | Varchar(20)  | Kode unik kategori (e.g. ELK, ATK) |
| `nama_kategori`             | Varchar(100) | Nama kategori                      |
| `deskripsi`                 | Text         | Penjelasan kategori                |
| `created_at` / `updated_at` | Timestamp    | Pencatatan waktu                   |

### Tabel `barangs`

| Kolom                       | Tipe Data    | Keterangan                                          |
| --------------------------- | ------------ | --------------------------------------------------- |
| `id`                        | BigInt (PK)  | Auto increment ID                                   |
| `kode_barang`               | Varchar(30)  | Kode unik identitas barang                          |
| `nama_barang`               | Varchar(150) | Nama lengkap barang                                 |
| `kategori_id`               | BigInt (FK)  | Relasi ke tabel `kategoris`                         |
| `stok`                      | Integer      | Jumlah kuantitas stok                               |
| `satuan`                    | Varchar(30)  | Satuan (Unit, Pcs, Box, Rim, dll.)                  |
| `harga_satuan`              | BigInt       | Estimasi harga barang (Rupiah)                      |
| `lokasi_penyimpanan`        | Varchar(100) | Ruangan / lokasi gudang penyimpanan                 |
| `kondisi`                   | Enum         | Kondisi fisik (Baik, Rusak Ringan, Perlu Perbaikan) |
| `deskripsi`                 | Text         | Spesifikasi atau catatan teknis barang              |
| `gambar`                    | Varchar(255) | Path penyimpanan berkas foto di storage             |
| `created_at` / `updated_at` | Timestamp    | Pencatatan waktu                                    |

---

## 👤 Pengembang

- **Nama**: Haliza Aufa Jawad
- **GitHub**: [@haliza29](https://github.com/haliza29)
- **Tujuan**: Technical Test PPI (Program Praktik/Pemagangan)
