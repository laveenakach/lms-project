<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createOrder($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Razorpay amount in paise
        $amountInPaise = $invoice->grand_total * 100;

        $order = $api->order->create([
            'receipt' => $invoice->invoice_number,
            'amount' => $amountInPaise,
            'currency' => 'INR'
        ]);

        // Save order ID in DB
        $invoice->razorpay_order_id = $order['id'];
        $invoice->save();

        return view('student.payment.checkout', [
            'order' => $order,
            'invoice' => $invoice
        ]);
    }

    // STEP 2: VERIFY PAYMENT
    public function verify(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {

            // Signature verification
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Update invoice as paid
            $invoice = Invoice::where('razorpay_order_id', $request->razorpay_order_id)->first();
            $invoice->status = 'paid';
            $invoice->payment_date = now();
            $invoice->payment_method = 'Razorpay';
            $invoice->transaction_id = $request->razorpay_payment_id;
            $invoice->save();

            $enrollment = \App\Models\CourseEnrollment::where('student_id', $invoice->user_id)
            ->where('course_id', $invoice->course_id)
            ->first();

            if ($enrollment) {
                $enrollment->status = 'approved';
                $enrollment->save();
            }

            // Redirect to certificate
            // return redirect()
            //     ->route('certifications.index')
            //     ->with('success', 'Payment successful! Certificate unlocked.');

            return redirect()
                ->route('student.invoices.index')
                ->with('success', 'Payment successful! Student is Enrolled in the course.');

        } catch (\Exception $e) {
            return back()->with('error', 'Payment Failed! ' . $e->getMessage());
        }
    }
}
