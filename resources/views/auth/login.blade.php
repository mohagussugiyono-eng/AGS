<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;

            /* BAGROUND */
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
                url("/image/bg-dashboard.jpg");
            background-size: cover;
            background-position: center;
        }

        .login-box {
            width: 380px;
            padding: 30px;
            border-radius: 18px;

            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            box-shadow: 0 15px 40px rgba(0, 0, 0, .35);
            color: #fff;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.85);
            border: none;
            border-radius: 10px;
            padding: 12px;
        }

        .form-control:focus {
            box-shadow: none;
            outline: none;
        }

        .btn-login {
            margin-top: 10px;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
        }

        .error {
            background: rgba(255, 0, 0, .15);
            border: 1px solid rgba(255, 0, 0, .4);
            color: #ffdcdc;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 14px;
            color: #333;
        }

        .password-wrapper {
            position: relative;
        }

        /* ===== RESPONSIVE MOBILE ===== */
        @media (max-width: 576px) {

            /* container turun dikit */
            .container {
                padding-left: 14px;
                padding-right: 14px;
            }

            /* card user */
            .card-body {
                padding: 14px;
            }

            /* banner diskon */
            .banner-card {
                height: 190px;
                border-radius: 14px;
            }

            .banner-content {
                padding: 14px;
            }

            /* teks biar gak kegedean */
            h4 {
                font-size: 18px;
            }

            h5 {
                font-size: 16px;
            }

            small {
                font-size: 12px;
            }

            /* tombol klaim full */
            .banner-content button {
                font-size: 14px;
                padding: 8px;
            }

            @media (max-width: 576px) {
                .navbar-brand span {
                    font-size: 14px;
                }
            }
    </style>

</head>

<body>

    <div class="login-box">
        <div class="text-center mb-4">
            <img src="{{ asset('image/logo.png') }}" width="80" class="mb-2">
            <h4 class="fw-bold">AGS Login</h4>
        </div>


        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3 password-wrapper">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                    required>

                <span class="toggle-password" onclick="togglePassword()">
                    👁
                </span>
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-login">
                Login
            </button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const pass = document.getElementById('password');
            pass.type = pass.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>

</html>
