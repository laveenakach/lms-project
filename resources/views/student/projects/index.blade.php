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
                @forelse($projects as $projects)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @if(Auth::user()->role === 'trainer')
                    <td>{{ $projects->student ? $projects->student->name : 'N/A' }}</td>
                    @elseif(Auth::user()->role === 'student')
                    <td>{{ $projects->trainer ? $projects->trainer->name : 'N/A' }}</td>
                    @endif
                    <td>{{ $projects->title }}</td>
                    <td>
                      {{ $projects->submission_date 
                       ? \Carbon\Carbon::parse($projects->submission_date)->format('d M Y') : '—' }}
                    </td>
                    <td>
                        @if($projects->file_path)
                        <a href="{{ asset('uploads/projects/'.$projects->file_path) }}" target="_blank">View File</a>
                        @else
                        —
                        @endif
                    </td>
                    <td>{{ $projects->status }}</td>
                    <td>
                        <a href="{{ route('student.projects.create', $projects->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>

                        @if(Auth::user()->role === 'trainer')
                        <form action="{{ route('student.projects.destroy', $projects->id) }}" method="POST" class="d-inline">
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