@extends('AdminDashboard.master')

@section('content')
<div class="content-header mb-4">
    <div>
        <h2 class="content-title card-title">Approved Withdrawal Requests</h2>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header pb-0">
        <form method="GET" action="{{ route('admin.withdrawals.approved') }}" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Search by name, email, or phone">
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i> Search
                </button>
            </div>
        </form>
    </div>

    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Dealer</th>
                        <th>Amount</th>
                        <th>BV</th>
                        <th>Requested At</th>
                        <th>Status</th>
                        <th>Live View</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($withdrawals as $index => $withdrawal)
                        <tr>
                            <td>{{ $loop->iteration + ($withdrawals->currentPage() - 1) * $withdrawals->perPage() }}</td>
                            <td>
                                <strong>{{ $withdrawal->dealer->name ?? 'N/A' }}</strong><br>
                                <small>{{ $withdrawal->dealer->email ?? '' }}</small>
                            </td>
                            <td>Rs. {{ number_format($withdrawal->amount, 2) }}</td>
                            <td>{{ number_format($withdrawal->bv, 2) }}</td>
                            <td>{{ $withdrawal->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <span class="badge bg-success">Approved</span>
                            </td>
                            <td>
                                @if($withdrawal->bankDetail)
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#bankModal{{ $withdrawal->id }}">
                                        Live View
                                    </button>
                                @else
                                    <span class="text-muted">No Details</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No approved withdrawal requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $withdrawals->links() }}
        </div>
    </div>
</div>

<!-- Modals -->
@include('AdminDashboard.withdraw.partials.bank_modals', ['withdrawals' => $withdrawals])
@endsection
