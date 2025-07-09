@forelse($productLinks as $link)
        <div class="card mb-3 w-100">
            <div class="card-body">
            <h5>{{ $link->product->product_name }}</h5>
            <p class="mb-1">
                <strong>Affiliate Link:</strong>
                <input type="text" class="form-control d-inline-block w-75" value="{{ url('showroom/'.$link->dealer->dealerProfile->dealer_shop_name.'/product/'.$link->unique_code) }}" id="affiliate-link-{{ $link->id }}" readonly>
                <button class="btn btn-sm btn-outline-secondary text-dark" type="button" onclick="navigator.clipboard.writeText(document.getElementById('affiliate-link-{{ $link->id }}').value)">
                Copy
                </button>
            </p>

            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('dealer.products.orders', $link->id) }}" class="btn btn-sm btn-outline-info text-dark">
                <i class="fas fa-list"></i> View Orders
                </a>
                <form action="{{ route('dealer.products.delete', $link->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger text-dark" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-trash"></i> Delete Link
                </button>
                </form>
            </div>
            </div>
        </div>
    @empty
        <p class="text-muted">You haven't generated any product links yet.</p>
    @endforelse
