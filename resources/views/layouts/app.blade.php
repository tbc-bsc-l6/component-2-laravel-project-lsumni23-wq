{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'College Management System')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Global Styles -->
    <style>
        body {
            background-color: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar-header {
            padding: 1.25rem;
            border-bottom: 1px solid #e5e7eb;
            text-align: center;
        }

        .sidebar-header h4 {
            font-weight: 700;
            color: #4f46e5;
            margin-bottom: 0;
        }

        .sidebar-header small {
            color: #6b7280;
        }

        .sidebar .nav {
            padding: 1rem 0.75rem;
        }

        .sidebar .nav-link {
            color: #374151;
            padding: 0.65rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar .nav-link:hover {
            background-color: #f3f4f6;
            color: #4f46e5;
        }

        .sidebar .nav-link.active {
            background-color: #4f46e5;
            color: #ffffff;
            font-weight: 600;
        }

        /* Main Content */
        .content-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.75rem 1.5rem;
        }

        .topbar-title {
            font-weight: 600;
            color: #111827;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
        }

        /* Alerts */
        .alert {
            border-radius: 0.75rem;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <nav class="col-md-2 sidebar p-0 d-none d-md-block">
            <div class="sidebar-header">
                <h4>SumSchool</h4>
                <small>{{ auth()->user()->role->role }}</small>
            </div>

            @include('layouts.navigation')
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 ms-sm-auto content-wrapper p-0">

            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between align-items-center">
                <h5 class="topbar-title mb-0">
                    @yield('page-title', 'Dashboard')
                </h5>

                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i>
                        {{ auth()->user()->name }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-1"></i> Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-4 flex-grow-1">

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Page Content --}}
                @yield('content')

            </div>
        </main>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
