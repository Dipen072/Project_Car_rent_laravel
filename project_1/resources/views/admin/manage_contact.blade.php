@extends('admin.layout.structure')

@section('content')
<h2 class="mb-4">Manage Contact</h2>
   <div class="card">
     <div class="card-body">
      <table class="table table-bordered table-striped">
         <thead class="table-dark">
           <tr>
             <th>ID</th>
             <th>Name</th>
             <th>Email</th>
             <th>Message</th>
             <th>Date</th>
             <th>Action</th>
          </tr>
         </thead>
         <tbody>

         @foreach($contacts as $data)
         <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->comment }}</td>
            <td>{{ $data->created_at }}</td>
            <td>
            <a href="{{url('/edit_contact/'.$data->id)}}" class="btn btn-primary btn-sm">
            Edit
            </a>
            <a href="{{url('/delete_contact/'.$data->id)}}" class="btn btn-danger btn-sm">
            Delete
            </a>
            </td>
           </tr>
         @endforeach
         </tbody>
      </table>
      <div class="mt-3 d-flex justify-content-center">
      {{ $contacts->links() }}
    </div>  
    </div>
</div>
@endsection