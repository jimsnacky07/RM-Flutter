@extends('layouts.admin')

@section('title', 'Daftar Menu')

@section('content')
    <div class="container-fluid">
        <!-- Header & Action Buttons -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-primary">
                    <i class="fas fa-utensils me-2"></i>Daftar Menu
                </h1>
                <p class="text-muted">Kelola menu makanan dan minuman</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Menu
                </a>
            </div>
            <button id="btnGenerateQR" class="btn btn-success mb-3">
                <i class="fas fa-qrcode me-2"></i>Generate QR Code
            </button>

        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Menu Table Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-table me-2"></i>Daftar Menu</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-image me-2"></i>Gambar</th>
                                <th><i class="fas fa-utensils me-2"></i>Nama Menu</th>
                                <th><i class="fas fa-tag me-2"></i>Harga</th>
                                <th><i class="fas fa-boxes me-2"></i>Stok</th>
                                <th><i class="fas fa-list me-2"></i>Kategori</th>
                                {{-- <th><i class="fas fa-qrcode me-2"></i>Barcode</th> --}}
                                <th class="text-center"><i class="fas fa-cogs me-2"></i>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $menu)
                                <tr>
                                    <td>
                                        @if ($menu->gambar)
                                            <div class="position-relative">
                                                <img src="{{ asset('images/menus/' . $menu->gambar) }}"
                                                    alt="{{ $menu->nama }}" class="rounded"
                                                    style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                                    data-bs-toggle="modal" data-bs-target="#imageModal{{ $menu->id }}"
                                                    title="Klik untuk melihat gambar">
                                            </div>
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width: 80px; height: 80px;">
                                                <i class="fas fa-image fa-2x text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="fas fa-utensils text-success"></i>
                                            </div>
                                            <span class="fw-medium">{{ $menu->nama }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success fs-6">Rp
                                            {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        @if ($menu->stok !== null)
                                            @if ($menu->stok > 0)
                                                <span class="badge bg-primary fs-6">{{ $menu->stok }}</span>
                                            @else
                                                <span class="badge bg-danger fs-6">Habis</span>
                                            @endif
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada data</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($menu->kategori)
                                            <span class="badge
                                                bg-info">
                                                <i class="fas fa-tag me-1"></i>{{ $menu->kategori }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-tag me-1"></i>Umum
                                            </span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        @if ($menu->barcode)
                                            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($menu->barcode, 'C128') }}"
                                                alt="Barcode {{ $menu->barcode }}" class="img-fluid"
                                                style="max-height: 50px;">
                                            <div class="text-muted  small">{{ $menu->barcode }}</div>
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada data</span>
                                        @endif
                                    </td> --}}
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                                class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Edit Menu">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $menu->id }}"
                                                title="Hapus Menu">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <div class="py-4">
                                            <i class="fas fa-utensils fa-3x mb-3 text-muted"></i>
                                            <p class="h5 mb-2">Belum ada menu tersedia</p>
                                            <p class="text-muted">Mulai dengan menambahkan menu pertama</p>
                                            <a href="{{ route('admin.menus.create') }}" class="btn btn-primary mt-2">
                                                <i class="fas fa-plus me-2"></i>Tambah Menu Pertama
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

    <!-- Image Preview Modals -->
    @foreach ($menus as $menu)
        @if ($menu->gambar)
            <div class="modal fade" id="imageModal{{ $menu->id }}" tabindex="-1"
                aria-labelledby="imageModalLabel{{ $menu->id }}">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel{{ $menu->id }}">
                                <i class="fas fa-image me-2"></i>{{ $menu->nama }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset('images/menus/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                                class="img-fluid rounded shadow-sm" style="max-height: 500px; object-fit: contain;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal{{ $menu->id }}" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $menu->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel{{ $menu->id }}">
                            <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus menu <strong>{{ $menu->nama }}</strong>?</p>
                        <p class="text-muted small">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="d-inline">
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
    @endforeach
@endsection

@push('scripts')
    <script>
        // Initialize tooltips for action buttons
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Initialize all modals properly
            document.querySelectorAll('.modal').forEach(function(modalElement) {
                const modal = new bootstrap.Modal(modalElement, {
                    backdrop: true,
                    keyboard: true,
                    focus: true
                });

                // Store modal instance for later use
                modalElement.bootstrapModal = modal;
            });

            // Add click event for image preview
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(trigger) {
                trigger.addEventListener('click', function(e) {
                    if (this.getAttribute('data-bs-target').includes('imageModal')) {
                        e.preventDefault();
                        const modalId = this.getAttribute('data-bs-target');
                        const modalElement = document.querySelector(modalId);

                        if (modalElement && modalElement.bootstrapModal) {
                            modalElement.bootstrapModal.show();
                        }
                    }
                });
            });
        });

        // Confirm delete function
        function confirmDelete(menuName) {
            return confirm(`Apakah Anda yakin ingin menghapus menu "${menuName}"?`);
        }
    </script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnGenerateQR = document.getElementById('btnGenerateQR');

            btnGenerateQR.addEventListener('click', function() {
                btnGenerateQR.disabled = true; // Disable sementara
                btnGenerateQR.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';

                fetch("{{ route('admin.menus.generateQRCode') }}")
                    .then(response => response.text())
                    .then(html => {
                        // Masukkan HTML modal ke body
                        const modalContainer = document.createElement('div');
                        modalContainer.innerHTML = html;
                        document.body.appendChild(modalContainer);

                        // Tampilkan modal
                        const qrModalEl = document.getElementById('qrModal');
                        const qrModal = new bootstrap.Modal(qrModalEl);
                        qrModal.show();

                        // Hapus modal saat ditutup untuk menghindari duplikasi
                        qrModalEl.addEventListener('hidden.bs.modal', function() {
                            qrModalEl.remove();
                        });
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Gagal generate QR Code');
                    })
                    .finally(() => {
                        btnGenerateQR.disabled = false;
                        btnGenerateQR.innerHTML = '<i class="fas fa-qrcode me-2"></i>Generate QR Code';
                    });
            });
        });
    </script>
@endpush
