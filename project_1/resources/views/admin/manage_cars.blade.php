@extends('admin.layout.structure')

@section('content')
<h2 class="mb-4">Manage Cars</h2>

<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Car List</h5>


    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-primary">
          <tr>
            <th>ID</th>
            <th>Car Name</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Category Id</th>
            <th>Car Image</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
        @foreach($car_arr as $key => $car)
          <tr>
            <td>{{ $car->id }}</td>
            <td>{{ $car->car_name }}</td>
            <td>{{ $car->brand }}</td>
            <td>₹ {{ $car->price_per_day }}</td>
            <td>{{ $car->category_id }}</td>
            <td>
              <img src="{{ url('upload/cars/'.$car->image) }}" width="80" alt="Car Image">
            </td>
            <td>{{ $car->description }}</td>

            <td>
              <a href="{{ url('/edit_car/'.$car->id) }}" class="btn btn-sm btn-warning">Edit</a>
              <a href="{{ url('delete_car/'.$car->id) }}" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    
    <div class="mt-3">
      {{ $car_arr->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection