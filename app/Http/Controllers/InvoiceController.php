<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Course;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $invoices = Invoice::with('user')->latest()->get();
        }
        else{
            $invoices = Invoice::where('user_id', auth()->id())->get();
        }

        //return response()->json(['invoices' => $invoices]);
        return view('student.invoices.index', compact('invoices'));
    }

    public function viewInvoice($id)
    {
        $invoice = Invoice::with('course', 'user')->findOrFail($id);
        return view('student.invoices.view', compact('invoice'));
    }

    public function downloadPdf($id)
    {
        $invoice = Invoice::with('course', 'user')->findOrFail($id);
        $pdf = Pdf::loadView('student.invoices.pdf', compact('invoice'));
        $fileName = 'Invoice-' . $invoice->invoice_number . '.pdf';
        return $pdf->download($fileName);
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $users = User::where('role', 'student')->get();
        $courses = Course::all();

        return view('admin.invoice.edit', compact('invoice', 'users', 'courses'));
    }


    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'invoice_number' => 'nullable|string|max:255',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'subtotal' => 'required|numeric|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'cgst_percent' => 'nullable|numeric|min:0|max:100',
            'sgst_percent' => 'nullable|numeric|min:0|max:100',
            'convenience_fee_percent' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:unpaid,paid,partial,cancelled',
        ]);

        // Only allow changing student & course if unpaid
        if ($invoice->status == 'unpaid') {
            $invoice->user_id = $request->user_id;
            $invoice->course_id = $request->course_id;
            $invoice->subtotal = $request->subtotal;
            $invoice->discount_percent = $request->discount_percent ?? 0;
            $invoice->cgst_percent = $request->cgst_percent ?? 0;
            $invoice->sgst_percent = $request->sgst_percent ?? 0;
            $invoice->convenience_fee_percent = $request->convenience_fee_percent ?? 0;

            // Calculate amounts
            $invoice->discount_amount = ($invoice->subtotal * $invoice->discount_percent) / 100;
            $invoice->cgst_amount = ($invoice->subtotal * $invoice->cgst_percent) / 100;
            $invoice->sgst_amount = ($invoice->subtotal * $invoice->sgst_percent) / 100;
            $invoice->convenience_fee_amount = ($invoice->subtotal * $invoice->convenience_fee_percent) / 100;

            $invoice->grand_total = $invoice->subtotal
                                - $invoice->discount_amount
                                + $invoice->cgst_amount
                                + $invoice->sgst_amount
                                + $invoice->convenience_fee_amount;
        }

        $invoice->invoice_number = $request->invoice_number;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_date = $request->due_date;
        $invoice->status = $request->status;

        $invoice->save();

        return redirect()->route('student.invoices.index')->with('success', 'Invoice updated successfully!');
    }
}
