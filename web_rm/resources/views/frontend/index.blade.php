<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body style="background: #f8f9fa;">
    <!-- NAVBAR CUSTOMER -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-shop"></i> Rumah Makan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link active">Pemesanan Menu</span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-3">
        <div class="row">
            <!-- Kolom Daftar Menu -->
            <div class="col-lg-8">
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        <div>
                            <i class="bi bi-list"></i> <b>Data Menu</b>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            {{-- <button type="button" class="btn btn-secondary btn-sm">Semua Kategori</button> --}}
                            <input type="text" class="form-control form-control-sm" placeholder="Cari Menu"
                                id="searchMenu" style="width: 200px;">
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="row" id="menuGrid">
                            @foreach ($menus as $menu)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 menu-card-item">
                                    <div class="card h-100 border border-2 border-light">
                                        @if ($menu->gambar)
                                            <img src="{{ asset('images/menus/' . $menu->gambar) }}" class="card-img-top"
                                                alt="{{ $menu->nama }}"
                                                style="height: 120px; width: 100%; object-fit: cover; object-position: center;">
                                        @endif
                                        <div class="card-body py-2 px-2">
                                            <div class="fw-bold" style="font-size: 1.05rem;">{{ $menu->nama }}</div>
                                            <div class="fw-bold text-success mb-1">
                                                Rp{{ number_format($menu->harga, 0, ',', '.') }}</div>
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                @if ($menu->stok == 0)
                                                    <button type="button" class="btn btn-danger btn-sm w-100"
                                                        disabled>Habis</button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm add-to-cart"
                                                        data-menu-id="{{ $menu->id }}"
                                                        data-menu-nama="{{ $menu->nama }}"
                                                        data-menu-harga="{{ $menu->harga }}"
                                                        data-menu-gambar="{{ $menu->gambar }}">Tambah</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Keranjang -->
            <!-- Keranjang -->
            <div class="col-md-4">
                <form action="{{ route('frontend.order.store') }}" method="POST" id="orderForm">
                    @csrf
                    <div class="position-sticky top-50 vh-60 d-flex flex-column">
                        <div class="card flex-grow-1 shadow-sm overflow-auto">
                            <div class="card-header bg-primary text-white fw-bold">
                                Keranjang
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="mb-3">
                                    <label class="form-label">No Meja</label>
                                    <input type="text" class="form-control" id="noMeja" name="table_number"
                                        placeholder="Masukkan nomor meja" required>
                                </div>

                                <table class="table table-sm align-middle" id="cartTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Menu</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Item keranjang via JS -->
                                    </tbody>
                                </table>

                                <div class="mb-3">
                                    <label class="form-label">Pembayaran</label>
                                    <select class="form-select" id="statusBayar" name="status_bayar">
                                        <option>Cash</option>
                                        <option>Transfer</option>
                                        <option>E-Wallet</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Total Bayar</label>
                                    <input type="text" class="form-control" id="totalBayar" value="Rp 0" readonly>
                                </div>
                                <div id="selectedItems"></div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary w-100" id="simpanTransaksi">
                                    Simpan Transaksi
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .menu-card-item .card {
            transition: box-shadow 0.2s;
        }

        .menu-card-item .card:hover {
            box-shadow: 0 0 0 2px #0d6efd33, 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .menu-card-item .card-img-top {
            background: #f8f9fa;
        }

        .card-header {
            font-size: 1rem;
        }

        .form-label-sm {
            font-size: 0.85rem;
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addToCartBtns = document.querySelectorAll('.add-to-cart');
                const cartTableBody = document.querySelector('#cartTable tbody');
                const cartTotalElement = document.getElementById('totalBayar');
                const selectedItemsDiv = document.getElementById('selectedItems');
                const searchInput = document.getElementById('searchMenu');
                const menuGrid = document.getElementById('menuGrid');
                const orderForm = document.getElementById('orderForm');
                let cart = [];

                function renderCart() {
                    cartTableBody.innerHTML = '';
                    let total = 0;
                    cart.forEach((item, idx) => {
                        total += item.harga * item.qty;
                        cartTableBody.innerHTML += `
                            <tr>
                                <td>${idx + 1}</td>
                                <td>${item.nama}</td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <button type="button" class="btn btn-outline-secondary btn-minus" data-id="${item.id}">-</button>
                                        <input type="text" class="form-control text-center cart-qty" value="${item.qty}" data-id="${item.id}" readonly style="max-width:45px;">
                                        <button type="button" class="btn btn-outline-secondary btn-plus" data-id="${item.id}">+</button>
                                    </div>
                                </td>
                                <td>Rp${item.harga.toLocaleString('id-ID')}</td>
                                <td><button type="button" class="btn btn-danger btn-sm btn-remove" data-id="${item.id}">&times;</button></td>
                            </tr>
                        `;
                    });
                    cartTotalElement.value = 'Rp ' + total.toLocaleString('id-ID');
                    updateSelectedItems();
                }

                function updateSelectedItems() {
                    selectedItemsDiv.innerHTML = '';
                    cart.forEach(item => {
                        selectedItemsDiv.innerHTML += `
                            <input type="hidden" name="items[]" value="${item.id}">
                            <input type="hidden" name="quantities[]" value="${item.qty}">
                        `;
                    });
                }

                addToCartBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = this.dataset.menuId;
                        const nama = this.dataset.menuNama;
                        const harga = parseInt(this.dataset.menuHarga);
                        const exist = cart.find(item => item.id === id);
                        if (exist) {
                            exist.qty += 1;
                        } else {
                            cart.push({
                                id,
                                nama,
                                harga,
                                qty: 1
                            });
                        }
                        renderCart();
                    });
                });

                cartTableBody.addEventListener('click', function(e) {
                    if (e.target.classList.contains('btn-minus')) {
                        const id = e.target.dataset.id;
                        const item = cart.find(i => i.id === id);
                        if (item && item.qty > 1) {
                            item.qty--;
                        }
                        renderCart();
                    } else if (e.target.classList.contains('btn-plus')) {
                        const id = e.target.dataset.id;
                        const item = cart.find(i => i.id === id);
                        if (item) {
                            item.qty++;
                        }
                        renderCart();
                    } else if (e.target.classList.contains('btn-remove')) {
                        const id = e.target.dataset.id;
                        cart = cart.filter(i => i.id !== id);
                        renderCart();
                    }
                });

                orderForm.addEventListener('submit', function(e) {
                    if (cart.length === 0) {
                        e.preventDefault();
                        alert('Silakan pilih minimal satu menu!');
                        return;
                    }
                });

                // Pencarian menu
                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        const keyword = this.value.toLowerCase();
                        const cards = menuGrid.querySelectorAll('.menu-card-item');
                        cards.forEach(card => {
                            const text = card.textContent.toLowerCase();
                            card.style.display = text.includes(keyword) ? '' : 'none';
                        });
                    });
                }
            });
        </script>

    </body>

    </html>
