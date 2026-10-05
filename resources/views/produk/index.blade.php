@extends('layouts.app') {{-- Sesuaikan layout utama kamu --}}

@section('content')
<!-- Hero Section -->
<section class="hero-section d-flex align-items-center justify-content-center text-center position-relative py-5 bg-primary text-white">
    <div class="container" style="max-width: 1200px;">
        <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-3">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none fw-semibold">Beranda</a>
                </li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Produk & Karya</li>
            </ol>
        </nav>

        <h1 class="display-4 fw-bold mb-3 text-white">Produk & Karya Siswa Kr4bat</h1>
        <p class="lead col-lg-8 mx-auto text-white fs-5 mb-0">
            Hasil inovasi, kreativitas, dan proyek unggulan karya siswa-siswi SMKN 4 Bogor di berbagai bidang keahlian.
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-5 bg-light">
    <div class="container" style="max-width: 1200px;">
        <!-- Filter Kategori -->
        <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
            <a href="{{ route('produk.index') }}" class="btn btn-outline-primary rounded-pill {{ !request('kategori') ? 'active' : '' }}">Semua Karya</a>
            <a href="{{ route('produk.index', ['kategori' => 'PPLG']) }}" class="btn btn-outline-primary rounded-pill {{ request('kategori') == 'PPLG' ? 'active' : '' }}">PPLG</a>
            <a href="{{ route('produk.index', ['kategori' => 'TJKT']) }}" class="btn btn-outline-primary rounded-pill {{ request('kategori') == 'TJKT' ? 'active' : '' }}">TJKT</a>
            <a href="{{ route('produk.index', ['kategori' => 'TO']) }}" class="btn btn-outline-primary rounded-pill {{ request('kategori') == 'TO' ? 'active' : '' }}">TO</a>
            <a href="{{ route('produk.index', ['kategori' => 'TPFL']) }}" class="btn btn-outline-primary rounded-pill {{ request('kategori') == 'TPFL' ? 'active' : '' }}">TPFL</a>
        </div>

        <!-- Grid Produk -->
        <div class="row g-4">
            @forelse($produk as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top object-fit-cover" alt="{{ $item->judul }}" style="height: 220px;">
                        <div class="card-body d-flex flex-column p-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill">{{ $item->kategori }}</span>
                                @if($item->pembuat)
                                    <small class="text-muted"><i class="bi bi-person me-1"></i>{{ $item->pembuat }}</small>
                                @endif
                            </div>
                            <h5 class="card-title fw-bold text-dark">{{ $item->judul }}</h5>
                            <p class="card-text text-secondary flex-grow-1">
                                {{ Str::limit(strip_tags($item->deskripsi), 90) }}
                            </p>
                            <a href="{{ route('produk.show', $item->slug) }}" class="btn btn-outline-primary btn-sm mt-3 fw-semibold rounded-2">
                                Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box-seam display-1 text-muted"></i>
                    <p class="text-muted mt-3 fs-5">Belum ada produk atau karya yang ditampilkan untuk kategori ini.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $produk->links() }}
        </div>
    </div>
</section>
@endsection