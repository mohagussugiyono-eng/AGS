<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Histori Klaim</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===== BACKGROUND ===== */
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

        /* ===== WRAPPER ===== */
        .history-wrapper {
            background: rgba(255, 255, 255, 0.516);
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .35);
        }

        /* ===== TABLE ===== */
        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background: #2563eb;
            color: #ffffffb8;
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
            font-size: 13px;
        }

        /* ==========================
           RESPONSIVE MOBILE
        ========================== */
        @media (max-width: 576px) {

            body {
                background-attachment: scroll;
            }

            .container {
                padding-left: 14px;
                padding-right: 14px;
            }

            .history-wrapper {
                padding: 18px;
                border-radius: 14px;
            }

            /* header stack */
            .history-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .history-header h4 {
                font-size: 18px;
            }

            .history-header p {
                font-size: 13px;
            }

            .history-header a {
                width: 100%;
                text-align: center;
            }

            /* table text kecil */
            table {
                font-size: 13px;
            }

            th,
            td {
                white-space: nowrap;
            }

            .badge-poin {
                font-size: 12px;
                padding: 5px 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-4 mb-5">
        <div class="history-wrapper">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4 history-header">
                <div>
                    <h4 class="fw-bold mb-1">📜 Histori Klaim Diskon</h4>
                    <p class="text-muted mb-0">
                        Daftar diskon yang pernah kamu klaim
                    </p>
                </div>

                <a href="/dashboard" class="btn btn-outline-primary btn-sm">
                    ← Kembali
                </a>
            </div>

            @if ($klaim->isEmpty())
                <div class="alert alert-info text-center">
                    Belum ada klaim diskon
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th width="40">No</th>
                                <th>Nama Diskon</th>
                                <th width="140">Poin</th>
                                <th width="170">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($klaim as $i => $k)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $k->nama_diskon }}</td>
                                    <td>
                                        <span class="badge-poin">
                                            {{ number_format($k->poin_digunakan) }}
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
