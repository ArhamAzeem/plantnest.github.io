@extends('admin.dashboard')
@section('title', 'Add Product')

@section('main_content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Product</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="product-form" novalidate>
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required pattern="^[A-Za-z\s]{3,}$" 
                                   title="Name should contain only letters and spaces, at least 3 characters.">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="species" class="form-label">Species <span class="text-danger">*</span></label>
                            <input type="text" id="species" name="species" class="form-control @error('species') is-invalid @enderror" 
                                   value="{{ old('species') }}" pattern="^[A-Za-z\s]{3,}$" 
                                   title="Species should contain only letters and spaces, at least 3 characters.">
                            @error('species')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" 
                                   step="0.01" value="{{ old('price') }}" required pattern="^\d+(\.\d{1,2})?$" 
                                   title="Enter a valid price with up to 2 decimal places.">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="discount_percentage" class="form-label">Discount Percentage</label>
                            <input type="number" id="discount_percentage" name="discount_percentage" class="form-control @error('discount_percentage') is-invalid @enderror" 
                                   step="0.01" value="{{ old('discount_percentage') }}" max="100" 
                                   pattern="^\d+(\.\d{1,2})?$" title="Discount must be between 0 and 100.">
                            @error('discount_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror" 
                                   value="{{ old('stock') }}" required pattern="^[0-9]+$" 
                                   title="Stock must be a valid number.">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="4" pattern="^[A-Za-z0-9\s.,!?]{10,}$" title="Description should be at least 10 characters long.">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Upload Image <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" id="image" name="image" class="custom-file-input @error('image') is-invalid @enderror" onchange="displayFileName()" required>
                                <label class="custom-file-label" for="image">Choose file</label>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Save Product</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Display the file name when a file is chosen
    function displayFileName() {
        const fileInput = document.getElementById('image');
        const fileName = fileInput.files[0] ? fileInput.files[0].name : 'Choose file';
        const label = fileInput.nextElementSibling;
        label.innerHTML = fileName;
    }

    // Add JS validation before submission
    document.getElementById('product-form').addEventListener('submit', function(event) {
        const form = event.target;

        // Bootstrap validation: mark form as was-validated on submit
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    });
</script>
@endsection
