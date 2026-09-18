<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang beserta kartu metrik dan filter pencarian.
     */
    public function index(Request $request)
    {
        $query = Barang::with('kategori');

        // Filter pencarian berdasarkan nama atau kode barang
        if ($request->filled('search')) {
            $keyword = trim($request->search);
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_barang', 'like', "%{$keyword}%")
                    ->orWhere('kode_barang', 'like', "%{$keyword}%")
                    ->orWhere('lokasi_penyimpanan', 'like', "%{$keyword}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter berdasarkan kondisi barang
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        // Filter status stok
        if ($request->filled('stok_status')) {
            if ($request->stok_status === 'habis') {
                $query->where('stok', '<=', 0);
            } elseif ($request->stok_status === 'menipis') {
                $query->whereBetween('stok', [1, 5]);
            } elseif ($request->stok_status === 'aman') {
                $query->where('stok', '>', 5);
            }
        }

        // Ambil data dengan paginasi
        $barangs = $query->latest()->paginate(8)->withQueryString();

        // Metrik ringkasan untuk kartu dashboard
        $metrics = [
            'total_barang' => Barang::count(),
            'total_stok' => Barang::sum('stok'),
            'total_nilai' => Barang::selectRaw('SUM(stok * harga_satuan) as total')->value('total') ?? 0,
            'stok_kritis' => Barang::where('stok', '<=', 5)->count(),
        ];

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('barang.index', compact('barangs', 'metrics', 'kategoris'));
    }

    /**
     * Form tambah barang baru.
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        // Format kode barang otomatis default (e.g. BRG-2026-011)
        $latestId = Barang::max('id') ?? 0;
        $defaultKode = 'BRG-' . date('y') . '-' . sprintf('%03d', $latestId + 1);

        return view('barang.create', compact('kategoris', 'defaultKode'));
    }

    /**
     * Menyimpan data barang ke database.
     */
    public function store(BarangRequest $request)
    {
        $validated = $request->validated();

        // Handle upload berkas foto barang jika ada
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('barang', 'public');
            $validated['gambar'] = $path;
        }

        Barang::create($validated);

        return redirect()->route('barang.index')
            ->with('success', 'Barang baru berhasil ditambahkan ke inventaris!');
    }

    /**
     * Menampilkan detail lengkap suatu barang.
     */
    public function show(Barang $barang)
    {
        $barang->load('kategori');
        return view('barang.show', compact('barang'));
    }

    /**
     * Form edit data barang.
     */
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Memperbarui data barang.
     */
    public function update(BarangRequest $request, Barang $barang)
    {
        $validated = $request->validated();

        // Handle update gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $path = $request->file('gambar')->store('barang', 'public');
            $validated['gambar'] = $path;
        }

        $barang->update($validated);

        return redirect()->route('barang.index')
            ->with('success', "Data barang '{$barang->nama_barang}' berhasil diperbarui!");
    }

    /**
     * Menghapus barang dari database.
     */
    public function destroy(Barang $barang)
    {
        $nama = $barang->nama_barang;

        // Hapus foto jika tersimpan di disk
        if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', "Barang '{$nama}' berhasil dihapus dari inventaris.");
    }
}
