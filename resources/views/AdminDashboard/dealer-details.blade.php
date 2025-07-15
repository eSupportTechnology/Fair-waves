@extends ('AdminDashboard.master')

@section('content')

<style>
    .card {
        margin-bottom: 20px;
        padding: 15px;
    }

    .card-title {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .order-cards-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .details-cards-row {
        display: flex;
        justify-content: space-between;
    }

    .details-cards-row .item-details-card {
        width: 100%;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .card-name{
      font-size: 14px;
      font-weight: 500;
    }

    .icon-container {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 55px; 
    height: 55px; 
    border-radius: 50%; 
    margin-right: 15px;
    }

    .icon-container i {
        font-size: 22px; 
    }

    .badge-soft-success {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    
    .badge-soft-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .badge-soft-primary {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }

    .badge-soft-info {
        background-color: rgba(13, 202, 240, 0.1);
        color: #0dcaf0;
    }

    .profile-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .profile-image-container {
        position: relative;
        display: inline-block;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-body {
        padding: 20px;
    }

    .profile-info-item {
        margin-bottom: 15px;
    }

    .profile-info-label {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .profile-info-value {
        font-size: 16px;
    }

    .dealer-card {
        background-color: #e8f4fc;
        border-left: 4px solid #0d6efd;
    }
</style>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Dealer Details</h2>
        <p>Complete dealer information</p>
    </div>
    <div>
        <a href="{{ route('dealers') }}" class="btn btn-light rounded font-md">
            <i class="fas fa-arrow-left"></i> Back to Dealers
        </a>
        <a href="{{ route('dealer.edit', $dealer->id) }}" class="btn btn-primary rounded font-md">
            <i class="fas fa-edit"></i> Edit Dealer
        </a>
    </div>
</div>

<div class="row">
    <!-- Dealer Profile Information -->
    <div class="col-md-4">
        <div class="card profile-card">
            <div class="profile-header text-center">
                <div class="profile-image-container">
                    <img src="{{ $dealer->profile_image_url }}" alt="Profile Image" class="profile-image">
                </div>
                <h4 class="mt-3">{{ $dealer->name }}</h4>
                <p class="text-muted mb-0">{{ $dealer->email }}</p>
                <span class="badge {{ $dealer->dealer_status == 1 ? 'badge-soft-success' : 'badge-soft-danger' }} px-3 py-2 mt-2">
                    {{ $dealer->dealer_status == 1 ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="profile-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Phone</div>
                            <div class="profile-info-value">{{ $dealer->phone ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Address</div>
                            <div class="profile-info-value">{{ $dealer->address ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Gender</div>
                            <div class="profile-info-value">{{ $dealer->gender ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Date of Birth</div>
                            <div class="profile-info-value">
                                {{ $dealer->dob ? \Carbon\Carbon::parse($dealer->dob)->format('F d, Y') : 'N/A' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Registered On</div>
                            <div class="profile-info-value">
                                {{ $dealer->created_at->format('F d, Y') }}
                            </div>
                        </div>
                    </div>
                    @if($dealer->dealerProfile)
                    <div class="col-md-12">
                        <div class="profile-info-item">
                            <div class="profile-info-label">Dealer Code</div>
                            <div class="profile-info-value fw-bold">
                                {{ $dealer->dealerProfile->dealer_code }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards and Orders -->
    <div class="col-md-8">
        <!-- Summary Cards -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <div class="icon-container bg-primary-light">
                            <i class="fas fa-shopping-bag text-primary"></i>
                        </div>
                        <div>
                            <h6 class="card-name">Total Orders</h6>
                            <h3 class="mb-0">{{ $totalOrders }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <div class="icon-container bg-success-light">
                            <i class="fas fa-dollar-sign text-success"></i>
                        </div>
                        <div>
                            <h6 class="card-name">Total Spent</h6>
                            <h3 class="mb-0">${{ number_format($totalCost, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="d-flex align-items-center">
                        <div class="icon-container bg-info-light">
                            <i class="fas fa-box text-info"></i>
                        </div>
                        <div>
                            <h6 class="card-name">Total Products</h6>
                            <h3 class="mb-0">{{ $totalProducts }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Referrals Section -->
        @if(count($referrals) > 0)
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Referrals</h5>
                <p class="mb-0">People referred by this dealer</p>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date Referred</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($referrals as $index => $referral)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $referral->referredUser->name ?? 'N/A' }}</td>
                                <td>{{ $referral->referredUser->email ?? 'N/A' }}</td>
                                <td>{{ $referral->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if($referral->referredUser && $referral->referredUser->role == 'customer')
                                        <span class="badge badge-soft-info">Customer</span>
                                    @else
                                        <span class="badge badge-soft-primary">Dealer</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Orders Section -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Recent Orders</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>${{ number_format($order->total_cost, 2) }}</td>
                                <td>
                                    @php
                                        $statusClass = 'badge-soft-info';
                                        if($order->status == 'completed') $statusClass = 'badge-soft-success';
                                        if($order->status == 'processing') $statusClass = 'badge-soft-primary';
                                        if($order->status == 'cancelled') $statusClass = 'badge-soft-danger';
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('order-details', $order->order_code) }}" class="btn btn-sm btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No orders found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
