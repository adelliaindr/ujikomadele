@extends('layouts.app')

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

    if (count($misiList) === 0) {
        $misiList = [
            'Menyelenggarakan pembelajaran berbasis kompetensi dan teknologi informasi.',
            'Meningkatkan kerja sama industri (DUDI) nasional dan internasional.',
            'Membentuk karakter peserta didik yang disiplin, kreatif, dan berakhlak mulia.',
        ];
    }
@endphp

<section class="hero-section d-flex align-items-center justify-content-center text-center position-relative">
    <div class="container" style="max-width: 1200px;">
        <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-3">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none fw-semibold">Beranda</a>
                </li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Profil Sekolah</li>
            </ol>
        </nav>

        <h1 class="display-4 fw-bold mb-3 text-white">Profil Kr4bat</h1>
        <p class="lead col-lg-8 mx-auto text-white fs-5 mb-0">
            Mengenal lebih dekat sambutan, sejarah, visi, misi, dan struktur organisasi SMKN 4 Bogor dalam mencetak generasi unggul berdaya saing.
        </p>
    </div>
</section>

<div class="container py-5">
    {{-- Banner --}}
    @if($profile?->foto_sekolah)
    <div class="mb-5 text-center">
        <img src="{{ asset('storage/' . $profile->foto_sekolah) }}" class="img-fluid rounded-4 shadow-sm" style="max-height: 400px; width: 100%; object-fit: cover;" alt="Foto Sekolah">
    </div>
    @endif

    {{-- Sambutan Kepala Sekolah --}}
    @if($profile?->sambutan)
    <div class="card border-0 shadow-sm bg-light mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3 mb-3">
                <h4 class="fw-bold m-0 text-primary">Sambutan Kepala Sekolah</h4>
            </div>
            <p class="card-text text-secondary lh-lg mb-0">{!! nl2br(e($profile->sambutan)) !!}</p>
        </div>
    </div>
    @endif

    {{-- Sejarah --}}
    @if($profile?->sejarah)
    <div class="card border-0 shadow-sm bg-light mb-5">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3 mb-3">
                <h4 class="fw-bold m-0 text-primary">Sejarah Sekolah</h4>
            </div>
            <p class="card-text text-secondary lh-lg mb-0">{!! nl2br(e($profile->sejarah)) !!}</p>
        </div>
    </div>
    @endif

    {{-- Visi & Misi --}}
    <div class="row g-4 mb-5">
        <!-- Visi -->
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm bg-light">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <h4 class="fw-bold m-0 text-primary">Visi Sekolah</h4>
                    </div>
                    <p class="card-text text-secondary mb-0">
                        "{{ $profile->visi ?? 'Terwujudnya Sekolah Menengah Kejuruan yang unggul, berkarakter, berwawasan lingkungan, dan menghasilkan lulusan yang kompeten serta berdaya saing global.' }}"
                    </p>
                </div>
            </div>
        </div>

        <!-- Misi -->
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm bg-light">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <h4 class="fw-bold m-0 text-primary">Misi Sekolah</h4>
                    </div>
                    <ul class="card-text text-secondary ps-3 mb-0">
                        @foreach($misiList as $misi)
                            <li class="mb-1">{{ $misi }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Struktur Organisasi -->
    <div class="mb-5">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-primary">Struktur Organisasi</h3>
            <p class="text-muted">Pimpinan dan Pengelola SMKN 4 Bogor</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($pengurus as $item)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm text-center p-3 hover-top">
                        <div class="mx-auto mb-3" style="width: 120px; height: 120px;">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="rounded-circle img-fluid object-fit-cover w-100 h-100 shadow-sm">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center w-100 h-100 border">
                                    <i class="bi bi-person-fill text-secondary display-5"></i>
                                </div>
                            @endif
                        </div>
                        <h6 class="fw-bold mb-1 text-dark">{{ $item->nama }}</h6>
                        <small class="text-primary fw-semibold">{{ $item->jabatan }}</small>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">
                    <p>Data struktur organisasi belum diisi.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection