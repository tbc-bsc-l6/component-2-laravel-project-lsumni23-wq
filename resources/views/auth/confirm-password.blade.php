{{-- resources/views/auth/confirm-password.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Security Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: radial-gradient(circle at top left, #4f46e5, #020617);
            font-family: 'Inter', system-ui, sans-serif;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0,0,0,0.4);
        }

        .auth-left {
            padding: 3rem;
            color: #fff;
            background: linear-gradient(160deg, rgba(99,102,241,0.9), rgba(79,70,229,0.9));
        }

        .auth-left h1 {
            font-weight: 700;
        }

        .auth-left p {
            opacity: 0.85;
        }

        .auth-right {
            padding: 3rem;
            background: #fff;
        }

        .form-control {
            border-radius: 12px;
            padding: 0.9rem 1rem;
        }

        .btn-secure {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            border: none;
            padding: 0.9rem;
            border-radius: 12px;
            font-weight: 600;
        }

        .btn-secure:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(79,70,229,0.4);
        }

        .password-toggle {
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .auth-card {
                grid-template-columns: 1fr;
            }
            .auth-left {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">

        <!-- Left / Branding -->
        <div class="auth-left">
            <i class="bi bi-shield-lock fs-1 mb-4"></i>
            <h1>Secure Area</h1>
            <p class="mt-3">
                You're accessing a protected section of the College Management System.
                Please verify your identity to continue.
            </p>
        </div>

        <!-- Right / Form -->
        <div class="auth-right">
            <h3 class="fw-bold mb-2">Confirm Password</h3>
            <p class="text-muted mb-4">Re-enter your password to proceed</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                        <span class="input-group-text password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-secure w-100 text-white">
                    <i class="bi bi-check-circle me-2"></i> Verify & Continue
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

</body>
</html>