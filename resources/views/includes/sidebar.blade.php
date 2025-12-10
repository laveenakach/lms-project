@php
$role = Auth::user()->role ?? 'student';
@endphp

<div class="text-center mb-1 px-1">
    <img src="{{ asset('images/logo.png') }}" class="mx-auto mb-2" width="80%" alt="Logo">
</div>
<hr>

@if($role === 'admin')
<a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i><span>Dashboard</span>
</a>
<a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}"><i class="bi bi-people"></i><span>Manage Users</span></a>

<a href="{{ route('attendances.index') }}" class="{{ request()->routeIs('attendances.index') ? 'active' : '' }}"><i class="bi bi-calendar-plus"></i><span>Attendances</span></a>

<a href="{{ route('courses.index') }}" class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">
    <i class="bi bi-journal-text me-2"></i>
    <span>Courses</span>
</a>
<a href="{{ route('certifications.index')}}" class="{{ request()->routeIs('certifications.index') ? 'active' : '' }}"><i class="bi bi-award"></i><span>Certificates</span></a>

<a href="{{ route('student.invoices.index') }}" class="{{ request()->routeIs('student.invoices.index') ? 'active' : '' }}"><i class="bi bi-receipt"></i><span>Invoices</span></a>

<a href="{{ route('admin.blogs.index') }}" 
   class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
    <i class="bi bi-journal-richtext me-2"></i>
    <span>Blogs</span>
</a>
<!--  Dropdown Example -->
<!-- <div class="dropdown">
    <a href="#" class="dropdown-btn d-flex align-items-center w-100 text-decoration-none">
        <i class="bi bi-book me-2"></i>
        <span class="flex-grow-1">Courses</span>
        <i class="bi bi-chevron-down ms-2 toggle-icon"></i>
    </a>

    <div class="dropdown-content">
        <a href="#" class="d-block py-2">All Courses</a>
        <a href="#" class="d-block py-2">Add New</a>
    </div>
</div> -->

<a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}"><i class="bi bi-envelope-fill me-2"></i>
    <span>Contacts</span>
</a>

<a href="{{ route('notifications.index')}}" class="{{ request()->routeIs('notifications.index') ? 'active' : '' }}"><i class="bi bi-bell-fill me-2"></i><span>Notifications</span></a>

@endif

@if($role === 'student')
<a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i><span>Dashboard</span>
</a>
<a href="{{ route('attendances.index') }}" class="{{ request()->routeIs('attendances.index') ? 'active' : '' }}"><i class="bi bi-calendar-plus"></i><span>Attendances</span></a>
<a href="{{ route('student.assignments.index') }}" class="{{ request()->routeIs('student.assignments.index') ? 'active' : '' }}"><i class="bi bi-graph-up"></i><span>Assignments</span></a>
<a href="{{ route('student.projects.index') }}" class="{{ request()->routeIs('student.projects.index') ? 'active' : '' }}"><i class="bi bi-folder2-open"></i><span> Projects</span></a>

<a href="{{ route('courses.index')}}" class="{{ request()->routeIs('courses.index') ? 'active' : '' }}"><i class="bi bi-book"></i><span>My Courses</span></a>

<a href="{{ route('student.invoices.index') }}" class="{{ request()->routeIs('student.invoices.index') ? 'active' : '' }}"><i class="bi bi-receipt"></i><span>My Invoices</span></a>

<a href="{{ route('certifications.index')}}" class="{{ request()->routeIs('certifications.index') ? 'active' : '' }}"><i class="bi bi-award"></i><span>Certificates</span></a>

<!-- Dropdown Example -->
<!-- <div class="dropdown">
    <a class="dropdown-btn"><i class="bi bi-book"></i><span>Courses</span><i class="bi bi-chevron-down ms-auto"></i></a>
    <div class="dropdown-content">
        <a href="#">All Courses</a>
        <a href="#">Add New</a>
    </div>
</div> -->

@endif

@if($role === 'trainer')
<a href="{{ route('trainer.dashboard') }}" class="{{ request()->routeIs('trainer.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i><span>Dashboard</span>
</a>
<a href="{{ route('attendances.index') }}" class="{{ request()->routeIs('attendances.index') ? 'active' : '' }}"><i class="bi bi-calendar-plus"></i><span>Attendances</span></a>
<a href="{{ route('student.assignments.index') }}" class="{{ request()->routeIs('student.assignments.index') ? 'active' : '' }}"><i class="bi bi-graph-up"></i><span>Assignments</span></a>
<a href="{{ route('student.projects.index') }}" class="{{ request()->routeIs('student.projects.index') ? 'active' : '' }}"><i class="bi bi-folder2-open"></i><span> Projects</span></a>
<a href="{{ route('trainer.courses') }}"><i class="bi bi-book"></i><span>My Courses</span></a>
<!-- <a href=""><i class="bi bi-clipboard-data"></i><span>Reports</span></a> -->
@endif