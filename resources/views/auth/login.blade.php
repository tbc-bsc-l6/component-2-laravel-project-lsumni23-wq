{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | College Management System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #f4f6fb;
            display: flex;
        }

        .auth-container {
            width: 100%;
            display: flex;
        }

        /* LEFT PANEL */
        .auth-left {
            background: linear-gradient(145deg, #1e3c72, #2a5298);
            color: #fff;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-left h1 {
            font-weight: 700;
            line-height: 1.2;
        }

        .role-card {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 14px;
            padding: 1rem 1.25rem;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        /* RIGHT PANEL */
        .auth-right {
            background: #ffffff;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        .form-floating > .form-control {
            border-radius: 12px;
        }

        .form-control:focus {
            border-color: #2a5298;
            box-shadow: 0 0 0 0.15rem rgba(42, 82, 152, 0.25);
        }

        .btn-login {
            background: #2a5298;
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #1e3c72;
            transform: translateY(-1px);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 16px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }

        .link {
            text-decoration: none;
            font-weight: 500;
            color: #2a5298;
        }

        .link:hover {
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .auth-left {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="auth-container">

    <!-- LEFT BRAND PANEL -->
    <div class="auth-left col-lg-5">
        <h1>SumSchool</h1>
        <p class="mt-3 opacity-75">
            Centralized platform for administrators, teachers, and students.
        </p>

        <div class="role-card">
            <strong>Admin</strong><br>
            admin@college.com / password
        </div>

        <div class="role-card">
            <strong>Teacher</strong><br>
            teacher@college.com / password
        </div>

        <div class="role-card">
            <strong>Student</strong><br>
            student@college.com / password
        </div>
    </div>

    <!-- RIGHT LOGIN PANEL -->
    <div class="auth-right">
        <div class="login-box">

            <h3 class="fw-bold mb-1">Welcome back</h3>
            <p class="text-muted mb-4">Sign in to continue</p>

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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           placeholder="name@example.com"
                           value="{{ old('email') }}"
                           required autofocus>
                    <label>Email address</label>
                </div>

                <div class="form-floating mb-3 position-relative">
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           name="password"
                           placeholder="Password"
                           required>
                    <label>Password</label>
                    <i class="bi bi-eye password-toggle" onclick="togglePassword()"></i>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label small">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="link small">Forgot password?</a>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-login text-white">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="text-center small">
                Don’t have an account?
                <a href="{{ route('register') }}" class="link">Create one</a>
            </div>

        </div>
    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
