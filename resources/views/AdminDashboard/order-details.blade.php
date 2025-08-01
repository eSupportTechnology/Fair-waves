@extends('AdminDashboard.master')

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Order Details</h2>
        </div>
    </div>

    <div class="card">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="material-icons md-check_circle"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <i class="material-icons md-error"></i>
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <header class="card-header">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                    <span> <i class="material-icons md-calendar_today"></i>
                        <b>{{ \Carbon\Carbon::parse($order->created_at)->format('D, M d, Y, h:i A') }}</b> </span> <br />
                    <a href="#" class="fw-bold">Order ID: #{{ $order->order_code }}</a>
                </div>
                <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                    <form action="{{ route('order.updateStatus', $order->order_code) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select d-inline-block mb-lg-0 mr-5 mw-200">
                            <option selected disabled>{{ $order->status }}</option>
                            @php
                                $validTransitions = [
                                    'Pending' => ['Accepted'],
                                    'Accepted' => ['Packed'],
                                    'Packed' => ['Pickup Done'],
                                    'Pickup Done' => ['Ready to Ship'],
                                    'Ready to Ship' => ['Shipped'],
                                    'Shipped' => ['In Transit'],
                                    'In Transit' => ['Delivered', 'Customer Unavailable', 'Rescheduled'],
                                    'Customer Unavailable' => ['Rescheduled', 'In Transit'],
                                    'Rescheduled' => ['In Transit'],
                                    'Delivered' => [],
                                    'Cancelled' => [],
                                    'Returned' => [],
                                ];
                                $nextStatuses = $validTransitions[$order->status] ?? [];
                            @endphp

                            @foreach ($nextStatuses as $next)
                                <option value="{{ $next }}">{{ $next }}</option>
                            @endforeach

                            @if (!in_array($order->status, ['Cancelled', 'Returned']))
                                <option value="Cancelled">Cancelled</option>
                                <option value="Returned">Returned</option>
                            @endif

                        </select>

                        @if ($order->status === 'Ready to Ship')
                            <div class="mt-2">
                                <input type="text" name="tracking_number" class="form-control mb-2"
                                    placeholder="Tracking Number"
                                    value="{{ old('tracking_number', $order->tracking_number ?? '') }}" required>

                                <input type="url" name="tracking_link" class="form-control"
                                    placeholder="Tracking Link (optional)"
                                    value="{{ old('tracking_link', $order->tracking_link ?? '') }}">
                            </div>
                        @elseif (!empty($order->tracking_number) || !empty($order->tracking_link))
                            <div class="mt-2">
                                <input type="text" class="form-control mb-2" 
                                    value="{{ $order->tracking_number }}" 
                                    placeholder="Tracking Number" 
                                    readonly>
                                <input type="url" class="form-control" 
                                    value="{{ $order->tracking_link }}" 
                                    placeholder="Tracking Link" 
                                    readonly>
                            </div>
                        @endif


                        <button type="submit" class="btn btn-primary p-2">Update</button>
                    </form>
                    <a class="btn btn-secondary print ms-2" href="#"><i class="icon material-icons md-print"></i></a>
                    
                    {{-- Show Cancel Request button only when coming from email link --}}
                    @if(request()->has('return_request_id'))
                        @php
                            $returnRequest = \App\Models\ReturnRequest::find(request('return_request_id'));
                        @endphp
                        @if($returnRequest && $returnRequest->status === 'pending')
                            <button type="button" class="btn btn-warning ms-2" data-bs-toggle="modal" data-bs-target="#returnRequestModal">
                                <i class="icon material-icons md-cancel"></i> 
                                {{ ucfirst($returnRequest->request_type) }} Request
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </header>
        <div class="card-body">
            <!-- Customer, Shipping, and Billing Details -->
            <div class="row mb-50 mt-20 order-info-wrap">
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Customer</h6>
                            <p class="mb-1">
                                {{ $order->customer_name }} <br />
                                {{ $order->email }} <br />
                                {{ $order->phone }}
                            </p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-local_shipping"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Shipping Details</h6>
                            <p class="mb-1">
                                Address: {{ $order->house_no }}, {{ $order->apartment }}<br />
                                City: {{ $order->city }} <br />
                                Postal code: {{ $order->postal_code }} <br />
                            </p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-place"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Billing Details </h6>
                            <p class="mb-1">
                                Pay method: {{ $order->payment_method }} <br />
                                Amount charged: Rs {{ $order->total_cost }} <br />
                                Payment Status: {{ $order->payment_status }}
                            </p>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Product Details -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="50%">Product</th>
                                    <th width="20%">Unit Price</th>
                                    <th width="5%">Quantity</th>
                                    <th width="20%" class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>
                                            <a class="itemside" href="#">
                                                <div class="left">
                                                    @if ($item->product->images->isNotEmpty())
                                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                                            width="40" height="40" class="img-xs" alt="Item" />
                                                    @else
                                                        <img src="{{ asset('path/to/default-image.jpg') }}" width="40"
                                                            height="40" class="img-xs" alt="Default Image" />
                                                    @endif
                                                </div>
                                                <div>{{ $item->product->product_name }}</div>
                                            </a>
                                        </td>
                                        <td>Rs {{ $item->product->normal_price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="text-end">Rs {{ $item->product->normal_price * $item->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Order Summary Card -->
                <div class="col-lg-4">
                    <div class="card shadow-sm bg-light">
                        <div class="card-body">
                            <h6 class="mb-3">Order Summary</h6>
                            <dl class="dlist">
                                <dt>Subtotal:</dt>
                                <dd>Rs {{ number_format($order->total_cost - 300, 2) }}</dd>
                            </dl>
                            <dl class="dlist">
                                <dt>Delivery Fee:</dt>
                                <dd>Rs 300.00</dd>
                            </dl>
                            <dl class="dlist">
                                <dt class="h5">Total:</dt>
                                <dd><b class="h5">Rs {{ number_format($order->total_cost, 2) }}</b></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="progress-container mt-4">
        <h5>Order Progress</h5>
        <div class="progress-wrapper">
            @php
                $statuses = [
                    'Pending' => 'Order Placed',
                    'Accepted' => 'Order Accepted',
                    'Packed' => 'Order Packed',
                    'Pickup Done' => 'Order Picked Up',
                    'Ready to Ship' => 'Ready to Ship',
                    'Shipped' => 'Shipped',
                    'In Transit' => 'In Transit',
                    'Customer Unavailable' => 'Customer Unavailable',
                    'Rescheduled' => 'Rescheduled',
                    'Delivered' => 'Delivered',
                    'Cancelled' => 'Cancelled',
                    'Returned' => 'Returned',
                ];

                $currentStatusIndex = array_search($order->status, array_keys($statuses));
            @endphp

            <ul class="progress-timeline">
                @foreach ($statuses as $key => $label)
                    <li class="{{ $currentStatusIndex >= array_search($key, array_keys($statuses)) ? 'completed' : '' }}">
                        <div class="step-circle">{{ $loop->index + 1 }}</div>
                        <span class="step-label">{{ $label }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>


    <style>
        .progress-container {
            margin-top: 30px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .progress-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            padding-top: 20px;
        }

        .progress-timeline {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            justify-content: space-between;
            position: relative;
        }

        .progress-timeline::before {
            content: '';
            position: absolute;
            top: 30%;
            left: 5%;
            width: 92%;
            height: 4px;
            background: #ddd;
            z-index: 0;
        }

        .progress-timeline li {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #ddd;
            color: white;
            line-height: 30px;
            font-size: 14px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .step-circle.completed {
            background: #4caf50;
        }

        .step-label {
            margin-top: 10px;
            font-size: 14px;
        }

        li.completed .step-circle {
            background-color: #4caf50;
            color: white;
        }
    </style>

    {{-- Return Request Modal --}}
    @if(request()->has('return_request_id'))
        @php
            $returnRequest = \App\Models\ReturnRequest::find(request('return_request_id'));
        @endphp
        @if($returnRequest)
            <!-- Return Request Modal -->
            <div class="modal fade" id="returnRequestModal" tabindex="-1" aria-labelledby="returnRequestModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="returnRequestModalLabel">
                                <i class="material-icons md-info"></i>
                                {{ ucfirst($returnRequest->request_type) }} Request Details
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary">Request Information</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Request Type:</strong></td>
                                            <td>
                                                <span class="badge {{ $returnRequest->request_type === 'cancel' ? 'bg-warning' : 'bg-info' }}">
                                                    {{ ucfirst($returnRequest->request_type) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                @php
                                                    $statusDisplay = $returnRequest->status === 'confirmed' ? 'Confirmed' : ucfirst($returnRequest->status);
                                                    $badgeClass = match($returnRequest->status) {
                                                        'pending' => 'bg-warning',
                                                        'confirmed' => 'bg-success',
                                                        'rejected' => 'bg-danger',
                                                        default => 'bg-secondary'
                                                    };
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">{{ $statusDisplay }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Submitted Date:</strong></td>
                                            <td>{{ $returnRequest->created_at->format('F j, Y \a\t g:i A') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Order Date:</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($returnRequest->order_date)->format('F j, Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-primary">Customer Information</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Name:</strong></td>
                                            <td>{{ $returnRequest->customer_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td>{{ $returnRequest->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone:</strong></td>
                                            <td>{{ $returnRequest->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Order Code:</strong></td>
                                            <td><strong class="text-primary">{{ $returnRequest->order_code }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h6 class="text-primary">
                                        {{ $returnRequest->request_type === 'cancel' ? 'Reason for Cancellation:' : 'Reason for Return:' }}
                                    </h6>
                                    <div class="alert alert-light">
                                        <p class="mb-0">{{ $returnRequest->cancel_reason }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($returnRequest->status === 'pending')
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h6 class="text-primary">Admin Response (Optional)</h6>
                                        <div class="form-group">
                                            <textarea id="adminResponse" class="form-control" rows="3" 
                                                placeholder="Add any comments or notes for this decision..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        @if($returnRequest->status === 'pending')
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" onclick="processReturnRequest('reject', {{ $returnRequest->id }})">
                                    <i class="material-icons md-close"></i> Reject Request
                                </button>
                                <button type="button" class="btn btn-success" onclick="processReturnRequest('approve', {{ $returnRequest->id }})">
                                    <i class="material-icons md-check"></i> 
                                    Confirm {{ ucfirst($returnRequest->request_type) }}
                                </button>
                            </div>
                        @else
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <div class="alert alert-info mb-0">
                                    @php
                                        $statusMessage = $returnRequest->status === 'confirmed' 
                                            ? 'confirmed' 
                                            : $returnRequest->status;
                                    @endphp
                                    This request has already been {{ $statusMessage }}.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- JavaScript for handling modal actions --}}
            <script>
                function processReturnRequest(action, requestId) {
                    console.log('Processing return request:', action, requestId);
                    
                    const adminResponse = document.getElementById('adminResponse').value;
                    console.log('Admin response:', adminResponse);
                    
                    // If rejecting and no reason provided, ask for one
                    if (action === 'reject' && !adminResponse.trim()) {
                        Swal.fire({
                            title: 'Admin Response Required',
                            text: 'Please provide a reason for rejecting this request.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                        document.getElementById('adminResponse').focus();
                        return;
                    }

                    // Show confirmation dialog with SweetAlert
                    const actionText = action === 'approve' ? 'approve' : 'reject';
                    const confirmMessage = `Are you sure you want to ${actionText} this request?`;
                    
                    Swal.fire({
                        title: 'Confirm Action',
                        text: confirmMessage,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: action === 'approve' ? '#28a745' : '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: `Yes, ${actionText}!`,
                        cancelButtonText: 'Cancel',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return submitRequest(action, requestId, adminResponse);
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show success message and reload page
                            Swal.fire({
                                title: 'Processing...',
                                text: 'Please wait while we process your request.',
                                icon: 'info',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                willOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        }
                    });
                }

                function submitRequest(action, requestId, adminResponse) {
                    return new Promise((resolve, reject) => {
                        console.log('Submitting request - Action:', action, 'ID:', requestId);
                        
                        // Create form and submit using Laravel route helper
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.style.display = 'none';
                        
                        // Use Laravel route helper for proper URL generation
                        if (action === 'approve') {
                            form.action = "{{ url('/admin/return-request') }}/" + requestId + "/approve";
                        } else {
                            form.action = "{{ url('/admin/return-request') }}/" + requestId + "/reject";  
                        }
                        
                        console.log('Form action URL:', form.action);
                        
                        // Add CSRF token
                        const csrfToken = document.querySelector('meta[name="csrf-token"]');
                        if (!csrfToken) {
                            reject('CSRF token not found. Please refresh the page.');
                            return;
                        }
                        
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken.getAttribute('content');
                        form.appendChild(csrfInput);
                        
                        // Add admin response if provided
                        if (adminResponse && adminResponse.trim()) {
                            const responseInput = document.createElement('input');
                            responseInput.type = 'hidden';
                            responseInput.name = 'admin_response';
                            responseInput.value = adminResponse.trim();
                            form.appendChild(responseInput);
                            console.log('Added admin response:', adminResponse.trim());
                        }
                        
                        console.log('Form elements created, submitting...');
                        
                        // Add form to DOM and submit
                        document.body.appendChild(form);
                        
                        // Add error handling for form submission
                        form.addEventListener('submit', function(e) {
                            console.log('Form submit event triggered');
                        });
                        
                        try {
                            form.submit();
                            console.log('Form submitted successfully');
                            resolve();
                        } catch (error) {
                            console.error('Error submitting form:', error);
                            reject('Error submitting form: ' + error.message);
                        }
                    });
                }

                // Auto-show modal if return_request_id is present in URL
                document.addEventListener('DOMContentLoaded', function() {
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('return_request_id')) {
                        console.log('Auto-showing modal for return request:', urlParams.get('return_request_id'));
                        const modal = new bootstrap.Modal(document.getElementById('returnRequestModal'));
                        modal.show();
                    }
                    
                    // Debug: Log current admin session info
                    console.log('Page loaded - debugging info:');
                    console.log('Current URL:', window.location.href);
                    console.log('CSRF token present:', !!document.querySelector('meta[name="csrf-token"]'));
                    console.log('Return request modal:', !!document.getElementById('returnRequestModal'));
                });
            </script>
        @endif
    @endif
@endsection
