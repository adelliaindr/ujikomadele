@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section d-flex align-items-center justify-content-center text-center position-relative py-5 bg-primary text-white">
    <div class="container" style="max-width: 1200px;">
        <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-3">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-white text-decoration-none fw-semibold">Beranda</a>
                </li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Kontak</li>
            </ol>
        </nav>

        <h1 class="display-4 fw-bold mb-3 text-white">Hubungi SMKN 4 Bogor</h1>
        <p class="lead col-lg-8 mx-auto text-white fs-5 mb-0">
            Punya pertanyaan atau butuh informasi lebih lanjut? Silakan hubungi kami melalui formulir atau informasi kontak di bawah ini.
        </p>
    </div>
</section>

<!-- Section Form & Informasi -->
<section class="py-5 bg-light">
    <div class="container" style="max-width: 1200px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Info Kontak & Lokasi -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 h-100 rounded-3">
                    <h4 class="fw-bold mb-4 text-dark">Informasi Kontak</h4>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-geo-alt fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Alamat</h6>
                            <p class="text-muted mb-0">Jl. Raya Tajur, Kp. Buntar RT 02/WO 08, Muarasari, Kec. Bogor Selatan, Kota Bogor, Jawa Barat 16137</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-envelope fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Email</h6>
                            <p class="text-muted mb-0">smkn4@smkn4bogor.sch.id</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary text-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-telephone fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Telepon</h6>
                            <p class="text-muted mb-0">(0251) 7547381</p>
                        </div>
                    </div>

                    <hr class="my-3">

                    <!-- Embedded Map Google -->
                    <div class="rounded-3 overflow-hidden mt-2">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.049889616738!2d106.82211897499402!3d-6.640733393353842!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16b607563%3A0x6a0f37f37478036!2sSMK%20Negeri%204%20Bogor!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                            width="100%" height="220" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <!-- Form Kirim Pesan -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4 h-100 rounded-3">
                    <h4 class="fw-bold mb-4 text-dark">Kirim Pesan</h4>
                    <form action="{{ route('kontak.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="alamat@email.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Subjek</label>
                                <input type="text" name="subjek" class="form-control" placeholder="Tujuan / Perihal pesan" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Pesan</label>
                                <textarea name="pesan" class="form-control" rows="6" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold">
                                    <i class="bi bi-send me-2"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection