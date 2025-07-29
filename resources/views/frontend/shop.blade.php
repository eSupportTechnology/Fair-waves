@extends('frontend.master')

@section('content')

<style>
.product-description {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
@media (max-width: 990px) {
  .hide-on-tiny {
    display: none !important;
  }
}

</style>

<!-- ========================= Breadcrumb Start =============================== -->
<div class="mb-0 breadcrumb py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="flex-wrap gap-16 breadcrumb-wrapper flex-between">
            <h6 class="mb-0">
                @if(isset($selectedBrand))
                    {{ $selectedBrand->name }} Products
                @else
                    Shop
                @endif
            </h6>
            <ul class="flex-wrap gap-8 flex-align">
                <li class="text-sm">
                    <a href="/" class="gap-8 text-gray-900 flex-align hover-text-main-600">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                @if(isset($selectedBrand))
                    <li class="text-sm">
                        <a href="{{ route('shop.index') }}" class="text-gray-500 hover-text-main-600">Shop</a>
                    </li>
                    <li class="flex-align">
                        <i class="ph ph-caret-right"></i>
                    </li>
                    <li class="text-sm text-main-600">{{ $selectedBrand->name }}</li>
                @else
                    <li class="text-sm text-main-600"> Product Shop </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- =============================== Shop Section Start ======================================== -->
<section class="shop py-80">
    <div class="container container-lg">
        @if(isset($selectedBrand))
            <!-- Brand Selection Header -->
            <div class="mb-32 alert alert-info d-flex align-items-center">
                <div class="flex-grow-1">
                    <h5 class="mb-2">
                        <i class="ph ph-funnel me-2"></i>
                        Showing products from: <strong>{{ $selectedBrand->name }}</strong>
                    </h5>
                    <p class="mb-0 text-muted">
                        Found {{ $products->total() }} products from {{ $selectedBrand->name }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="ph ph-x me-1"></i>
                        Clear Brand Filter
                    </a>
                </div>
            </div>
        @endif
        
        <div class="row">

            <!-- Sidebar Start -->
            <div class="col-lg-3 hide-on-tiny" >
                <div class="shop-sidebar">
                    <div class="p-32 mb-32 border border-gray-100 shop-sidebar__box rounded-8">
                        <h6 class="pb-24 mb-24 text-xl border-gray-100 border-bottom">Product Category</h6>
                        <form id="categoryFilterForm" action="{{ route('shop.index') }}" method="GET">
                            <!-- Preserve other filters -->
                            @if(request('min_price'))
                                <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                            @endif
                            @if(request('max_price'))
                                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                            @endif
                            @if(request('subcategory_id'))
                                <input type="hidden" name="subcategory_id" value="{{ request('subcategory_id') }}">
                            @endif
                            @if(request('subsubcategory_id'))
                                <input type="hidden" name="subsubcategory_id" value="{{ request('subsubcategory_id') }}">
                            @endif
                            @if(request('color'))
                                <input type="hidden" name="color" value="{{ request('color') }}">
                            @endif
                            @if(request('rating'))
                                <input type="hidden" name="rating" value="{{ request('rating') }}">
                            @endif

                            <ul class="overflow-y-auto max-h-540 scroll-sm">
                                <li class="mb-24 d-flex align-items-center">
                                    <input type="checkbox" id="all_categories" class="category-checkbox me-2"
                                           onchange="handleAllCategoriesChange(this)"
                                           {{ (!isset($categoryIds) || empty($categoryIds)) || (isset($allCategoriesSelected) && $allCategoriesSelected) ? 'checked' : '' }}>
                                    <label for="all_categories" class="text-gray-900 hover-text-main-600 {{ (!isset($categoryIds) || empty($categoryIds)) || (isset($allCategoriesSelected) && $allCategoriesSelected) ? 'font-bold' : '' }} mb-0 cursor-pointer">
                                        All Categories
                                    </label>
                                    <a href="{{ route('shop.index') }}" class="ms-2 text-gray-500 hover-text-main-600 text-decoration-none">
                                        <i class="ph ph-arrow-square-out"></i>
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li class="mb-24 d-flex align-items-center">
                                        <input type="checkbox" id="category_{{ $category->id }}"
                                               name="category_ids[]" value="{{ $category->id }}"
                                               class="category-checkbox me-2"
                                               onchange="handleCategoryChange()"
                                               {{ isset($categoryIds) && in_array($category->id, $categoryIds) ? 'checked' : '' }}>
                                        <label for="category_{{ $category->id }}" class="text-gray-900 hover-text-main-600 {{ isset($categoryIds) && in_array($category->id, $categoryIds) ? 'font-bold' : '' }} mb-0 cursor-pointer flex-grow-1">
                                            {{ $category->name }} ({{ $category->products_count }})
                                        </label>
                                        <a href="{{ route('shop.index', ['category_id' => $category->id]) }}"
                                           class="ms-2 text-gray-500 hover-text-main-600 text-decoration-none">
                                            <i class="ph ph-arrow-square-out"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>

                    <!-- Brands Filter Section -->
                    <div class="p-32 mb-32 border border-gray-100 shop-sidebar__box rounded-8">
                        <h6 class="pb-24 mb-24 text-xl border-gray-100 border-bottom">Brands</h6>
                        @if(isset($selectedBrand))
                            <div class="mb-3 alert alert-info">
                                <small><i class="ph ph-info me-1"></i>Filtering by: <strong>{{ $selectedBrand->name }}</strong></small>
                            </div>
                        @endif
                        <form id="brandFilterForm" action="{{ route('shop.index') }}" method="GET">
                            <!-- Preserve other filters -->
                            @if(request('min_price'))
                                <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                            @endif
                            @if(request('max_price'))
                                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                            @endif
                            @if(request('subcategory_id'))
                                <input type="hidden" name="subcategory_id" value="{{ request('subcategory_id') }}">
                            @endif
                            @if(request('subsubcategory_id'))
                                <input type="hidden" name="subsubcategory_id" value="{{ request('subsubcategory_id') }}">
                            @endif
                            @if(request('color'))
                                <input type="hidden" name="color" value="{{ request('color') }}">
                            @endif
                            @if(request('rating'))
                                <input type="hidden" name="rating" value="{{ request('rating') }}">
                            @endif
                            @if(request('category_ids'))
                                @foreach(request('category_ids') as $catId)
                                    <input type="hidden" name="category_ids[]" value="{{ $catId }}">
                                @endforeach
                            @endif

                            <ul class="overflow-y-auto max-h-540 scroll-sm">
                                <li class="mb-24 d-flex align-items-center">
                                    <input type="checkbox" id="all_brands" class="brand-checkbox me-2"
                                           onchange="handleAllBrandsChange(this)"
                                           {{ (!isset($brandSlugs) || empty($brandSlugs)) || (isset($allBrandsSelected) && $allBrandsSelected) ? 'checked' : '' }}>
                                    <label for="all_brands" class="text-gray-900 hover-text-main-600 {{ (!isset($brandSlugs) || empty($brandSlugs)) || (isset($allBrandsSelected) && $allBrandsSelected) ? 'font-bold' : '' }} mb-0 cursor-pointer">
                                        All Brands
                                    </label>
                                    <a href="{{ route('shop.index') }}" class="ms-2 text-gray-500 hover-text-main-600 text-decoration-none">
                                        <i class="ph ph-arrow-square-out"></i>
                                    </a>
                                </li>
                                @foreach($brands as $brand)
                                    <li class="mb-24 d-flex align-items-center">
                                        <input type="checkbox" id="brand_{{ $brand->id }}"
                                               name="brand_slugs[]" value="{{ $brand->slug }}"
                                               class="brand-checkbox me-2"
                                               onchange="handleBrandChange()"
                                               {{ isset($brandSlugs) && in_array($brand->slug, $brandSlugs) ? 'checked' : '' }}>
                                        <label for="brand_{{ $brand->id }}" class="text-gray-900 hover-text-main-600 {{ isset($brandSlugs) && in_array($brand->slug, $brandSlugs) ? 'font-bold' : '' }} mb-0 cursor-pointer flex-grow-1">
                                            {{ $brand->name }} ({{ $brand->products_count }})
                                        </label>
                                        <a href="{{ route('shop.index', ['brand_slug' => $brand->slug]) }}"
                                           class="ms-2 text-gray-500 hover-text-main-600 text-decoration-none">
                                            <i class="ph ph-arrow-square-out"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Sidebar End -->

            <!-- Content Start -->
            <div class="col-lg-9">
                <!-- Search Results Header -->
                @if(isset($searchQuery) && !empty($searchQuery))
                    <div class="mb-32 p-24 bg-gray-50 rounded-8 border border-gray-200">
                        <div class="flex-wrap gap-16 flex-between">
                            <div>
                                <h5 class="mb-8 text-lg fw-semibold text-main-600">
                                    <i class="ph ph-magnifying-glass me-2"></i>Search Results for: "{{ $searchQuery }}"
                                </h5>
                                <span class="text-gray-600">
                                    Found {{ $products->total() }} product{{ $products->total() != 1 ? 's' : '' }} matching your search
                                </span>
                            </div>
                            <a href="{{ route('shop.index') }}" class="gap-8 btn btn-outline-main-600 rounded-pill flex-align">
                                <i class="ph ph-x"></i>
                                Clear Search
                            </a>
                        </div>
                    </div>
                @endif

                <div class="flex-wrap gap-16 mb-40 flex-between">
                    <span class="text-gray-900">
                        Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} results
                    </span>
                </div>

                <div class="list-grid-wrapper">
                    @if($products->count() > 0)
                        @foreach($products as $product)
                        <div class="p-16 border border-gray-100 product-card h-100 hover-border-main-600 rounded-16 position-relative transition-2">
                            <a href="{{ url('/product-details/' . $product->product_id) }}" class="product-card__thumb flex-center rounded-8 bg-gray-50 position-relative">
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                     alt="{{ $product->product_name }}"
                                     class="product-image">
                            </a>

                            <div class="mt-16 product-card__content">
                                <h6 class="mt-12 mb-8 text-lg title fw-semibold">
                                    <a href="{{ url('/product-details/' . $product->product_id) }}" class="link text-line-2" tabindex="0">{{ $product->product_name }}</a>
                                </h6>
                                <div class="gap-6 mt-16 mb-20 flex-align">
                                    @if ($product->total_reviews!=0)
                                    <div class="gap-2 rating-info d-flex">
                                        @php
                                            $fullStars = floor($product->average_rating);
                                            $hasHalfStar = ($product->average_rating - $fullStars) >= 0.5;
                                        @endphp
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                        @endfor
                                        @if ($hasHalfStar)
                                            <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star-half"></i></span>
                                        @endif
                                        <span class="text-xs text-gray-500 fw-medium">{{ number_format($product->average_rating, 1) }}</span>
                                        &nbsp;<span class="text-xs text-gray-500 fw-medium">({{ $product->total_reviews }})</span>
                                    </div>
                                    @endif
                                    <!-- <button type="button" class="heart-icon ms-auto" id="wishlist-icon-{{ $product->product_id }}" onclick="toggleWishlist(this, '{{ $product->product_id }}')">
                                        <i class="fa-regular fa-heart" style="font-size: 15px;"></i>
                                    </button> -->
                                </div>

                                <div class="mt-8 mb-20 product-card__price">
                                    @if($isDealer)
                                        <span class="text-heading text-md fw-semibold ">Rs {{ number_format($product->normal_price, 2) }} ({{ $product->bv ? $product->bv : '0' }} IV)</span>
                                    @else
                                        @if($product->affiliate_price && $product->affiliate_price != $product->normal_price)
                                            <span class="text-gray-500 text-sm text-decoration-line-through">Rs {{ number_format($product->affiliate_price, 2) }}</span>
                                        @endif
                                        <span class="text-heading text-md fw-semibold ">Rs {{ number_format($product->normal_price, 2) }} </span>
                                    @endif
                                </div>

                                <a href="#"
                                   class="gap-8 px-24 product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 rounded-8 flex-center fw-medium add-to-cart-btn"
                                   data-bs-toggle="modal"
                                   data-bs-target="#cartModal_{{ $product->product_id }}"
                                   data-product-id="{{ $product->product_id }}">
                                    Add To Cart <i class="ph ph-shopping-cart"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Cart Modal -->
                        <div class="modal fade" id="cartModal_{{ $product->product_id }}" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="p-6 modal-content" style="border-radius: 0;">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row gx-5">
                                            <aside class="col-lg-5">
                                                <div class="mb-3 rounded-4 d-flex justify-content-center">
                                                    <img id="mainImage" class="rounded-4 fit" src="{{ asset('storage/' . $product->images->first()->image_path) }}" style="width:250px" />
                                                </div>
                                            </aside>

                                            <main class="col-lg-7">
                                                <h6>{{ $product->product_name }}</h6>
                                                <p class="product-description">{{ $product->product_description }}</p>

                                                <hr />

                                                <div class="mt-8 mb-3 product-price d-flex align-items-center">
                                                    @if($isDealer)
                                                        <h6 class="mb-0">Rs {{ $product->normal_price }} ({{ $product->bv ? $product->bv : '0' }} IV)</h6>
                                                    @else
                                                        @if($product->affiliate_price && $product->affiliate_price != $product->normal_price)
                                                            <span class="text-gray-500 text-sm text-decoration-line-through me-2">Rs {{ number_format($product->affiliate_price, 2) }}</span>
                                                        @endif
                                                        <h6 class="mb-0">Rs {{ $product->normal_price }}</h6>
                                                    @endif
                                                </div>

                                                @auth
                                                <form action="{{ route('cart.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <input type="hidden" name="price" value="{{ $product->normal_price }}">
                                                    <button type="submit" class="mt-5 btn btn-main w-95">
                                                        Add To Cart
                                                    </button>
                                                </form>
                                                @else
                                                    <p class="mb-5 text-danger">Please <a href="{{ route('login') }}">log in</a> to add items to the cart.</p>
                                                @endauth
                                            </main>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    @else
                        <div class="col-12">
                            <div class="text-center py-80">
                                <div class="mb-24">
                                    <i class="ph ph-package text-6xl text-gray-400"></i>
                                </div>
                                <h4 class="mb-16 text-2xl fw-semibold text-gray-600">No Products Found</h4>
                                <p class="text-gray-500 mb-32">
                                    @if(isset($searchQuery) && !empty($searchQuery))
                                        Sorry, no products match your search for "<strong>{{ $searchQuery }}</strong>".
                                        <br>Try searching with different keywords or
                                        <a href="{{ route('shop.index') }}" class="text-main-600 hover-text-main-700 fw-medium">
                                            browse all products
                                        </a>.
                                    @elseif(!empty($categoryIds) || !empty($brandSlugs))
                                        Sorry, no products match your current filter selection.
                                        Try adjusting your filters or
                                        <a href="{{ route('shop.index') }}" class="text-main-600 hover-text-main-700 fw-medium">
                                            browse all products
                                        </a>.
                                    @else
                                        Please check back later for new products.
                                    @endif
                                </p>
                                <a href="{{ route('shop.index') }}" class="btn btn-main rounded-8 py-12 px-24">
                                    <i class="ph ph-arrow-left me-2"></i>
                                    View All Products
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Pagination Start -->
                <ul class="flex-wrap gap-16 pagination flex-center">
                    <li class="page-item">
                        <a class="border border-gray-100 page-link flex-center text-xxl rounded-8 fw-medium text-neutral-600" href="{{ $products->previousPageUrl() }}">
                            <i class="ph-bold ph-arrow-left"></i>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                            <a class="border border-gray-100 page-link flex-center text-md rounded-8 fw-medium text-neutral-600" href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="border border-gray-100 page-link flex-center text-xxl rounded-8 fw-medium text-neutral-600" href="{{ $products->nextPageUrl() }}">
                            <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- Pagination End -->
            </div>
            <!-- Content End -->
        </div>
    </div>
</section>
<!-- =============================== Shop Section End ======================================== -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Wishlist Handling Script -->
<script>
function toggleWishlist(button, productId) {
    button.classList.toggle('active');
    const icon = button.querySelector('i');

    if (button.classList.contains('active')) {
        icon.classList.replace('fa-regular', 'fa-solid');
        icon.style.color = 'red';
    } else {
        icon.classList.replace('fa-solid', 'fa-regular');
        icon.style.color = '#ccc';
    }

    fetch('/wishlist/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Category filter handling
function handleAllCategoriesChange(checkbox) {
    const categoryCheckboxes = document.querySelectorAll('input[name="category_ids[]"]');

    if (checkbox.checked) {
        // Check all category checkboxes
        categoryCheckboxes.forEach(cb => {
            cb.checked = true;
        });

        // Get all category IDs and submit
        const allCategoryIds = Array.from(categoryCheckboxes).map(cb => cb.value);
        const url = '{{ route("shop.index") }}' + buildQueryStringWithCategories(allCategoryIds);
        window.location.href = url;
    } else {
        // Uncheck all category checkboxes
        categoryCheckboxes.forEach(cb => {
            cb.checked = false;
        });

        // Submit form to show all products (no category filter)
        window.location.href = '{{ route("shop.index") }}' + buildQueryString(true);
    }
}

function handleCategoryChange() {
    const allCategoriesCheckbox = document.getElementById('all_categories');
    const categoryCheckboxes = document.querySelectorAll('input[name="category_ids[]"]');
    const checkedCategories = document.querySelectorAll('input[name="category_ids[]"]:checked');

    // Check if all categories are selected
    const allSelected = checkedCategories.length === categoryCheckboxes.length;

    if (checkedCategories.length > 0) {
        if (allSelected) {
            // All categories are selected, check "All Categories"
            allCategoriesCheckbox.checked = true;
        } else {
            // Some but not all categories selected, uncheck "All Categories"
            allCategoriesCheckbox.checked = false;
        }

        // Build URL with multiple category IDs
        const categoryIds = Array.from(checkedCategories).map(cb => cb.value);
        const url = '{{ route("shop.index") }}' + buildQueryStringWithCategories(categoryIds);
        window.location.href = url;
    } else {
        // If no categories selected, check "All Categories" and show all products
        allCategoriesCheckbox.checked = true;
        window.location.href = '{{ route("shop.index") }}' + buildQueryString(true);
    }
}

function buildQueryStringWithCategories(categoryIds) {
    const params = new URLSearchParams();

    // Add category IDs
    categoryIds.forEach(id => {
        params.append('category_ids[]', id);
    });

    // Preserve existing filters
    @if(request('search'))
        params.append('search', '{{ request("search") }}');
    @endif
    @if(request('min_price'))
        params.append('min_price', '{{ request("min_price") }}');
    @endif
    @if(request('max_price'))
        params.append('max_price', '{{ request("max_price") }}');
    @endif
    @if(request('subcategory_id'))
        params.append('subcategory_id', '{{ request("subcategory_id") }}');
    @endif
    @if(request('subsubcategory_id'))
        params.append('subsubcategory_id', '{{ request("subsubcategory_id") }}');
    @endif
    @if(request('color'))
        params.append('color', '{{ request("color") }}');
    @endif
    @if(request('rating'))
        params.append('rating', '{{ request("rating") }}');
    @endif

    const queryString = params.toString();
    return queryString ? '?' + queryString : '';
}

// Brand filter handling
function handleAllBrandsChange(checkbox) {
    const brandCheckboxes = document.querySelectorAll('input[name="brand_slugs[]"]');

    if (checkbox.checked) {
        // Check all brand checkboxes
        brandCheckboxes.forEach(cb => {
            cb.checked = true;
        });

        // Get all brand slugs and submit
        const allBrandSlugs = Array.from(brandCheckboxes).map(cb => cb.value);
        const url = '{{ route("shop.index") }}' + buildQueryStringWithBrands(allBrandSlugs);
        window.location.href = url;
    } else {
        // Uncheck all brand checkboxes
        brandCheckboxes.forEach(cb => {
            cb.checked = false;
        });

        // Submit form to show all products (no brand filter)
        window.location.href = '{{ route("shop.index") }}' + buildQueryString(false, true);
    }
}

function handleBrandChange() {
    const allBrandsCheckbox = document.getElementById('all_brands');
    const brandCheckboxes = document.querySelectorAll('input[name="brand_slugs[]"]');
    const checkedBrands = document.querySelectorAll('input[name="brand_slugs[]"]:checked');

    // Check if all brands are selected
    const allSelected = checkedBrands.length === brandCheckboxes.length;

    if (checkedBrands.length > 0) {
        if (allSelected) {
            // All brands are selected, check "All Brands"
            allBrandsCheckbox.checked = true;
        } else {
            // Some but not all brands selected, uncheck "All Brands"
            allBrandsCheckbox.checked = false;
        }

        // Build URL with multiple brand slugs
        const brandSlugs = Array.from(checkedBrands).map(cb => cb.value);
        const url = '{{ route("shop.index") }}' + buildQueryStringWithBrands(brandSlugs);
        window.location.href = url;
    } else {
        // If no brands selected, check "All Brands" and show all products
        allBrandsCheckbox.checked = true;
        window.location.href = '{{ route("shop.index") }}' + buildQueryString(false, true);
    }
}

function buildQueryStringWithBrands(brandSlugs) {
    const params = new URLSearchParams();

    // Add brand slugs
    brandSlugs.forEach(slug => {
        params.append('brand_slugs[]', slug);
    });

    // Preserve existing filters including category IDs
    @if(request('search'))
        params.append('search', '{{ request("search") }}');
    @endif
    @if(isset($categoryIds) && !empty($categoryIds))
        @foreach($categoryIds as $catId)
            params.append('category_ids[]', '{{ $catId }}');
        @endforeach
    @endif
    @if(request('min_price'))
        params.append('min_price', '{{ request("min_price") }}');
    @endif
    @if(request('max_price'))
        params.append('max_price', '{{ request("max_price") }}');
    @endif
    @if(request('subcategory_id'))
        params.append('subcategory_id', '{{ request("subcategory_id") }}');
    @endif
    @if(request('subsubcategory_id'))
        params.append('subsubcategory_id', '{{ request("subsubcategory_id") }}');
    @endif
    @if(request('color'))
        params.append('color', '{{ request("color") }}');
    @endif
    @if(request('rating'))
        params.append('rating', '{{ request("rating") }}');
    @endif

    const queryString = params.toString();
    return queryString ? '?' + queryString : '';
}

function buildQueryString(excludeCategoryId = false, excludeBrandSlug = false) {
    const params = new URLSearchParams();

    // Preserve existing filters
    @if(request('search'))
        params.append('search', '{{ request("search") }}');
    @endif
    @if(request('min_price'))
        params.append('min_price', '{{ request("min_price") }}');
    @endif
    @if(request('max_price'))
        params.append('max_price', '{{ request("max_price") }}');
    @endif
    @if(request('subcategory_id'))
        params.append('subcategory_id', '{{ request("subcategory_id") }}');
    @endif
    @if(request('subsubcategory_id'))
        params.append('subsubcategory_id', '{{ request("subsubcategory_id") }}');
    @endif
    @if(request('color'))
        params.append('color', '{{ request("color") }}');
    @endif
    @if(request('rating'))
        params.append('rating', '{{ request("rating") }}');
    @endif

    // Preserve multiple category IDs if not excluding them
    @if(isset($categoryIds) && !empty($categoryIds))
        if (!excludeCategoryId) {
            @foreach($categoryIds as $catId)
                params.append('category_ids[]', '{{ $catId }}');
            @endforeach
        }
    @endif

    // Preserve multiple brand slugs if not excluding them
    @if(isset($brandSlugs) && !empty($brandSlugs))
        if (!excludeBrandSlug) {
            @foreach($brandSlugs as $brandSlug)
                params.append('brand_slugs[]', '{{ $brandSlug }}');
            @endforeach
        }
    @endif

    const queryString = params.toString();
    return queryString ? (excludeCategoryId || excludeBrandSlug ? '&' + queryString : '?' + queryString) : '';
}

// Style checkboxes
document.addEventListener('DOMContentLoaded', function() {
    const style = document.createElement('style');
    style.textContent = `
        .category-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #3B82F6;
            cursor: pointer;
        }

        .brand-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #3B82F6;
            cursor: pointer;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .me-2 {
            margin-right: 0.5rem;
        }

        .ms-2 {
            margin-left: 0.5rem;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .flex-grow-1 {
            flex-grow: 1;
        }

        .text-decoration-none {
            text-decoration: none;
        }
    `;
    document.head.appendChild(style);
});
</script>

@endsection
