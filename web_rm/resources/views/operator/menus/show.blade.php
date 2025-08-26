@extends('layouts.operator')

@section('title', 'Detail Menu - ' . $menu->nama)

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('operator.menus.index') }}" class="text-decoration-none">
                            <i class="fas fa-utensils me-1"></i>Menu
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $menu->nama }}</li>
                </ol>
            </nav>

            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-utensils me-2"></i>Detail Menu
            </h1>
            <p class="text-muted">Informasi lengkap tentang menu {{ $menu->nama }}</p>
        </div>
    </div>

    <!-- Menu Detail -->
    <div class="row">
        <!-- Menu Image -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($menu->gambar)
                    <img src="{{ asset('images/menus/' . $menu->gambar) }}"
                        class="img-fluid rounded"
                        alt="{{ $menu->nama }}"
                        style="max-height: 400px; object-fit: cover;">
                    @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                        style="height: 400px;">
                        <i class="fas fa-utensils fa-5x text-muted"></i>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Menu Information -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Menu</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Nama Menu:</strong>
                        </div>
                        <div class="col-sm-8">
                            <h5 class="text-primary mb-0">{{ $menu->nama }}</h5>
                        </div>
                    </div>

                    @if($menu->kategori)
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Kategori:</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="badge bg-info fs-6">
                                <i class="fas fa-tag me-1"></i>{{ $menu->kategori }}
                            </span>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Harga:</strong>
                        </div>
                        <div class="col-sm-8">
                            <h3 class="text-success fw-bold mb-0">
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>

                    @if($menu->deskripsi)
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Deskripsi:</strong>
                        </div>
                        <div class="col-sm-8">
                            <p class="mb-0">{{ $menu->deskripsi }}</p>
                        </div>
                    </div>
                    @endif

                    @if($menu->barcode)
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Barcode:</strong>
                        </div>
                        <div class="col-sm-8">
                            <code class="fs-6">{{ $menu->barcode }}</code>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Dibuat:</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="text-muted">
                                {{ $menu->created_at ? $menu->created_at->format('d M Y H:i') : 'N/A' }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong class="text-muted">Terakhir Update:</strong>
                        </div>
                        <div class="col-sm-8">
                            <span class="text-muted">
                                {{ $menu->updated_at ? $menu->updated_at->format('d M Y H:i') : 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="{{ route('operator.menus.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Menu
            </a>

            <a href="{{ route('operator.dashboard') }}" class="btn btn-outline-primary">
                <i class="fas fa-home me-2"></i>Dashboard
            </a>
        </div>
    </div>
</div>
@endsection