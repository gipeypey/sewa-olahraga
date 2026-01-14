<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SewaSport - Solusi Alat Olahraga</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <style>
        .hero-section {
            background: linear-gradient(135deg, #696cff 0%, #3031f1 100%);
            color: white;
            padding: 100px 0;
            border-bottom-left-radius: 50% 20%;
            border-bottom-right-radius: 50% 20%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-3" href="#">🏃‍♂️ Sewa-Olahraga</a>
            <div class="ms-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold text-white mb-3">Sewa Alat Olahraga Tanpa Ribet</h1>
            <p class="lead mb-5">Tersedia perlengkapan Road Running dan Trail Running kualitas premium.</p>
            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="250" alt="Hero Image">
        </div>
    </div>

    <div class="container py-5 text-center">
        <div class="row">
            <div class="col-md-4 mb-4">
                <i class="bx bx-check-shield fs-1 text-primary"></i>
                <h4 class="mt-3">Alat Terjamin</h4>
                <p class="text-muted">Semua alat selalu dicek kebersihannya dan fungsinya.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="bx bx-time-five fs-1 text-primary"></i>
                <h4 class="mt-3">Proses Cepat</h4>
                <p class="text-muted">Booking via web, ambil alat di store kami.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="bx bx-wallet fs-1 text-primary"></i>
                <h4 class="mt-3">Harga Terjangkau</h4>
                <p class="text-muted">Sewa harian dengan harga bersaing bagi komunitas lari.</p>
            </div>
        </div>
    </div>
</body>
</html>