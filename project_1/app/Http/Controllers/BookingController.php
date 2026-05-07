<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    // List available cars for users
    public function index()
    {
        $cars = Car::paginate(6);
        return view('website.cars', compact('cars'));
    }

    // Show booking form (Added for convenience, but form can also be on car detail page)
    public function showBookingForm($id)
    {
        $car = Car::findOrFail($id);
        return view('website.book_car', compact('car'));
    }

    // Store a new booking
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after:from_date',
        ]);

        $car = Car::findOrFail($request->car_id);

        // Check availability
        $isBooked = Booking::where('car_id', $car->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('from_date', [$request->from_date, $request->to_date])
                      ->orWhereBetween('to_date', [$request->from_date, $request->to_date])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('from_date', '<=', $request->from_date)
                            ->where('to_date', '>=', $request->to_date);
                      });
            })->exists();

        if ($isBooked) {
            Alert::error('Sorry, this car is already booked for the selected dates.');
            return back();
        }

        // Calculate total price
        $from = Carbon::parse($request->from_date);
        $to = Carbon::parse($request->to_date);
        $days = $from->diffInDays($to) == 0 ? 1 : $from->diffInDays($to); // Minimum 1 day
        $total_price = $days * $car->price_per_day;

        $booking = new Booking();
        $booking->customer_id = session('user_id'); // Using their session logic
        $booking->car_id = $car->id;
        $booking->from_date = $request->from_date;
        $booking->to_date = $request->to_date;
        $booking->total_price = $total_price;
        $booking->status = 'pending';
        $booking->save();

        // Get customer details
        $customer = \App\Models\Customer::find(session('user_id'));
        if ($customer && $customer->email) {
            $bookingData = [
                'customer_name' => $customer->name,
                'car_name' => $car->car_name,
                'brand' => $car->brand,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'total_price' => $total_price,
                'status' => 'Pending'
            ];

            try {
                \Illuminate\Support\Facades\Mail::to($customer->email)->send(new \App\Mail\BookingNotificationMail($bookingData));
            } catch (\Exception $e) {
                // Log the error or handle it silently if mail fails so it doesn't break the booking flow
                \Illuminate\Support\Facades\Log::error('Mail sending failed: ' . $e->getMessage());
            }
        }

        Alert::success('Success', 'Car booked successfully! Waiting for admin approval.');
        return redirect('/booking');
    }

    // View User's Booking History
    public function myBookings()
    {
        $bookings = Booking::with('car')->where('customer_id', session('user_id'))->orderBy('created_at', 'desc')->get();
        return view('website.my_bookings', compact('bookings'));
    }

    // Admin: View all bookings
    public function adminIndex()
    {
        $bookings = Booking::with(['car', 'customer'])->orderBy('created_at', 'desc')->get();
        return view('admin.manage_bookings', compact('bookings'));
    }

    // Admin: Update Status
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed'
        ]);

        $booking->status = $request->status;
        $booking->save();

        Alert::success('Success', 'Booking status updated to ' . ucfirst($request->status));
        return back();
    }
}
