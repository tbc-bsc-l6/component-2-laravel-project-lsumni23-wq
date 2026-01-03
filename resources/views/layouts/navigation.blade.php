{{-- resources/views/layouts/navigation.blade.php --}}
<ul class="nav flex-column sidebar-nav">
    @if(auth()->user()->isAdmin())
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
               href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.modules.*') ? 'active' : '' }}"
               href="{{ route('admin.modules.index') }}">
                <i class="bi bi-book"></i>
                <span>Modules</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}"
               href="{{ route('admin.teachers.index') }}">
                <i class="bi bi-person-badge"></i>
                <span>Teachers</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}"
               href="{{ route('admin.students.index') }}">
                <i class="bi bi-people"></i>
                <span>Students</span>
            </a>
        </li>

    @elseif(auth()->user()->isTeacher())
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}"
               href="{{ route('teacher.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

    @else
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}"
               href="{{ route('student.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if(auth()->user()->isStudent())
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('student.enroll.*') ? 'active' : '' }}"
                   href="{{ route('student.enroll.index') }}">
                    <i class="bi bi-plus-circle"></i>
                    <span>Enroll in Module</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('student.history') ? 'active' : '' }}"
               href="{{ route('student.history') }}">
                <i class="bi bi-clock-history"></i>
                <span>Module History</span>
            </a>
        </li>
    @endif
</ul>
