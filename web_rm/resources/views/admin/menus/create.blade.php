@extends('layouts.admin')

@section('title', 'Tambah Menu')

@section('content')
<div class="container-fluid">
    <!-- Header & Back Button -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-plus me-2"></i>Tambah Menu Baru
            </h1>
            <p class="text-muted">Tambahkan menu makanan atau minuman baru</p>
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
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Tambah Menu</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
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
                                   value="{{ old('nama') }}"
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
                                       value="{{ old('harga') }}"
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
                                <option value="Makanan Berat">Makanan Berat</option>
                                <option value="Makanan Ringan">Makanan Ringan</option>
                                <option value="Minuman Panas">Minuman Panas</option>
                                <option value="Minuman Dingin">Minuman Dingin</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
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
                                      placeholder="Masukkan deskripsi menu">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <label for="gambar" class="form-label fw-medium">
                                <i class="fas fa-image me-2"></i>Gambar Menu
                            </label>
                            <input type="file" 
                                   id="gambar"
                                   name="gambar" 
                                   class="form-control @error('gambar') is-invalid @enderror" 
                                   accept="image/*"
                                   required>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.
                            </div>
                            @error('gambar')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Preview Gambar -->
                        <div class="mb-4" id="imagePreview" style="display: none;">
                            <label class="form-label fw-medium">
                                <i class="fas fa-eye me-2"></i>Preview Gambar
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
                                <i class="fas fa-save me-2"></i>Simpan Menu
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
