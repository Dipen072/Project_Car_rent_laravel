@extends('admin.layout.structure')

@section('content')

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-plus me-1"></i>
        Add Category
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

        <form action="{{ url('add_category') }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label>Category Name</label>
                <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" required>
            </div>
            
            <div class="mb-3">
                <label>Category Image (jpg/png)</label>
                <input type="file" name="category_image" class="form-control" accept="image/jpeg, image/png">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="statusActive" value="Active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusActive">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="statusInactive" value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusInactive">
                        Inactive
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ url('manage_category') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection
