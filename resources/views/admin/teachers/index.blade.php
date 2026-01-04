{{-- resources/views/admin/teachers/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage Teachers')
@section('page-title', 'Teachers')

@section('content')

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Manage teachers</h5>
        <small class="text-muted">
            Assign modules and manage teaching staff.
        </small>
    </div>
    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>
        New Teacher
    </a>
</div>

<!-- SEARCH -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.teachers.index') }}" method="GET">
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
                        <a href="{{ route('admin.teachers.index') }}"
                           class="btn btn-outline-secondary">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- TEACHERS TABLE -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Teacher</th>
                        <th>Assigned Modules</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($teachers as $teacher)
                    <tr>
                        <td class="ps-4 text-muted">#{{ $teacher->id }}</td>

                        <td>
                            <div class="fw-semibold">{{ $teacher->name }}</div>
                            <div class="small text-muted">{{ $teacher->email }}</div>
                        </td>

                        <td>
                            @if($teacher->teacherModules->count())
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($teacher->teacherModules as $tm)
                                        <div class="d-flex align-items-center gap-1">
                                            <span class="badge bg-info-subtle text-info">
                                                {{ $tm->module->module }}
                                            </span>
                                            <form action="{{ route('admin.teachers.detach-module') }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                                <input type="hidden" name="module_id" value="{{ $tm->module->id }}">
                                                <button type="submit"
                                                        class="btn btn-sm btn-link text-danger p-0"
                                                        title="Remove module">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted small">No modules assigned</span>
                            @endif

                            <!-- ASSIGN MODULE BUTTON -->
                            <button type="button"
                                    class="btn btn-sm btn-outline-success ms-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#assignModal{{ $teacher->id }}">
                                <i class="bi bi-plus"></i>
                            </button>
                        </td>

                        <td class="text-end pe-4">
                            <form action="{{ route('admin.teachers.destroy', $teacher) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to remove this teacher?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- ASSIGN MODULE MODAL -->
                    <div class="modal fade"
                         id="assignModal{{ $teacher->id }}"
                         tabindex="-1"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('admin.teachers.attach-module') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Assign module
                                        </h5>
                                        <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">

                                        <p class="small text-muted mb-3">
                                            Assign a module to
                                            <strong>{{ $teacher->name }}</strong>
                                        </p>

                                        <div class="mb-3">
                                            <label class="form-label">
                                                Select module
                                            </label>
                                            <select class="form-select" name="module_id" required>
                                                <option value="">Choose a module…</option>
                                                @foreach($modules as $module)
                                                    <option value="{{ $module->id }}">
                                                        {{ $module->module }}
                                                    </option>
                                                @endforeach
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
                                            Assign module
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="4"
                            class="text-center py-5 text-muted">
                            <i class="bi bi-person-workspace fs-3 d-block mb-2"></i>
                            No teachers found.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection
