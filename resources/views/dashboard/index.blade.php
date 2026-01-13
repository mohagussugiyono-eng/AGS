<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===== NAVBAR AUTO HIDE ===== */
        .navbar-hover {
            position: fixed;
            top: -70px;
            /* sembunyi */
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            max-width: 1200px;
            z-index: 999;
            transition: all .35s ease;
            backdrop-filter: blur(12px);
            background: rgba(0, 0, 0, 0.45);
            border-radius: 0 0 18px 18px;
        }

        /* kasih jarak aman dari navbar */
        .page-content {
            padding-top: 80px;
            /* sesuaikan tinggi navbar */
        }


        /* trigger area biar gampang munculin */
        .navbar-trigger {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 30px;
            z-index: 998;
        }

        /* kalau hover area atas ATAU navbar */
        .navbar-trigger:hover+.navbar-hover,
        .navbar-hover:hover {
            top: 0;
        }

        /* tombol navbar */
        .navbar-hover .btn {
            border-color: rgba(255, 255, 255, .6);
        }

        /* ===== BACKGROUND DASHBOARD ===== */
        body {
            min-height: 100vh;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.55),
                    rgba(0, 0, 0, 0.55)),
                url("/image/bg-dashboard.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* ===== WRAPPER BIAR TEKS KEBACA ===== */
        .dashboard-wrapper {
            background: rgba(255, 255, 255, 0.711);
            border-radius: 18px;
            padding: 28px;
        }

        /* ===== BANNER DISKON ===== */
        .banner-card {
            position: relative;
            height: 230px;
            border-radius: 16px;
            overflow: hidden;
            color: #fff;
            background-size: cover;
            background-position: center;
            transition: all .25s ease-in-out;
        }

        .banner-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(0, 0, 0, .75),
                    rgba(0, 0, 0, .25));
            pointer-events: none;
        }

        .banner-content {
            position: absolute;
            bottom: 0;
            z-index: 2;
            padding: 18px;
            width: 100%;
        }

        .banner-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, .35);
        }

        .badge-discount {
            background: #ffc107;
            color: #000;
            font-weight: 600;
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 20px;
        }
    </style>
</head>

<body>

    <!-- AREA PEMICU (TIDAK KELIHATAN) -->
    <div class="navbar-trigger"></div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-hover navbar-dark px-4 py-2">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <span class="navbar-brand fw-bold">
                AGS Dashboard
            </span>

            <div class="d-flex gap-2">
                <a href="{{ route('histori.klaim') }}" class="btn btn-outline-light btn-sm">
                    Histori Klaim
                </a>

                <form method="POST" action="/logout">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </nav>


    <div class="container mb-5 page-content">
        <div class="dashboard-wrapper">

            {{-- NOTIFIKASI --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- USER CARD --}}
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>

                                @php
                                    $badge = match ($level) {
                                        'Bronze' => 'secondary',
                                        'Silver' => 'info',
                                        'Gold' => 'warning',
                                        'Platinum' => 'primary',
                                    };
                                @endphp

                                <span class="badge bg-{{ $badge }} fs-6 px-3 py-2">
                                    {{ $level }}
                                </span>
                            </div>

                            <hr>

                            <div class="row text-center">
                                <div class="col">
                                    <p class="mb-1 text-muted">Total Poin</p>
                                    <h4>{{ number_format($totalPoin) }}</h4>
                                </div>
                                <div class="col">
                                    <p class="mb-1 text-muted">Poin Tersedia</p>
                                    <h4>{{ number_format($poinTersedia) }}</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- JUDUL DISKON --}}
            <div class="row mb-3">
                <div class="col">
                    <h4>🎁 Diskon Spesial Untukmu</h4>
                    <p class="text-muted">Diskon sesuai level akun kamu</p>
                </div>
            </div>

            {{-- DAFTAR DISKON --}}
            <div class="row">
                @foreach ($discounts as $discount)
                    @php
                        $images = [
                            'https://images.unsplash.com/photo-1607082349566-187342175e2f',
                            'https://images.unsplash.com/photo-1523275335684-37898b6baf30',
                            'https://images.unsplash.com/photo-1512436991641-6745cdb1723f',
                            'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d',
                        ];
                        $bg = $images[$discount->id % count($images)];
                    @endphp

                    <div class="col-md-4 mb-4">
                        <div class="banner-card" style="background-image: url('{{ $bg }}')">

                            <div class="banner-content">
                                <span class="badge badge-discount mb-2">
                                    {{ $discount->discount_percent }}% OFF
                                </span>

                                <h5 class="mb-1">{{ $discount->title }}</h5>

                                <small class="d-block mb-2">
                                    Harga poin: {{ number_format($discount->poin_harga) }}
                                </small>

                                <form method="POST" action="{{ route('discount.claim', $discount->id) }}">
                                    @csrf
                                    <button class="btn btn-light btn-sm w-100 fw-semibold">
                                        Klaim Diskon
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
