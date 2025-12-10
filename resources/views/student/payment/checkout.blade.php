<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<h3>Pay Invoice: {{ $invoice->invoice_number }}</h3>
<p>Amount: <strong>₹{{ $invoice->grand_total }}</strong></p>

<script>
var options = {
    "key": "{{ env('RAZORPAY_KEY') }}",
    "amount": "{{ $order['amount'] }}",
    "currency": "INR",
    "name": "Your LMS",
    "description": "Invoice Payment",
    "order_id": "{{ $order['id'] }}",
    "handler": function (response){
        // Submit hidden form on success
        document.getElementById('paymentForm').razorpay_payment_id.value = response.razorpay_payment_id;
        document.getElementById('paymentForm').razorpay_signature.value = response.razorpay_signature;
        document.getElementById('paymentForm').submit();
    }
};

var rzp1 = new Razorpay(options);
rzp1.open();
</script>

<form id="paymentForm" action="{{ route('student.payment.verify') }}" method="POST">
    @csrf
    <input type="hidden" name="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature">
    <input type="hidden" name="razorpay_order_id" value="{{ $order['id'] }}">
</form>
