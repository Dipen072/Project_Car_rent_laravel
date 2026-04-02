@extends('admin.layout.structure')

@section('content')

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Add Car
    </div>
    <div class="card-body">
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('add_car') }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Car Name</label>
                    <input type="text" name="car_name" class="form-control" value="{{ old('car_name') }}" required>
                </div>
                <div class="col-md-6">
                    <label>Brand</label>
                    <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Price Per Day</label>
                    <input type="number" step="0.01" name="price_per_day" class="form-control" value="{{ old('price_per_day') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ url('manage_cars') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
