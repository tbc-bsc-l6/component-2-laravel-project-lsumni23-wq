{{-- resources/views/auth/forgot-password.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | College Management System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at top left, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .auth-wrapper {
            max-width: 900px;
            width: 100%;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(18px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-left {
            background: linear-gradient(160deg, #5f72ff, #9a4eff);
            color: #fff;
            padding: 3rem 2.5rem;
            height: 100%;
        }

        .auth-left i {
            font-size: 4rem;
            opacity: 0.9;
        }

        .auth-right {
            background: #ffffff;
            padding: 3rem 2.5rem;
        }

        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 0 0.15rem rgba(108, 99, 255, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(118, 75, 162, 0.35);
        }

        .alert {
            border-radius: 12px;
            font-size: 0.9rem;
        }

        .back-link {
            font-size: 0.9rem;
        }

        .back-link a {
            color: #6c63ff;
            font-weight: 500;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .auth-left {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="row g-0 auth-card">
        
        <!-- Left Side -->
        <div class="col-md-5 auth-left d-flex flex-column justify-content-center">
            <i class="bi bi-shield-lock-fill mb-4"></i>
            <h3 class="fw-semibold">Password Recovery</h3>
            <p class="opacity-75 mt-2">
                Forgot your password?  
                Enter your email and we’ll send you a secure reset link.
            </p>
        </div>

        <!-- Right Side -->
        <div class="col-md-7 auth-right">
            <h4 class="fw-semibold mb-2">Reset your password</h4>
            <p class="text-muted mb-4">We’ll email you instructions.</p>

            @if (session('status'))
                <div class="alert alert-success d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-medium">
                        Email address
                    </label>
                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="you@example.com"
                           value="{{ old('email') }}"
                           required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-envelope-paper-fill me-1"></i>
                        Send Reset Link
                    </button>
                </div>
            </form>

            <div class="text-center back-link">
                Remember your password?
                <a href="{{ route('login') }}">Back to login</a>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
