{{-- resources/views/student/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Hero Section --}}
<div class="mb-4 p-4 rounded-4 text-white"
     style="background: linear-gradient(135deg, #4f46e5, #6366f1);">
    <h2 class="fw-bold mb-1">Welcome back, {{ auth()->user()->name }} 👋</h2>
    <p class="mb-0 opacity-75">
        Track your learning progress and manage your modules from here.
    </p>
</div>

{{-- Stats Row --}}
@if(auth()->user()->isStudent())
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-primary fs-2">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Active Modules</h6>
                    <h3 class="fw-bold mb-0">{{ $activeEnrollments->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-success fs-2">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Completed Modules</h6>
                    <h3 class="fw-bold mb-0">{{ $completedEnrollments->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-warning fs-2">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted">Available Slots</h6>
                    <h3 class="fw-bold mb-0">{{ 4 - $activeEnrollments->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Enroll CTA --}}
@if(auth()->user()->isStudent())
    @if($activeEnrollments->count() < 4)
        <div class="mb-4 text-end">
            <a href="{{ route('student.enroll.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle me-1"></i> Enroll in New Module
            </a>
        </div>
    @else
        <div class="alert alert-warning rounded-4">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            You’ve reached the maximum of 4 active modules.
        </div>
    @endif
@endif

{{-- Active Modules --}}
@if(auth()->user()->isStudent() && $activeEnrollments->count() > 0)
<div class="mb-5">
    <h4 class="fw-bold mb-3">📚 Active Modules</h4>

    <div class="row g-4">
        @foreach($activeEnrollments as $enrollment)
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="fw-bold mb-1">
                                {{ $enrollment->module->module }}
                            </h5>
                            <span class="badge bg-primary">In Progress</span>
                        </div>

                        <p class="text-muted small mb-0">
                            <i class="bi bi-calendar-event me-1"></i>
                            Enrolled on {{ $enrollment->enrolled_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

{{-- Completed Modules --}}
@if($completedEnrollments->count() > 0)
<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
        <h4 class="fw-bold mb-0">🏁 Recently Completed</h4>
        <a href="{{ route('student.history') }}" class="btn btn-sm btn-outline-primary">
            View Full History
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Module</th>
                        <th>Enrolled</th>
                        <th>Completed</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($completedEnrollments->take(5) as $enrollment)
                        <tr>
                            <td class="fw-semibold">
                                {{ $enrollment->module->module }}
                            </td>
                            <td>{{ $enrollment->enrolled_at->format('M d, Y') }}</td>
                            <td>{{ $enrollment->completed_at->format('M d, Y') }}</td>
                            <td>
                                @if($enrollment->status === 'pass')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> PASS
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i> FAIL
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
@if(auth()->user()->isStudent())
<div class="alert alert-info rounded-4 mt-4">
    <i class="bi bi-info-circle-fill me-1"></i>
    You haven’t completed any modules yet — keep going 💪
</div>
@endif
@endif

@endsection
