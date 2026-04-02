@extends('website.layout.structure')

@section('content')

<div class="ftco-blocks-cover-1">
  <div class="ftco-cover-1 overlay innerpage"
       style="background-image: url('{{ url('website/images/hero_2.jpg') }}')">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 text-center">
          <h1>Booking</h1>
          <p>Choose your car and book it</p>
        </div>
      </div>
    </div>
  </div>
</div>

    <div class="site-section pt-5 pb-5 bg-light" style="margin-top: 80px;">
       <div class="container">
          <div class="row">
             <div class="col-12">

        <form class="trip-form" action="{{ url('booking') }}" method="POST">
        @csrf

        <div class="row align-items-center mb-4">
        <div class="col-md-6">
        <h3 class="m-0">Book your trip here</h3>
        </div>

        <div class="col-md-6 text-md-right">
        <span class="text-primary">{{ $cars->count() }}</span> 
        <span>cars available</span>
        </div>
        </div>

        <div class="row">

        <div class="form-group col-md-4">
        <label>Select Car</label>
        <select name="car_id" class="form-control px-3" required>

        <option value="">-- Choose a Car --</option>

        @foreach($cars as $car)

        <option value="{{ $car->id }}">
        {{ $car->title }} (₹{{ $car->price_per_day }}/day)
        </option>

        @endforeach

        </select>
        </div>

        <div class="form-group col-md-4">
        <label>Pickup date</label>
        <input type="date" class="form-control px-3" name="pickup_date" required>
        </div>

        <div class="form-group col-md-4">
        <label>Return date</label>
        <input type="date" class="form-control px-3" name="return_date" required>
        </div>

        </div>

        <div class="row">
        <div class="col-lg-6">
        <input type="submit" value="Confirm Booking" class="btn btn-primary">
        </div>
        </div>

        </form>

        </div>
       </div>
    </div>
</div>