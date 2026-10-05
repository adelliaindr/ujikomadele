@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Kelola Produk &amp; Karya Siswa</h3>
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Karya
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;">Foto</th>
                            <th>Judul Karya</th>
                            <th>Kategori</th>
                            <th>Pembuat</th>
                            <th style="width: 150px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produk as $item)
                        <tr>
                            <td>
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="rounded object-fit-cover" width="60" height="45">
                                @else
                                    <div class="rounded bg-light border d-flex align-items-center justify-content-center" style="width: 60px; height: 45px;">
                                        <i class="bi bi-image text-secondary"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $item->judul }}</td>
                            <td><span class="badge bg-info text-dark">{{ $item->kategori }}</span></td>
                            <td>{{ $item->pembuat ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.produk.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus karya ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data produk atau karya.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection