<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
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
        if ($booking->status == 'confirmed') {
            return redirect('/booking')->with('error', 'Booking already confirmed.');
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

            // Create payment record
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'status' => 'pending',
                'payment_data' => ['order_id' => $order->id],
            ]);

            return response()->json([
                'order_id' => $order->id,
                'amount' => $order->amount,
                'key' => env('RAZORPAY_KEY'),
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
        ]);

        try {
            // Verify payment signature
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $this->getRazorpay()->utility->verifyPaymentSignature($attributes);

            // Find payment by order_id
            $payment = Payment::where('payment_data->order_id', $request->razorpay_order_id)->first();

            if (!$payment) {
                return redirect('/booking')->with('error', 'Payment record not found.');
            }

            // Update payment
            $payment->update([
                'payment_id' => $request->razorpay_payment_id,
                'status' => 'success',
                'payment_data' => array_merge($payment->payment_data ?? [], [
                    'signature' => $request->razorpay_signature,
                    'verified_at' => now(),
                ]),
            ]);

            // Update booking status
            $payment->booking->update(['status' => 'confirmed']);

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
        $order_id = $request->get('razorpay_order_id');

        $payment = Payment::where('payment_data->order_id', $order_id)->first();

        if ($payment) {
            $payment->update(['status' => 'failed']);
            // Optionally, update booking to cancelled or keep pending
            $payment->booking->update(['status' => 'pending']); // Or 'cancelled'
        }

        return redirect('/booking')->with('error', 'Payment failed. Please try again.');
    }
}
