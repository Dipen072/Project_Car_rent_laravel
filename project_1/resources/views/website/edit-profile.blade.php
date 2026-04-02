@extends('website.layout.structure')

@section('content')

<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">

        <h2 class="text-center mb-4">Edit Profile</h2>

        <div class="card shadow">
          <div class="card-body">

      <form method="POST" action="{{ url('/update_profile/'.$data->id) }}" enctype="multipart/form-data">
              @csrf

              <input type="text" name="name" value="{{ $data->name }}" class="form-control mb-2" placeholder="Name">
              <input type="email" name="email" value="{{ $data->email }}" class="form-control mb-2" placeholder="Email">
              <input type="text" name="mobile" value="{{ $data->mobile }}" class="form-control mb-2" placeholder="Mobile">
              <textarea name="address" class="form-control mb-2">{{ $data->address }}</textarea>
              <input type="text" name="city" value="{{ $data->city }}" class="form-control mb-2" placeholder="City">
              <input type="text" name="state" value="{{ $data->state }}" class="form-control mb-2" placeholder="State">
              <input type="text" name="pincode" value="{{ $data->pincode }}" class="form-control mb-2" placeholder="Pincode">
              <input type="text" name="hobbies" value="{{ $data->hobbies }}" class="form-control mb-2" placeholder="Hobbies">
              <input type="text" name="gender" value="{{ $data->gender }}" class="form-control mb-2" placeholder="Gender">
              <input type="text" name="license_number" value="{{ $data->license_number }}" class="form-control mb-2" placeholder="License Number">
              <input type="file" name="profile_image" value="{{ $data->profile_image }}" class="form-control mb-2" placeholder="Profile Image">
              
              <button class="tm-submit btn btn-primary" type="submit" name="submit">Update</button>
            </form>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection