<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .banner-card {
            transition: all .2s ease-in-out;
        }

        .banner-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .15);
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container d-flex justify-content-between">
            <span class="navbar-brand fw-bold">AGS Dashboard</span>
            <div class="d-flex gap-2">
                <a href="{{ route('histori.klaim') }}" class="btn btn-outline-light btn-sm">
                    Histori Klaim
                </a>
                <form method="POST" action="/logout">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">

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
                <div class="card shadow-sm">
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
            @php
                $levels = [
                    'Bronze' => 1,
                    'Silver' => 2,
                    'Gold' => 3,
                    'Platinum' => 4,
                ];
            @endphp

            @forelse ($discounts as $discount)
                @if ($levels[$level] >= $levels[$discount->min_level])
                    <div class="col-md-4 mb-4">
                        <div class="card banner-card h-100">
                            <div class="card-body">
                                <span class="badge bg-success mb-2">
                                    {{ $discount->discount_percent }}% OFF
                                </span>

                                <h5 class="card-title mt-2">
                                    {{ $discount->title }}
                                </h5>

                                <p class="card-text text-muted">
                                    {{ $discount->description }}
                                </p>

                                <small class="text-muted">
                                    Harga poin: {{ number_format($discount->poin_harga) }}
                                </small>
                            </div>

                            <div class="card-footer bg-white">
                                <form method="POST" action="{{ route('discount.claim', $discount->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100">
                                        Klaim Diskon
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col">
                    <div class="alert alert-info">
                        Belum ada diskon tersedia
                    </div>
                </div>
            @endforelse
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
