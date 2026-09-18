@extends('layouts.app')

@section('title', 'Edit Barang: ' . $barang->nama_barang)

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1">Edit Data Barang</h4>
                    <p class="text-muted small mb-0">Perbarui informasi barang inventaris:
                        <strong>{{ $barang->nama_barang }}</strong></p>
                </div>
                <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-4">
                            <!-- Kode Barang -->
                            <div class="col-12 col-md-4">
                                <label for="kode_barang" class="form-label fw-semibold">Kode Barang <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="kode_barang" id="kode_barang"
                                    class="form-control font-monospace @error('kode_barang') is-invalid @enderror"
                                    value="{{ old('kode_barang', $barang->kode_barang) }}" required>
                                @error('kode_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Kode identifikasi unik barang.</small>
                            </div>

                            <!-- Nama Barang -->
                            <div class="col-12 col-md-8">
                                <label for="nama_barang" class="form-label fw-semibold">Nama Barang <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_barang" id="nama_barang"
                                    class="form-control @error('nama_barang') is-invalid @enderror"
                                    placeholder="Contoh: Laptop Lenovo ThinkPad L14"
                                    value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="col-12 col-md-6">
                                <label for="kategori_id" class="form-label fw-semibold">Kategori <span
                                        class="text-danger">*</span></label>
                                <select name="kategori_id" id="kategori_id"
                                    class="form-select @error('kategori_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }} ({{ $kategori->kode_kategori }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Lokasi Penyimpanan -->
                            <div class="col-12 col-md-6">
                                <label for="lokasi_penyimpanan" class="form-label fw-semibold">Lokasi Penyimpanan</label>
                                <input type="text" name="lokasi_penyimpanan" id="lokasi_penyimpanan"
                                    class="form-control @error('lokasi_penyimpanan') is-invalid @enderror"
                                    placeholder="Contoh: Gudang Utama Lt. 1 / Ruang IT"
                                    value="{{ old('lokasi_penyimpanan', $barang->lokasi_penyimpanan) }}">
                                @error('lokasi_penyimpanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stok -->
                            <div class="col-6 col-md-4">
                                <label for="stok" class="form-label fw-semibold">Jumlah Stok <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="stok" id="stok" min="0"
                                    class="form-control @error('stok') is-invalid @enderror" placeholder="0"
                                    value="{{ old('stok', $barang->stok) }}" required>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Satuan -->
                            <div class="col-6 col-md-4">
                                <label for="satuan" class="form-label fw-semibold">Satuan <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="satuan" id="satuan" list="satuan-options"
                                    class="form-control @error('satuan') is-invalid @enderror"
                                    placeholder="Pcs / Unit / Box" value="{{ old('satuan', $barang->satuan) }}" required>
                                <datalist id="satuan-options">
                                    <option value="Unit">
                                    <option value="Pcs">
                                    <option value="Box">
                                    <option value="Rim">
                                    <option value="Pack">
                                    <option value="Set">
                                    <option value="Botol">
                                </datalist>
                                @error('satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Harga Satuan -->
                            <div class="col-12 col-md-4">
                                <label for="harga_satuan" class="form-label fw-semibold">Harga Satuan (Rp) <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">Rp</span>
                                    <input type="number" name="harga_satuan" id="harga_satuan" min="0" step="100"
                                        class="form-control @error('harga_satuan') is-invalid @enderror" placeholder="0"
                                        value="{{ old('harga_satuan', $barang->harga_satuan) }}" required>
                                </div>
                                @error('harga_satuan')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kondisi Barang -->
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-semibold d-block">Kondisi Barang <span
                                        class="text-danger">*</span></label>
                                <div class="d-flex gap-3 pt-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kondisi" id="kondisi_baik"
                                            value="Baik" {{ old('kondisi', $barang->kondisi) == 'Baik' ? 'checked' : '' }}>
                                        <label class="form-check-label text-success fw-semibold" for="kondisi_baik">
                                            <i class="bi bi-check-circle me-1"></i> Baik
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kondisi"
                                            id="kondisi_rusak_ringan" value="Rusak Ringan" {{ old('kondisi', $barang->kondisi) == 'Rusak Ringan' ? 'checked' : '' }}>
                                        <label class="form-check-label text-warning fw-semibold" for="kondisi_rusak_ringan">
                                            <i class="bi bi-exclamation-circle me-1"></i> Rusak Ringan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kondisi"
                                            id="kondisi_perlu_perbaikan" value="Perlu Perbaikan" {{ old('kondisi', $barang->kondisi) == 'Perlu Perbaikan' ? 'checked' : '' }}>
                                        <label class="form-check-label text-danger fw-semibold"
                                            for="kondisi_perlu_perbaikan">
                                            <i class="bi bi-tools me-1"></i> Perlu Perbaikan
                                        </label>
                                    </div>
                                </div>
                                @error('kondisi')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Upload / Ganti Foto Barang -->
                            <div class="col-12 col-md-6">
                                <label for="gambar" class="form-label fw-semibold">Ganti Foto Barang</label>
                                <input type="file" name="gambar" id="gambar" accept="image/*"
                                    class="form-control @error('gambar') is-invalid @enderror"
                                    onchange="previewImage(event)">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto saat ini.</small>
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Preview Box -->
                                <div class="mt-2 d-flex align-items-center gap-3">
                                    @if($barang->gambar)
                                        <div>
                                            <small class="d-block text-muted mb-1">Foto Saat Ini:</small>
                                            <img src="{{ asset('storage/' . $barang->gambar) }}"
                                                alt="{{ $barang->nama_barang }}" class="img-thumbnail"
                                                style="max-height: 80px; object-fit: cover;">
                                        </div>
                                    @endif
                                    <div id="previewContainer" style="display: none;">
                                        <small class="d-block text-muted mb-1">Foto Baru:</small>
                                        <img id="previewImg" src="#" alt="Preview Foto Baru"
                                            class="img-thumbnail border-primary"
                                            style="max-height: 80px; object-fit: cover;">
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi / Spesifikasi -->
                            <div class="col-12">
                                <label for="deskripsi" class="form-label fw-semibold">Deskripsi / Spesifikasi
                                    Tambahan</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Tuliskan spesifikasi teknis, nomor seri, atau catatan penting...">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 border-top pt-3">
                            <a href="{{ route('barang.index') }}" class="btn btn-light px-4">Batal</a>
                            <button type="submit" class="btn btn-custom-primary px-4">
                                <i class="bi bi-check2-circle me-1"></i> Perbarui Data Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const input = event.target;
            const container = document.getElementById('previewContainer');
            const preview = document.getElementById('previewImg');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    container.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                container.style.display = 'none';
            }
        }
    </script>
@endpush