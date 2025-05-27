@extends('layouts.user_sidebar')

@section('dashboard-content')

<style>
    .text-danger {
        color: #e3342f;
    }

    .btn-primary {
        background-color: #ff3c00 !important;
        border-color: #ff3c00 !important;
    }

    .btn-primary:hover {
        background-color: #e63300 !important;
        border-color: #e63300 !important;
    }

    .form-control:focus, .form-select:focus {
        border-color: hsl(14, 72%, 69%) !important;
        box-shadow: 0 0 0 0.2rem hsla(12, 81%, 40%, 0.251) !important;
    }
</style>

<div class="container p-3">
    <h4 class="px-2 py-2">Change Password</h4>

    <!-- Success and Error Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('user.change_password') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current password" required>
            @error('current_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password" required>
            @error('new_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Retype New Password</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Retype new password" required>
            @error('new_password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="mt-3 btn btn-primary">Change Password</button>
    </form>
</div>
@endsection
