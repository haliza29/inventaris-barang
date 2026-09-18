<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris Barang</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            /* Latar belakang gambar gudang dengan overlay bayangan hitam transparan */
            background: linear-gradient(rgba(15, 23, 42, 0.65), rgba(15, 23, 42, 0.75)), 
                        url("{{ asset('bg-login.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        /* Kartu Login Transparan / Glassmorphism dengan Bayangan Soft */
        .login-card {
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Styling Input Form */
        .glass-input-group {
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: #1e293b;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.5);
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.3);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="card login-card p-4 p-sm-5">
                    
                    <!-- Header Logo & Title -->
                    <div class="text-center mb-4">
                        <div class="bg-primary text-white rounded-3 d-inline-flex align-items-center justify-content-center mb-3 shadow" style="width: 52px; height: 52px;">
                            <i class="bi bi-box-seam fs-3"></i>
                        </div>
                        <h4 class="fw-bold text-white mb-1">Login Admin</h4>
                        <p class="text-white-50 small mb-0">Masukan akun untuk mengelola inventaris</p>
                    </div>

                    <!-- Alert Error -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show small border-0 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Form Login -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-white small">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text glass-input-group border-end-0 text-muted">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email" 
                                       class="form-control glass-input border-start-0 @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" required placeholder="admin@gmail.com">
                            </div>
                            @error('email')
                                <div class="text-warning small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-white small">Password</label>
                            <div class="input-group">
                                <span class="input-group-text glass-input-group border-end-0 text-muted">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password" id="password" 
                                       class="form-control glass-input border-start-0" 
                                       required placeholder="••••••••">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-gradient w-100 py-2.5 fw-semibold rounded-3 d-flex align-items-center justify-content-center gap-2">
                            <span>Masuk ke Sistem</span>
                            <i class="bi bi-arrow-right-short fs-5"></i>
                        </button>
                    </form>

                </div>
                
                <!-- Footer Note -->
                <div class="text-center mt-4">
                    <p class="text-white-50 small mb-0">
                        &copy; {{ date('Y') }} Sistem Inventaris Barang
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>