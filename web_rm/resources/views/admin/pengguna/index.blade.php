@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="container-fluid">
    <!-- Header & Action Buttons -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-users me-2"></i>Kelola Pengguna
            </h1>
            <p class="text-muted">Kelola data pengguna sistem</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Pengguna
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Users Table Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i>Daftar Pengguna</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-2"></i>No</th>
                            <th><i class="fas fa-user me-2"></i>Nama</th>
                            <th><i class="fas fa-envelope me-2"></i>Email</th>
                            <th><i class="fas fa-user-tag me-2"></i>Level</th>
                            <th class="text-center"><i class="fas fa-cogs me-2"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengguna as $index => $p)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <span class="fw-medium">{{ $p->nama }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $p->email }}</span>
                                </td>
                                <td>
                                    @if($p->level === 'admin')
                                        <span class="badge bg-danger">
                                            <i class="fas fa-crown me-1"></i>Admin
                                        </span>
                                    @elseif($p->level === 'operator')
                                        <span class="badge bg-warning">
                                            <i class="fas fa-user-cog me-1"></i>Operator
                                        </span>
                                    @else
                                        <span class="badge bg-info">
                                            <i class="fas fa-user me-1"></i>{{ ucfirst($p->level) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.pengguna.edit', $p->id) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           data-bs-toggle="tooltip" 
                                           title="Edit Pengguna">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $p->id }}"
                                                title="Hapus Pengguna">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger">
                                                <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus pengguna <strong>{{ $p->nama }}</strong>?</p>
                                            <p class="text-muted small">Tindakan ini tidak dapat dibatalkan.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-2"></i>Batal
                                            </button>
                                            <form action="{{ route('admin.pengguna.destroy', $p->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash me-2"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <div class="py-4">
                                        <i class="fas fa-users fa-3x mb-3 text-muted"></i>
                                        <p class="h5 mb-2">Belum ada pengguna</p>
                                        <p class="text-muted">Mulai dengan menambahkan pengguna pertama</p>
                                        <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus me-2"></i>Tambah Pengguna Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
