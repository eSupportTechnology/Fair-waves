@extends('AdminDashboard.master')

@section('content')

<style>
    .btn-view {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }
    .btn-view:hover {
        background-color: #138496;
        border-color: #117a8b;
        color: white;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .card-header h4 {
        margin-bottom: 0;
        font-size: 1.1rem;
        font-weight: 600;
    }
</style>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Edit Dealer</h2>
    </div>
    <div>
        <a href="{{ route('dealers') }}" class="btn btn-light rounded font-md">
            <i class="fas fa-arrow-left"></i> Back to Dealers
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h4>Dealer Information</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('dealer.update', $dealer->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $dealer->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $dealer->email) }}" required>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $dealer->phone) }}">
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $dealer->address) }}">
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" name="fname" id="fname" class="form-control @error('fname') is-invalid @enderror" value="{{ old('fname', $dealer->fname) }}">
                    @error('fname')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control @error('lname') is-invalid @enderror" value="{{ old('lname', $dealer->lname) }}">
                    @error('lname')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob', $dealer->dob) }}">
                    @error('dob')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $dealer->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $dealer->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $dealer->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                @if($dealer->dealerProfile)
                <div class="col-md-6 mb-3">
                    <label class="form-label">Dealer Code</label>
                    <input type="text" class="form-control" value="{{ $dealer->dealerProfile->dealer_code }}" disabled readonly>
                </div>
                @endif

                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Change Password (Optional)</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                    <small class="form-text text-muted">Leave blank to keep the current password</small>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('dealers') }}" class="btn btn-light me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Dealer</button>
            </div>
        </form>
    </div>
</div>

@endsection
