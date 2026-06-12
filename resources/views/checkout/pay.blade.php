@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded-lg shadow p-8 text-center">
    <h1 class="text-2xl font-bold mb-4">Complete Payment</h1>
    <p class="text-gray-600 mb-6">Order #{{ $order->order_number }} <br> Amount: <strong>Rs. {{ number_format($order->total_amount) }}</strong></p>
    <div id="razorpay-button"></div>
    <p class="text-sm text-gray-500 mt-4">You will be redirected after successful payment.</p>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        key: "{{ $key }}",
        amount: "{{ $order->total_amount * 100 }}",
        currency: "INR",
        name: "Cartzen",
        description: "Order #{{ $order->order_number }}",
        order_id: "{{ $razorpayOrder->id }}",
        handler: function (response) {
            // After payment success, submit to callback
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('payment.callback') }}";
            form.style.display = "none";
            form.innerHTML = '@csrf<input type="hidden" name="razorpay_payment_id" value="'+response.razorpay_payment_id+'"><input type="hidden" name="razorpay_order_id" value="'+response.razorpay_order_id+'"><input type="hidden" name="razorpay_signature" value="'+response.razorpay_signature+'">';
            document.body.appendChild(form);
            form.submit();
        },
        theme: {
            color: "#ea580c"
        }
    };
    var rzp = new Razorpay(options);
    rzp.open();
</script>
@endsection