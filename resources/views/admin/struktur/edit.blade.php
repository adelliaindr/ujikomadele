@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Jabatan</h1>
            <p class="text-muted small mb-0">Ubah data {{ $struktur->jabatan }} di struktur organisasi.</p>
        </div>
        <a href="{{ route('admin.profil.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            @include('admin.struktur._form', [
                'action' => route('admin.struktur.update', $struktur),
                'method' => 'PUT',
                'struktur' => $struktur,
            ])
        </div>
    </div>
</div>
@endsection