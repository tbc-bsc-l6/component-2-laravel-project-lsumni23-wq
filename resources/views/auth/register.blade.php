{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | College Management System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(120deg, #f4f6fb 70%, #eef1ff);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .register-wrapper {
            width: 100%;
            max-width: 960px;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 30px 70px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* LEFT INFO */
        .register-info {
            background: linear-gradient(160deg, #667eea, #764ba2);
            color: #fff;
            padding: 3.5rem;
            height: 100%;
        }

        .register-info h2 {
            font-weight: 700;
        }

        .info-step {
            display: flex;
            align-items: center;
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }

        .info-step i {
            font-size: 1.4rem;
            margin-right: 0.75rem;
            opacity: 0.9;
        }

        /* RIGHT FORM */
        .register-form {
            padding: 3.5rem;
        }

        .form-floating > .form-control {
            border-radius: 12px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.15rem rgba(102, 126, 234, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 30px rgba(118, 75, 162, 0.35);
        }

        .hint {
            font-size: 0.8rem;
            color: #777;
        }

        .link {
            color: #667eea;
            font-weight: 500;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .register-info {
                display: none;
            }
            .register-form {
                padding: 2.5rem;
            }
        }
    </style>
</head>
<body>

<div class="register-wrapper row g-0">

    <!-- LEFT PANEL -->
    <div class="col-lg-5 register-info">
        <h2>Join the Platform</h2>
        <p class="opacity-75 mt-2">
            Create your account and get access to the college management system.
        </p>

        <div class="info-step">
            <i class="bi bi-person-check-fill"></i>
            Create your profile
        </div>

        <div class="info-step">
            <i class="bi bi-shield-lock-fill"></i>
            Secure your credentials
        </div>

        <div class="info-step">
            <i class="bi bi-speedometer2"></i>
            Access your dashboard
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="col-lg-7 register-form">
        <h4 class="fw-bold mb-1">Create your account</h4>
        <p class="text-muted mb-4">It only takes a minute.</p>

        @if(session('error'))
            <div class="alert alert-danger small">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger small">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name"
                       name="name"
                       placeholder="Full Name"
                       value="{{ old('name') }}"
                       required autofocus>
                <label>Full name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       name="email"
                       placeholder="Email address"
                       value="{{ old('email') }}"
                       required>
                <label>Email address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="password"
                       name="password"
                       placeholder="Password"
                       required>
                <label>Password</label>
                <div class="hint mt-1">
                    Use at least 8 characters with letters & numbers
                </div>
            </div>

            <div class="form-floating mb-4">
                <input type="password"
                       class="form-control"
                       id="password_confirmation"
                       name="password_confirmation"
                       placeholder="Confirm Password"
                       required>
                <label>Confirm password</label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-register text-white">
                    Create Account
                </button>
            </div>
        </form>

        <div class="text-center small">
            Already have an account?
            <a href="{{ route('login') }}" class="link">Sign in</a>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
