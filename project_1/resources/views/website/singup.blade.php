@extends('website.layout.structure')

@section('content')

<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">

        <h2 class="text-center mb-4"> Customer Registration</h2>

        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif


        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


  <form action="{{ url('/ins_signup') }}" method="POST" enctype="multipart/form-data">
   @csrf

       <!--name-->
       <div class="mb-3">
        <input type="text" name="name" class="form-control" placeholder="Name" required>
       </div>

       <!--email-->
       <div class="mb-3">
        <input type="text" name="email" class="form-control" placeholder="Email" required>
       </div>

       <!--password-->
       <div class="mb-3">
        <input type="text" name="password" class="form-control" placeholder="Password" required>
       </div>

       <!--gender-->
       <div class="mb-3"> 
        <label>Gender</label><br> 
        <input type="radio" name="gender" value="Male"> Male 
        <input type="radio" name="gender" value="Female"> Female 
       </div>

       <!--hobbies-->
       <div class="mb-3">
        <input type="checkbox" name="hobbies[]" value="Reading"> Reading 
        <input type="checkbox" name="hobbies[]" value="Traveling"> Traveling 
        <input type="checkbox" name="hobbies[]" value="Gaming"> Gaming 
       </div>

       <!--mobile-->
       <div class="mb-3">
        <input type="text" name="mobile" class="form-control" placeholder="Mobile Number" required>
       </div>

      <!--address-->
       <div class="mb-3">
        <input type="text" name="address" class="form-control" placeholder="Address">
       </div>

       <!--city-->
       <div class="mb-3">
        <input type="text" name="city" class="form-control" placeholder="City">
       </div>

       <!--state-->
       <div class="row">
        <div class="col-md-4 mb-3">
        <input type="text" name="state" class="form-control" placeholder="State">
        </div>
       </div>

       <!--pincode-->
       <div class="mb-3">
        <input type="text" name="pincode" class="form-control" placeholder="Pincode">
       </div>

       <!--license_number-->
       <div class="mb-3">
        <input type="text" name="license_number" class="form-control" placeholder="License Number">
       </div>

       <!--profile_image-->
       <div class="mb-3">
        <input type="file" name="profile_image" class="form-control" placeholder="Profile Image">
       </div>

       <button type="submit" class="btn btn-primary btn-block py-3">
        Register
       </button>
     </form>
        
      </div>
    </div>
  </div>
</div>

@endsection
