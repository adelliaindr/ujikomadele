@extends('layouts.app')

@section('content')
<section class="py-5 bg-light">
    <div class="container" style="max-width: 1000px;">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('produk.index') }}" class="text-decoration-none">Produk & Karya</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $item->judul }}</li>
            </ol>
        </nav>

        <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-5">
            <img src="{{ asset('storage/' . $item->foto) }}" class="w-100 object-fit-cover" alt="{{ $item->judul }}" style="max-height: 450px;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="badge bg-primary px-3 py-2 rounded-pill fs-6">{{ $item->kategori }}</span>
                    @if($item->pembuat)
                        <span class="text-secondary fw-semibold"><i class="bi bi-code-slash me-1"></i> Karya: {{ $item->pembuat }}</span>
                    @endif
                </div>

                <h2 class="fw-bold text-dark mb-4">{{ $item->judul }}</h2>

                <div class="lh-lg text-secondary mb-4">
                    {!! nl2br(e($item->deskripsi)) !!}
                </div>

                @if($item->link_demo)
                    <a href="{{ $item->link_demo }}" target="_blank" class="btn btn-primary px-4 py-2 fw-semibold rounded-pill">
                        <i class="bi bi-box-arrow-up-right me-2"></i> Lihat Live Demo / Proyek
                    </a>
                @endif
            </div>
        </div>

        @if($related->count() > 0)
            <h4 class="fw-bold mb-4 text-dark">Karya Terkait</h4>
            <div class="row g-4">
                @foreach($related as $rel)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                            <img src="{{ asset('storage/' . $rel->foto) }}" class="card-img-top object-fit-cover" style="height: 160px;" alt="{{ $rel->judul }}">
                            <div class="card-body">
                                <h6 class="fw-bold text-dark mb-2">{{ $rel->judul }}</h6>
                                <a href="{{ route('produk.show', $rel->slug) }}" class="btn btn-sm btn-link p-0 text-primary text-decoration-none fw-semibold">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection