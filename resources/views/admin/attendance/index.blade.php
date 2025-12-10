@extends('layouts.app')

@section('title', 'Attendance List')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-plus"></i> Attendance List</h2>
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('attendances.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Attendance</a>
        @endif
    </div>

    <div class="table-responsive">
        <table id="attendanceTable" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Status</th>
                    @if(Auth::user()->role === 'admin')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendance->user->name ?? '' }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->check_in }}</td>
                    <td>{{ $attendance->check_out }}</td>
                    <td>{{ $attendance->status }}</td>
                    @if(Auth::user()->role === 'admin')
                    <td>
                        <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="d-inline">
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

<!-- DataTables JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#attendanceTable').DataTable({
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