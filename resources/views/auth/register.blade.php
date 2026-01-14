<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <title>Register - SewaSport</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
</head>
<body>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card">
            <div class="card-body">
              <h4 class="mb-2">Daftar Akun Baru 🚀</h4>
              <p class="mb-4">Bergabunglah dengan komunitas pelari kami.</p>

              <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama" required />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="email@contoh.com" required />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="············" required />
                </div>
                <div class="mb-3">
                  <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                  <input type="password" class="form-control" name="password_confirmation" placeholder="············" required />
                </div>
                <button class="btn btn-primary d-grid w-100">Daftar</button>
              </form>

              <p class="text-center mt-3">
                <span>Sudah punya akun?</span>
                <a href="{{ route('login') }}"><span>Login di sini</span></a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>