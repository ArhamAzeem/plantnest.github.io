@extends('admin.dashboard')
@section('title', 'Feedback Details')

@section('main_content')

<div class="container mt-5">
    <h1 class="mb-4">Feedback Details</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">{{ $feedback->name }}</h5>
        </div>
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted">{{ $feedback->email }}</h6>
            <p class="card-text mb-3">{{ $feedback->message }}</p>
            <p class="card-text">
                <small class="text-muted">Submitted on {{ $feedback->created_at->format('d M Y, h:i A') }}</small>
            </p>

            <div class="d-flex justify-content-between">
                <a href="{{ route('feedback.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Feedback List
                </a>
                <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
