@extends('website.layout.structure')

@section('content')

<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">

        <h2 class="text-center mb-4">My Profile</h2>

        <div class="card shadow">
          <div class="card-body">

         
          <form action="{{ url('/user_profile/'.$data->id) }}" method="post">
            @csrf

            <p><strong>Name:</strong> {{ $data->name }}</p>
            <p><strong>Email:</strong> {{ $data->email }}</p>
            <p><strong>Mobile:</strong> {{ $data->mobile }}</p>
            <p><strong>City:</strong> {{ $data->city }}</p>
            <p><strong>Gender:</strong> {{ $data->gender }}</p>
            <p><strong>Hobbies:</strong> {{ $data->hobbies }}</p>
            <p><strong>Address:</strong> {{ $data->address }}</p>
            <p><strong>State:</strong> {{ $data->state }}</p>
            <p><strong>Pincode:</strong> {{ $data->pincode }}</p>
            <p><strong>License Number:</strong> {{ $data->license_number }}</p>
            <p><strong>Profile Image:</strong> <img src="{{ url('upload/customer/'.$data->profile_image) }}" width="60"></p>

            <div class="mt-4">
              <a href="{{ url('edit_profile/'.$data->id) }}" class="btn btn-primary">Edit Profile</a>
            </div>
          </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection