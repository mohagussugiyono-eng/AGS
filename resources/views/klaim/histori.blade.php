<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Histori Klaim</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.55),
                    rgba(0, 0, 0, 0.55)),
                url("/image/bg-dashboard.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .history-wrapper {
            background: rgba(255, 255, 255, 0.82);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .35);
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background: #2563eb;
            color: #fff;
        }

        .table tbody tr:hover {
            background: rgba(37, 99, 235, 0.08);
        }

        .badge-poin {
            background: #facc15;
            color: #000;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
        }
    </style>
</head>

<body>

    <div class="container mt-5 mb-5">
        <div class="history-wrapper">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-1">📜 Histori Klaim Diskon</h4>
                    <p class="text-muted mb-0">Daftar diskon yang pernah kamu klaim</p>
                </div>

                <a href="/dashboard" class="btn btn-outline-primary btn-sm">
                    ← Kembali
                </a>
            </div>

            @if ($klaim->isEmpty())
                <div class="alert alert-info">
                    Belum ada klaim diskon
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Diskon</th>
                                <th width="150">Poin Digunakan</th>
                                <th width="200">Tanggal Klaim</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($klaim as $i => $k)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $k->nama_diskon }}</td>
                                    <td>
                                        <span class="badge-poin">
                                            {{ number_format($k->poin_digunakan) }} poin
                                        </span>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($k->created_at)->format('d M Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
