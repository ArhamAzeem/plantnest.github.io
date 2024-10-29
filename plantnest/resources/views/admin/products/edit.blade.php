@extends('admin.dashboard')
@section('title','Edit Product')

@section('main_content')
<div class="container my-4">
    <h1 class="mb-4">Edit Product</h1>
    
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="edit-product-form ">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required
                           placeholder="Enter product name" pattern="^[A-Za-z\s]{3,}$" title="Name must contain only letters and spaces, with at least 3 characters.">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="species">Species</label>
                    <input type="text" id="species" name="species" class="form-control" value="{{ old('species', $product->species) }}"
                           placeholder="Enter species" pattern="^[A-Za-z\s]{3,}$" title="Species must contain only letters and spaces, with at least 3 characters.">
                    @error('species')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required
                           placeholder="Enter price" min="0.01" title="Price must be a positive number.">
                    @error('price')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="discount_percentage">Discount Percentage</label>
                    <input type="number" id="discount_percentage" name="discount_percentage" class="form-control" step="0.01" value="{{ old('discount_percentage', $product->discount_percentage) }}"
                           placeholder="Enter discount percentage" min="0" max="100" title="Discount must be a percentage between 0 and 100.">
                    @error('discount_percentage')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required
                           placeholder="Enter stock quantity" min="0" title="Stock must be a non-negative number.">
                    @error('stock')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" required placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control" onchange="displayImagePreview()">
                @if($product->image_path)
                    <div class="mt-2">
                        <img id="image-preview" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" width="150" class="img-thumbnail">
                    </div>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
</div>

<script>
    function displayImagePreview() {
        const fileInput = document.getElementById('image');
        const preview = document.getElementById('image-preview');
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        } else {
            preview.src = ''; // Clear preview if no file is selected
        }
    }

    document.getElementById('edit-product-form').addEventListener('submit', function(event) {
        const namePattern = /^[A-Za-z\s]{3,}$/;
        const pricePattern = /^\d+(\.\d{1,2})?$/;
        const discountPattern = /^\d+(\.\d{1,2})?$/;
        const stockPattern = /^[0-9]+$/;

        const name = document.getElementById('name').value;
        const species = document.getElementById('species').value;
        const price = document.getElementById('price').value;
        const discount = document.getElementById('discount_percentage').value;
        const stock = document.getElementById('stock').value;

        let isValid = true;

        if (!namePattern.test(name)) {
            alert('Invalid name. It should contain only letters and spaces, with at least 3 characters.');
            isValid = false;
        }

        if (species && !namePattern.test(species)) {
            alert('Invalid species. It should contain only letters and spaces, with at least 3 characters.');
            isValid = false;
        }

        if (!pricePattern.test(price) || price <= 0) {
            alert('Invalid price. It must be a positive number.');
            isValid = false;
        }

        if (discount && (discount < 0 || discount > 100)) {
            alert('Invalid discount. It must be a percentage between 0 and 100.');
            isValid = false;
        }

        if (!stockPattern.test(stock) || stock < 0) {
            alert('Invalid stock. It must be a non-negative number.');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
</script>
@endsection
