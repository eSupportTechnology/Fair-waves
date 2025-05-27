@extends ('VendorDashboard.Vendormaster')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Payments</h2>
    </div>
    
</div>

        <div class="row">
            <!-- Display Total Available Balance -->
            <div class="col-md-6 col-12 mb-4"> 
                <div class="card">
                    <div class="card-body">
                        <p class="mb-3">Total Available Balance</p>
                        @if($vendorWallet)
                        <h3 class="mb-6">Rs {{ number_format($vendorWallet->balance, 2) }}</h3>
                        @else
                        <h3 class="mb-6">RS.00.00</h3>
                        @endif

                    </div>
                </div>
            </div>


            <!-- Withdrawal Box -->
            <div class="col-md-6 col-12 mb-4"> 
                <div class="card">
                    <div class="card-body">
                        <p class="mb-3">Request Payment</p>
                        <p class="mb-2 text-danger">Check your balance; it must be more than LKR 1000 before requesting a payment.</p>
                        <form method="POST" action="{{ route('vendor.paymentRequest') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="number" name="request_amount" id="request_amount" class="form-control" placeholder="Enter Amount" required>
                            </div>
                            <input type="hidden" name="total" value="{{ $totalBalance }}"> 
                            <button type="submit" class="btn btn-primary">Request</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- Payment Requests Table -->
        <div class="card">
            <div class="card-body">
                <div class="tab-pane fade show active" role="tabpanel">
                    <div class="row align-items-center mb-3">
                        <div class="col-md-4 mb-2 d-flex align-items-center">
                            <input type="date" id="date" class="form-control" style="font-size: 0.8rem;">
                        </div>
                    </div>

                    <div class="container mt-4 mb-4">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Account Number</th>
                                        <th scope="col">Requested Payment Amount</th>
                                        <th scope="col">Processing Fee</th>
                                        <th scope="col">Paid Amount</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($paymentRequests as $paymentRequest)
                                        <tr>
                                            <td>{{ $paymentRequest->requested_at->format('Y-m-d H:i:s') }}</td>
                                            <td>{{ $paymentRequest->account_number }}</td>
                                            <td>Rs {{ number_format($paymentRequest->request_amount, 2) }}</td>
                                            <td>Rs {{ number_format($paymentRequest->processing_fee, 2) }}</td>
                                            <td>Rs {{ number_format($paymentRequest->paid_amount, 2) }}</td>
                                            <td>{{ $paymentRequest->status }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No payment requests found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination links -->
                            <div class="d-flex justify-content-center">
                                {{ $paymentRequests->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
 

@endsection
