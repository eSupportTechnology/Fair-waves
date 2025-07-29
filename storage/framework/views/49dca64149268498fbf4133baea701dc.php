<?php $__env->startSection('content'); ?>
<style>
    :root {
        --primary-color: #ff5800;
        --primary-dark: #e64a00;
        --secondary-color: #6c757d;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --light-bg: #f8f9fa;
        --white: #ffffff;
        --border-radius: 12px;
        --box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .showroom-container {
        padding: 30px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
    }

    .breadcrumb-custom {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        padding: 20px 0;
        margin-bottom: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border-bottom: 1px solid #e9ecef;
    }

    .breadcrumb {
        background: transparent;
        margin-bottom: 0;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
    }

    .breadcrumb-item a:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .product-images-container {
        position: sticky;
        top: 20px;
        background: var(--white);
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--box-shadow);
        border: 1px solid #e9ecef;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .main-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: var(--border-radius);
        background: #f8f9fa;
        margin-bottom: 20px;
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-image {
        width: 100%;
        height: 450px;
        object-fit: cover;
        transition: transform 0.3s ease;
        cursor: zoom-in;
        border-radius: var(--border-radius);
    }

    .main-image:hover {
        transform: scale(1.05);
    }

    .image-zoom-indicator {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 12px;
        opacity: 0;
        transition: var(--transition);
    }

    .main-image-wrapper:hover .image-zoom-indicator {
        opacity: 1;
    }

    .thumbnail-images {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .thumbnail {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        border: 3px solid transparent;
        transition: var(--transition);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .thumbnail:hover, .thumbnail.active {
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 88, 0, 0.3);
    }

    .product-info-card {
        background: var(--white);
        border-radius: var(--border-radius);
        padding: 30px;
        box-shadow: var(--box-shadow);
        border: 1px solid #e9ecef;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-info-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-info-main {
        flex-grow: 1;
        padding-bottom: 15px;
    }

    .product-info-actions {
        margin-top: auto;
        padding-top: 20px;
    }

    .product-title {
        font-size: 1.9rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 30px;
        line-height: 1.5;
        word-wrap: break-word;
        overflow-wrap: break-word;
        padding-right: 10px;
        min-height: auto;
        display: block;
        white-space: normal;
    }

    .product-price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--success-color);
        margin-bottom: 20px;
    }

    .product-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid var(--primary-color);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .meta-icon {
        width: 40px;
        height: 40px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .meta-content h6 {
        margin: 0;
        font-size: 12px;
        color: #6c757d;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .meta-content p {
        margin: 0;
        font-weight: 600;
        color: #2d3748;
    }

    .showroom-banner {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 25px;
        border-radius: var(--border-radius);
        margin-bottom: 30px;
        box-shadow: var(--box-shadow);
        position: relative;
        overflow: hidden;
    }

    .showroom-banner::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(30px, -30px);
    }

    .showroom-banner h5 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .variations-section {
        margin-bottom: 25px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .variation-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 12px;
        font-size: 1.1rem;
    }

    .size-badge {
        background: white;
        color: #2d3748;
        border: 2px solid #e9ecef;
        padding: 8px 16px;
        border-radius: 25px;
        font-weight: 600;
        margin: 4px;
        display: inline-block;
        transition: var(--transition);
        cursor: pointer;
    }

    .size-badge:hover {
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: white;
        transform: translateY(-1px);
    }

    .color-circle {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: inline-block;
        margin: 4px;
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        transition: var(--transition);
    }

    .color-circle:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border: none;
        padding: 8px 20px;
        font-weight: 500;
        border-radius: 25px;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(255, 88, 0, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 14px;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 88, 0, 0.4);
    }

    .btn-outline-custom {
        background: white;
        color: var(--success-color);
        border: 2px solid var(--success-color);
        padding: 8px 20px;
        font-weight: 500;
        border-radius: 25px;
        transition: var(--transition);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 14px;
    }

    .btn-outline-custom:hover {
        background: var(--success-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    .description-section {
        background: white;
        padding: 25px;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        border: 1px solid #e9ecef;
        margin-bottom: 25px;
        width: 100%;
        max-width: 100%;
    }

    .product-info-main {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-info-content {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        width: 100%;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary-color);
        display: inline-block;
    }

    .dealer-card {
        background: white;
        padding: 25px;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        border: 1px solid #e9ecef;
        position: sticky;
        top: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .dealer-card .section-title {
        margin-bottom: 20px;
    }

    .dealer-card .dealer-info-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .dealer-card .dealer-actions {
        margin-top: auto;
        padding-top: 20px;
    }

    .dealer-info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
        transition: var(--transition);
    }

    .dealer-info-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .dealer-icon {
        width: 35px;
        height: 35px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    .specifications-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        border: 1px solid #e9ecef;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .specifications-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 20px 25px;
        border-bottom: 2px solid var(--primary-color);
        margin: 0;
    }

    .specifications-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d3748;
        text-align: left;
    }

    .specifications-body {
        padding: 0;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .spec-item {
        display: flex;
        align-items: center;
        padding: 18px 25px;
        border-bottom: 1px solid #f1f3f4;
        transition: var(--transition);
        min-height: 70px;
    }

    .spec-item:hover {
        background: #f8f9fa;
        transform: translateX(3px);
    }

    .spec-item:last-child {
        border-bottom: none;
    }

    .spec-label {
        flex: 0 0 160px;
        font-weight: 600;
        color: #4a5568;
        font-size: 14px;
        margin-right: 20px;
    }

    .spec-value {
        flex: 1;
        color: #2d3748;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .spec-icon {
        width: 20px;
        height: 20px;
        background: var(--primary-color);
        color: white;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        flex-shrink: 0;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .alert-custom {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border: 1px solid #2196f3;
        color: #1565c0;
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .product-title {
            font-size: 1.6rem;
            margin-bottom: 25px;
            line-height: 1.5;
            min-height: auto;
        }

        .product-meta {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-primary-custom, .btn-outline-custom {
            width: 100%;
            justify-content: center;
        }

        .product-info-main {
            padding: 10px 0;
        }

        .showroom-container {
            padding: 20px 0;
        }

        .showroom-container .row {
            flex-direction: column;
        }

        .additional-info-row {
            flex-direction: column;
        }

        .additional-info-row .col-lg-8,
        .additional-info-row .col-lg-4 {
            flex-direction: column;
        }

        .product-images-container,
        .product-info-card,
        .dealer-card,
        .specifications-card {
            position: static;
            margin-bottom: 20px;
            height: auto;
        }

        .main-image-wrapper {
            height: auto;
        }

        .main-image {
            height: 300px;
        }
    }

    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .showroom-container .row {
        display: flex;
        align-items: stretch;
    }

    .showroom-container .row .col-lg-6 {
        display: flex;
        flex-direction: column;
    }

    /* Additional Information Section Equal Heights */
    .additional-info-row {
        display: flex;
        align-items: stretch;
    }

    .additional-info-row .col-lg-8,
    .additional-info-row .col-lg-4 {
        display: flex;
        flex-direction: column;
    }

    .product-images-container {
        position: sticky;
        top: 20px;
        background: var(--white);
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--box-shadow);
        border: 1px solid #e9ecef;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Review Section Styles */
    .review-section-card {
        background: var(--white);
        border-radius: var(--border-radius);
        padding: 30px;
        box-shadow: var(--box-shadow);
        border: 1px solid #e9ecef;
        margin-top: 20px;
    }

    .reviews-container {
        max-height: 600px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .review-item {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
        transition: var(--transition);
    }

    .review-item:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-color);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .reviewer-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .reviewer-avatar {
        width: 45px;
        height: 45px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .reviewer-name {
        margin: 0 0 5px 0;
        font-size: 16px;
        font-weight: 600;
        color: #2d3748;
    }

    .review-rating-stars {
        display: flex;
        gap: 2px;
    }

    .review-rating-stars i {
        font-size: 14px;
        color: #ffd700;
    }

    .review-rating-stars i.far {
        color: #ddd;
    }

    .review-content {
        margin: 15px 0;
        line-height: 1.6;
        color: #4a5568;
    }

    .review-media {
        margin-top: 15px;
    }

    .media-gallery {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .review-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        transition: var(--transition);
        border: 2px solid #e9ecef;
    }

    .review-image:hover {
        transform: scale(1.05);
        border-color: var(--primary-color);
    }

    .review-video {
        width: 120px;
        height: 80px;
        border-radius: 8px;
        border: 2px solid #e9ecef;
    }

    .rating-summary {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 25px;
        height: fit-content;
        border: 1px solid #e9ecef;
    }

    .average-rating {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e9ecef;
    }

    .rating-score {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .rating-score .score {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        line-height: 1;
    }

    .rating-stars {
        display: flex;
        gap: 3px;
        font-size: 18px;
    }

    .rating-stars i {
        color: #ffd700;
    }

    .rating-breakdown {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .rating-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .rating-label {
        display: flex;
        align-items: center;
        gap: 3px;
        min-width: 35px;
        font-weight: 600;
        color: #4a5568;
    }

    .rating-label i {
        color: #ffd700;
        font-size: 12px;
    }

    .progress-container {
        flex: 1;
    }

    .progress {
        height: 8px;
        background: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .rating-count {
        min-width: 25px;
        text-align: right;
        font-weight: 600;
        color: #4a5568;
    }

    .no-reviews {
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .no-reviews i {
        color: #cbd5e0;
    }

    /* Responsive design for reviews */
    @media (max-width: 768px) {
        .review-header {
            flex-direction: column;
            gap: 10px;
        }

        .reviewer-info {
            width: 100%;
        }

        .review-date {
            align-self: flex-start;
        }

        .media-gallery {
            justify-content: center;
        }

        .rating-summary {
            margin-top: 20px;
        }
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-custom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('showroom.index', $productLink->dealer->dealerProfile->dealer_shop_name)); ?>">
                        <i class="fas fa-store me-1"></i> <?php echo e($productLink->dealer->dealerProfile->dealer_shop_name); ?>

                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-box me-1"></i> <?php echo e($productLink->product->product_name); ?>

                </li>
            </ol>
        </nav>
    </div>
</div>

<!-- Showroom Info Banner -->
<div class="container">
    <div class="showroom-banner fade-in">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="mb-1">
                    <i class="fas fa-store me-2"></i>
                    <?php echo e($productLink->dealer->dealerProfile->dealer_shop_name); ?>

                </h5>
                <p class="mb-0 opacity-75">
                    <i class="fas fa-certificate me-1"></i>
                    Authorized Seller Showroom
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-flex flex-column align-items-md-end">
                    <small class="opacity-75">Product Code</small>
                    <strong class="fs-6"><?php echo e($productLink->unique_code); ?></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Product Content -->
<div class="container showroom-container">
    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6">
            <div class="product-images-container fade-in">
                <?php if($productLink->product->images->count() > 0): ?>
                    <div class="main-image-wrapper">
                        <img src="<?php echo e(asset('storage/' . $productLink->product->images->first()->image_path)); ?>"
                             alt="<?php echo e($productLink->product->product_name); ?>"
                             class="main-image"
                             id="mainImage">
                        <div class="image-zoom-indicator">
                            <i class="fas fa-search-plus me-1"></i>
                            Click to zoom
                        </div>
                    </div>

                    <?php if($productLink->product->images->count() > 1): ?>
                    <div class="thumbnail-images">
                        <?php $__currentLoopData = $productLink->product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>"
                                 alt="<?php echo e($productLink->product->product_name); ?>"
                                 class="thumbnail <?php echo e($index === 0 ? 'active' : ''); ?>"
                                 onclick="changeMainImage('<?php echo e(asset('storage/' . $image->image_path)); ?>', this)">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="main-image-wrapper">
                        <img src="https://via.placeholder.com/500x450/f8f9fa/6c757d?text=No+Image+Available"
                             alt="<?php echo e($productLink->product->product_name); ?>"
                             class="main-image">
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Product Information -->
        <div class="col-lg-6">
            <div class="product-info-card fade-in">
                <div class="product-info-content">
                    <div class="product-info-main">
                        <h2 class="product-title"><?php echo e($productLink->product->product_name); ?></h2>

                        <div class="product-price">
                            <i class="fas fa-tag me-2"></i>
                            Rs. <?php echo e(number_format($productLink->product->normal_price, 2)); ?>

                        </div>

                        <!-- Product Meta Information -->
                        <div class="product-meta">
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="fas fa-barcode"></i>
                                </div>
                                <div class="meta-content">
                                    <h6>Product ID</h6>
                                    <p><?php echo e($productLink->product->product_id); ?></p>
                                </div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                                <div class="meta-content">
                                    <h6>Category</h6>
                                    <p><?php echo e($productLink->product->category->name ?? 'N/A'); ?></p>
                                </div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="fas fa-trademark"></i>
                                </div>
                                <div class="meta-content">
                                    <h6>Brand</h6>
                                    <p><?php echo e($productLink->product->brand->name ?? 'N/A'); ?></p>
                                </div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="fas fa-cube"></i>
                                </div>
                                <div class="meta-content">
                                    <h6>Stock Status</h6>
                                    <p>
                                        <?php if($productLink->product->quantity > 0): ?>
                                            <span class="status-badge bg-success text-white">
                                                <?php echo e($productLink->product->quantity); ?> Available
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge bg-danger text-white">
                                                Out of Stock
                                            </span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Sizes Section (if any) -->
<?php if($productLink->product->variations->pluck('value')->filter()->unique()->isNotEmpty()): ?>
<div class="variations-section mb-3">
    <h6 class="variation-title"><i class="fas fa-ruler me-2"></i>Select Size (Optional)</h6>
    <div class="d-flex flex-wrap gap-2">
        <?php $__currentLoopData = $productLink->product->variations->pluck('value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="size-badge selectable">
                <input type="radio" name="size_option" value="<?php echo e($size); ?>" class="d-none size-input">
                <span><?php echo e($size); ?></span>
            </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>

<!-- Colors Section (if any) -->
<?php if($productLink->product->variations->pluck('hex_value')->filter()->unique()->isNotEmpty()): ?>
<div class="variations-section mb-3">
    <h6 class="variation-title"><i class="fas fa-palette me-2"></i>Select Color (Optional)</h6>
    <div class="d-flex flex-wrap gap-2 align-items-center">
        <?php $__currentLoopData = $productLink->product->variations->pluck('hex_value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="color-circle-wrapper" title="<?php echo e($color); ?>">
                <input type="radio" name="color_option" value="<?php echo e($color); ?>" class="d-none color-input">
                <span class="color-circle" style="background-color: <?php echo e($color); ?>"></span>
            </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>

<!-- Action Buttons -->
                        <div class="action-buttons">
<?php if($productLink->product->quantity > 0): ?>
    <!-- Add to Cart Form -->
    <form action="<?php echo e(route('showroom.cart.add', [$productLink->dealer->dealerProfile->dealer_shop_name, $productLink->product->id])); ?>" method="POST" class="d-inline add-to-cart-form" onsubmit="return handleAddToCart(event, this);">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="size">
        <input type="hidden" name="color">
        <input type="hidden" name="image_path" value="<?php echo e($productLink->product->images->first() ? $productLink->product->images->first()->image_path : ''); ?>">
        <button type="submit" class="btn btn-primary-custom mt-2">
            <i class="fas fa-shopping-cart me-2"></i> Add To Cart
        </button>
    </form>

    <!-- Buy Now Form -->
    <form action="<?php echo e(route('dealer.buy.now', [$productLink->product->id, $productLink->id])); ?>" method="POST" class="d-inline" onsubmit="return copyOptionalSelections(this);">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="size">
        <input type="hidden" name="color">
        <button type="submit" class="btn btn-outline-custom mt-2">
            <i class="fas fa-bolt me-2"></i> Buy Now
        </button>
    </form>
<?php else: ?>
    <button type="button" class="btn btn-secondary mt-2" disabled>
        <i class="fas fa-times me-2"></i> Out of Stock
    </button>
<?php endif; ?>


                        <!-- Product Description -->
                        <?php if($productLink->product->product_description): ?>
                        <div class="description-section">
                            <h5 class="section-title">
                                <i class="fas fa-align-left me-2"></i>
                                Product Description
                            </h5>
                            <p class="text-muted lh-lg"><?php echo e($productLink->product->product_description); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Additional Information Section -->
    <div class="row mt-4 additional-info-row">
        <!-- Product Specifications -->
        <div class="col-lg-8">
            <div class="specifications-card fade-in">
                <div class="specifications-header">
                    <h5>
                        <i class="fas fa-list-ul me-2"></i>
                        Product Specifications
                    </h5>
                </div>
                <div class="specifications-body">
                    <div class="spec-item">
                        <div class="spec-label">Product Name</div>
                        <div class="spec-value">
                            <div class="spec-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <?php echo e($productLink->product->product_name); ?>

                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-label">Product ID</div>
                        <div class="spec-value">
                            <div class="spec-icon">
                                <i class="fas fa-barcode"></i>
                            </div>
                            <code class="bg-light px-2 py-1 rounded"><?php echo e($productLink->product->product_id); ?></code>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-label">Category</div>
                        <div class="spec-value">
                            <div class="spec-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <span class="badge bg-primary"><?php echo e($productLink->product->category->name ?? 'N/A'); ?></span>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-label">Brand</div>
                        <div class="spec-value">
                            <div class="spec-icon">
                                <i class="fas fa-trademark"></i>
                            </div>
                            <?php echo e($productLink->product->brand->name ?? 'N/A'); ?>

                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-label">Price</div>
                        <div class="spec-value">
                            <div class="spec-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <span class="fw-bold text-success fs-5">Rs. <?php echo e(number_format($productLink->product->normal_price, 2)); ?></span>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-label">Availability</div>
                        <div class="spec-value">
                            <div class="spec-icon">
                                <i class="fas fa-cube"></i>
                            </div>
                            <?php if($productLink->product->quantity > 0): ?>
                                <span class="status-badge bg-success text-white">
                                    <i class="fas fa-check-circle me-1"></i>
                                    <?php echo e($productLink->product->quantity); ?> Units Available
                                </span>
                            <?php else: ?>
                                <span class="status-badge bg-danger text-white">
                                    <i class="fas fa-times-circle me-1"></i>
                                    Out of Stock
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($productLink->product->variations->pluck('value')->filter()->unique()->isNotEmpty()): ?>
                    <div class="spec-item">
                        <div class="spec-label">Available Sizes</div>
                        <div class="spec-value">
                            <div class="spec-icon">
                                <i class="fas fa-ruler"></i>
                            </div>
                            <div class="d-flex flex-wrap gap-1">
                                <?php $__currentLoopData = $productLink->product->variations->pluck('value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge bg-light text-dark"><?php echo e($size); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($productLink->product->variations->pluck('hex_value')->filter()->unique()->isNotEmpty()): ?>
                    <div class="spec-item">
                        <div class="spec-label">Available Colors</div>
                        <div class="spec-value">
                            <div class="spec-icon">
                                <i class="fas fa-palette"></i>
                            </div>
                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                <?php $__currentLoopData = $productLink->product->variations->pluck('hex_value')->filter()->unique(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="d-inline-block"
                                          style="width: 24px; height: 24px; background-color: <?php echo e($color); ?>; border-radius: 50%; border: 2px solid #dee2e6; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"
                                          title="<?php echo e($color); ?>"
                                          data-bs-toggle="tooltip">
                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Dealer Contact Information -->
        <div class="col-lg-4">
            <div class="dealer-card fade-in" id="dealer-info">
                <h6 class="section-title mb-3">
                    <i class="fas fa-store me-2"></i>
                    Dealer Information
                </h6>

                <div class="dealer-info-content">
                    <div class="dealer-info-item">
                        <div class="dealer-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Dealer Name</small>
                            <strong><?php echo e($productLink->dealer->name); ?></strong>
                        </div>
                    </div>

                    <div class="dealer-info-item">
                        <div class="dealer-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Shop Name</small>
                            <strong><?php echo e($productLink->dealer->dealerProfile->dealer_shop_name); ?></strong>
                        </div>
                    </div>

                    <?php if($productLink->dealer->dealerProfile->phone): ?>
                    <div class="dealer-info-item">
                        <div class="dealer-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Phone</small>
                            <a href="tel:<?php echo e($productLink->dealer->dealerProfile->phone); ?>"
                               class="text-decoration-none fw-bold">
                                <?php echo e($productLink->dealer->dealerProfile->phone); ?>

                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($productLink->dealer->email): ?>
                    <div class="dealer-info-item">
                        <div class="dealer-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Email</small>
                            <a href="mailto:<?php echo e($productLink->dealer->email); ?>"
                               class="text-decoration-none fw-bold">
                                <?php echo e($productLink->dealer->email); ?>

                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($productLink->dealer->dealerProfile->address): ?>
                    <div class="dealer-info-item">
                        <div class="dealer-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Address</small>
                            <span class="fw-bold"><?php echo e($productLink->dealer->dealerProfile->address); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="dealer-actions">
                    <div class="d-grid gap-2">
                        <?php if($productLink->dealer->dealerProfile->phone): ?>
                        <a href="tel:<?php echo e($productLink->dealer->dealerProfile->phone); ?>"
                           class="btn btn-primary-custom">
                            <i class="fas fa-phone me-2"></i>
                            Call Dealer
                        </a>
                        <?php endif; ?>
                        <?php if($productLink->dealer->email): ?>
                        <a href="mailto:<?php echo e($productLink->dealer->email); ?>"
                           class="btn btn-outline-custom">
                            <i class="fas fa-envelope me-2"></i>
                            Email Dealer
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Reviews Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="review-section-card fade-in">
                <h6 class="section-title mb-4">
                    <i class="fas fa-star me-2"></i>
                    Product Reviews & Ratings
                </h6>
                
                <?php if($totalReviews > 0): ?>
                    <div class="row mb-4">
                        <!-- Reviews List -->
                        <div class="col-lg-8">
                            <h6 class="mb-3">Customer Reviews (<?php echo e($totalReviews); ?>)</h6>
                            <div class="reviews-container">
                                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="review-item">
                                        <div class="review-header">
                                            <div class="reviewer-info">
                                                <div class="reviewer-avatar">
                                                    <i class="fas fa-user-circle"></i>
                                                </div>
                                                <div class="reviewer-details">
                                                    <h6 class="reviewer-name">
                                                        <?php echo e($review->is_anonymous ? 'Anonymous Customer' : $review->reviewer->name); ?>

                                                    </h6>
                                                    <div class="review-rating-stars">
                                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                                            <i class="<?php echo e($review->rating >= $i ? 'fas fa-star filled' : 'far fa-star'); ?>"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-date">
                                                <small class="text-muted"><?php echo e($review->created_at->format('M d, Y')); ?></small>
                                            </div>
                                        </div>
                                        
                                        <?php if($review->review): ?>
                                            <div class="review-content">
                                                <p><?php echo e($review->review); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if($review->media): ?>
                                            <div class="review-media">
                                                <?php
                                                    $mediaFiles = is_string($review->media) ? json_decode($review->media, true) : $review->media;
                                                ?>
                                                <?php if(!empty($mediaFiles)): ?>
                                                    <div class="media-gallery">
                                                        <?php $__currentLoopData = $mediaFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(in_array(pathinfo($media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                                                <img src="<?php echo e(asset('storage/' . $media)); ?>" 
                                                                     alt="Review Image" 
                                                                     class="review-image"
                                                                     onclick="openImageModal('<?php echo e(asset('storage/' . $media)); ?>')">
                                                            <?php elseif(in_array(pathinfo($media, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov', 'webm'])): ?>
                                                                <video controls class="review-video">
                                                                    <source src="<?php echo e(asset('storage/' . $media)); ?>" 
                                                                            type="video/<?php echo e(pathinfo($media, PATHINFO_EXTENSION)); ?>">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        
                        <!-- Rating Summary -->
                        <div class="col-lg-4">
                            <div class="rating-summary">
                                <h6 class="mb-3">Overall Rating</h6>
                                <div class="average-rating">
                                    <div class="rating-score">
                                        <span class="score"><?php echo e(number_format($averageRating, 1)); ?></span>
                                        <div class="rating-stars">
                                            <?php
                                                $fullStars = floor($averageRating);
                                                $hasHalfStar = ($averageRating - $fullStars) >= 0.5;
                                            ?>
                                            <?php for($i = 0; $i < $fullStars; $i++): ?>
                                                <i class="fas fa-star"></i>
                                            <?php endfor; ?>
                                            <?php if($hasHalfStar): ?>
                                                <i class="fas fa-star-half-alt"></i>
                                            <?php endif; ?>
                                            <?php for($i = 0; $i < (5 - $fullStars - ($hasHalfStar ? 1 : 0)); $i++): ?>
                                                <i class="far fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <small class="text-muted">Based on <?php echo e($totalReviews); ?> <?php echo e($totalReviews == 1 ? 'review' : 'reviews'); ?></small>
                                    </div>
                                </div>
                                
                                <div class="rating-breakdown">
                                    <?php $__currentLoopData = array_reverse($ratingCounts->toArray(), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                        ?>
                                        <div class="rating-bar">
                                            <div class="rating-label">
                                                <span><?php echo e($rating); ?></span>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: <?php echo e($percentage); ?>%"></div>
                                                </div>
                                            </div>
                                            <span class="rating-count"><?php echo e($count); ?></span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="no-reviews">
                        <div class="text-center py-5">
                            <i class="fas fa-star-o fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Reviews Yet</h5>
                            <p class="text-muted">Be the first to review this product!</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function copyOptionalSelections(form) {
    const selectedSize = document.querySelector('input[name="size_option"]:checked');
    const selectedColor = document.querySelector('input[name="color_option"]:checked');

    form.querySelector('input[name="size"]').value = selectedSize ? selectedSize.value : '';
    form.querySelector('input[name="color"]').value = selectedColor ? selectedColor.value : '';

    return true; // Always allow submit
}

// AJAX Add to Cart function
function handleAddToCart(event, form) {
    event.preventDefault(); // Prevent normal form submission
    
    // Copy selections before submitting
    copyOptionalSelections(form);
    
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    
    // Show loading state
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Adding...';
    
    // Create FormData from form
    const formData = new FormData(form);
    
    // Submit via AJAX
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text(); // Laravel returns HTML for redirects
    })
    .then(data => {
        // Show success message
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Product added to cart successfully!',
                showConfirmButton: false,
                timer: 2000,
                toast: true,
                position: 'top-end'
            });
        } else {
            // Fallback notification
            const notification = document.createElement('div');
            notification.className = 'alert alert-success position-fixed';
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.textContent = 'Product added to cart successfully!';
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }
        
        // Update cart count - this is the key fix!
        if (typeof window.updateCartCount === 'function') {
            window.updateCartCount();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // Show error message
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to add product to cart. Please try again.',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        } else {
            // Fallback notification
            const notification = document.createElement('div');
            notification.className = 'alert alert-danger position-fixed';
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.textContent = 'Failed to add product to cart. Please try again.';
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }
    })
    .finally(() => {
        // Reset button state
        submitButton.disabled = false;
        submitButton.innerHTML = originalText;
    });
    
    return false; // Prevent form submission
}
</script>


<script>
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            const submitButton = form.querySelector('.btn-primary-custom, .btn-outline-custom');
            if (submitButton) {
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                submitButton.disabled = true;
            }
        });
    });
</script>


<script>
// Enhanced image gallery functionality
function changeMainImage(imageSrc, thumbnailElement) {
    const mainImage = document.getElementById('mainImage');

    // Add fade effect
    mainImage.style.opacity = '0.7';

    setTimeout(() => {
        mainImage.src = imageSrc;
        mainImage.style.opacity = '1';
    }, 150);

    // Update active thumbnail
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
    });

    if (thumbnailElement) {
        thumbnailElement.classList.add('active');
    }
}

// Initialize page functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Add smooth scrolling for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // // Add loading animation for action buttons
    // document.querySelectorAll('.btn-primary-custom, .btn-outline-custom').forEach(button => {
    //     button.addEventListener('click', function() {
    //         const originalContent = this.innerHTML;
    //         this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
    //         this.disabled = true;

    //         // Simulate processing time (remove this in production)
    //         setTimeout(() => {
    //             this.innerHTML = originalContent;
    //             this.disabled = false;
    //         }, 2000);
    //     });
    // });

    // Add image zoom functionality
    const mainImage = document.getElementById('mainImage');
    if (mainImage) {
        mainImage.addEventListener('click', function() {
            // Create modal for image zoom
            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.innerHTML = `
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e($productLink->product->product_name); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="${this.src}" class="img-fluid" alt="<?php echo e($productLink->product->product_name); ?>">
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();

            // Remove modal from DOM when hidden
            modal.addEventListener('hidden.bs.modal', function() {
                document.body.removeChild(modal);
            });
        });
    }

    // Add intersection observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe fade-in elements
    document.querySelectorAll('.fade-in').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Add size selection functionality
    document.querySelectorAll('.size-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            document.querySelectorAll('.size-badge').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Add color selection functionality
    document.querySelectorAll('.color-circle').forEach(circle => {
        circle.addEventListener('click', function() {
            document.querySelectorAll('.color-circle').forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
    });

    console.log('Professional product view page loaded successfully');

    // Function to ensure equal heights for product containers
    function equalizeHeights() {
        const imageContainer = document.querySelector('.product-images-container');
        const infoContainer = document.querySelector('.product-info-card');

        if (imageContainer && infoContainer) {
            // Reset heights
            imageContainer.style.height = 'auto';
            infoContainer.style.height = 'auto';

            // Get heights
            const imageHeight = imageContainer.offsetHeight;
            const infoHeight = infoContainer.offsetHeight;

            // Set equal heights
            const maxHeight = Math.max(imageHeight, infoHeight);
            imageContainer.style.height = maxHeight + 'px';
            infoContainer.style.height = maxHeight + 'px';
        }
    }

    // Call equalizeHeights on load and resize
    equalizeHeights();
    window.addEventListener('resize', equalizeHeights);

    // Handle navigation clicks for better UX
    document.querySelectorAll('.contact-scroll').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Handle products navigation - scroll to products section in showroom
    document.querySelectorAll('a[href*="#products-section"]').forEach(function(element) {
        element.addEventListener('click', function(e) {
            // If the link contains a hash, it means it's trying to scroll to a section
            const href = this.getAttribute('href');
            if (href.includes('#products-section')) {
                // Let the browser handle the navigation to the showroom page
                // The hash will be handled by the showroom page
                window.location.href = href;
            }
        });
    });
});

// Add CSS for selected states
const style = document.createElement('style');
style.textContent = `
    .size-badge.selected {
        background: var(--primary-color) !important;
        color: white !important;
        border-color: var(--primary-color) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 88, 0, 0.3);
    }

    .color-circle.selected {
        box-shadow: 0 0 0 3px var(--primary-color) !important;
    }

    .btn-primary-custom:disabled,
    .btn-outline-custom:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
`;
document.head.appendChild(style);

// Image modal functionality for review images
function openImageModal(imageSrc) {
    // Create modal HTML
    const modal = document.createElement('div');
    modal.innerHTML = `
        <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Review Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="${imageSrc}" class="img-fluid" alt="Review Image" style="max-height: 70vh; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Add modal to body
    document.body.appendChild(modal);
    
    // Initialize and show modal
    const bsModal = new bootstrap.Modal(modal.querySelector('#imageModal'));
    bsModal.show();
    
    // Remove modal from DOM when hidden
    modal.querySelector('#imageModal').addEventListener('hidden.bs.modal', function() {
        document.body.removeChild(modal);
    });
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.DealerShowroom.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/DealerShowroom/product/productView.blade.php ENDPATH**/ ?>