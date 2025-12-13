@extends('layouts.app')

@section('title', 'Projects List')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-plus"></i> My Projects</h2>
        @if(Auth::user()->role === 'trainer')
        <a href="{{ route('student.projects.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Project</a>
         @endif
    </div>

    <div class="table-responsive">
        <table id="projectTable" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    @if(Auth::user()->role === 'trainer')
                    <th>Student</th>
                    @elseif(Auth::user()->role === 'student')
                    <th>Trainer</th>
                    @endif
                    <th>Title</th>
                    <th>Submission Date</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @if(Auth::user()->role === 'trainer')
                    <td>{{ $project->student ? $project->student->name : 'N/A' }}</td>
                    @elseif(Auth::user()->role === 'student')
                    <td>{{ $project->trainer ? $project->trainer->name : 'N/A' }}</td>
                    @endif
                    <td>{{ $project->title }}</td>
                    <td>
                      {{ $project->submission_date 
                       ? \Carbon\Carbon::parse($project->submission_date)->format('d M Y') : '—' }}
                    </td>
                    <td>
                        @php
                            $isPaid = true;

                            if(auth()->user()->role === 'student') {
                                $isPaid = DB::table('course_enrollments')
                                            ->where('student_id', auth()->id())
                                            ->where('course_id', $project->course_id)
                                            ->where('status', 'Approved')
                                            ->exists();
                            }
                        @endphp

                        @if($project->file_path)
                            @if(auth()->user()->role === 'student')
                                @if($isPaid)
                                    <a href="{{ route('student.projects.viewfile', $project->id) }}"
                                    class="btn btn-success btn-sm" 
                                target="_blank">

                                        View Project
                                    </a>
                                @else
                                    <span class="text-danger">Payment required</span>
                                @endif
                            @else
                                <!-- Admin & Trainer always can view -->
                            <a href="{{ route('student.projects.viewfile', $project->id) }}" 
                                class="btn btn-success btn-sm" target="_blank">
                                    View Project
                                </a>
                            @endif
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $project->status }}</td>
                    <td>
                        <a href="{{ route('student.projects.create', $project->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>

                        @if(Auth::user()->role === 'trainer')
                        <form action="{{ route('student.projects.destroy', $project->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#projectTable').DataTable({
            pageLength: 10,
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search attendance..."
            }
        });
    });
</script>
@endsection