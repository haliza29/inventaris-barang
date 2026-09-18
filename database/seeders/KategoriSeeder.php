<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'kode_kategori' => 'ELK',
                'nama_kategori' => 'Elektronik & IT',
                'deskripsi' => 'Perangkat komputer, laptop, printer, dan aksesori digital.',
            ],
            [
                'kode_kategori' => 'ATK',
                'nama_kategori' => 'Alat Tulis Kantor',
                'deskripsi' => 'Kebutuhan kertas, pena, map, binder, dan perlengkapan tulis.',
            ],
            [
                'kode_kategori' => 'FNT',
                'nama_kategori' => 'Furnitur & Perabot',
                'deskripsi' => 'Meja kerja, kursi ergonomis, lemari berkas, dan partisi.',
            ],
            [
                'kode_kategori' => 'LOG',
                'nama_kategori' => 'Peralatan Gudang & Logistik',
                'deskripsi' => 'Pallet, troli, tangga lipat, dan perkakas operasional gudang.',
            ],
            [
                'kode_kategori' => 'KBS',
                'nama_kategori' => 'Kebersihan & Sanitasi',
                'deskripsi' => 'Disinfektan, tempat sampah medis/organik, dan alat pembersih.',
            ],
        ];

        foreach ($kategori as $item) {
            \App\Models\Kategori::updateOrCreate(
                ['kode_kategori' => $item['kode_kategori']],
                $item
            );
        }
    }
}
