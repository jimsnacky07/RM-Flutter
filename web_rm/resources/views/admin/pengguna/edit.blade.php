@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container-fluid">
    <!-- Header & Back Button -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-user-edit me-2"></i>Edit Pengguna
            </h1>
            <p class="text-muted">Edit informasi pengguna {{ $pengguna->nama ?? 'Pengguna' }}</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.pengguna.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Pengguna
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Pengguna</h5>
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

                    <form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="nama" class="form-label fw-medium">
                                <i class="fas fa-user me-2"></i>Nama Lengkap
                            </label>
                            <input type="text" 
                                   id="nama"
                                   name="nama" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   placeholder="Masukkan nama lengkap"
                                   value="{{ old('nama', $pengguna->nama ?? '') }}"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="mb-4">
                            <label for="username" class="form-label fw-medium">
                                <i class="fas fa-user me-2"></i>Username
                            </label>
                            <input type="text" 
                                   id="username"
                                   name="username" 
                                   class="form-control @error('username') is-invalid @enderror" 
                                   placeholder="Masukkan username"
                                   value="{{ old('username', $pengguna->username ?? '') }}"
                                   required>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium">
                                <i class="fas fa-envelope me-2"></i>Email
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-at text-primary"></i>
                                </span>
                                <input type="email" 
                                       id="email"
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="nama@example.com"
                                       value="{{ old('email', $pengguna->email ?? '') }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Level -->
                        <div class="mb-4">
                            <label for="level" class="form-label fw-medium">
                                <i class="fas fa-user-tag me-2"></i>Level Akses
                            </label>
                            <select id="level" 
                                    name="level" 
                                    class="form-select @error('level') is-invalid @enderror"
                                    required>
                                <option value="">Pilih Level</option>
                                <option value="admin" {{ old('level', $pengguna->level ?? '') == 'admin' ? 'selected' : '' }}>
                                    <i class="fas fa-crown me-2"></i>Admin
                                </option>
                                <option value="operator" {{ old('level', $pengguna->level ?? '') == 'operator' ? 'selected' : '' }}>
                                    <i class="fas fa-user-cog me-2"></i>Operator
                                </option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password (Optional) -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-medium">
                                <i class="fas fa-lock me-2"></i>Password Baru (Opsional)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-key text-warning"></i>
                                </span>
                                <input type="password" 
                                       id="password"
                                       name="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Kosongkan jika tidak ingin mengubah password">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Biarkan kosong jika tidak ingin mengubah password. Minimal 8 karakter jika diisi.
                            </div>
                        </div>

                        <!-- Konfirmasi Password (if password is filled) -->
                        <div class="mb-4" id="passwordConfirmationGroup" style="display: none;">
                            <label for="password_confirmation" class="form-label fw-medium">
                                <i class="fas fa-lock me-2"></i>Konfirmasi Password Baru
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-check-circle text-success"></i>
                                </span>
                                <input type="password" 
                                       id="password_confirmation"
                                       name="password_confirmation" 
                                       class="form-control" 
                                       placeholder="Ulangi password baru">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.pengguna.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Password toggle functionality
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (password.type === 'password') {
        password.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
});

// Show/hide password confirmation based on password input
document.getElementById('password').addEventListener('input', function() {
    const passwordConfirmationGroup = document.getElementById('passwordConfirmationGroup');
    const passwordConfirmation = document.getElementById('password_confirmation');
    
    if (this.value) {
        passwordConfirmationGroup.style.display = 'block';
        passwordConfirmation.required = true;
    } else {
        passwordConfirmationGroup.style.display = 'none';
        passwordConfirmation.required = false;
        passwordConfirmation.value = '';
    }
});

// Password confirmation validation
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    
    if (password && confirmPassword && password !== confirmPassword) {
        this.setCustomValidity('Password tidak cocok');
    } else {
        this.setCustomValidity('');
    }
});
</script>
@endsection