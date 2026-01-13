<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Histori Klaim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <h4>Histori Klaim Diskon</h4>

        @if ($klaim->isEmpty())
            <div class="alert alert-info">Belum ada klaim</div>
        @else
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Diskon</th>
                    <th>Poin</th>
                    <th>Tanggal</th>
                </tr>
                @foreach ($klaim as $i => $k)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $k->nama_diskon }}</td>
                        <td>{{ number_format($k->poin_digunakan) }}</td>
                        <td>{{ $k->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        @endif

        <a href="/dashboard" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>
