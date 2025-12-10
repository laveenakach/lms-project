@extends('layouts.app')

@section('title', 'Certification List')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-award"></i> Certification List</h2>
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('certifications.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Certification
        </a>
        @endif
    </div>

    <div class="table-responsive">
        <table id="certificationTable" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>Student</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>File</th>
                    @if(Auth::user()->role === 'admin')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($certifications as $certification)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $certification->student->name ?? '' }}</td>
                    <td>{{ $certification->title }}</td>
                    <td>{{ Str::limit($certification->description, 50) }}</td>
                    <td>
                        @if($certification->file_path)
                            <a href="{{ asset('uploads/certifications/'.$certification->file_path) }}" target="_blank" class="btn btn-sm btn-success">
                                <i class="bi bi-file-earmark-arrow-down"></i> View
                            </a>
                        @else
                            <span class="text-muted">No File</span>
                        @endif
                    </td>
                    @if(Auth::user()->role === 'admin')
                    <td>
                        <a href="{{ route('certifications.edit', $certification->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('certifications.destroy', $certification->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#certificationTable').DataTable({
            pageLength: 10,
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search certifications..."
            }
        });
    });
</script>
@endsection
