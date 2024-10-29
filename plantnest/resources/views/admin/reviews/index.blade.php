@extends('admin.dashboard')
@section('title', 'Reviews')

@section('main_content')
<div class="container py-5">
    <h1 class="mb-4">Manage Reviews</h1>

    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Reviews Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $review->product_id }}</td>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->user->email }}</td>
                        <td>{{ $review->rating }}/5</td>
                        <td>{{ Str::limit($review->review, 50) }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No reviews found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
