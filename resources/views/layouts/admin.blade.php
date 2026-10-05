<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - SMKN 4 Bogor')</title>

    <!--logo wesbite-->
    <link rel="icon" type="image/jpeg" href="{{ asset('img/logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.jpg') }}">

    <!--bootstrap 5 css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        /*sidebar styling*/
        .sidebar{
            width: 260px;
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e9ecef;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }
        .sidebar .nav-link{
            color: #495057;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active{
            background-color: #0d6efd;
            color: #ffffff;
        }
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            padding: 2rem
        }

    </style>
</head>
<body>
    <div class="d-flex">
    <!--sidebae navbar-->
    <aside class="sidebar p-3 d-flex flex-column justify-content-between">
        <div>
    <!-- Logo & Brand Header -->
    <div class="d-flex align-items-center gap-2 px-3 py-3 mb-3 border-bottom">
        <img src="{{ asset('img/logo.jpg') }}" alt="Logo SMKN 4 Bogor" class="rounded" style="height: 40px; width: auto; object-fit: contain;">
        <div>
            <h5 class="fw-bold mb-0 text-dark lh-1">SI-Kr4bat</h5>
            <small class="text-muted style-small" style="font-size: 0.75rem;">SMKN 4 Bogor</small>
        </div>
    </div>

    <!-- Navigasi Utama -->
    <nav class="nav flex-column gap-1 px-2">
        <!-- Dasbor -->
        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-grid-1x2-fill me-2"></i>
            <span>Dasbor</span>
        </a>

        <!-- Header Seksi Konten -->
        <div class="sidebar-heading text-uppercase text-muted fw-bold px-3 mt-3 mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">
            Kelola Konten
        </div>

        <!-- Profil Sekolah -->
        <a class="nav-link {{ request()->is('admin/profil*') ? 'active' : '' }}" href="{{ route('admin.profil.index') }}">
            <i class="bi bi-building me-2"></i>
            <span>Profil Sekolah</span>
        </a>

        <!-- Program Keahlian -->
        <a class="nav-link {{ request()->is('admin/program*') ? 'active' : '' }}" href="{{ route('admin.program.index') }}">
            <i class="bi bi-award-fill me-2"></i>
            <span>Program Keahlian</span>
        </a>

        <!-- Produk & Karya -->
        <a class="nav-link {{ request()->is('admin/produk*') ? 'active' : '' }}" href="{{ route('admin.produk.index') }}">
            <i class="bi bi-box-seam-fill me-2"></i>
            <span>Produk & Karya</span>
        </a>

        <!-- Galeri -->
        <a class="nav-link {{ request()->is('admin/galeri*') ? 'active' : '' }}" href="{{ route('admin.galeri.index') }}">
            <i class="bi bi-images me-2"></i>
            <span>Galeri</span>
        </a>

        <!-- Artikel -->
        <a class="nav-link {{ request()->is('admin/artikel*') ? 'active' : '' }}" href="{{ route('admin.artikel.index') }}">
            <i class="bi bi-newspaper me-2"></i>
            <span>Artikel</span>
        </a>

        <!-- Header Seksi Pesan -->
        <div class="sidebar-heading text-uppercase text-muted fw-bold px-3 mt-3 mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">
            Pesan & Interaksi
        </div>

        <!-- Pesan Masuk / Kontak -->
        <a class="nav-link {{ request()->is('admin/kontak*') ? 'active' : '' }}" href="{{ route('admin.kontak.index') }}">
            <i class="bi bi-envelope-paper-fill me-2"></i>
            <span>Pesan Masuk</span>
        </a>

        <hr class="my-3 mx-2 border-secondary opacity-25">

        <!-- Lihat Website Publik -->
        <a class="nav-link text-primary fw-semibold" href="{{ url('/') }}" target="_blank">
            <i class="bi bi-box-arrow-up-right me-2"></i>
            <span>Lihat Website</span>
        </a>
    </nav>
</div>
        <!--tombolkeluar-->
        <div class="pt-3 border-top">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link text-danger w-100 border-0 bg-transparent text-start">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>

    </div>

    <!--bootstrap 5 js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>