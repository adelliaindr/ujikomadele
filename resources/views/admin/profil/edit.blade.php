@extends('layouts.admin')

@section('content')
@php
    // Misi bisa berupa array, string JSON, atau teks biasa. Di form ditampilkan satu poin per baris.
    $misiRaw = $profile?->misi;
    if (is_array($misiRaw)) {
        $misiList = $misiRaw;
    } elseif (is_string($misiRaw) && is_array(json_decode($misiRaw, true))) {
        $misiList = json_decode($misiRaw, true);
    } elseif (is_string($misiRaw) && trim($misiRaw) !== '') {
        $misiList = preg_split('/\r\n|\r|\n/', $misiRaw);
    } else {
        $misiList = [];
    }
    $misiText = implode("\n", array_values(array_filter(array_map('trim', array_map('strval', $misiList)))));
@endphp

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Profil Sekolah</h1>
            <p class="text-muted small mb-0">Ubah sambutan, visi, misi, dan sejarah SMKN 4 Bogor.</p>
        </div>
        <a href="{{ route('admin.profil.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Data belum bisa disimpan:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 fw-bold text-primary">
                <i class="bi bi-building me-2"></i>Identitas &amp; Sambutan
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama_sekolah" class="form-label fw-semibold">Nama Sekolah <span class="text-danger">*</span></label>
                    <input type="text" id="nama_sekolah" name="nama_sekolah"
                           class="form-control @error('nama_sekolah') is-invalid @enderror"
                           value="{{ old('nama_sekolah', $profile?->nama_sekolah ?? 'SMKN 4 Bogor') }}" required>
                    @error('nama_sekolah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-0">
                    <label for="sambutan" class="form-label fw-semibold">Sambutan Kepala Sekolah</label>
                    <textarea id="sambutan" name="sambutan" rows="6"
                              class="form-control @error('sambutan') is-invalid @enderror">{{ old('sambutan', $profile?->sambutan) }}</textarea>
                    @error('sambutan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 fw-bold text-primary">
                <i class="bi bi-compass me-2"></i>Visi &amp; Misi
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="visi" class="form-label fw-semibold">Visi</label>
                    <textarea id="visi" name="visi" rows="4"
                              class="form-control @error('visi') is-invalid @enderror">{{ old('visi', $profile?->visi) }}</textarea>
                    @error('visi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-0">
                    <label for="misi" class="form-label fw-semibold">Misi</label>
                    <textarea id="misi" name="misi" rows="6"
                              class="form-control @error('misi') is-invalid @enderror">{{ old('misi', $misiText) }}</textarea>
                    <div class="form-text">Tulis satu poin misi per baris.</div>
                    @error('misi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 fw-bold text-primary">
                <i class="bi bi-journal-text me-2"></i>Sejarah Sekolah
            </div>
            <div class="card-body">
                <textarea id="sejarah" name="sejarah" rows="8"
                          class="form-control @error('sejarah') is-invalid @enderror">{{ old('sejarah', $profile?->sejarah) }}</textarea>
                @error('sejarah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('admin.profil.index') }}" class="btn btn-light border">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection