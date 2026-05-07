<div style="font-family: Arial, sans-serif; padding: 20px; color: #333;">
    <h1 style="background-color: brown; color: white; padding: 10px; text-align: center;">Car Rental Service</h1>
    
    <h2>Hello {{ $bookingData['customer_name'] }},</h2>
    
    <p>Thank you for choosing our service. Your car booking request has been received and is currently <strong>{{ $bookingData['status'] }}</strong>.</p>
    
    <h3>Booking Details:</h3>
    <ul>
        <li><strong>Car:</strong> {{ $bookingData['car_name'] }} ({{ $bookingData['brand'] }})</li>
        <li><strong>From Date:</strong> {{ $bookingData['from_date'] }}</li>
        <li><strong>Due Date (To Date):</strong> <span style="color: red;">{{ $bookingData['to_date'] }}</span></li>
        <li><strong>Total Price:</strong> ₹{{ $bookingData['total_price'] }}</li>
    </ul>

    <br>
    <p>Please make sure to return the car by the due date to avoid any late fees.</p>
    
    <h3 style="background-color: brown; color: white; padding: 10px; text-align: center;">We will contact you soon...!</h3>
</div>
