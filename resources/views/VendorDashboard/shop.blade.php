@extends('VendorDashboard.Vendormaster')

@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Shop Details</h2>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-brand-2" style="height: 150px"></div>
    <form id="generalSection" method="POST" action="{{ route('vendor.shop.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-xl col-lg flex-grow-0" style="flex-basis: 230px">
                <div class="img-thumbnail shadow w-100 bg-white position-relative text-center" style="height: 190px; width: 200px; margin-top: -120px">
                    <img id="shop-logo-preview" 
                    src="{{ $shop && $shop->shop_logo ? asset('storage/' . $shop->shop_logo) : asset('path_to_default_image/default-logo.png') }}" 
                    class="center-xy img-fluid" 
                    alt="Logo Brand" />


                    <label for="logo-upload" class="position-absolute bottom-0 end-0 p-2 bg-dark rounded-circle text-white" style="cursor: pointer;">
                        <i class="fas fa-camera"></i>
                    </label>
                    <input id="logo-upload" type="file" name="shop_logo" style="display:none;" accept="image/*" onchange="previewLogo(event)" />
                </div>
            </div>
            <!-- col.// -->

            <div class="col-xl col-lg">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row gx-3">
                            <div class="col-12 mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" 
                                       type="text" 
                                       name="shop_name" 
                                       placeholder="Type here" 
                                       value="{{ $shop->shop_name ?? '' }}" 
                                       required />
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" 
                                          name="shop_description" 
                                          placeholder="Type here" 
                                          required>{{ $shop->shop_description ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
            </form>
        </div>
        <!-- col.// -->
    </div>
    <!-- card-body.// -->
    <hr class="my-4" />
</div>


@endsection

@section('scripts')
<script>
    function previewLogo(event) {
        const logoPreview = document.getElementById('shop-logo-preview');
        const file = event.target.files[0]; 

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                logoPreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            logoPreview.src = "{{ $shop && $shop->shop_logo ? asset('storage/' . $shop->shop_logo) : asset('path_to_default_image/default-logo.png') }}";
        }
    }
</script>
@endsection

