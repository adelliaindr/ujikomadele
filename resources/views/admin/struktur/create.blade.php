@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Jabatan</h1>
            <p class="text-muted small mb-0">Tambahkan pengurus ke struktur organisasi SMKN 4 Bogor.</p>
        </div>
        <a href="{{ route('admin.profil.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            @include('admin.struktur._form', [
                'action' => route('admin.struktur.store'),
                'method' => 'POST',
                'struktur' => null,
            ])
        </div>
    </div>
</div>
@endsection