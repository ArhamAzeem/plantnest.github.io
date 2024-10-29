@extends('admin.dashboard')
@section('title', 'Edit Category')

@section('main_content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Edit Category</h4>
                </div>
                <div class="card-body">
                    <form id="edit-category-form" action="{{ route('categories.update', $category->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" 
                                       value="{{ old('name', $category->name) }}" pattern="^[A-Za-z].*" 
                                       title="The name must start with an alphabet." required>
                                <div class="invalid-feedback">The name must start with an alphabet.</div>
                            </div>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="type" class="form-label">Category Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="" disabled>Select Type</option>
                                <option value="plant" {{ old('type', $category->type) === 'plant' ? 'selected' : '' }}>Plant</option>
                                <option value="accessory" {{ old('type', $category->type) === 'accessory' ? 'selected' : '' }}>Accessory</option>
                            </select>
                            <div class="invalid-feedback">Please select a category type.</div>
                            @error('type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back to Categories
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('edit-category-form');
        const nameInput = document.getElementById('name');

        form.addEventListener('submit', function(event) {
            // Bootstrap validation: mark form as was-validated on submit
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        });
    });
</script>
@endpush
