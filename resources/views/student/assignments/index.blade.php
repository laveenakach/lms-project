@extends('layouts.app')

@section('title', 'Assignments List')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-plus"></i> My Assignments</h2>
        @if(Auth::user()->role === 'trainer')
        <a href="{{ route('student.assignments.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Assignment</a>
         @endif
    </div>

    <div class="table-responsive">
        <table id="assignmentTable" class="table table-bordered table-striped">
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
                @forelse($assignments as $assignment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @if(Auth::user()->role === 'trainer')
                    <td>{{ $assignment->student ? $assignment->student->name : 'N/A' }}</td>
                    @elseif(Auth::user()->role === 'student')
                    <td>{{ $assignment->trainer ? $assignment->trainer->name : 'N/A' }}</td>
                    @endif
                    <td>{{ $assignment->title }}</td>
                    <td>
                      {{ $assignment->submission_date 
                       ? \Carbon\Carbon::parse($assignment->submission_date)->format('d M Y') : '—' }}
                    </td>
                    <td>
                        @if($assignment->file_path)
                        <a href="{{ asset('uploads/assignments/'.$assignment->file_path) }}" target="_blank">View File</a>
                        @else
                        —
                        @endif
                    </td>
                    <td>{{ $assignment->status }}</td>
                    <td>
                        <a href="{{ route('student.assignments.create', $assignment->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>

                        @if(Auth::user()->role === 'trainer')
                        <form action="{{ route('student.assignments.destroy', $assignment->id) }}" method="POST" class="d-inline">
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
        $('#assignmentTable').DataTable({
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