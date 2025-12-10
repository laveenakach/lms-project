@extends('layouts.app')
@section('title', 'Edit Invoice')

@section('content')
<div class="card shadow-sm border-0 w-100 mx-auto" style="max-width: 700px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-award me-2"></i>
            Edit Invoice
        </h5>
        <a href="{{ route('student.invoices.index') }}" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body">
        <form method="POST"
              action="{{ route('admin.invoice.update', $invoice->id) }}"
              enctype="multipart/form-data">
            @csrf
            @if(isset($invoice)) @method('PUT') @endif

            <div class="row g-3">
                <!-- Student -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Select Student</label>
                     <select name="user_id" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $invoice->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Course -->
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Course</label>
                    <select name="course_id" class="form-select" required
                        {{ isset($invoice) && $invoice->status != 'unpaid' ? 'disabled' : '' }}>
                        <option value="">-- Select Course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ isset($invoice) && $invoice->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Invoice Number -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Invoice Number</label>
                    <input type="text" name="invoice_number" class="form-control"
                           value="{{ old('invoice_number', $invoice->invoice_number ?? '') }}">
                </div>

                <!-- Invoice Date -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Invoice Date</label>
                    <input type="date" name="invoice_date" class="form-control"
                           value="{{ old('invoice_date', isset($invoice) ? $invoice->invoice_date->format('Y-m-d') : '') }}"
                           required>
                </div>

                <!-- Due Date -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Due Date</label>
                    <input type="date" name="due_date" class="form-control"
                           value="{{ old('due_date', isset($invoice) ? $invoice->due_date->format('Y-m-d') : '') }}"
                           required>
                </div>

                <!-- Subtotal / Course Fee -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Course Fee (Subtotal)</label>
                    <input type="number" name="subtotal" step="0.01" class="form-control"
                           value="{{ old('subtotal', $invoice->subtotal ?? 0) }}"
                           {{ isset($invoice) && $invoice->status != 'unpaid' ? 'readonly' : '' }} required>
                </div>

                <!-- Discount % -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Discount %</label>
                    <input type="number" name="discount_percent" step="0.01" class="form-control"
                           value="{{ old('discount_percent', $invoice->discount_percent ?? 0) }}"
                           {{ isset($invoice) && $invoice->status != 'unpaid' ? 'readonly' : '' }}>
                </div>

                <!-- CGST % -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">CGST %</label>
                    <input type="number" name="cgst_percent" step="0.01" class="form-control"
                           value="{{ old('cgst_percent', $invoice->cgst_percent ?? 0) }}"
                           {{ isset($invoice) && $invoice->status != 'unpaid' ? 'readonly' : '' }}>
                </div>

                <!-- SGST % -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">SGST %</label>
                    <input type="number" name="sgst_percent" step="0.01" class="form-control"
                           value="{{ old('sgst_percent', $invoice->sgst_percent ?? 0) }}"
                           {{ isset($invoice) && $invoice->status != 'unpaid' ? 'readonly' : '' }}>
                </div>

                <!-- Convenience Fee % -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Convenience Fee %</label>
                    <input type="number" name="convenience_fee_percent" step="0.01" class="form-control"
                           value="{{ old('convenience_fee_percent', $invoice->convenience_fee_percent ?? 0) }}"
                           {{ isset($invoice) && $invoice->status != 'unpaid' ? 'readonly' : '' }}>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="partial" {{ $invoice->status == 'partial' ? 'selected' : '' }}>Partial</option>
                        <option value="cancelled" {{ $invoice->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i>
                        {{ isset($invoice) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
