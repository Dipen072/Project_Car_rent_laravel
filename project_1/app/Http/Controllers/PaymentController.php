<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $razorpay = null;

    private function getRazorpay()
    {
        if ($this->razorpay === null) {
            if (class_exists('Razorpay\Api\Api')) {
                $this->razorpay = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            }
        }
        return $this->razorpay;
    }

    /**
     * Show the payment page for a specific booking.
     */
    public function paymentPage($booking_id)
    {
        $booking = Booking::with('car')->findOrFail($booking_id);

        // Check if booking belongs to user
        if ($booking->customer_id != session('user_id')) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        // Check if already paid
        if ($booking->payment_status == 'success' || $booking->status == 'approved') {
            return redirect('/booking')->with('error', 'Booking already paid or confirmed.');
        }

        return view('website.payment', compact('booking'));
    }

    /**
     * Create Razorpay order
     */
    public function createOrder(Request $request, $booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        if ($booking->customer_id != session('user_id')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $order = $this->getRazorpay()->order->create([
                'receipt' => 'booking_' . $booking->id,
                'amount' => $booking->total_price * 100, // Amount in paisa
                'currency' => 'INR',
                'payment_capture' => 1, // Auto capture
            ]);

            return response()->json([
                'order_id' => $order->id,
                'amount' => $order->amount,
                'key' => env('RAZORPAY_KEY'),
                'customer_name' => $booking->customer->name ?? 'Customer',
                'customer_email' => $booking->customer->email ?? '',
                'customer_phone' => $booking->customer->mobile ?? ''
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Order creation failed'], 500);
        }
    }

    /**
     * Handle payment success
     */
    public function paymentSuccess(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required',
            'razorpay_signature' => 'required',
            'booking_id' => 'required'
        ]);

        try {
            // Verify payment signature
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $this->getRazorpay()->utility->verifyPaymentSignature($attributes);

            $booking = Booking::findOrFail($request->booking_id);

            // Fetch payment method details from Razorpay if needed
            $paymentDetails = $this->getRazorpay()->payment->fetch($request->razorpay_payment_id);
            $paymentMethod = $paymentDetails->method ?? 'netbanking';

            // Update booking
            $booking->update([
                'payment_id' => $request->razorpay_payment_id,
                'payment_status' => 'success',
                'payment_method' => $paymentMethod,
                'status' => 'approved'
            ]);

            return redirect('/booking')->with('success', 'Payment successful! Booking confirmed.');
        } catch (\Exception $e) {
            Log::error('Payment verification failed: ' . $e->getMessage());
            return redirect('/booking')->with('error', 'Payment verification failed.');
        }
    }

    /**
     * Handle payment failure
     */
    public function paymentFailure(Request $request)
    {
        $booking_id = $request->get('booking_id');
        if ($booking_id) {
            $booking = Booking::find($booking_id);
            if ($booking) {
                $booking->update(['payment_status' => 'failed']);
            }
        }

        return redirect('/booking')->with('error', 'Payment failed. Please try again.');
    }
}
