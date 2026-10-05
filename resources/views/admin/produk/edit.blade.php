@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Edit Karya</h3>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-9">
            @include('admin.produk._form', [
                'action' => route('admin.produk.update', $produk->id),
                'method' => 'PUT',
                'produk' => $produk,
            ])
        </div>
    </div>
</div>
@endsection