@extends('admin.dashboard')
@section('title', 'Profile')

@section('main_content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Profile</h1>

    <div class="row gy-4">
        <!-- Update Profile Information -->
        <div class="col-lg-8 mx-auto mb-3">
            <div class="card shadow-lg border-light rounded-3">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-primary">Update Profile Information</h5>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <!-- Update Password -->
        <div class="col-lg-8 mx-auto  mb-3">
            <div class="card shadow-lg border-light rounded-3">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-primary">Update Password</h5>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Delete User -->
        <div class="col-lg-8 mx-auto  mb-3">
            <div class="card shadow-lg border-light rounded-3">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-danger">Delete User</h5>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
