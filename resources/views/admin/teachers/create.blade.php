{{-- resources/views/admin/teachers/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Create Teacher')
@section('page-title', 'Create New Teacher')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-5 col-lg-6">

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <!-- HEADER -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-1">Add a new teacher</h5>
                    <p class="text-muted small mb-0">
                        Create a teacher account and grant system access.
                    </p>
                </div>

                <!-- FORM -->
                <form action="{{ route('admin.teachers.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium">
                            Full name
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. John Doe"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium">
                            Email address
                        </label>
                        <input type="email"
                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="teacher@example.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium">
                            Temporary password
                        </label>
                        <input type="password"
                               class="form-control form-control-lg @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="Minimum 8 characters"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            The teacher can change this password after logging in.
                        </div>
                    </div>

                    <!-- ACTIONS -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.teachers.index') }}" class="btn btn-light">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            Create Teacher
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
