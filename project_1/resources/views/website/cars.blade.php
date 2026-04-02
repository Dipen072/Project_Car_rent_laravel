@extends('website.layout.structure')

@section('content')

<div class="ftco-blocks-cover-1">
  <div class="ftco-cover-1 overlay innerpage"
       style="background-image: url('{{ url('website/images/hero_2.jpg') }}')">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 text-center">
          <h1>Our For Rent Cars</h1>
          <p>Choose your car and rent it</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="site-section bg-light">
  <div class="container">
    <div class="row">

    {{-- No cars --}}
    @if($cars->count() == 0)
      <p>No cars available</p>
    @endif

    {{-- Dynamic cars --}}
    @foreach($cars as $car)
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="item-1">

        <a href="#">
          <img src="{{ url('upload/cars/'.$car->image) }}"
               class="car-img" alt="car">
        </a>

        <div class="item-1-contents">
          <div class="text-center">
            <h3>{{ $car->name }}</h3>

            <div class="rating">
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
              <span class="icon-star text-warning"></span>
            </div>

            <div class="rent-price">
              <span>₹{{ $car->price_per_day }}/</span>day
              
            </div>
          </div>

          <ul class="specs">
            <li><span>Doors</span><span class="spec">{{ $car->doors }}</span></li>
            <li><span>Seats</span><span class="spec">{{ $car->seats }}</span></li>
            <li><span>Transmission</span><span class="spec">{{ $car->transmission }}</span></li>
            <li><span>Minimum age</span><span class="spec">{{ $car->min_age }} years</span></li>
          </ul>

          <div class="d-flex action justify-content-between">
            <a href="{{ url('book-car/'.$car->id) }}"
               class="btn btn-primary text-white">
               Book Now
            </a>
          </div>
        </div>

      </div>
    </div>
    @endforeach

    </div>
  </div>
</div>

@endsection