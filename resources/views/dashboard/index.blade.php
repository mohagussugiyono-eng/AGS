<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Bootstrap 5 -->
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

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container d-flex justify-content-between">
            <span class="navbar-brand fw-bold">AGS Dashboard</span>

            <form method="POST" action="/logout">
                @csrf
                <button class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">

        <!-- NOTIFIKASI -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- USER CARD -->
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
                                $badge = match ($user->level) {
                                    'Bronze' => 'secondary',
                                    'Silver' => 'info',
                                    'Gold' => 'warning',
                                    'Platinum' => 'primary',
                                };
                            @endphp

                            <span class="badge bg-{{ $badge }} fs-6 px-3 py-2">
                                {{ $user->level }}
                            </span>
                        </div>

                        <hr>

                        <div class="row text-center">
                            <div class="col">
                                <p class="mb-1 text-muted">Poin</p>
                                <h4>{{ number_format($user->points) }}</h4>
                            </div>
                            <div class="col">
                                <p class="mb-1 text-muted">Status</p>
                                <span class="badge bg-success">Aktif</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- DISCOUNT TITLE -->
        <div class="row mb-3">
            <div class="col">
                <h4>🎁 Diskon Spesial Untukmu</h4>
                <p class="text-muted">Klik diskon untuk klaim</p>
            </div>
        </div>

        <!-- DISCOUNT LIST -->
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
                @if ($levels[$user->level] >= $levels[$discount->min_level])
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
                                    Minimal level: {{ $discount->min_level }}
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
