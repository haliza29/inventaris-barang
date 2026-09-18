@extends('layouts.app')

@section('title', 'Detail: ' . $barang->nama_barang)

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1">Detail Informasi Barang</h4>
                    <p class="text-muted small mb-0">Rincian spesifikasi dan status ketersediaan barang inventaris.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <a href="{{ route('barang.edit', $barang->id) }}"
                        class="btn btn-warning d-flex align-items-center gap-1">
                        <i class="bi bi-pencil"></i>
                        <span>Edit Barang</span>
                    </a>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4">
                        <!-- Foto Barang -->
                        <div class="col-12 col-md-5 text-center">
                            <div class="p-3 bg-light rounded-4 border d-flex align-items-center justify-content-center"
                                style="min-height: 280px;">
                                @if($barang->gambar)
                                    <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}"
                                        class="img-fluid rounded-3 shadow-sm" style="max-height: 260px; object-fit: contain;">
                                @else
                                    <div class="text-secondary py-5">
                                        <i class="bi bi-image fs-1 d-block mb-2"></i>
                                        <span class="small">Tidak ada foto barang</span>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-3">
                                <span class="badge bg-{{ $barang->status_stok['badge'] }} px-3 py-2 fs-6">
                                    Status Stok: {{ $barang->status_stok['label'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Informasi Rinci -->
                        <div class="col-12 col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span
                                    class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle px-3 py-1">
                                    {{ $barang->kategori->nama_kategori ?? '-' }}
                                </span>
                                <span class="text-muted small font-monospace">
                                    <i class="bi bi-upc-scan me-1"></i>{{ $barang->kode_barang }}
                                </span>
                            </div>

                            <h3 class="fw-bold text-dark mb-3">{{ $barang->nama_barang }}</h3>

                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="text-muted" style="width: 160px;">Jumlah Stok</td>
                                        <td class="fw-bold text-dark">: {{ $barang->stok }} {{ $barang->satuan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Harga Satuan</td>
                                        <td class="fw-bold text-dark">: {{ $barang->harga_format }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Total Nilai Aset</td>
                                        <td class="fw-bold text-success">: {{ $barang->total_nilai_format }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Lokasi Gudang/Ruang</td>
                                        <td class="fw-semibold text-dark">:
                                            {{ $barang->lokasi_penyimpanan ?? 'Belum Ditentukan' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Kondisi Fisik</td>
                                        <td>:
                                            @if($barang->kondisi == 'Baik')
                                                <span class="badge bg-success">Baik</span>
                                            @elseif($barang->kondisi == 'Rusak Ringan')
                                                <span class="badge bg-warning text-dark">Rusak Ringan</span>
                                            @else
                                                <span class="badge bg-danger">Perlu Perbaikan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Terdaftar Pada</td>
                                        <td class="text-muted">: {{ $barang->created_at->format('d M Y, H:i') }} WIB</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Terakhir Diperbarui</td>
                                        <td class="text-muted">: {{ $barang->updated_at->format('d M Y, H:i') }} WIB</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="mt-4 pt-3 border-top">
                                <h6 class="fw-bold text-dark mb-2">Deskripsi & Spesifikasi Tambahan:</h6>
                                <p class="text-secondary mb-0" style="white-space: pre-line;">
                                    {{ $barang->deskripsi ?: 'Tidak ada keterangan tambahan.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection