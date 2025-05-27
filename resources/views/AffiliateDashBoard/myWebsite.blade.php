@extends ('AffiliateDashBoard.affmaster')

@section('content')



<div class="content-header">
    <div>
        <h2 class="content-title card-title">My Details</h2>
        <p>Manage your website information here</p>
    </div>
</div>

<!-- Display Flash Messages -->
<div class="container pt-4 px-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<div class="container pt-4 px-4">
    <h3 class="py-3">Basic Information</h3>

    <!-- Display Basic Information -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4 mb-2">
                    <h5 class="py-3" style="font-weight: bold;">Basic Information</h5>
                </div>
                <div class="col-md-8 d-flex justify-content-end">
                    <!-- Trigger Modal for Editing Basic Information -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editBasicInfoModal">
                        Edit
                    </button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><strong>Login Email</strong><br>{{ $customer->email }}</td>
                            <td><strong>Password</strong><br>*********</td>
                            <td><strong>Login Phone Number</strong><br>{{ $customer->contactno ?: '-' }}</td>
                            <td><strong>Payee Name</strong><br>{{ $customer->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <h3 class="py-3">Promotion Methods</h3>

    <!-- Promotion Methods Table -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4 mb-2">
                    <h5 class="py-3" style="font-weight: bold;">Promotion Methods</h5>
                </div>
                <div class="col-md-8 d-flex justify-content-end">
                    <!-- Trigger Modal for Editing Promotion Methods -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPromotionMethodsModal">
                        Edit
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><strong>Promotion Methods</strong><br>
                                <ul>
                                    @foreach($customer->promotion_method ?? [] as $method)
                                        <li>{{ $method }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td><strong>Social Media Platform</strong><br>
                                @if($customer->instagram_url)
                                    Instagram: <a href="{{ $customer->instagram_url }}" target="_blank">{{ $customer->instagram_url }}</a><br>
                                @endif
                                @if($customer->facebook_url)
                                    Facebook: <a href="{{ $customer->facebook_url }}" target="_blank">{{ $customer->facebook_url }}</a><br>
                                @endif
                                @if($customer->tiktok_url)
                                    TikTok: <a href="{{ $customer->tiktok_url }}" target="_blank">{{ $customer->tiktok_url }}</a><br>
                                @endif
                                @if($customer->youtube_url)
                                    YouTube: <a href="{{ $customer->youtube_url }}" target="_blank">{{ $customer->youtube_url }}</a><br>
                                @endif
                                @if($customer->content_website_url)
                                    Website: <a href="{{ $customer->content_website_url }}" target="_blank">{{ $customer->content_website_url }}</a><br>
                                @endif
                                @if($customer->content_whatsapp_url)
                                    WhatsApp: <a href="{{ $customer->content_whatsapp_url }}" target="_blank">{{ $customer->content_whatsapp_url }}</a><br>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->

<!-- Modal for Editing Basic Information -->
<div class="modal fade" id="editBasicInfoModal" tabindex="-1" aria-labelledby="editBasicInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBasicInfoModalLabel">Edit Basic Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('affiliate.updateBasicInfo') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="payeename" class="text-secondary">Payee Name</label>
                        <input type="text" id="payeename" name="payeename" class="form-control" value="{{ $customer->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="loginemail" class="text-secondary">Login Email</label>
                        <input type="email" id="loginemail" name="loginemail" class="form-control" value="{{ $customer->email }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="loginphone" class="text-secondary">Login Phone Number</label>
                        <input type="text" id="loginphone" name="loginphone" class="form-control" value="{{ $customer->contactno }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Promotion Methods -->
<div class="modal fade" id="editPromotionMethodsModal" tabindex="-1" aria-labelledby="editPromotionMethodsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPromotionMethodsModalLabel">Edit Promotion Methods</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('affiliate.updateSiteInfo') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="text-secondary mb-2">Promotion Methods</label>
                        @php
                            $promotionMethods = $customer->promotion_method ?? [];
                            $allMethods = ['Instagram', 'Facebook', 'TikTok', 'YouTube', 'Content website/blog', 'WhatsApp'];
                        @endphp
                        @foreach($allMethods as $method)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="promotion_methods[]" 
                                       value="{{ $method }}" 
                                       id="promotion_method_{{ $loop->index }}" 
                                       {{ in_array($method, $promotionMethods) ? 'checked' : '' }}>
                                <label class="form-check-label" for="promotion_method_{{ $loop->index }}">
                                    {{ $method }}
                                </label>
                            </div>
                            <div class="form-group mt-2">
                                <input type="text" class="form-control" 
                                       name="{{ strtolower(str_replace(' ', '_', $method)) . '_url' }}" 
                                       placeholder="Enter {{ $method }} URL"
                                       value="{{ $customer->{strtolower(str_replace(' ', '_', $method)) . '_url'} ?? '' }}"
                                       {{ !in_array($method, $promotionMethods) ? 'disabled' : '' }}>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enable or disable URL input based on checkbox selection
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const urlInput = this.closest('.form-check').nextElementSibling.querySelector('input[type="text"]');
                if (urlInput) {
                    urlInput.disabled = !this.checked;
                }
            });
        });
    });
</script>

@endsection
