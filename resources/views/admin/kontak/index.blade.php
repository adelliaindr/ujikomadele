@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h3 class="fw-bold mb-4">Pesan Masuk (Kontak)</h3>

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
                            <th style="width: 50px;">Status</th>
                            <th>Pengirim</th>
                            <th>Email</th>
                            <th>Subjek</th>
                            <th>Tanggal</th>
                            <th style="width: 150px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesan as $item)
                        <tr class="{{ !$item->is_read ? 'fw-bold bg-light' : '' }}">
                            <td class="text-center">
                                @if(!$item->is_read)
                                    <span class="badge bg-danger">Baru</span>
                                @else
                                    <span class="badge bg-secondary">Dibaca</span>
                                @endif
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->subjek }}</td>
                            <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info text-white me-1" data-bs-toggle="modal" data-bs-target="#modalBaca{{ $item->id }}">Baca</button>
                                <form action="{{ route('admin.kontak.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Detail Pesan -->
                        <div class="modal fade" id="modalBaca{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Detail Pesan dari {{ $item->nama }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-start fw-normal">
                                        <p><strong>Tanggal:</strong> {{ $item->created_at->format('d F Y - H:i') }} WIB</p>
                                        <p><strong>Email:</strong> {{ $item->email }}</p>
                                        <p><strong>Subjek:</strong> {{ $item->subjek }}</p>
                                        <hr>
                                        <p class="mb-0"><strong>Pesan:</strong></p>
                                        <div class="p-3 bg-light rounded mt-2">
                                            {!! nl2br(e($item->pesan)) !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="mailto:{{ $item->email }}" class="btn btn-primary"><i class="bi bi-reply me-1"></i> Balas via Email</a>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada pesan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection