@extends('admin.layout.structure')

@section('content')
  <h2 class="mb-4">Add New Customer</h2>
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Add Customer</h5>
    <form>
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter full name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email">
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone" placeholder="Enter phone number">
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" rows="3" placeholder="Enter address"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Customer</button>
    </form>
  </div>
</div>
@endsection
