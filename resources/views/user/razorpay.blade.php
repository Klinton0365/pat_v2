@extends('user.layout.app')
@section('content')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<div class="container py-5 text-center">
    <h3>Processing Payment...</h3>
</div>

<script>
var options = {
    "key": "{{ env('RAZORPAY_KEY_ID') }}",
    "amount": "{{ $total * 100 }}",
    "currency": "INR",
    "name": "Your Shop",
    "description": "Order Payment",
    "order_id": "{{ $order['id'] }}",
    "handler": function (response){
        fetch("{{ route('payment.success') }}", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: JSON.stringify(response)
        }).then(() => window.location.href = "{{ route('thankyou') }}");
    }
};
var rzp = new Razorpay(options);
rzp.open();
</script>
@endsection
