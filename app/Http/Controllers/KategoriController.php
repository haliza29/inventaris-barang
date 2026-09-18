<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar seluruh kategori dan jumlah barang terkait.
     */
    public function index()
    {
        $kategoris = Kategori::withCount('barangs')->orderBy('nama_kategori')->get();
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kategori' => 'required|string|max:20|unique:kategoris,kode_kategori',
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:255',
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.unique' => 'Kode kategori sudah terdaftar.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
        ]);

        Kategori::create($validated);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Memperbarui kategori yang ada.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'kode_kategori' => 'required|string|max:20|unique:kategoris,kode_kategori,' . $kategori->id,
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:255',
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.unique' => 'Kode kategori sudah terdaftar.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.index')
            ->with('success', "Kategori '{$kategori->nama_kategori}' berhasil diperbarui!");
    }

    /**
     * Menghapus kategori beserta barang terkait (on cascade delete).
     */
    public function destroy(Kategori $kategori)
    {
        $nama = $kategori->nama_kategori;
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', "Kategori '{$nama}' beserta barang di dalamnya telah dihapus.");
    }
}
