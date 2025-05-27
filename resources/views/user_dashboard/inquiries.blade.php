@extends('layouts.user_sidebar')

@section('dashboard-content')

<style>
.list-group-item {
    border: 1px solid #e0e0e0;
    border-radius: 5px; 
}

.list-group-item h6 {
    color: hsl(357, 100%, 50%); 
}

.list-group-item p {
    margin-bottom: 0.5rem; 
}

.list-group-item small {
    font-style: italic; 
}
</style>

<h4 class="px-2 py-2">Customer Inquiries</h4>
<div class="container p-4">
    <div class="list-group">
        <!-- Example Inquiry Item -->
        <div class="mb-3 list-group-item position-relative">
            <button type="button" class="top-0 p-3 btn-close position-absolute end-0" style="font-size:12px;" aria-label="Close"></button>
            <h6 style="color: black; font-size: 17px;" class="mb-1">Subject of Inquiry</h6>
            <p class="mb-1"><strong>Message:</strong> This is a sample inquiry message from the customer.</p>
            <small class="text-muted">Date: 2024-11-13</small>
            <hr>
            <h6 class="mt-2" style="font-size: 17px;">Admin Response:</h6>
            <p>No response yet.</p>
            <small class="text-muted">Date of Response: 2024/11/13</small>
        </div>
        <!-- No Inquiries Available -->
        <div class="mb-3 list-group-item">
            <p class="text-center">No inquiries available.</p>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-close').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.list-group-item').remove(); 
        });
    });
</script>
@endsection




