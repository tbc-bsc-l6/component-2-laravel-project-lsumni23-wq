{{-- resources/views/teacher/modules/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Module Details')
@section('page-title', 'Module Overview')

@push('styles')
<style>
    .module-hero {
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: #fff;
        border-radius: 1rem;
        padding: 1.75rem;
        margin-bottom: 1.5rem;
    }
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="module-hero d-flex justify-content-between align-items-center flex-wrap">
    <div>
        <h2 class="fw-bold mb-1">{{ $module->module }}</h2>
        <p class="mb-0 opacity-75">
            <i class="bi bi-people me-1"></i>
            {{ $students->where('status', 'enrolled')->count() }} active students
        </p>
    </div>

    <a href="{{ route('teacher.dashboard') }}"
       class="btn btn-light mt-3 mt-md-0">
        <i class="bi bi-arrow-left me-1"></i>
        Back to Dashboard
    </a>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body">
                <i class="bi bi-people-fill text-primary fs-2 mb-2"></i>
                <h3 class="fw-bold mb-0">
                    {{ $students->where('status', 'enrolled')->count() }}
                </h3>
                <p class="text-muted mb-0">Currently Enrolled</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body">
                <i class="bi bi-check-circle-fill text-success fs-2 mb-2"></i>
                <h3 class="fw-bold mb-0">
                    {{ $students->where('status', 'pass')->count() }}
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
                    {{ $students->where('status', 'fail')->count() }}
                </h3>
                <p class="text-muted mb-0">Failed</p>
            </div>
        </div>
    </div>
</div>

{{-- Students Table --}}
<!-- SEARCH -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('teacher.modules.show', $module) }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-8">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search students by name or email…"
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-4 text-md-end">
                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bi bi-search me-1"></i>
                        Search
                    </button>

                    @if(request('search'))
                        <a href="{{ route('teacher.modules.show', $module) }}"
                           class="btn btn-outline-secondary">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-transparent">
        <h5 class="fw-bold mb-0"> Enrolled Students</h5>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Student</th>
                        <th>Email</th>
                        <th>Enrolled</th>
                        <th>Status</th>
                        <th>Completed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $enrollment)
                        <tr>
                            <td class="fw-semibold">
                                {{ $enrollment->user->name }}
                            </td>
                            <td>{{ $enrollment->user->email }}</td>
                            <td>{{ $enrollment->enrolled_at->format('M d, Y') }}</td>
                            <td>
                                @if($enrollment->status === 'enrolled')
                                    <span class="badge bg-primary">Enrolled</span>
                                @elseif($enrollment->status === 'pass')
                                    <span class="badge bg-success">Pass</span>
                                @else
                                    <span class="badge bg-danger">Fail</span>
                                @endif
                            </td>
                            <td>
                                {{ $enrollment->completed_at
                                    ? $enrollment->completed_at->format('M d, Y')
                                    : '—' }}
                            </td>
                            <td>
                                @if($enrollment->status === 'enrolled')
                                    <button class="btn btn-sm btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#gradeModal{{ $enrollment->id }}">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Grade
                                    </button>
                                @else
                                    <span class="text-muted small">Completed</span>
                                @endif
                            </td>
                        </tr>

                        {{-- Grade Modal --}}
                        @if($enrollment->status === 'enrolled')
                            <div class="modal fade"
                                 id="gradeModal{{ $enrollment->id }}"
                                 tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Grade: {{ $enrollment->user->name }}
                                            </h5>
                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('teacher.grades.update', [$module, $enrollment]) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <div class="modal-body">
                                                <p class="text-muted">
                                                    Select the final result for this student.
                                                </p>

                                                <div class="d-grid gap-2 mb-3">
                                                    <button type="submit"
                                                            name="status"
                                                            value="pass"
                                                            class="btn btn-success btn-lg">
                                                        <i class="bi bi-check-circle me-1"></i>
                                                        PASS
                                                    </button>

                                                    <button type="submit"
                                                            name="status"
                                                            value="fail"
                                                            class="btn btn-danger btn-lg">
                                                        <i class="bi bi-x-circle me-1"></i>
                                                        FAIL
                                                    </button>
                                                </div>

                                                <div class="alert alert-warning mb-0">
                                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                                    This action marks the module as completed
                                                    and cannot be undone.
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted p-4">
                                No students enrolled in this module yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
   