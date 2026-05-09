@extends('website.layout.structure')
@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 text-center mt-5">
                    <h2 class="mb-4">Complete Your Payment</h2>
                    
                    <div class="booking-details text-left mb-4 p-3 border rounded">
                        <h5>Booking Details</h5>
                        <p><strong>Car:</strong> {{ $booking->car->name ?? 'Car Name' }}</p>
                        <p><strong>From Date:</strong> {{ $booking->from_date }}</p>
                        <p><strong>To Date:</strong> {{ $booking->to_date }}</p>
                        <p><strong>Total Price:</strong> ₹{{ $booking->total_price }}</p>
                    </div>

                    <p>Select your preferred payment method in the next step. You can choose <strong>Netbanking</strong>, UPI, or Card.</p>
                    
                    <button id="rzp-button1" class="btn btn-primary btn-lg mt-3">Pay Now ₹{{ $booking->total_price }}</button>
                    
                    <form action="{{ url('/payment/success') }}" method="POST" id="razorpay-form" style="display: none;">
                        @csrf
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    </form>

                    <form action="{{ url('/payment/failure') }}" method="POST" id="razorpay-failure-form" style="display: none;">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('rzp-button1').onclick = function(e){
    e.preventDefault();
    
    // Disable button to prevent multiple clicks
    this.disabled = true;
    this.innerText = 'Processing...';

    // Call your server to create an order
    fetch("{{ url('/payment/create-order/' . $booking->id) }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.error) {
            alert(data.error);
            document.getElementById('rzp-button1').disabled = false;
            document.getElementById('rzp-button1').innerText = 'Pay Now ₹{{ $booking->total_price }}';
            return;
        }

        var options = {
            "key": data.key, 
            "amount": data.amount,
            "currency": "INR",
            "name": "Car Rental",
            "description": "Car Booking Payment",
            "order_id": data.order_id,
            "handler": function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('razorpay-form').submit();
            },
            "prefill": {
                "name": data.customer_name,
                "email": data.customer_email,
                "contact": data.customer_phone
            },
            "theme": {
                "color": "#007bff"
            }
        };

        var rzp1 = new Razorpay(options);
        
        rzp1.on('payment.failed', function (response){
            alert("Payment Failed: " + response.error.description);
            document.getElementById('razorpay-failure-form').submit();
        });

        rzp1.open();

        // Reset button
        document.getElementById('rzp-button1').disabled = false;
        document.getElementById('rzp-button1').innerText = 'Pay Now ₹{{ $booking->total_price }}';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
        document.getElementById('rzp-button1').disabled = false;
        document.getElementById('rzp-button1').innerText = 'Pay Now ₹{{ $booking->total_price }}';
    });
}
</script>
@endsection
