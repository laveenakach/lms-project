@extends('layouts.app')

@section('page_title', 'Courses')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-plus"></i> Courses List</h2>
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Courses</a>
        @endif
    </div>

    <div class="table-responsive">
        <table id="coursesTable" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Trainer</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ $course->thumbnail ? asset('uploads/course_thumbnails/'.$course->thumbnail) : asset('images/default-user.png') }}"
                            class="rounded-circle" width="40" height="40">
                    </td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->trainer->name ?? 'N/A' }}</td>
                    <td><span class="badge bg-success">{{ $course->status }}</span></td>
                    <td>{{ $course->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')"><i class="bi bi-trash"></i></button>
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
        $('#coursesTable').DataTable({
            pageLength: 10,
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Courses..."
            }
        });
    });
</script>
@endsection