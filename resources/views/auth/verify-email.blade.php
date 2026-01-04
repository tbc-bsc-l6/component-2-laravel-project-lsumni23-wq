{{-- resources/views/auth/verify-email.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email | College Management System</title>

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

        .verify-wrapper {
            width: 100%;
            max-width: 520px;
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.1);
            padding: 3rem;
            text-align: center;
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

        .verify-icon {
            font-size: 4rem;
            color: #2a5298;
        }

        .btn-primary {
            background: #2a5298;
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #1e3c72;
        }

        .btn-outline-secondary {
            border-radius: 12px;
        }

        .hint {
            font-size: 0.85rem;
            color: #777;
        }
    </style>
</head>
<body>

<div class="verify-wrapper">

    <div class="verify-icon mb-3">
        <i class="bi bi-envelope-check-fill"></i>
    </div>

    <h4 class="fw-bold mb-2">Verify your email address</h4>
    <p class="text-muted mb-4">
        We’ve sent a verification link to your email.
        Please check your inbox and click the link to continue.
    </p>

    @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success small">
            <i class="bi bi-check-circle-fill me-1"></i>
            A new verification link has been sent to your email address.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
        @csrf
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                Resend verification email
            </button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="d-grid">
            <button type="submit" class="btn btn-outline-secondary">
                Log out
            </button>
        </div>
    </form>

    <div class="hint mt-4">
        <i class="bi bi-shield-check"></i>
        Didn’t receive the email? Check your spam or junk folder.
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>