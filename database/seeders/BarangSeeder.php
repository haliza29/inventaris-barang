<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = \App\Models\Kategori::pluck('id', 'kode_kategori');

        $barangs = [
            [
                'kode_barang' => 'BRG-ELK-001',
                'nama_barang' => 'Laptop Lenovo ThinkPad L14 Gen 4',
                'kategori_id' => $kategoris['ELK'] ?? 1,
                'stok' => 12,
                'satuan' => 'Unit',
                'harga_satuan' => 14500000,
                'lokasi_penyimpanan' => 'Ruang IT Lantai 2',
                'kondisi' => 'Baik',
                'deskripsi' => 'Intel Core i5-1335U, RAM 16GB, SSD 512GB NVMe, OS Windows 11 Pro.',
                'gambar' => null,
            ],
            [
                'kode_barang' => 'BRG-ELK-002',
                'nama_barang' => 'Monitor LED Dell 24 Inch P2419H',
                'kategori_id' => $kategoris['ELK'] ?? 1,
                'stok' => 8,
                'satuan' => 'Unit',
                'harga_satuan' => 2350000,
                'lokasi_penyimpanan' => 'Ruang IT Lantai 2',
                'kondisi' => 'Baik',
                'deskripsi' => 'FHD IPS panel, pivot stand, konektor HDMI, DisplayPort, dan VGA.',
                'gambar' => null,
            ],
            [
                'kode_barang' => 'BRG-ELK-003',
                'nama_barang' => 'Mouse Wireless Logitech Silent M331',
                'kategori_id' => $kategoris['ELK'] ?? 1,
                'stok' => 4, // Menipis
                'satuan' => 'Pcs',
                'harga_satuan' => 215000,
                'lokasi_penyimpanan' => 'Lemari IT A-03',
                'kondisi' => 'Baik',
                'deskripsi' => 'Koneksi wireless nano receiver 2.4GHz, klik senyap.',
                'gambar' => null,
            ],
            [
                'kode_barang' => 'BRG-ATK-001',
                'nama_barang' => 'Kertas HVS A4 80gr Sinar Dunia (SiDu)',
                'kategori_id' => $kategoris['ATK'] ?? 2,
                'stok' => 25,
                'satuan' => 'Rim',
                'harga_satuan' => 52000,
                'lokasi_penyimpanan' => 'Gudang ATK Lt. 1',
                'kondisi' => 'Baik',
                'deskripsi' => 'Kertas cetak dokumen resmi kantor 500 lembar per rim.',
                'gambar' => null,
            ],
            [
                'kode_barang' => 'BRG-ATK-002',
                'nama_barang' => 'Spidol Whiteboard Snowman Hitam',
                'kategori_id' => $kategoris['ATK'] ?? 2,
                'stok' => 0, // Habis
                'satuan' => 'Box',
                'harga_satuan' => 85000,
                'lokasi_penyimpanan' => 'Gudang ATK Lt. 1',
                'kondisi' => 'Baik',
                'deskripsi' => '1 box isi 12 pcs, tinta hitam pekat mudah dihapus.',
                'gambar' => null,
            ],
            [
                'kode_barang' => 'BRG-ATK-003',
                'nama_barang' => 'Ordner / Binder Bantex Folio 7cm Biru',
                'kategori_id' => $kategoris['ATK'] ?? 2,
                'stok' => 18,
                'satuan' => 'Pcs',
                'harga_satuan' => 36500,
                'lokasi_penyimpanan' => 'Gudang Arsip',
                'kondisi' => 'Baik',
                'deskripsi' => 'Ordner pengarsipan dokumen surat dinas ukuran Folio.',
                'gambar' => null,
            ],
            [
                'kode_barang' => 'BRG-FNT-001',
                'nama_barang' => 'Kursi Kerja Ergonomis Mesh Fantech OCA258',
                'kategori_id' => $kategoris['FNT'] ?? 3,
                'stok' => 6,
                'satuan' => 'Unit',
                'harga_satuan' => 1150000,
                'lokasi_penyimpanan' => 'Ruang Kerja Staf',
                'kondisi' => 'Baik',
                'deskripsi' => 'Sandaran jaring adem, adjustable headrest & lumbar support.',
                'gambar' => null,
            ],
            [
                'kode_barang' => 'BRG-FNT-002',
                'nama_barang' => 'Meja Rapat Modera 8 Seater Kayu Mahoni',
                'kategori_id' => $kategoris['FNT'] ?? 3,
                'stok' => 2,
                'satuan' => 'Unit',
                'harga_satuan' => 4750000,
                'lokasi_penyimpanan' => 'Ruang Meeting Utama',
                'kondisi' => 'Rusak Ringan',
                'deskripsi' => 'Goresan halus di sudut kanan meja, struktur kaki masih kokoh.',
                'gambar' => null,
            ],
            [
                'kode_barang' => 'BRG-LOG-001',
                'nama_barang' => 'Hand Pallet Truck Dalton 3 Ton',
                'kategori_id' => $kategoris['LOG'] ?? 4,
                'stok' => 3,
                'satuan' => 'Unit',
                'harga_satuan' => 3800000,
                'lokasi_penyimpanan' => 'Gudang Pusat Blok C',
                'kondisi' => 'Baik',
                'deskripsi' => 'Roda double PU kuat untuk lantai epoxy maupun semen halus.',
                'gambar' => null,
            ],
            [
                'kode_barang' => 'BRG-KBS-001',
                'nama_barang' => 'Dispenser Hand Sanitizer Standing Otomatis',
                'kategori_id' => $kategoris['KBS'] ?? 5,
                'stok' => 5, // Menipis
                'satuan' => 'Unit',
                'harga_satuan' => 450000,
                'lokasi_penyimpanan' => 'Lobby Depan & Koridor',
                'kondisi' => 'Perlu Perbaikan',
                'deskripsi' => 'Sensor inframerah kadang macet, perlu penggantian baterai atau dinamo.',
                'gambar' => null,
            ],
        ];

        foreach ($barangs as $item) {
            \App\Models\Barang::updateOrCreate(
                ['kode_barang' => $item['kode_barang']],
                $item
            );
        }
    }
}
