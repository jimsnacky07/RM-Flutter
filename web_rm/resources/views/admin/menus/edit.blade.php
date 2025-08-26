@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
<div class="container-fluid">
    <!-- Header & Back Button -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-edit me-2"></i>Edit Menu
            </h1>
            <p class="text-muted">Edit informasi menu {{ $menu->nama ?? 'Menu' }}</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Menu
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Menu</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.menus.update', $menu->id ?? 0) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nama Menu -->
                        <div class="mb-4">
                            <label for="nama" class="form-label fw-medium">
                                <i class="fas fa-utensils me-2"></i>Nama Menu
                            </label>
                            <input type="text" 
                                   id="nama"
                                   name="nama" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   placeholder="Masukkan nama menu"
                                   value="{{ old('nama', $menu->nama ?? '') }}"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <label for="harga" class="form-label fw-medium">
                                <i class="fas fa-tag me-2"></i>Harga
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-money-bill text-success"></i>
                                </span>
                                <input type="number" 
                                       id="harga"
                                       name="harga" 
                                       class="form-control @error('harga') is-invalid @enderror" 
                                       placeholder="0"
                                       value="{{ old('harga', $menu->harga ?? '') }}"
                                       min="0"
                                       required>
                                @error('harga')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="kategori" class="form-label fw-medium">
                                <i class="fas fa-list me-2"></i>Kategori
                            </label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <option value="Makanan Berat" {{ $menu->kategori == 'Makanan Berat' ? 'selected' : '' }}>Makanan Berat</option>
                                <option value="Makanan Ringan" {{ $menu->kategori == 'Makanan Ringan' ? 'selected' : '' }}>Makanan Ringan</option>
                                <option value="Minuman Panas" {{ $menu->kategori == 'Minuman Panas' ? 'selected' : '' }}>Minuman Panas</option>
                                <option value="Minuman Dingin" {{ $menu->kategori == 'Minuman Dingin' ? 'selected' : '' }}>Minuman Dingin</option>
                            </select>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-medium">
                                <i class="fas fa-align-left me-2"></i>Deskripsi
                            </label>
                            <textarea id="deskripsi" 
                                      name="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror" 
                                      rows="4"
                                      placeholder="Masukkan deskripsi menu">{{ old('deskripsi', $menu->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Gambar Saat Ini -->
                        @if($menu->gambar)
                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-image me-2"></i>Gambar Saat Ini
                                </label>
                                <div class="text-center">
                                    <img src="{{ $menu->gambar }}" 
                                         alt="{{ $menu->nama }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 200px;">
                                    <p class="text-muted small mt-2">{{ $menu->gambar }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Upload Gambar Baru -->
                        <div class="mb-4">
                            <label for="gambar" class="form-label fw-medium">
                                <i class="fas fa-upload me-2"></i>Ganti Gambar (Opsional)
                            </label>
                            <input type="file" 
                                   id="gambar"
                                   name="gambar" 
                                   class="form-control @error('gambar') is-invalid @enderror" 
                                   accept="image/*">
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Format yang didukung: JPG, PNG, GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengganti gambar.
                            </div>
                            @error('gambar')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Preview Gambar Baru -->
                        <div class="mb-4" id="imagePreview" style="display: none;">
                            <label class="form-label fw-medium">
                                <i class="fas fa-eye me-2"></i>Preview Gambar Baru
                            </label>
                            <div class="text-center">
                                <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview functionality
document.getElementById('gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');
    const previewDiv = document.getElementById('imagePreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewDiv.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewDiv.style.display = 'none';
    }
});
</script>
@endsection
