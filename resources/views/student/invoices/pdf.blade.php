<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
        }
        .no-border td { border: 0 !important; }
        .title { font-size: 22px; font-weight: bold; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="header">
    <h2 class="title">INVOICE</h2>
    <p><strong>Adlertech Innovations OPC Pvt Ltd</strong></p>
</div>

<table class="table no-border">
    <tr>
        <td><strong>Invoice No:</strong> {{ $invoice->invoice_number }}</td>
        <td><strong>Date:</strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}</td>
    </tr>
    <tr>
        <td><strong>Student:</strong> {{ $invoice->user->name }}</td>
        <td><strong>Course:</strong> {{ $invoice->course->title }}</td>
    </tr>
</table>

<br>

<table class="table">
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

<br><br>
<p><strong>Status: </strong> {{ ucfirst($invoice->status) }}</p>

@if($invoice->status === 'paid')
<p><strong>Payment Method:</strong> {{ $invoice->payment_method }}</p>
<p><strong>Transaction ID:</strong> {{ $invoice->transaction_id }}</p>
<p><strong>Payment Date:</strong> {{ \Carbon\Carbon::parse($invoice->payment_date)->format('d-m-Y') }}</p>
@endif

</body>
</html>
