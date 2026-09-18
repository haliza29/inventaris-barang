<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $barangId = $this->route('barang') ? $this->route('barang')->id : null;

        return [
            'kode_barang' => ['required', 'string', 'max:30', 'unique:barangs,kode_barang,' . $barangId],
            'nama_barang' => ['required', 'string', 'max:150'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'stok' => ['required', 'integer', 'min:0'],
            'satuan' => ['required', 'string', 'max:30'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
            'lokasi_penyimpanan' => ['nullable', 'string', 'max:100'],
            'kondisi' => ['required', 'in:Baik,Rusak Ringan,Perlu Perbaikan'],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    /**
     * Nama atribut yang ramah pengguna
     */
    public function attributes(): array
    {
        return [
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'kategori_id' => 'Kategori Barang',
            'stok' => 'Jumlah Stok',
            'satuan' => 'Satuan Barang',
            'harga_satuan' => 'Harga Satuan',
            'lokasi_penyimpanan' => 'Lokasi Penyimpanan',
            'kondisi' => 'Kondisi Barang',
            'deskripsi' => 'Deskripsi Barang',
            'gambar' => 'Foto Barang',
        ];
    }

    /**
     * Pesan error validasi dalam Bahasa Indonesia
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan, gunakan kode lain.',
            'exists' => ':attribute yang dipilih tidak valid.',
            'min' => ':attribute minimal bernilai :min.',
            'max' => ':attribute tidak boleh melebihi :max karakter.',
            'image' => ':attribute harus berupa file gambar.',
            'mimes' => ':attribute harus berformat :values.',
            'gambar.max' => 'Ukuran foto maksimal adalah 2MB.',
        ];
    }
}
