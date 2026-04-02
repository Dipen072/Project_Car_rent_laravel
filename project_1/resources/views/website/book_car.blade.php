@extends('website.layout.structure')

@section('content')

<div class="site-section bg-light" id="contact-section">
  <div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <h2>Book {{ $car->car_name }} ({{ $car->brand }})</h2>
          <p>Fill out the form below to secure your car.</p>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-8 mb-5" >
        <form action="{{ url('book-car') }}" method="post" class="p-5 bg-white">
          @csrf
          <input type="hidden" name="car_id" value="{{ $car->id }}">
          
          <h2 class="h4 text-black mb-5">Booking Details</h2>
          
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <div class="row form-group">
            <div class="col-md-6 mb-3 mb-md-0">
              <label class="text-black" for="from_date">From Date</label>
              <input type="date" name="from_date" id="from_date" class="form-control" value="{{ old('from_date') }}" required min="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-6">
              <label class="text-black" for="to_date">To Date</label>
              <input type="date" name="to_date" id="to_date" class="form-control" value="{{ old('to_date') }}" required min="{{ date('Y-m-d') }}">
            </div>
          </div>

          <div class="row form-group mt-4">
            <div class="col-md-12">
              <label class="text-black">Price per day: ₹{{ $car->price_per_day }}</label>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" value="Confirm Booking" class="btn btn-primary py-2 px-4 text-white">
            </div>
          </div>

        </form>
      </div>

      <div class="col-lg-4">
        <div class="p-4 mb-3 bg-white">
          <h3 class="h5 text-black mb-3">Car Info</h3>
          <p class="mb-0 font-weight-bold">Brand</p>
          <p class="mb-4">{{ $car->brand }}</p>

          <p class="mb-0 font-weight-bold">Features</p>
          <p class="mb-4">{{ $car->description }}</p>

          <img src="{{ url('upload/cars/'.$car->image) }}" alt="Image" class="img-fluid rounded">
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
