@extends('layouts.app')

@section('title', 'Kelola Kategori Barang')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Kelola Kategori Barang</h4>
            <p class="text-muted small mb-0">Klasifikasikan barang inventaris agar pengelolaan logistik lebih terstruktur.
            </p>
        </div>
        <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-1">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali ke Data Barang</span>
        </a>
    </div>

    <div class="row g-4">
        <!-- Form Tambah Kategori -->
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-plus-circle text-primary me-2"></i> Tambah Kategori Baru
                    </h6>
                </div>
                <div class="card-body p-3 p-md-4 pt-0">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_kategori" class="form-label fw-semibold small">Kode Kategori <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="kode_kategori" id="kode_kategori"
                                class="form-control font-monospace @error('kode_kategori') is-invalid @enderror"
                                placeholder="Contoh: ELK, ATK, FNT" value="{{ old('kode_kategori') }}" required>
                            @error('kode_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label fw-semibold small">Nama Kategori <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="nama_kategori" id="nama_kategori"
                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                placeholder="Contoh: Elektronik & IT" value="{{ old('nama_kategori') }}" required>
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold small">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" rows="2"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                placeholder="Keterangan cakupan kategori...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-custom-primary w-100">
                            <i class="bi bi-save me-1"></i> Simpan Kategori
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Kategori -->
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-tags text-primary me-2"></i> Daftar Kategori Terdaftar
                    </h6>
                    <span class="badge bg-light text-secondary border">{{ $kategoris->count() }} Kategori</span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">#</th>
                                <th scope="col" style="width: 90px;">Kode</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col" class="text-center" style="width: 120px;">Jumlah Barang</th>
                                <th scope="col" class="text-center" style="width: 110px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $index => $kat)
                                <tr>
                                    <td class="text-center text-muted fw-semibold">{{ $index + 1 }}</td>
                                    <td>
                                        <span
                                            class="badge bg-light text-dark border font-monospace">{{ $kat->kode_kategori }}</span>
                                    </td>
                                    <td class="fw-bold text-dark">{{ $kat->nama_kategori }}</td>
                                    <td class="text-muted small">{{ $kat->deskripsi ?: '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                            {{ $kat->barangs_count }} barang
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $kat->id }}" title="Edit Kategori">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $kat->id }}" title="Hapus Kategori">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Modal Edit Kategori -->
                                        <div class="modal fade" id="editModal{{ $kat->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content text-start">
                                                    <form action="{{ route('kategori.update', $kat->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header border-0 pb-0">
                                                            <h5 class="modal-title fw-bold">Edit Kategori</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body py-3">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold small">Kode
                                                                    Kategori</label>
                                                                <input type="text" name="kode_kategori"
                                                                    class="form-control font-monospace"
                                                                    value="{{ old('kode_kategori', $kat->kode_kategori) }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold small">Nama
                                                                    Kategori</label>
                                                                <input type="text" name="nama_kategori" class="form-control"
                                                                    value="{{ old('nama_kategori', $kat->nama_kategori) }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold small">Deskripsi</label>
                                                                <textarea name="deskripsi" rows="2"
                                                                    class="form-control">{{ old('deskripsi', $kat->deskripsi) }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0 pt-0">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Delete Kategori -->
                                        <div class="modal fade" id="deleteModal{{ $kat->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content text-start">
                                                    <div class="modal-header border-0 pb-0">
                                                        <h5 class="modal-title fw-bold text-danger">Hapus Kategori</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body py-3">
                                                        Hapus kategori <strong>"{{ $kat->nama_kategori }}"</strong>?
                                                        @if($kat->barangs_count > 0)
                                                            <div class="alert alert-warning small mt-2 mb-0">
                                                                <i class="bi bi-exclamation-triangle me-1"></i> Perhatian: Terdapat
                                                                {{ $kat->barangs_count }} barang yang terhubung ke kategori ini dan
                                                                akan ikut terhapus.
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer border-0 pt-0">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('kategori.destroy', $kat->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus Kategori</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Belum ada kategori terdaftar. Silakan tambahkan pada formulir di samping.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection