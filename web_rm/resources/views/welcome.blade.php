<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rumah Makan - Selamat Datang</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #D2B48C;
            --secondary-color: #8B7355;
            --accent-color: #F5DEB3;
            --text-dark: #2C1810;
            --text-light: #6B7280;
            --bg-light: #FEFEFE;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset("images/background_rm.png") }}') no-repeat center center;
            background-size: cover;
            opacity: 0.1;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* Button Styling */
        .btn {
            border-radius: 0.75rem;
            font-weight: 600;
            padding: 0.75rem 2rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .btn-primary {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            color: var(--primary-color);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            color: var(--secondary-color);
        }

        .btn-outline-light {
            border: 2px solid white;
            color: white;
            background: transparent;
        }

        .btn-outline-light:hover {
            background: white;
            color: var(--primary-color);
        }

        /* Features Section */
        .features {
            padding: 5rem 0;
            background: var(--bg-light);
        }

        .feature-card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }

        /* Menu Preview Section */
        .menu-preview {
            padding: 5rem 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .menu-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .menu-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .menu-content {
            padding: 1.5rem;
        }

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer h5 {
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--accent-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .btn {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in-left {
            animation: slideInLeft 1s ease-out;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-in-right {
            animation: slideInRight 1s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: rgba(0,0,0,0.1);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-utensils me-2"></i>Rumah Makan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="slide-in-left">Selamat Datang di Sistem Rumah Makan</h1>
                    <p class="slide-in-left">Kelola pesanan, menu, dan laporan dengan mudah dan efisien. Sistem yang dirancang khusus untuk kebutuhan rumah makan modern.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="fas fa-rocket me-2"></i>Mulai Sekarang
                        </a>
                        <a href="#features" class="btn btn-outline-light">
                            <i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="fade-in">
                        <i class="fas fa-utensils" style="font-size: 15rem; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-5 fw-bold text-primary mb-3">Fitur Unggulan</h2>
                    <p class="lead text-muted">Sistem yang lengkap untuk mengelola rumah makan Anda</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Manajemen Pesanan</h4>
                        <p class="text-muted">Kelola pesanan dengan mudah, dari konfirmasi hingga selesai. Sistem yang intuitif untuk operator.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Kelola Menu</h4>
                        <p class="text-muted">Tambah, edit, dan hapus menu dengan gambar. Kategorisasi menu yang terorganisir.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Laporan Lengkap</h4>
                        <p class="text-muted">Laporan penjualan bulanan dan tahunan dengan grafik visual yang informatif.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Manajemen Pengguna</h4>
                        <p class="text-muted">Kelola akses admin dan operator dengan sistem role yang aman dan fleksibel.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Responsif Design</h4>
                        <p class="text-muted">Interface yang responsif dan mudah digunakan di berbagai perangkat.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Keamanan Tinggi</h4>
                        <p class="text-muted">Sistem keamanan yang kuat dengan autentikasi dan otorisasi yang terjamin.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Preview Section -->
    <section class="menu-preview" id="menu">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-5 fw-bold text-primary mb-3">Menu Favorit</h2>
                    <p class="lead text-muted">Beberapa menu unggulan yang tersedia</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="menu-card">
                        <img src="{{ asset('images/menus/rendang.png') }}" alt="Rendang" class="menu-image">
                        <div class="menu-content">
                            <h5 class="fw-bold">Rendang</h5>
                            <p class="text-muted">Rendang daging sapi dengan bumbu rempah khas Padang</p>
                            <span class="badge bg-success">Rp 25.000</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="menu-card">
                        <img src="{{ asset('images/menus/ayam_goreng.png') }}" alt="Ayam Goreng" class="menu-image">
                        <div class="menu-content">
                            <h5 class="fw-bold">Ayam Goreng</h5>
                            <p class="text-muted">Ayam goreng crispy dengan bumbu rahasia</p>
                            <span class="badge bg-success">Rp 18.000</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="menu-card">
                        <img src="{{ asset('images/menus/ikan_bakar.png') }}" alt="Ikan Bakar" class="menu-image">
                        <div class="menu-content">
                            <h5 class="fw-bold">Ikan Bakar</h5>
                            <p class="text-muted">Ikan bakar dengan bumbu khas yang meresap</p>
                            <span class="badge bg-success">Rp 22.000</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="menu-card">
                        <img src="{{ asset('images/menus/gulai_tambusu.png') }}" alt="Gulai Tambusu" class="menu-image">
                        <div class="menu-content">
                            <h5 class="fw-bold">Gulai Tambusu</h5>
                            <p class="text-muted">Gulai usus sapi dengan santan kental</p>
                            <span class="badge bg-success">Rp 20.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-eye me-2"></i>Lihat Semua Menu
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="fas fa-utensils me-2"></i>Rumah Makan</h5>
                    <p class="text-muted">Sistem manajemen rumah makan yang modern dan efisien untuk mengelola operasional bisnis Anda.</p>
                </div>

                <div class="col-lg-4 mb-4">
                    <h5>Fitur Utama</h5>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="fas fa-chevron-right me-2"></i>Manajemen Pesanan</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right me-2"></i>Kelola Menu</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right me-2"></i>Laporan Penjualan</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right me-2"></i>Manajemen Pengguna</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 mb-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Contoh No. 123, Kota</li>
                        <li><i class="fas fa-phone me-2"></i>+62 812-3456-7890</li>
                        <li><i class="fas fa-envelope me-2"></i>info@rumahmakan.com</li>
                    </ul>
                </div>
            </div>

            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">&copy; 2024 Sistem Rumah Makan. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex gap-3 justify-content-md-end">
                        <a href="#" class="text-muted"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Smooth Scrolling -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all feature cards and menu cards
        document.querySelectorAll('.feature-card, .menu-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
    </script>
</body>

</html>