{{-- Variabel: $action, $method ('POST' atau 'PUT'), $produk (null saat tambah) --}}
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Karya <span class="text-danger">*</span></label>
                    <input type="text" id="judul" name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $produk?->judul) }}"
                           placeholder="Contoh: SI-Kr4bat Web Info Sekolah" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="kategori" class="form-label fw-semibold">Kategori / Jurusan <span class="text-danger">*</span></label>
                    <select id="kategori" name="kategori"
                            class="form-select @error('kategori') is-invalid @enderror" required>
                        @foreach (['PPLG', 'TJKT', 'TO', 'TPFL'] as $kat)
                            <option value="{{ $kat }}" {{ old('kategori', $produk?->kategori) === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="pembuat" class="form-label fw-semibold">Pembuat (Siswa / Tim)</label>
                    <input type="text" id="pembuat" name="pembuat"
                           class="form-control @error('pembuat') is-invalid @enderror"
                           value="{{ old('pembuat', $produk?->pembuat) }}"
                           placeholder="Contoh: Tim Siswa XI PPLG 1">
                    @error('pembuat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="link_demo" class="form-label fw-semibold">Link Demo / GitHub (Opsional)</label>
                    <input type="url" id="link_demo" name="link_demo"
                           class="form-control @error('link_demo') is-invalid @enderror"
                           value="{{ old('link_demo', $produk?->link_demo) }}"
                           placeholder="https://github.com/...">
                    @error('link_demo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="foto" class="form-label fw-semibold">
                        {{ $produk ? 'Ganti Foto Karya (Opsional)' : 'Foto Karya' }}
                        @unless ($produk) <span class="text-danger">*</span> @endunless
                    </label>

                    @if ($produk?->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->judul }}"
                                 class="rounded border" style="height: 90px; object-fit: cover;">
                        </div>
                    @endif

                    <input type="file" id="foto" name="foto" accept="image/*"
                           class="form-control @error('foto') is-invalid @enderror"
                           {{ $produk ? '' : 'required' }}>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-0">
                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi Karya <span class="text-danger">*</span></label>
                    <textarea id="deskripsi" name="deskripsi" rows="5"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              placeholder="Penjelasan mengenai fitur, teknologi, dan keunggulan karya..." required>{{ old('deskripsi', $produk?->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mb-5">
        <a href="{{ route('admin.produk.index') }}" class="btn btn-light border">Batal</a>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-lg me-1"></i> {{ $produk ? 'Simpan Perubahan' : 'Simpan' }}
        </button>
    </div>
</form>