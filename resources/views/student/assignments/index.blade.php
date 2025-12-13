@extends('layouts.app')

@section('title', 'Assignments List')

@section('content')
<div class="card shadow-sm p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-plus"></i> My Assignments</h2>

        @if(Auth::user()->role === 'trainer')
            <a href="{{ route('student.assignments.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Assignment
            </a>
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
                    <th>Assignment File</th>
                    <th>Status</th>
                    <th>Submission File</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @forelse($assignments as $assignment)

                {{-- 🔴 DEFINE SUBMISSION HERE (VERY IMPORTANT) --}}
                @php
                    $submission = $assignment->submissions
                        ->where('student_id', auth()->id())
                        ->first();
                @endphp

                <tr>
                    <td>{{ $loop->iteration }}</td>

                 <td>

                    {{-- ================= STUDENT VIEW ================= --}}
                    @if(Auth::user()->role === 'student')

                        <strong>{{ $assignment->trainer->name ?? 'N/A' }}</strong>

                    {{-- ================= TRAINER VIEW ================= --}}
                    @elseif(Auth::user()->role === 'trainer')

                        @foreach($assignment->course->enrollments as $enroll)

                            @php
                                $student = $enroll->student;

                                $submission = $assignment->submissions
                                    ->where('student_id', $student->id)
                                    ->first();
                            @endphp

                            <div class="mb-1">
                                <strong>{{ $student->name }}</strong>
                            </div>

                        @endforeach

                    @endif

                </td>

                    <td>{{ $assignment->title }}</td>

                    <td>
                        {{ $assignment->submission_date
                            ? \Carbon\Carbon::parse($assignment->submission_date)->format('d M Y')
                            : '—'
                        }}
                    </td>

                    {{-- ================= ASSIGNMENT FILE ================= --}}
                    <td>
                        @php
                            $isPaid = true;

                            if(auth()->user()->role === 'student') {
                                $isPaid = DB::table('course_enrollments')
                                    ->where('student_id', auth()->id())
                                    ->where('course_id', $assignment->course_id)
                                    ->where('status', 'Approved')
                                    ->exists();
                            }
                        @endphp

                        @if($assignment->file_path)
                            @if(auth()->user()->role === 'student')
                                @if($isPaid)
                                    <a href="{{ route('student.assignments.viewfile', $assignment->id) }}"
                                       class="btn btn-success btn-sm"
                                       target="_blank">
                                        View Assignment
                                    </a>
                                @else
                                    <span class="text-danger">Payment required</span>
                                @endif
                            @else
                                <a href="{{ route('student.assignments.viewfile', $assignment->id) }}"
                                   class="btn btn-success btn-sm"
                                   target="_blank">
                                    View Assignment
                                </a>
                            @endif
                        @else
                            —
                        @endif
                    </td>

                    {{-- ================= STATUS ================= --}}
                    <!-- <td>
                        <span class="badge bg-info">
                            {{ $assignment->status ?? 'Pending' }}
                        </span>
                    </td> -->

                    <td>
                        
                            {{ $assignment->status }}
                       
                    </td>

                    {{-- ================= SUBMISSION FILE ================= --}}

                    <td>
                        {{-- ================= STUDENT ================= --}}
                        @if(Auth::user()->role === 'student')

                            @php
                                $submission = $assignment->submissions
                                    ->where('student_id', auth()->id())
                                    ->first();
                            @endphp

                            @if($submission)
                                <a href="{{ route('assignment.submission.view', $submission->id) }}"
                                class="btn btn-success btn-sm"
                                target="_blank">
                                    View Submission
                                </a>
                            @else
                                <form action="{{ route('student.assignment.upload', $assignment->id) }}"
                                    method="POST"
                                    enctype="multipart/form-data"
                                    class="mt-2">
                                    @csrf
                                    <input type="file"
                                        name="file"
                                        class="form-control mb-2"
                                        required>

                                    <button class="btn btn-primary btn-sm">
                                        Upload Assignment
                                    </button>
                                </form>
                            @endif

                        {{-- ================= TRAINER ================= --}}
                        @elseif(Auth::user()->role === 'trainer')

                            @if($assignment->submissions->isEmpty())
                                <span>No submissions</span>
                            @else
                                @foreach($assignment->submissions as $sub)
                                    <div class="mb-1">
                                        <a href="{{ route('assignment.submission.view', $sub->id) }}"
                                        class="btn btn-success btn-sm ms-2"
                                        target="_blank">
                                            View Submission
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                        @endif
                    </td>

                    {{-- ================= ACTION ================= --}}
                    <td>
                        <a href="{{ route('student.assignments.create', $assignment->id) }}"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>

                        @if(Auth::user()->role === 'trainer')
                            <form action="{{ route('student.assignments.destroy', $assignment->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">
                        No assignments found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ================= DATATABLE ================= --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#assignmentTable').DataTable({
            pageLength: 10,
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search assignments..."
            }
        });
    });
</script>
@endsection
