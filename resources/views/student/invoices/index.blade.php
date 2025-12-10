@extends('layouts.app')

@section('title', 'Invoice List')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-plus"></i> My Invoices</h2>
    </div>

    <div class="table-responsive">
        <table id="assignmentTable" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Invoice No</th>
                    <th>Course</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->course->title }}</td>
                    <td>₹{{ number_format($invoice->grand_total, 2) }}</td>

                    <td>
                        @if($invoice->status == 'paid')
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-danger">Unpaid</span>
                        @endif
                    </td>

                    <td>
                        @if($invoice->status == 'unpaid')

                            @if(Auth::user()->role === 'student')
                            <a href="{{ route('student.payment.checkout', $invoice->id) }}" class="btn btn-primary btn-sm">
                            Pay Now</a>
                            @endif

                            @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.invoice.edit',$invoice->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>

                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                            </form>
                        @endif
                        @else
                            <a href="{{ route('student.invoice.view', $invoice->id) }}" 
                            class="btn btn-info btn-sm">View</a>

                            @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.invoice.edit',$invoice->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>

                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                            </form>
                        @endif
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