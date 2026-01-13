{{-- resources/views/auth/reset-password.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | College Management System</title>

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
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .reset-wrapper {
            width: 100%;
            max-width: 900px;
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: fadeUp 0.6s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* LEFT SECURITY PANEL */
        .security-panel {
            background: linear-gradient(160deg, #1e3c72, #2a5298);
            color: #fff;
            padding: 3.5rem;
            height: 100%;
        }

        .security-panel i {
            font-size: 3rem;
            opacity: 0.95;
        }

        .security-point {
            display: flex;
            align-items: center;
            margin-top: 1.25rem;
            font-size: 0.95rem;
        }

        .security-point i {
            font-size: 1.2rem;
            margin-right: 0.75rem;
        }

        /* FORM PANEL */
        .reset-form {
            padding: 3.5rem;
        }

        .form-floating > .form-control {
            border-radius: 12px;
        }

        .form-control:focus {
            border-color: #2a5298;
            box-shadow: 0 0 0 0.15rem rgba(42, 82, 152, 0.25);
        }

        .btn-reset {
            background: #2a5298;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-reset:hover {
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

        .hint {
            font-size: 0.8rem;
            color: #777;
        }

        @media (max-width: 992px) {
            .security-panel {
                display: none;
            }
            .reset-form {
                padding: 2.5rem;
            }
        }
    </style>
</head>
<body>

<div class="reset-wrapper row g-0">

    <!-- LEFT PANEL -->
    <div class="col-lg-5 security-panel">
        <i class="bi bi-shield-lock-fill"></i>
        <h3 class="fw-bold mt-3">Secure your account</h3>
        <p class="opacity-75 mt-2">
            You're just one step away from regaining access.
        </p>

        <div class="security-point">
            <i class="bi bi-check-circle-fill"></i>
            Use a strong, unique password
        </div>

        <div class="security-point">
            <i class="bi bi-check-circle-fill"></i>
            Never reuse old passwords
        </div>

        <div class="security-point">
            <i class="bi bi-check-circle-fill"></i>
            Keep your credentials private
        </div>
    </div>

    <!-- RIGHT FORM -->
    <div class="col-lg-7 reset-form">
        <h4 class="fw-bold mb-1">Reset your password</h4>
        <p class="text-muted mb-4">
            Enter your email and choose a new password.
        </p>

        @if($errors->any())
            <div class="alert alert-danger small">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-floating mb-3">
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       name="email"
                       placeholder="Email address"
                       value="{{ old('email', $request->email) }}"
                       required autofocus>
                <label>Email address</label>
            </div>

            <div class="form-floating mb-3 position-relative">
                <input type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="password"
                       name="password"
                       placeholder="New password"
                       required>
                <label>New password</label>
                <i class="bi bi-eye password-toggle" onclick="togglePassword('password')"></i>
                <div class="hint mt-1">
                    Minimum 8 characters, include letters & numbers
                </div>
            </div>

            <div class="form-floating mb-4 position-relative">
                <input type="password"
                       class="form-control"
                       id="password_confirmation"
                       name="password_confirmation"
                       placeholder="Confirm password"
                       required>
                <label>Confirm password</label>
                <i class="bi bi-eye password-toggle" onclick="togglePassword('password_confirmation')"></i>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-reset text-white">
                    Reset Password
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
