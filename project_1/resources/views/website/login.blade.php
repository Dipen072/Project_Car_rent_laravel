@extends('website.layout.structure')

@section('content')

<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">

        <h2 class="text-center mb-4">Customer Login</h2>

        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
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

        <form action="{{ url('/check_login') }}" method="POST">
          @csrf

          <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>

          <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <button type="submit" class="btn btn-primary btn-block py-3">
            Login
          </button>

        </form>

      </div>
    </div>
  </div>
</div>

@endsection
