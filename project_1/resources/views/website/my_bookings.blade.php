@extends('website.layout.structure')

@section('content')

<div class="site-section bg-light" id="contact-section">
  <div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <h2>My Bookings</h2>
          <p>Here you can track your current and past car rentals.</p>
        </div>
    </div>
    
    <div class="row">
      <div class="col-12 bg-white p-5">
          
          <div class="table-responsive">
              <table class="table table-bordered">
                  <thead class="thead-dark">
                      <tr>
                          <th>Booking ID</th>
                          <th>Car details</th>
                          <th>From Date</th>
                          <th>To Date</th>
                          <th>Total Amount</th>
                          <th>Status</th>
                          <th>Booked On</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse($bookings as $booking)
                      <tr>
                          <td>#{{ $booking->id }}</td>
                          <td>
                              <strong>{{ $booking->car->car_name }}</strong><br>
                              <small>{{ $booking->car->brand }}</small>
                          </td>
                          <td>{{ \Carbon\Carbon::parse($booking->from_date)->format('d M, Y') }}</td>
                          <td>{{ \Carbon\Carbon::parse($booking->to_date)->format('d M, Y') }}</td>
                          <td>₹{{ $booking->total_price }}</td>
                          <td>
                              @if($booking->status == 'pending')
                                  <span class="badge badge-warning text-dark p-2">Pending</span>
                              @elseif($booking->status == 'approved')
                                  <span class="badge badge-success p-2">Approved</span>
                              @elseif($booking->status == 'rejected')
                                  <span class="badge badge-danger p-2">Rejected</span>
                              @elseif($booking->status == 'completed')
                                  <span class="badge badge-info p-2">Completed</span>
                              @endif
                          </td>
                          <td>{{ $booking->created_at->format('d M, Y') }}</td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="7" class="text-center">You haven't booked any cars yet.</td>
                      </tr>
                      @endforelse
                  </tbody>
              </table>
          </div>

      </div>
    </div>
  </div>
</div>

@endsection
