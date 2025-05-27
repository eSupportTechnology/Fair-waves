@extends ('AffiliateDashBoard.affmaster')

@section('content')

<!-- Display Success Message -->
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Display Error Message -->
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Display Validation Errors -->
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="content-header">
    <div>
        <h2 class="content-title card-title">Payment Information</h2>
        <p>Manage your bank account details for withdrawals</p>
    </div>
    
</div>

<div class="container pt-10 px-4 ">
    <div class="card pt-15 pl-20 pb-20 pr-20 text-center">
        <div class="section">
            @if($customer && $customer->account_number)
                <!-- Show Payment Details -->
                <h3>Bank Account Details</h3>
                <p>Bank Name: {{ $customer->bank_name }}</p>
                <p>Branch: {{ $customer->branch }}</p>
                <p>Account Holder Name: {{ $customer->account_name }}</p>
                <p>Account Number: {{ $customer->account_number }}</p>
            @else
                <!-- No Payment Information -->
                <h3>Bank Account Not Linked</h3>
                <p>You have not linked any bank account.</p>
            @endif
        </div>

        <div style="display: flex; justify-content: center; margin-top: 20px;">
            <a href="{{ route('bank_acc') }}" class="btn btn-primary">Update Bank Account</a>
        </div>
    </div>
</div>
@endsection
