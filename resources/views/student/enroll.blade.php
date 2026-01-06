{{-- resources/views/student/enroll.blade.php --}}
@extends('layouts.app')

@section('title', 'Enroll in Modules')
@section('page-title', 'Enroll')

@push('styles')
<style>
    .enroll-hero {
        background: linear-gradient(135deg, #0ea5e9, #2563eb);
        color: #fff;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .progress-sm {
        height: 8px;
    }
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="enroll-hero">
    <h2 class="fw-bold mb-1">Enroll in Modules 🎓</h2>
    <p class="mb-0 opacity-75">
        Choose new modules and continue your learning journey.
    </p>
</div>

{{-- Enrollment Status --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-primary fs-2">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Active Modules</h6>
                    <h3 class="fw-bold mb-0">{{ $activeCount }} / 4</h3>
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
                    <h6 class="text-muted mb-0">Available Slots</h6>
                    <h3 class="fw-bold mb-0">{{ 4 - $activeCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 text-warning fs-2">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Class Size</h6>
                    <h3 class="fw-bold mb-0">Max 10</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Enrollment Lock --}}
@if(!$canEnroll)
    <div class="alert alert-warning rounded-4 mb-4">
        <i class="bi bi-exclamation-triangle-fill me-1"></i>
        You’ve reached the maximum of <strong>4 active modules</strong>.
        Complete a module to unlock new enrollments.
    </div>
@endif

{{-- Available Modules --}}
@if($canEnroll)
<div class="mb-4">
    <h4 class="fw-bold mb-3">📚 Available Modules</h4>

    @if($availableModules->count() > 0)
        <div class="row g-4">
            @foreach($availableModules as $module)
                @php
                    $enrolled = $module->activeStudents()->count();
                    $percentage = ($enrolled / 10) * 100;

                    if ($percentage < 25) {
                        $widthClass = 'w-25';
                    } elseif ($percentage < 50) {
                        $widthClass = 'w-50';
                    } elseif ($percentage < 75) {
                        $widthClass = 'w-75';
                    } else {
                        $widthClass = 'w-100';
                    }

                    $spotsLeft = 10 - $enrolled;
                @endphp

                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex flex-column">

                            <h5 class="fw-bold mb-2">{{ $module->module }}</h5>

                            <p class="text-muted small mb-2">
                                <i class="bi bi-people me-1"></i>
                                {{ $enrolled }} of 10 students enrolled
                            </p>

                            {{-- Progress (NO INLINE STYLE) --}}
                            <div class="progress progress-sm mb-3">
                                <div
                                    class="progress-bar {{ $widthClass }}
                                    {{ $percentage >= 90 ? 'bg-danger' : ($percentage >= 75 ? 'bg-warning' : 'bg-success') }}"
                                    role="progressbar">
                                </div>
                            </div>

                            {{-- Availability --}}
                            @if($spotsLeft > 0)
                                <span class="badge bg-success mb-3 align-self-start">
                                    {{ $spotsLeft }} {{ Str::plural('spot', $spotsLeft) }} left
                                </span>
                            @else
                                <span class="badge bg-danger mb-3 align-self-start">
                                    Full
                                </span>
                            @endif

                            {{-- Enroll --}}
                            <form action="{{ route('student.enroll.store') }}" method="POST" class="mt-auto">
                                @csrf
                                <input type="hidden" name="module_id" value="{{ $module->id }}">
                                <button
                                    type="submit"
                                    class="btn btn-primary w-100"
                                    {{ $spotsLeft === 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Enroll Now
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info rounded-4">
            <i class="bi bi-info-circle-fill me-1"></i>
            No modules are available at the moment.
        </div>
    @endif
</div>
@endif

@endsection
