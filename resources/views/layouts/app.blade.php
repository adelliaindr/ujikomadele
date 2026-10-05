<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Informasi SMKN 4 Bogor' }}</title>
    <!--logo wesbite-->
    <link rel="icon" type="image/jpeg" href="{{ asset('img/logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.jpg') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <!--bootstrap-icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .hero-section{
            min-height: calc(100vh - 70px);
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url({{ asset('img/smkn4bogor.jpg') }}) center/cover no-repeat;
            color: white;
            padding: 100px 20px;
        }

        /*warna teks untuk link navbar*/
        .custom-nav-link{
            color: #000000 !important; /*warna hitam saat bukan di halaman yang mau dituju*/
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }

        /*warna teks untuk link navbar saat halaman yang dituju*/
        .custom-nav-link.active,
        .custom-nav-link:hover{
            color: #0d6efd !important;
            font-weight: 700;
        }

        .hover-white:hover{
            color: #ffffff !important;
        }

    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm border-bottom">
        <div class="container-fluid px-lg-5">
            <!--logo dan si-kr4bat-->
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark me-0" href="{{ url('/') }}">
                <img src="{{ asset('img/logo.jpg') }}" alt="Logo" width="40" height="40" >
                <span>SI-Kr4bat</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto my-2 my-lg-0 text-center gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link custom-nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-nav-link {{ Request::is('profil*') ? 'active' : '' }}" href="{{ url('/profil') }}">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-nav-link {{ Request::is('program-keahlian*') ? 'active' : '' }}" href="{{ url('/program-keahlian') }}">Program Keahlian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-nav-link {{ Request::is('produk*') ? 'active' : '' }}" href="{{ url('/produk') }}">Produk & Karya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-nav-link {{ Request::is('galeri*') ? 'active' : '' }}" href="{{ route('galeri.index') }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-nav-link {{ Request::is('artikel*') ? 'active' : '' }}" href="{{ route('artikel.index') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-nav-link {{ Request::is('kontak*') ? 'active' : '' }}" href="{{ url('/kontak') }}">Kontak</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center justify-content-center">
                    <a href="{{ url('/login') }}" class="btn btn-primary fw-semibold px-3 py-2 text-white">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="bg-primary text-white pt-5 pb-3 mt-auto">
        <div class="container text-start text-md-center" style="max-width: 1200px;">
            <div class="row g-4 mb-4 text-start">

            <!--profil singkat-->
            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold text-uppercase mb-3 text-white">SMKN 4 Bogor</h5>
                <p class="text-white small mb-3">
                    Sekolah Menengah Kejuruan Negeri 4 Bogor berfokus pada pengembangan keahlian teknologi, karakter, dan kesiapan kerja siswa.
                </p>

                <!--medsos-->
                <div class="d-flex gap-2">
                    <a href="https://www.youtube.com/channel/UC4M-6Oc1ZvECz00MlMa4v_A/videos?app=desktop" class="btn btn-outline-light btn-sm rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="https://www.instagram.com/smkn4kotabogor/" class="btn btn-outline-light btn-sm rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/people/SMK-NEGERI-4-KOTA-BOGOR/100054636630766/" class="btn btn-outline-light btn-sm rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                </div>
            </div>
            <!--link cepet-->
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold text-uppercase mb-3 text-white">Navigasi</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <a href="{{ url('/') }}" class="text-white text-decoration-none hover-white">Beranda</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/profil') }}" class="text-white text-decoration-none hover-white">Profil Sekolah</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/program-keahlian') }}" class="text-white text-decoration-none hover-white">Program keahlian</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('produk.index') }}" class="text-white text-decoration-none hover-white">Produk & Karya</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/galeri') }}" class="text-white text-decoration-none hover-white">Galeri</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ url('/artikel') }}" class="text-white text-decoration-none hover-white">Artikel</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('kontak.index') }}" class="text-white text-decoration-none hover-white">Kontak</a>
                    </li>
                </ul>
            </div>
            <!--kontak-->
            <div class="col-lg-5 col-md-12">
                <h5 class="fw-bold text-uppercase mb-3 text-white">Hubungi Kami</h5>
                <ul class="list-unstyled text-white small mb-0">
                    <li class="mb-2 d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill text-white fs-6"></i>
                        <span>Jl. Raya Tajur, Kp. Buntar, RT.03/RW.04, Muarasari, Kec. Bogor Selatan, Kota Bogor, Jawa barat 16137 </span>
                    </li>
                    <li class="mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-white fs-6"></i>
                        <span>0895-1654-0987</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill text-white fs-6"></i>
                        <span>smkn4bogor@smkn4bogor.sch.id</span>
                    </li>
                </ul>
            </div>
            </div>
            <hr class="border-secondary opacity-50 my-4">

            <!--copyright-->
            <div class="row align-items-center text-center text-md-between text-white-50 small">
                <div class="col-md-12 text-center">
                    <p class="m-0">&copy;  {{ date('Y') }} SMKN 4 Bogor. Hal cipta dilindungi.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>