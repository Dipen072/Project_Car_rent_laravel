@extends('website.layout.structure')

@section('content')

    <div class="ftco-blocks-cover-1">
      <div class="ftco-cover-1 overlay innerpage" style="background-image: url(' {{url ('website/images/hero_2.jpg') }}')">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center">
              <h1>Contact Us</h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="site-section bg-light" id="contact-section">
      <div class="container">
        <div class="row justify-content-center text-center">
        <div class="col-7 text-center mb-5">
          <h2>Contact Us Or Use This Form To Rent A Car</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda, dolorum necessitatibus eius earum voluptates sed!</p>
        </div>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger">
           <ul>
           @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
        @endforeach
      </ul>
   </div>
@endif
        

            <form action="{{url ('/ins_contact') }}" method="POST">
            @csrf

    <div class="form-group row">
        <div class="col-md-6 mb-4 mb-lg-0">

            <input type="text" name="name" class="form-control" placeholder="Name">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <input type="email" name="email" class="form-control" placeholder="Email address">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <textarea name="comment" class="form-control" placeholder="Write your message." cols="30" rows="10"></textarea>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6 mr-auto">
            <button type="submit" class="btn btn-block btn-primary text-white py-3 px-5">
                Send Message
            </button>
        </div>
    </div>
</form>
          <div class="col-lg-4 ml-auto">
            <div class="bg-white p-3 p-md-5">
              <h3 class="text-black mb-4">Contact Info</h3>
              <ul class="list-unstyled footer-link">
                <li class="d-block mb-3">
                  <span class="d-block text-black">Address:</span>
                  <span>34 Street Name, City Name Here, United States</span></li>
                <li class="d-block mb-3"><span class="d-block text-black">Phone:</span><span>+1 242 4942 290</span></li>
                <li class="d-block mb-3"><span class="d-block text-black">Email:</span><span>info@yourdomain.com</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
