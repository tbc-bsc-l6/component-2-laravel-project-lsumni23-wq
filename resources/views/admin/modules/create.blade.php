{{-- resources/views/admin/modules/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Create Module')
@section('page-title', 'Create New Module')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-5 col-lg-6">

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <!-- HEADER -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-1">Add a new module</h5>
                    <p class="text-muted small mb-0">
                        Create a module that can be assigned to teachers and students.
                    </p>
                </div>

                <!-- FORM -->
                <form action="{{ route('admin.modules.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="module" class="form-label fw-medium">
                            Module name
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('module') is-invalid @enderror"
                               id="module"
                               name="module"
                               value="{{ old('module') }}"
                               placeholder="e.g. Data Structures"
                               required>
                        @error('module')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Choose a clear, descriptive module name.
                        </div>
                    </div>

                    <!-- ACTIONS -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.modules.index') }}" class="btn btn-light">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            Create Module
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection