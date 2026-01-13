{{-- resources/views/admin/modules/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage Modules')
@section('page-title', 'Modules')

@section('content')

<!-- HEADER ACTION BAR -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Manage modules</h5>
        <small class="text-muted">
            View availability, capacity, and assignments.
        </small>
    </div>
    <a href="{{ route('admin.modules.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>
        New Module
    </a>
</div>

<!-- SEARCH -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.modules.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-8">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search modules..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-4 text-md-end">
                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bi bi-search me-1"></i>
                        Search
                    </button>

                    @if(request('search'))
                        <a href="{{ route('admin.modules.index') }}"
                           class="btn btn-outline-secondary">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- MODULES TABLE -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Module</th>
                        <th>Status</th>
                        <th>Enrollment</th>
                        <th>Capacity</th>
                        <th>Teachers</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($modules as $module)
                    @php
                        $capacity = 10;
                        $spotsLeft = $capacity - $module->active_students_count;
                        $isFull = $spotsLeft <= 0;
                    @endphp

                    <tr>
                        <td class="ps-4 text-muted">#{{ $module->id }}</td>

                        <td>
                            <div class="fw-semibold">{{ $module->module }}</div>
                        </td>

                        <td>
                            @if($module->is_available)
                                <span class="badge bg-success-subtle text-success">
                                    Available
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">
                                    Archived
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ $module->active_students_count }} / {{ $capacity }}
                        </td>

                        <td>
                            <span class="badge {{ $isFull ? 'bg-danger-subtle text-danger' : 'bg-info-subtle text-info' }}">
                                {{ $spotsLeft }} spots left
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-primary-subtle text-primary">
                                {{ $module->teachers_count }}
                            </span>
                        </td>

                        <td class="text-end pe-4">
                            <form action="{{ route('admin.modules.toggle', $module) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        class="btn btn-sm {{ $module->is_available ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                    {{ $module->is_available ? 'Archive' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-journal-x fs-3 d-block mb-2"></i>
                            No modules found. Create your first module to get started.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        @if($modules->hasPages())
            <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-center">
                    {{ $modules->links() }}
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
