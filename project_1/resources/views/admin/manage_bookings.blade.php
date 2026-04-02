@extends('admin.layout.structure')

@section('content')

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Manage Bookings
    </div>
    <div class="card-body">
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th>Booking ID</th>
                        <th>Customer</th>
                        <th>Car Details</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>#{{ $booking->id }}</td>
                        <td>
                            @if($booking->customer)
                                {{ $booking->customer->name }} <br><small>{{ $booking->customer->mobile }}</small>
                            @else
                                <span class="text-danger">Deleted User</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->car)
                                <strong>{{ $booking->car->car_name }}</strong> <br><small>{{ $booking->car->brand }}</small>
                            @else
                                <span class="text-danger">Deleted Car</span>
                            @endif
                        </td>
                        <td>{{ date('d M, Y', strtotime($booking->from_date)) }}</td>
                        <td>{{ date('d M, Y', strtotime($booking->to_date)) }}</td>
                        <td>₹ {{ $booking->total_price }}</td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($booking->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($booking->status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @elseif($booking->status == 'completed')
                                <span class="badge bg-info">Completed</span>
                            @endif
                        </td>
                        <td>
                            <!-- Status Update Form -->
                            <form action="{{ url('/manage_bookings/status/'.$booking->id) }}" method="post" class="d-inline">
                                @csrf
                                <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $booking->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>

@endsection