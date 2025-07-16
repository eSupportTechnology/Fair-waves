@extends('layouts.user_sidebar')

@section('dashboard-content')
<div class="container">
    <h4 class="mb-4">Orders for {{ $dealerProductLink->product->name }}</h4>

    @if($orders->isEmpty())
        <p class="text-muted">No orders found for this product.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order->order->customer_name }}</td>
                        <td>{{ $order->order->quantity }}</td>
                        <td>₹{{ number_format($order->total_price, 2) }}</td>
                        <td>{{ ucfirst($order->order->order->status) }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="https://track.example.com/order/{{ $order->id }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-external-link-alt"></i> Track
                            </a>
                            <form action="{{ route('dealer.products.orders.delete', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this order?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('dealer.products.dashboard') }}" class="btn btn-outline-primary mt-3">
        <i class="fas fa-arrow-left"></i> Back to Product Links
    </a>
</div>
@endsection
