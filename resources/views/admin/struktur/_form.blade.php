{{-- Variabel: $action, $method ('POST' atau 'PUT'), $struktur (null saat tambah), $urutanDefault (opsional) --}}
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="mb-3">
                <label for="jabatan" class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                <input type="text" id="jabatan" name="jabatan"
                       class="form-control @error('jabatan') is-invalid @enderror"
                       value="{{ old('jabatan', $struktur?->jabatan) }}"
                       placeholder="Contoh: Kepala Sekolah" required>
                @error('jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                <input type="text" id="nama" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $struktur?->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="urutan" class="form-label fw-semibold">Urutan <span class="text-danger">*</span></label>
                <input type="number" id="urutan" name="urutan" min="1"
                       class="form-control @error('urutan') is-invalid @enderror"
                       value="{{ old('urutan', $struktur?->urutan ?? ($urutanDefault ?? 1)) }}" required>
                <div class="form-text">Angka kecil tampil lebih dulu (1 = paling atas, misalnya Kepala Sekolah).</div>
                @error('urutan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-0">
                <label for="foto" class="form-label fw-semibold">Foto</label>

                @if ($struktur?->foto)
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <img src="{{ asset('storage/' . $struktur->foto) }}" alt="{{ $struktur->nama }}"
                             class="rounded-circle border" style="width: 72px; height: 72px; object-fit: cover;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hapus_foto" value="1" id="hapus_foto">
                            <label class="form-check-label" for="hapus_foto">Hapus foto saat ini</label>
                        </div>
                    </div>
                @endif

                <input type="file" id="foto" name="foto" accept="image/*"
                       class="form-control @error('foto') is-invalid @enderror">
                <div class="form-text">Opsional. Format JPG, PNG, atau WEBP, maksimal 2 MB.</div>
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mb-5">
        <a href="{{ route('admin.profil.index') }}" class="btn btn-light border">Batal</a>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-lg me-1"></i> Simpan
        </button>
    </div>
</form>