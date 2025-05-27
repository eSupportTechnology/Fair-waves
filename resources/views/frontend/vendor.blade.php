
@extends ('frontend.master')

@section('content')

    

    <!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">All Vendors</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="index.html" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-main-600"> All Vendors </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

    <!-- =============================== Vendor Two Section Start =============================== -->
 <section class="vendor-two py-80">
    <div class="container container-lg">

        <!-- Top Search -->
         <div class="d-flex align-items-center justify-content-between flex-wrap mb-48 gap-16">
             <form action="#" class="input-group w-100 max-w-418">
                 <input type="text" class="form-control common-input rounded-start-3" placeholder="Searching...">
                 <button type="submit" class="input-group-text border-0 bg-main-two-600 rounded-end-3 text-white text-2xl hover-bg-main-two-700 px-24">
                     <i class="ph ph-magnifying-glass"></i>
                 </button>
             </form>
     
             <div class="d-flex align-items-center justify-content-between justify-content-sm-end gap-16 flex-grow-1">
                <div class="text-gray-600 text-md flex-shrink-0">
                    <span class="text-neutral-900 fw-semibold">{{ $totalResults }}</span> Results Found
                </div>

                 <div class="d-flex align-items-center gap-8 d-sm-flex d-none">
                    <button type="button" class="grid-btn text-2xl d-flex w-48 h-48 border border-neutral-100 rounded-8 justify-content-center align-items-center border-main-600 text-white bg-main-600"><i class="ph ph-squares-four"></i></button>
                    <button type="button" class="list-btn text-2xl d-flex w-48 h-48 border border-neutral-100 rounded-8 justify-content-center align-items-center"><i class="ph ph-list-bullets"></i></button>
                 </div>
                 <button type="button" class="w-48 h-48 d-lg-none d-flex flex-center border border-gray-100 rounded-6 text-2xl sidebar-btn">
                    <i class="ph-bold ph-funnel"></i>
                </button>
             </div>
         </div>
        <!-- Top Search End -->



        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="shop-sidebar">
                    <button type="button" class="shop-sidebar__close d-lg-none d-flex w-32 h-32 flex-center border border-gray-100 rounded-circle hover-bg-main-600 position-absolute inset-inline-end-0 me-10 mt-8 hover-text-white hover-border-main-600">
                        <i class="ph ph-x"></i>
                    </button>
                    <div class="d-flex flex-column gap-12 px-lg-0 px-3 py-lg-0 py-4">
                        <div class="border border-gray-50 rounded-8 p-24">
                            <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Filter by Location</h6>
                            <form action="{{ route('frontend.vendor') }}" method="GET">
                                <div class="d-flex flex-column gap-8">
                                    <input type="text" class="common-input" name="location" placeholder="Location" value="{{ request('location') }}">
                                </div>
                                <button type="submit" class="btn bg-main-600 text-white mt-8">Filter</button>
                            </form>
                        </div>

                        <div class="shop-sidebar__box border border-gray-100 rounded-8 p-32 mb-32">
                            <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Filter by Rating</h6>
                            <div class="flex-align gap-8 position-relative mb-20">
                                <label class="position-absolute w-100 h-100 cursor-pointer" for="rating5"> </label>
                                <div class="common-check common-radio mb-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rating5">
                                </div>
                                <div class="progress w-100 bg-gray-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main-600 rounded-pill" style="width: 70%"></div>
                                </div>
                                <div class="flex-align gap-4">
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                </div>
                                <span class="text-gray-900 flex-shrink-0">124</span>
                            </div>
                            <div class="flex-align gap-8 position-relative mb-20">
                                <label class="position-absolute w-100 h-100 cursor-pointer" for="rating4"> </label>
                                <div class="common-check common-radio mb-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rating4">
                                </div>
                                <div class="progress w-100 bg-gray-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main-600 rounded-pill" style="width: 50%"></div>
                                </div>
                                <div class="flex-align gap-4">
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                </div>
                                <span class="text-gray-900 flex-shrink-0">52</span>
                            </div>
                            <div class="flex-align gap-8 position-relative mb-20">
                                <label class="position-absolute w-100 h-100 cursor-pointer" for="rating3"> </label>
                                <div class="common-check common-radio mb-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rating3">
                                </div>
                                <div class="progress w-100 bg-gray-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main-600 rounded-pill" style="width: 35%"></div>
                                </div>
                                <div class="flex-align gap-4">
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                </div>
                                <span class="text-gray-900 flex-shrink-0">12</span>
                            </div>
                            <div class="flex-align gap-8 position-relative mb-20">
                                <label class="position-absolute w-100 h-100 cursor-pointer" for="rating2"> </label>
                                <div class="common-check common-radio mb-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rating2">
                                </div>
                                <div class="progress w-100 bg-gray-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main-600 rounded-pill" style="width: 20%"></div>
                                </div>
                                <div class="flex-align gap-4">
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                </div>
                                <span class="text-gray-900 flex-shrink-0">5</span>
                            </div>
                            <div class="flex-align gap-8 position-relative mb-0">
                                <label class="position-absolute w-100 h-100 cursor-pointer" for="rating1"> </label>
                                <div class="common-check common-radio mb-0">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="rating1">
                                </div>
                                <div class="progress w-100 bg-gray-100 rounded-pill h-8" role="progressbar" aria-label="Basic example" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main-600 rounded-pill" style="width: 5%"></div>
                                </div>
                                <div class="flex-align gap-4">
                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-medium text-gray-400 d-flex"><i class="ph-fill ph-star"></i></span>
                                </div>
                                <span class="text-gray-900 flex-shrink-0">2</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
             <!-- Vendors Start -->
                <div class="list-grid-wrapper vendors-two-item-wrapper grid-cols-3">
                    @foreach ($vendors as $vendor)
                        <!-- Check if the vendor has an associated shop -->
                        @if ($vendor->shop)
                            <div class="vendors-two-item rounded-12 overflow-hidden bg-color-three border border-neutral-50 hover-border-main-two-600 transition-2">
                                <div class="vendors-two-item__top bg-overlay style-two position-relative">
                                    <div class="vendors-two-item__thumbs h-210">
                                        <!-- Check if the shop has a logo -->
                                        @if ($vendor->shop->shop_logo)
                                            <img src="{{ asset('storage/' . $vendor->shop->shop_logo) }}" alt="" class="cover-img">
                                        @else
                                            <img src="assets/images/default-shop-logo.png" alt="Default Logo" class="cover-img">
                                        @endif
                                    </div>
                                    <div class="position-absolute top-0 inset-inline-start-0 w-100 h-100 p-24 z-1 d-flex flex-column justify-content-between">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="w-80 h-80 flex-center bg-white rounded-circle flex-shrink-0">
                                            @if ($vendor->shop->shop_logo)
                                                <img src="{{ asset('storage/' . $vendor->shop->shop_logo) }}" alt="" class="cover-img rounded-circle ">
                                            @else
                                                <img src="assets/images/default-shop-logo.png" alt="Default Logo" class="cover-img rounded-circle ">
                                            @endif
                                            </span>
                                        </div>
                                        <div class="mt-16">
                                            <h6 class="text-white fw-semibold mb-12">
                                                <a href="{{ route('frontend.vendor.details', $vendor->id) }}" class="">{{ $vendor->shop->shop_name }}</a>
                                            </h6>
                                            <div class="flex-align gap-6">
                                                <div class="flex-align gap-8">
                                                    <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                    <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                    <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                    <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                    <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                </div>
                                                <span class="text-xs fw-medium text-white">4.8</span>
                                                <span class="text-xs fw-medium text-white">(12K)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vendors-two-item__content p-24 flex-grow-1">
                                    <div class="d-flex flex-column gap-14">
                                        <div class="flex-align gap-8">
                                            <span class="flex-center text-main-two-600 text-2xl flex-shrink-0">
                                                <i class="ph ph-map-pin-line"></i>
                                            </span>
                                            <p class="text-md text-gray-900">{{ $vendor->address }}</p>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="flex-center text-main-two-600 text-2xl flex-shrink-0">
                                                <i class="ph ph-envelope-simple"></i>
                                            </span>
                                            <a href="mailto:{{ $vendor->email }}" class="text-md text-gray-900 hover-text-main-60">{{ $vendor->email }}</a>
                                        </div>
                                        <div class="flex-align gap-8">
                                            <span class="flex-center text-main-two-600 text-2xl flex-shrink-0">
                                                <i class="ph ph-phone"></i>
                                            </span>
                                            <a href="tel:{{ $vendor->phone }}" class="text-md text-gray-900 hover-text-main-60">{{ $vendor->phone }}</a>
                                        </div>
                                    </div>
                                    <a href="{{ route('frontend.vendor.details', $vendor->id) }}" class="btn bg-neutral-600 hover-bg-neutral-700 text-white py-12 px-24 rounded-8 flex-center gap-8 fw-medium mt-24">
                                        Visit Store
                                        <span class="text-xl d-flex text-main-two-600"> <i class="ph ph-storefront"></i></span>
                                    </a>

                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Vendors End -->



                
                <!-- Pagination Start -->
                <ul class="pagination flex-center flex-wrap gap-16">
                    <!-- Previous page button -->
                    <li class="page-item">
                        <a class="page-link h-44 w-44 flex-center text-xxl rounded-8 fw-medium text-neutral-600 border border-gray-100" href="{{ $vendors->previousPageUrl() }}">
                            <i class="ph-bold ph-arrow-left"></i>
                        </a>
                    </li>
                    
                    <!-- Page numbers -->
                    @foreach ($vendors->getUrlRange(1, $vendors->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $vendors->currentPage() ? 'active' : '' }}">
                            <a class="page-link h-44 w-44 flex-center text-md rounded-8 fw-medium text-neutral-600 border border-gray-100" href="{{ $url }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                        </li>
                    @endforeach

                    <!-- Next page button -->
                    <li class="page-item">
                        <a class="page-link h-44 w-44 flex-center text-xxl rounded-8 fw-medium text-neutral-600 border border-gray-100" href="{{ $vendors->nextPageUrl() }}">
                            <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- Pagination End -->

            </div>
        </div>
    </div>
 </section>
<!-- =============================== Vendor Two Section End =============================== -->

   
  
@endsection
