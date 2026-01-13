{{-- resources/views/admin/students/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage Students')
@section('page-title', 'Students')

@section('content')

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Manage students</h5>
        <small class="text-muted">
            Search students, review enrollments, and manage roles.
        </small>
    </div>
</div>

<!-- SEARCH -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.students.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-8">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by name or email…"
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-4 text-md-end">
                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bi bi-search me-1"></i>
                        Search
                    </button>

                    @if(request('search'))
                        <a href="{{ route('admin.students.index') }}"
                           class="btn btn-outline-secondary">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- STUDENTS TABLE -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Student</th>
                        <th>Role</th>
                        <th>Active Enrollments</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($students as $student)
                    <tr>
                        <td class="ps-4 text-muted">#{{ $student->id }}</td>

                        <td>
                            <div class="fw-semibold">{{ $student->name }}</div>
                            <div class="small text-muted">{{ $student->email }}</div>
                        </td>

                        <td>
                            <span class="badge
                                @if($student->role->role === 'student') bg-primary-subtle text-primary
                                @elseif($student->role->role === 'teacher') bg-success-subtle text-success
                                @else bg-secondary-subtle text-secondary
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $student->role->role)) }}
                            </span>
                        </td>

                        <td>
                            @if($student->activeEnrollments->count())
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($student->activeEnrollments as $enrollment)
                                        <span class="badge bg-info-subtle text-info">
                                            {{ $enrollment->module->module }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted small">No active enrollments</span>
                            @endif
                        </td>

                        <td class="text-end pe-4">
                            <button type="button"
                                    class="btn btn-sm btn-outline-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#roleModal{{ $student->id }}">
                                Change role
                            </button>
                        </td>
                    </tr>

                    <!-- CHANGE ROLE MODAL -->
                    <div class="modal fade"
                         id="roleModal{{ $student->id }}"
                         tabindex="-1"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('admin.students.change-role', $student) }}"
                                      method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Change role
                                        </h5>
                                        <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p class="small text-muted mb-3">
                                            Updating the role for
                                            <strong>{{ $student->name }}</strong>
                                        </p>

                                        <div class="mb-3">
                                            <label class="form-label">
                                                Select new role
                                            </label>
                                            <select class="form-select" name="role" required>
                                                <option value="student"
                                                    {{ $student->role->role === 'student' ? 'selected' : '' }}>
                                                    Student
                                                </option>
                                                <option value="old_student"
                                                    {{ $student->role->role === 'old_student' ? 'selected' : '' }}>
                                                    Old Student
                                                </option>
                                                <option value="teacher"
                                                    {{ $student->role->role === 'teacher' ? 'selected' : '' }}>
                                                    Teacher
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button"
                                                class="btn btn-light"
                                                data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                                class="btn btn-primary">
                                            Update role
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="5"
                            class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-3 d-block mb-2"></i>
                            No students found.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        @if($students->hasPages())
            <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-center">
                    {{ $students->links() }}
                </div>
            </div>
        @endif

    </div>
</div>

@endsection