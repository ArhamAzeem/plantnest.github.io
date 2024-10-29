@extends('admin.dashboard')
@section('title', 'Create Category')

@section('main_content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Create New Category</h4>
                </div>
                <div class="card-body">
                    <form id="create-category-form" action="{{ route('categories.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" pattern="[A-Za-z][A-Za-z0-9]*" title="Name must start with an alphabet and can only contain alphanumeric characters" required>
                                <div class="invalid-feedback">The name must start with an alphabet and only contain alphanumeric characters.</div>
                            </div>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="type" class="form-label">Category Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="" disabled selected>Select Type</option>
                                <option value="plant" {{ old('type') === 'plant' ? 'selected' : '' }}>Plant</option>
                                <option value="accessory" {{ old('type') === 'accessory' ? 'selected' : '' }}>Accessory</option>
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
                                <i class="bi bi-save"></i> Create Category
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
        const form = document.getElementById('create-category-form');
        const nameInput = document.getElementById('name');
        const namePattern = /^[A-Za-z]/;

        form.addEventListener('submit', function(event) {
            const nameValue = nameInput.value;
            if (!namePattern.test(nameValue)) {
                nameInput.setCustomValidity('The name must start with an alphabet.');
            } else {
                nameInput.setCustomValidity('');
            }

            // Check form validity before submitting
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        });
    });
</script>
@endpush
