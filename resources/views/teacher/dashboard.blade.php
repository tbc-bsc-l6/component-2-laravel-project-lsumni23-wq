{{-- resources/views/teacher/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Teacher Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .teacher-hero {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #fff;
        border-radius: 1rem;
        padding: 1.75rem;
        margin-bottom: 1.5rem;
    }

    .progress-sm {
        height: 8px;
    }
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="teacher-hero">
    <h2 class="fw-bold mb-1">
        Welcome back, {{ auth()->user()->name }} 
    </h2>
    <p class="mb-0 opacity-75">
        Manage your assigned modules and students from here.
    </p>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-primary fs-2">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Assigned Modules</h6>
                    <h3 class="fw-bold mb-0">{{ $modules->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-success fs-2">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Total Students</h6>
                    <h3 class="fw-bold mb-0">
                        {{ $modules->sum('active_students_count') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-warning fs-2">
                    <i class="bi bi-bar-chart-fill"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Max Capacity</h6>
                    <h3 class="fw-bold mb-0">{{ $modules->count() * 10 }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modules --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent">
        <h5 class="fw-bold mb-0">📚 My Modules</h5>
    </div>

    <div class="card-body">
        <div class="row g-4">

            @forelse($modules as $module)
                @php
                    $count = $module->active_students_count;
                    $percentage = ($count / 10) * 100;

                    if ($percentage < 25) {
                        $widthClass = 'w-25';
                    } elseif ($percentage < 50) {
                        $widthClass = 'w-50';
                    } elseif ($percentage < 75) {
                        $widthClass = 'w-75';
                    } else {
                        $widthClass = 'w-100';
                    }
                @endphp

                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">

                            <h5 class="fw-bold mb-1">
                                {{ $module->module }}
                            </h5>

                            <p class="text-muted small mb-2">
                                <i class="bi bi-people me-1"></i>
                                {{ $count }} / 10 students enrolled
                            </p>

                            {{-- Progress (NO INLINE STYLE) --}}
                            <div class="progress progress-sm mb-3">
                                <div
                                    class="progress-bar {{ $widthClass }}
                                    {{ $percentage >= 90 ? 'bg-danger' : ($percentage >= 75 ? 'bg-warning' : 'bg-success') }}"
                                    role="progressbar">
                                </div>
                            </div>

                            <a href="{{ route('teacher.modules.show', $module) }}"
                               class="btn btn-outline-primary w-100 mt-auto">
                                <i class="bi bi-eye me-1"></i>
                                View Students
                            </a>

                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12">
                    <div class="alert alert-info rounded-4 mb-0">
                        <i class="bi bi-info-circle-fill me-1"></i>
                        You don’t have any modules assigned yet.
                    </div>
                </div>
            @endforelse

        </div>
    </div>
</div>

@endsection
