@extends('layouts.app')

@section('title', 'Daftar Inventaris Barang')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Daftar Inventaris Barang</h4>
            <p class="text-muted small mb-0">Kelola dan pantau seluruh data aset serta stok logistik kantor.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('barang.create') }}" class="btn btn-custom-primary d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah Barang</span>
            </a>
        </div>
    </div>

    <!-- Kartu Ringkasan Metrik / Statistik -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-stat bg-white h-100 p-3 border-start border-primary border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Total Jenis Barang</span>
                        <h3 class="fw-bold text-dark mt-1 mb-0">{{ number_format($metrics['total_barang']) }}</h3>
                    </div>
                    <div class="stat-icon text-primary">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-stat bg-white h-100 p-3 border-start border-info border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Total Stok Fisik</span>
                        <h3 class="fw-bold text-dark mt-1 mb-0">{{ number_format($metrics['total_stok']) }} <small
                                class="text-muted fs-6 fw-normal">unit</small></h3>
                    </div>
                    <div class="stat-icon text-info">
                        <i class="bi bi-layers"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-stat bg-white h-100 p-3 border-start border-success border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Total Nilai Aset</span>
                        <h3 class="fw-bold text-success mt-1 mb-0">Rp
                            {{ number_format($metrics['total_nilai'], 0, ',', '.') }}</h3>
                    </div>
                    <div class="stat-icon text-success">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-stat bg-white h-100 p-3 border-start border-warning border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Stok Kritis / Menipis</span>
                        <h3 class="fw-bold text-warning mt-1 mb-0">{{ number_format($metrics['stok_kritis']) }}</h3>
                    </div>
                    <div class="stat-icon text-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Filter & Pencarian -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body p-3 p-md-4">
            <form method="GET" action="{{ route('barang.index') }}" class="row g-3">
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold text-muted">Cari Barang</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0"
                            placeholder="Nama, kode, atau lokasi..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <label class="form-label small fw-semibold text-muted">Kategori</label>
                    <select name="kategori_id" class="form-select">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-md-2">
                    <label class="form-label small fw-semibold text-muted">Kondisi</label>
                    <select name="kondisi" class="form-select">
                        <option value="">-- Semua --</option>
                        <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan
                        </option>
                        <option value="Perlu Perbaikan" {{ request('kondisi') == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu
                            Perbaikan</option>
                    </select>
                </div>

                <div class="col-6 col-md-2">
                    <label class="form-label small fw-semibold text-muted">Status Stok</label>
                    <select name="stok_status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="aman" {{ request('stok_status') == 'aman' ? 'selected' : '' }}>Tersedia (>5)</option>
                        <option value="menipis" {{ request('stok_status') == 'menipis' ? 'selected' : '' }}>Menipis (1-5)
                        </option>
                        <option value="habis" {{ request('stok_status') == 'habis' ? 'selected' : '' }}>Habis (0)</option>
                    </select>
                </div>

                <div class="col-6 col-md-1 d-flex align-items-end gap-1">
                    <button type="submit" class="btn btn-primary w-100" title="Terapkan Filter">
                        <i class="bi bi-filter"></i>
                    </button>
                    @if(request()->hasAny(['search', 'kategori_id', 'kondisi', 'stok_status']))
                        <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Card Tabel Data Barang -->
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-dark">
                <i class="bi bi-table me-2 text-primary"></i> Data Tabel Barang
            </h6>
            <span class="badge bg-light text-secondary border">
                Menampilkan {{ $barangs->count() }} dari {{ $barangs->total() }} data
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center" style="width: 50px;">#</th>
                        <th scope="col" style="width: 70px;">Foto</th>
                        <th scope="col">Kode & Nama Barang</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Kondisi & Lokasi</th>
                        <th scope="col" class="text-center" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $index => $item)
                        <tr>
                            <td class="text-center text-muted fw-semibold">
                                {{ $barangs->firstItem() + $index }}
                            </td>
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_barang }}"
                                        class="thumbnail-img">
                                @else
                                    <div
                                        class="thumbnail-img bg-light d-flex align-items-center justify-content-center text-secondary">
                                        <i class="bi bi-image fs-5"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $item->nama_barang }}</div>
                                <small class="text-muted font-monospace"><i
                                        class="bi bi-upc-scan me-1"></i>{{ $item->kode_barang }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle">
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item->stok }} <small class="text-muted">{{ $item->satuan }}</small>
                                </div>
                                <span class="badge bg-{{ $item->status_stok['badge'] }} badge-status mt-1">
                                    {{ $item->status_stok['label'] }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item->harga_format }}</div>
                                <small class="text-muted">Total: {{ $item->total_nilai_format }}</small>
                            </td>
                            <td>
                                <div>
                                    @if($item->kondisi == 'Baik')
                                        <span
                                            class="badge bg-success-subtle text-success-emphasis border border-success-subtle">Baik</span>
                                    @elseif($item->kondisi == 'Rusak Ringan')
                                        <span
                                            class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">Rusak
                                            Ringan</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle">Perlu
                                            Perbaikan</span>
                                    @endif
                                </div>
                                <small class="text-muted d-block mt-1">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $item->lokasi_penyimpanan ?? 'Tidak dispesifikasi' }}
                                </small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('barang.show', $item->id) }}" class="btn btn-outline-info"
                                        title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-outline-warning"
                                        title="Edit Barang">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" title="Hapus Barang"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                                <!-- Modal Konfirmasi Hapus -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content text-start">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold text-danger">
                                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Konfirmasi Hapus
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-3">
                                                Apakah Anda yakin ingin menghapus barang
                                                <strong>"{{ $item->nama_barang }}"</strong> ({{ $item->kode_barang }}) dari
                                                inventaris?
                                                <div class="text-muted small mt-2">Tindakan ini tidak dapat dibatalkan.</div>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus Data</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                    <h6>Tidak ada data barang yang ditemukan</h6>
                                    <p class="small mb-3">Coba ubah kata kunci pencarian atau filter yang dipilih.</p>
                                    <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-plus-lg me-1"></i> Tambah Barang Sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($barangs->hasPages())
            <div class="card-footer bg-white py-3 border-0 d-flex justify-content-center">
                {{ $barangs->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection