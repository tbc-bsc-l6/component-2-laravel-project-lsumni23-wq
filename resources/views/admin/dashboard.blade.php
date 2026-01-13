{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<!-- KPI CARDS -->
<div class="row g-4 mb-4">

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <div class="icon-circle bg-primary-subtle text-primary">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                </div>
                <div>
                    <div class="text-muted small">Total Teachers</div>
                    <h4 class="fw-bold mb-0">{{ $stats['total_teachers'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <div class="icon-circle bg-success-subtle text-success">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div>
                    <div class="text-muted small">Total Students</div>
                    <h4 class="fw-bold mb-0">{{ $stats['total_students'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <div class="icon-circle bg-info-subtle text-info">
                        <i class="bi bi-journal-text"></i>
                    </div>
                </div>
                <div>
                    <div class="text-muted small">Total Modules</div>
                    <h4 class="fw-bold mb-0">{{ $stats['total_modules'] }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <div class="icon-circle bg-warning-subtle text-warning">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                </div>
                <div>
                    <div class="text-muted small">Active Modules</div>
                    <h4 class="fw-bold mb-0">{{ $stats['active_modules'] }}</h4>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- WELCOME PANEL -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h5 class="fw-bold mb-1">Welcome back, Admin </h5>
                    <p class="text-muted mb-0">
                        Here’s a quick overview of what’s happening in your system today.
                    </p>
                </div>
                <div class="mt-3 mt-md-0">
                    <span class="badge bg-primary-subtle text-primary me-2">System Healthy</span>
                    <span class="badge bg-success-subtle text-success">All Services Running</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QUICK ACTIONS -->
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-semibold mb-2">
                    <i class="bi bi-journal-plus me-1 text-primary"></i>
                    Manage Modules
                </h6>
                <p class="text-muted small mb-3">
                    Create, update, and control academic modules offered by the college.
                </p>
                <a href="{{ route('admin.modules.index') }}" class="btn btn-sm btn-outline-primary">
                    View Modules
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-semibold mb-2">
                    <i class="bi bi-person-workspace me-1 text-success"></i>
                    Manage Teachers
                </h6>
                <p class="text-muted small mb-3">
                    Assign modules, manage teacher profiles, and permissions.
                </p>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-sm btn-outline-success">
                    View Teachers
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-semibold mb-2">
                    <i class="bi bi-mortarboard-fill me-1 text-info"></i>
                    Manage Students
                </h6>
                <p class="text-muted small mb-3">
                    Monitor student enrollment and academic participation.
                </p>
                <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-outline-info">
                    View Students
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }
</style>
@endpush