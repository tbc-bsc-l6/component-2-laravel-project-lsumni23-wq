{{-- resources/views/student/history.blade.php --}}
@extends('layouts.app')

@section('title', 'Module History')
@section('page-title', 'History')

@section('content')

{{-- Page Header --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h3 class="fw-bold mb-1"> Module History</h3>
        <p class="text-muted mb-0">
            Review all completed modules and your performance.
        </p>
    </div>
</div>

{{-- Summary Stats --}}
@if($completedEnrollments->count() > 0)
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body">
                <i class="bi bi-journal-check text-primary fs-2 mb-2"></i>
                <h3 class="fw-bold mb-0">{{ $completedEnrollments->count() }}</h3>
                <p class="text-muted mb-0">Total Completed</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body">
                <i class="bi bi-check-circle-fill text-success fs-2 mb-2"></i>
                <h3 class="fw-bold mb-0">
                    {{ $completedEnrollments->where('status', 'pass')->count() }}
                </h3>
                <p class="text-muted mb-0">Passed</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body">
                <i class="bi bi-x-circle-fill text-danger fs-2 mb-2"></i>
                <h3 class="fw-bold mb-0">
                    {{ $completedEnrollments->where('status', 'fail')->count() }}
                </h3>
                <p class="text-muted mb-0">Failed</p>
            </div>
        </div>
    </div>
</div>
@endif

{{-- History Table --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent">
        <h5 class="fw-bold mb-0">Completed Modules</h5>
    </div>

    <div class="card-body p-0">
        @if($completedEnrollments->count() > 0)
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Module</th>
                            <th>Enrolled</th>
                            <th>Completed</th>
                            <th>Duration</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($completedEnrollments as $index => $enrollment)
                            @php
                                $duration = $enrollment->enrolled_at
                                    ->diffInDays($enrollment->completed_at);
                            @endphp
                            <tr>
                                <td class="text-muted">{{ $index + 1 }}</td>

                                <td>
                                    <span class="fw-semibold">
                                        {{ $enrollment->module->module }}
                                    </span>

                                    @if(!$enrollment->module->is_available)
                                        <span class="badge bg-secondary ms-2">
                                            Archived
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $enrollment->enrolled_at->format('M d, Y') }}</td>
                                <td>{{ $enrollment->completed_at->format('M d, Y') }}</td>

                                <td>
                                    {{ $duration }}
                                    {{ Str::plural('day', $duration) }}
                                </td>

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
        @else
            <div class="p-4">
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    You haven’t completed any modules yet. Keep learning 
                </div>
            </div>
        @endif
    </div>
</div>

@endsection