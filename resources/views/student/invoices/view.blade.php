@extends('layouts.app')

@section('title', 'View Invoice')

@section('content')
<div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Invoice: {{ $invoice->invoice_number }}</h2>
        <a href="{{ route('student.invoice.download', $invoice->id) }}" class="btn btn-success">
            Download PDF
        </a>
    </div>

    <!-- Invoice Content Same as PDF -->
    <div style="font-family: DejaVu Sans, sans-serif; font-size: 13px;">
        <div class="text-center mb-4">
            <h3>INVOICE</h3>
            <p><strong>Adlertech Innovations OPC Pvt Ltd</strong></p>
        </div>

        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td><strong>Invoice No:</strong> {{ $invoice->invoice_number }}</td>
                <td><strong>Date:</strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td><strong>Student:</strong> {{ $invoice->user->name }}</td>
                <td><strong>Course:</strong> {{ $invoice->course->title }}</td>
            </tr>
        </table>

        <table style="width: 100%; border-collapse: collapse;" border="1">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Course Fee</td>
                    <td>{{ number_format($invoice->subtotal, 2) }}</td>
                </tr>

                @if($invoice->discount_amount > 0)
                <tr>
                    <td>Discount</td>
                    <td>-{{ number_format($invoice->discount_amount, 2) }}</td>
                </tr>
                @endif

                <tr>
                    <td>CGST ({{ $invoice->cgst_percent }}%)</td>
                    <td>{{ number_format($invoice->cgst_amount, 2) }}</td>
                </tr>

                <tr>
                    <td>SGST ({{ $invoice->sgst_percent }}%)</td>
                    <td>{{ number_format($invoice->sgst_amount, 2) }}</td>
                </tr>

                <tr>
                    <td>Convenience Fee</td>
                    <td>{{ number_format($invoice->convenience_fee_amount, 2) }}</td>
                </tr>

                <tr>
                    <th>Total Payable</th>
                    <th>₹{{ number_format($invoice->grand_total, 2) }}</th>
                </tr>
            </tbody>
        </table>

        <br>
        <p><strong>Status: </strong> {{ ucfirst($invoice->status) }}</p>

        @if($invoice->status === 'paid')
        <p><strong>Payment Method:</strong> {{ $invoice->payment_method }}</p>
        <p><strong>Transaction ID:</strong> {{ $invoice->transaction_id }}</p>
        <p><strong>Payment Date:</strong> {{ \Carbon\Carbon::parse($invoice->payment_date)->format('d-m-Y') }}</p>
        @endif
    </div>
</div>
@endsection
