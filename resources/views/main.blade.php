<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>AGS | Welcome</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background:
                linear-gradient(rgba(0, 0, 0, 0.45),
                    rgba(0, 0, 0, 0.45)),
                url("/image/bg-dashboard.jpg") no-repeat center center fixed;
            background-size: cover;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            border: none;
        }

        .banner-title {
            letter-spacing: 1px;
        }
    </style>
</head>

<body class="d-flex align-items-center" style="min-height:100vh">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card glass-card shadow-lg text-center">
                    <div class="card-body p-5">

                        <h2 class="fw-bold mb-3 banner-title">
                            Selamat Datang di AGS
                        </h2>

                        <p class="text-muted mb-4">
                            Sistem poin dan klaim diskon berbasis level pengguna
                        </p>

                        <div class="d-grid">
                            <a href="/login" class="btn btn-primary btn-lg">
                                Login
                            </a>
                        </div>

                    </div>
                </div>

                <p class="text-center text-light mt-4">
                    © {{ date('Y') }} AGS Project
                </p>

            </div>
        </div>
    </div>

</body>

</html>
