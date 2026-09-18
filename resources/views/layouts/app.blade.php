<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem Inventaris Barang</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f6f9;
            color: #2c3e50;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 700;
            color: #1e3a8a;
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 500;
            color: #4b5563;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #1e40af;
            background-color: #eff6ff;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-stat {
            position: relative;
            overflow: hidden;
        }

        .card-stat .stat-icon {
            position: absolute;
            right: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2.75rem;
            opacity: 0.15;
        }

        .table> :not(caption)>*>* {
            padding: 0.85rem 1rem;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f8fafc;
        }

        .badge-status {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.65rem;
            border-radius: 30px;
        }

        .btn-custom-primary {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            font-weight: 500;
            padding: 0.5rem 1.1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-custom-primary:hover {
            background-color: #1d4ed8;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .footer {
            margin-top: auto;
            background-color: #ffffff;
            border-top: 1px solid #e5e7eb;
            padding: 1.25rem 0;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .thumbnail-img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('barang.index') }}">
                <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center"
                    style="width: 38px; height: 38px;">
                    <i class="bi bi-box-seam fs-5"></i>
                </div>
                <span>Inventaris<span class="text-primary">Barang</span></span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-lg-4 mb-2 mb-lg-0 gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}"
                            href="{{ route('barang.index') }}">
                            <i class="bi bi-boxes me-1"></i> Data Barang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}"
                            href="{{ route('kategori.index') }}">
                            <i class="bi bi-tags me-1"></i> Kategori
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('barang.create') }}"
                        class="btn btn-custom-primary d-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Barang</span>
                    </a>

                    @auth
                        <!-- Informasi User & Tombol Logout -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="py-4">
        <div class="container">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center border-0 shadow-sm mb-4"
                    role="alert">
                    <i class="bi bi-check-circle-fill fs-5 me-2 text-success"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center border-0 shadow-sm mb-4"
                    role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2 text-danger"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <div class="fw-semibold d-flex align-items-center gap-2 mb-1">
                        <i class="bi bi-exclamation-circle-fill"></i> Terdapat kesalahan pada form:
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <div>
                <strong>Sistem Manajemen Inventaris Barang</strong> &copy; {{ date('Y') }}
            </div>
            <div class="text-muted small">
                Technical Test PPI &bull; Laravel v{{ Illuminate\Foundation\Application::VERSION }} &bull; MySQL
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>