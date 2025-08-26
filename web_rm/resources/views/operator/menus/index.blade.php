@extends('layouts.operator')

@section('title', 'Daftar Menu')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-utensils me-2"></i>Daftar Menu
            </h1>
            <p class="text-muted">Lihat semua menu yang tersedia di rumah makan</p>
        </div>
    </div>

    <!-- Menu Grid -->
    <div class="row g-4">
        @forelse($menus as $menu)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100">
                @if($menu->gambar)
                <img src="{{ asset('images/menus/' . $menu->gambar) }}" 
                     class="card-img-top" 
                     alt="{{ $menu->nama }}"
                     style="height: 200px; object-fit: cover;">
                @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                     style="height: 200px;">
                    <i class="fas fa-utensils fa-3x text-muted"></i>
                </div>
                @endif
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary mb-2">{{ $menu->nama }}</h5>
                    
                    @if($menu->kategori)
                    <span class="badge bg-info mb-2">
                        <i class="fas fa-tag me-1"></i>{{ $menu->kategori }}
                    </span>
                    @endif
                    
                    @if($menu->deskripsi)
                    <p class="card-text text-muted flex-grow-1">
                        {{ Str::limit($menu->deskripsi, 100) }}
                    </p>
                    @endif
                    
                    <div class="mt-auto">
                        <h4 class="text-success fw-bold mb-3">
                            Rp {{ number_format($menu->harga, 0, ',', '.') }}
                        </h4>
                        
                        <a href="{{ route('operator.menus.show', $menu->id) }}" 
                           class="btn btn-outline-primary w-100">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-utensils fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada menu tersedia</h5>
                    <p class="text-muted">Silakan hubungi admin untuk menambahkan menu</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($menus->hasPages())
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            <nav aria-label="Menu pagination">
                {{ $menus->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
    @endif
</div>
@endsection
