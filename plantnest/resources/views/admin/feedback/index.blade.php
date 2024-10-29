@extends('admin.dashboard')
@section('title', 'Feedbacks')

@section('main_content')
<div class="container mt-5">
    <h1 class="mb-4">Feedback Messages</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Feedback List</h5>
        </div>
        <div class="card-body">
            @if($feedbacks->isEmpty())
                <p>No feedback messages found.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->name }}</td>
                                <td>{{ $feedback->email }}</td>
                                <td>{{ Str::limit($feedback->message, 50) }}</td>
                                <td>{{ $feedback->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    <a href="{{ route('feedback.show', $feedback->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="View Feedback">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Feedback">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
@endsection
@endsection
