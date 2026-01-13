<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container d-flex justify-content-between">
            <span class="navbar-brand fw-bold">AGS Dashboard</span>
            <div class="d-flex gap-2">
                <a href="{{ route('histori.klaim') }}" class="btn btn-outline-light btn-sm">Histori Klaim</a>
                <form method="POST" action="/logout">@csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <h5>{{ $user->name }}</h5>
                    <small>{{ $user->email }}</small>
                </div>
                <span class="badge bg-primary fs-6">{{ $level }}</span>
            </div>
            <div class="card-footer text-center">
                <strong>Total Poin:</strong> {{ number_format($totalPoin) }} |
                <strong>Poin Tersedia:</strong> {{ number_format($poinTersedia) }}
            </div>
        </div>

        <div class="row">
            @foreach ($discounts as $d)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5>{{ $d->title }}</h5>
                            <p>{{ $d->description }}</p>
                            <small>Harga poin: {{ number_format($d->poin_harga) }}</small>
                        </div>
                        <div class="card-footer">
                            <form method="POST" action="{{ route('discount.claim', $d->id) }}">
                                @csrf
                                <button class="btn btn-primary w-100">Klaim</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</body>

</html>
