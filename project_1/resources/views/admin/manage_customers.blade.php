@extends('admin.layout.structure')

@section('content')
<h2 class="mb-4">Manage Customers</h2>

<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Manage Customers</h5>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>City</th>
            <th>Image</th>
            <th>Action</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
          @foreach($customers as $data)
          <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->mobile }}</td>
            <td>{{ $data->city }}</td>

            <td>
              <img src="{{ url('upload/customer/'.$data->profile_image) }}" width="60">
            </td>

            <td>
              <a href="{{ url('edit_customer/'.$data->id) }}" class="btn btn-warning btn-sm">
                Edit
              </a>
              <a href="{{ url('delete_customer/'.$data->id) }}" class="btn btn-danger btn-sm">
                Delete
              </a>
            </td>
            <td>
              <a href="{{ url('status_customer/'.$data->id) }}" class="btn btn-danger btn-sm">
                Block
              </a>

              <a href="{{ url('status_customer/'.$data->id) }}" class="btn btn-success btn-sm">
                Unblock
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- ✅ Pagination niche -->
    <div class="mt-3 d-flex justify-content-center">
      {{ $customers->links() }}
    </div>  
  </div>
</div>
@endsection