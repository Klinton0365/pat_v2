@extends('user.layout.app')
@section('content')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <div class="container py-5 text-center">
        <h3>Please wait, redirecting to payment gateway...</h3>
    </div>

    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY_ID') }}",
            "amount": "{{ $total * 100 }}",
            "currency": "INR",
            "name": "PureAquaTech",
            "description": "Order Payment",
            "order_id": "{{ $order['id'] }}",
            "handler": function (response) {
                response.order_number = "{{ $dbOrder->order_number }}";

                fetch("{{ route('payment.success') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(response)
                })
                .then(response => response.json())
                .then(data => {
                    // ✅ Redirect to the URL returned from server
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                    } else {
                        // Fallback with order ID
                        window.location.href = "{{ route('thankyou', ['order' => $dbOrder->id]) }}";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Fallback with order ID
                    window.location.href = "{{ route('thankyou', ['order' => $dbOrder->id]) }}";
                });
            },

            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp = new Razorpay(options);
        rzp.open();
    </script>
@endsection

{{-- @extends('user.layout.app')
@section('content')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <div class="container py-5 text-center">
        <h3>Please wait, redirecting to payment gateway...</h3>
    </div>

    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY_ID') }}",
            "amount": "{{ $total * 100 }}",
            "currency": "INR",
            "name": "PureAquaTech",
            "description": "Order Payment",
            "order_id": "{{ $order['id'] }}",
            "handler": function (response) {
                response.order_number = "{{ $dbOrder->order_number }}";

                fetch("{{ route('payment.success') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(response)
                }).then(() => {
                    window.location.href = "{{ route('thankyou') }}";
                });
            },

            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp = new Razorpay(options);
        rzp.open();
    </script>
@endsection --}}