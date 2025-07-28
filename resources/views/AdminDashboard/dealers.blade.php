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

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background-color: #ffca2c;
            border-color: #ffc720;
            color: #212529;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
            color: white;
        }

        .search-container {
            position: relative;
        }

        .search-container .form-control {
            padding-right: 45px;
        }

        .search-container .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
    </style>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dealers</h2>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('dealers.export', request()->query()) }}" class="btn btn-primary rounded font-md">
                <i class="fas fa-file-excel me-2"></i>Export to Excel
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <form method="GET" action="{{ route('dealers') }}">
                <div class="search-container" style="max-width: 800px; margin: 0 auto;">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-lg"
                            placeholder="Search dealers by name, email, or phone..." value="{{ $search ?? '' }}"
                            style="border-radius: 30px 0 0 30px; padding-left: 20px;">
                        <button class="btn btn-primary btn-lg" type="submit"
                            style="border-radius: 0 30px 30px 0; padding: 0 25px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    @if ($search)
                        <div class="mt-2">
                            <a href="{{ route('dealers') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-times"></i> Clear search
                            </a>
                            <span class="ms-2 text-muted">Search results for: <strong>"{{ $search }}"</strong></span>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <header class="card-header">
            <div class="row align-items-center">
                <!-- Removed the date filter form -->
            </div>
        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dealerTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Dealer Code</th>
                                    <th>Registered Date</th>
                                    <th>Total Orders</th>
                                    <th>KYC Status</th>
                                    <th>Bank Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dealers as $index => $dealer)
                                    <tr>
                                        <td>{{ $dealers->firstItem() + $index }}</td>
                                        <td>{{ $dealer->name }}</td>
                                        <td>{{ $dealer->email }}</td>
                                        <td>{{ $dealer->phone }}</td>
                                        <td>{{ $dealer->dealerProfile->dealer_code ?? 'N/A' }}</td>
                                        <td>{{ $dealer->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            {{-- TODO: Uncomment for future development - Total Orders functionality --}}
                                            {{ $dealer->dealer_product_orders_count }}
                                        </td>
                                        <td>
                                            @if ($dealer->kycDetail)
                                                <span
                                                    class="badge bg-{{ $dealer->kycDetail->kyc_status === 'approved' ? 'success' : ($dealer->kycDetail->kyc_status === 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($dealer->kycDetail->kyc_status) }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Not Submitted</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($dealer->bankDetail)
                                                <span
                                                    class="badge bg-{{ $dealer->bankDetail->bank_status === 'approved' ? 'success' : ($dealer->bankDetail->bank_status === 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($dealer->bankDetail->bank_status) }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Not Submitted</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('dealer-details', $dealer->id) }}"
                                                class="btn btn-view btn-sm me-2" data-bs-toggle="tooltip"
                                                title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dealer.edit', $dealer->id) }}"
                                                class="btn btn-warning btn-sm me-2" data-bs-toggle="tooltip"
                                                title="Edit Dealer">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dealer.delete', $dealer->id) }}" method="POST"
                                                class="d-inline" id="delete-form-{{ $dealer->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete('delete-form-{{ $dealer->id }}', 'Are you sure you want to deactivate this dealer?')"
                                                    class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                    title="Deactivate Dealer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- .col// -->
            </div>
            <!-- .row // -->
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->

    <!-- Pagination Area -->
    <div class="pagination-area mt-30 mb-50">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-start">
                {{ $dealers->appends(request()->input())->links() }}
            </ul>
        </nav>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Initialize DataTables but disable the built-in pagination since we're using Laravel's pagination
            $('#dealerTable').DataTable({
                "paging": false,
                "info": false,
                "searching": false, // Disable built-in search since we have custom search
                "responsive": true,
                "order": [
                    [0, 'asc']
                ],
                "columnDefs": [{
                        "orderable": false,
                        "targets": 7
                    } // Disable ordering on action column
                ]
            });
        });
    </script>
@endsection
