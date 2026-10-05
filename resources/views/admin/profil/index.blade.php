@extends('layouts.admin')

@section('content')
@php
    // Misi bisa berupa array, string JSON, atau teks biasa (satu poin per baris).
    $misiRaw = $profile->misi ?? null;
    if (is_array($misiRaw)) {
        $misiList = $misiRaw;
    } elseif (is_string($misiRaw) && is_array(json_decode($misiRaw, true))) {
        $misiList = json_decode($misiRaw, true);
    } elseif (is_string($misiRaw) && trim($misiRaw) !== '') {
        $misiList = preg_split('/\r\n|\r|\n/', $misiRaw);
    } else {
        $misiList = [];
    }
    $misiList = array_values(array_filter(array_map('trim', array_map('strval', $misiList))));
@endphp

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Profil Sekolah</h1>
            <p class="text-muted small mb-0">Kelola informasi profil, visi-misi, dan struktur organisasi SMKN 4 Bogor.</p>
        </div>
        <a href="{{ route('admin.profil.edit') }}" class="btn btn-primary">
            <i class="bi bi-pencil-square me-1"></i> Edit Profil
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-lg-8">
            <!-- Nama Sekolah & Sambutan -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3 fw-bold text-primary">
                    <i class="bi bi-building me-2"></i>Sambutan Kepala Sekolah
                </div>
                <div class="card-body">
                    <h5 class="fw-bold text-dark mb-3">{{ $profile->nama_sekolah ?? 'SMKN 4 Bogor' }}</h5>
                    <p class="card-text text-secondary" style="white-space: pre-line;">{{ $profile->sambutan ?? 'Belum ada data sambutan kepala sekolah.' }}</p>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3 fw-bold text-primary">
                    <i class="bi bi-compass me-2"></i>Visi &amp; Misi
                </div>
                <div class="card-body">
                    <h6 class="fw-bold text-dark">Visi</h6>
                    <p class="text-secondary mb-4" style="white-space: pre-line;">{{ $profile->visi ?? 'Belum ada data visi.' }}</p>

                    <h6 class="fw-bold text-dark">Misi</h6>
                    @if (count($misiList) > 0)
                        <ol class="text-secondary ps-3 mb-0">
                            @foreach ($misiList as $item)
                                <li class="mb-1">{{ $item }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p class="text-secondary mb-0">Belum ada data misi.</p>
                    @endif
                </div>
            </div>

            <!-- Sejarah Sekolah -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3 fw-bold text-primary">
                    <i class="bi bi-journal-text me-2"></i>Sejarah Sekolah
                </div>
                <div class="card-body">
                    <p class="card-text text-secondary mb-0" style="white-space: pre-line;">{{ $profile->sejarah ?? 'Belum ada data sejarah sekolah.' }}</p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Struktur Organisasi -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3 fw-bold text-primary d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-diagram-3 me-2"></i>Struktur Organisasi</span>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-pill">{{ count($struktur ?? []) }} Jabatan</span>
                        <a href="{{ route('admin.struktur.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-lg"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if (isset($struktur) && count($struktur) > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($struktur as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center gap-2 px-3 py-2">
                                    <div class="d-flex align-items-center gap-2">
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                                 class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center"
                                                 style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill text-secondary"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $item->jabatan }}</span>
                                            <small class="text-muted">{{ $item->nama }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <span class="badge bg-light text-dark border me-1">{{ $item->urutan }}</span>
                                        <a href="{{ route('admin.struktur.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.struktur.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('Hapus {{ addslashes($item->jabatan) }} - {{ addslashes($item->nama) }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="p-3 text-center text-muted small">
                            Belum ada data struktur organisasi.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection