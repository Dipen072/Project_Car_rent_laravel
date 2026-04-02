@extends('admin.layout.structure')

@section('content')
  <h2 class="mb-4">Dashboard</h2>
  <div class="row">
    <!-- Total Cars -->
    <div class="col-lg-3 col-md-6">
      <div class="card bg-primary text-white">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <i class="fa fa-car fs-6"></i>
            </div>
            <div>
              <h5 class="card-title mb-1 text-white">Total Cars</h5>
              <h3 class="fw-bold mb-0 text-white">12</h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Bookings -->
    <div class="col-lg-3 col-md-6">
      <div class="card bg-success text-white">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <i class="fa fa-calendar-check fs-6"></i>
            </div>
            <div>
              <h5 class="card-title mb-1 text-white">Bookings</h5>
              <h3 class="fw-bold mb-0 text-white">45</h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Customers -->
    <div class="col-lg-3 col-md-6">
      <div class="card bg-warning text-white">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <i class="fa fa-users fs-6"></i>
            </div>
            <div>
              <h5 class="card-title mb-1 text-white">Customers</h5>
              <h3 class="fw-bold mb-0 text-white">89</h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Categories -->
    <div class="col-lg-3 col-md-6">
      <div class="card bg-danger text-white">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <i class="fa fa-list fs-6"></i>
            </div>
            <div>
              <h5 class="card-title mb-1 text-white">Categories</h5>
              <h3 class="fw-bold mb-0 text-white">5</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection