<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'stok',
        'satuan',
        'harga_satuan',
        'lokasi_penyimpanan',
        'kondisi',
        'deskripsi',
        'gambar',
    ];

    /**
     * Relasi ke model Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Accessor format Rupiah untuk harga satuan
     */
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_satuan, 0, ',', '.');
    }

    /**
     * Accessor total nilai aset barang (stok x harga)
     */
    public function getTotalNilaiFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->stok * $this->harga_satuan, 0, ',', '.');
    }

    /**
     * Indikator status ketersediaan stok
     */
    public function getStatusStokAttribute(): array
    {
        if ($this->stok <= 0) {
            return ['badge' => 'danger', 'label' => 'Habis'];
        }

        if ($this->stok <= 5) {
            return ['badge' => 'warning text-dark', 'label' => 'Menipis'];
        }

        return ['badge' => 'success', 'label' => 'Tersedia'];
    }
}
