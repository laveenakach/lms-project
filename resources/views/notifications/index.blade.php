@extends('layouts.app')
@section('title', 'Notifications')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-bell-fill me-2"></i> Notification List</h2>
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Notification</a>
        @endif
    </div>

    <div class="table-responsive">
        <table id="notificationTable" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Attachment</th>
                    @if(Auth::user()->role === 'admin')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $notification->title }}</td>
                    <td>{{ Str::limit($notification->message, 60) }}</td>
                    <td>{{ \Carbon\Carbon::parse($notification->date)->format('d M Y') }}</td>
                    <td>
                        @if($notification->attachment)
                        <a href="{{ asset('uploads/notifications/'.$notification->attachment) }}" target="_blank" class="text-decoration-none">
                            <i class="bi bi-file-earmark-arrow-down"></i> View
                        </a>
                        @else
                        —
                        @endif
                    </td>
                    @if(Auth::user()->role === 'admin')
                    <td>
                        <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" class="d-inline">
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
        $('#notificationTable').DataTable({
            pageLength: 10,
            order: [
                [2, 'desc']
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search notification ..."
            }
        });
    });
</script>
@endsection