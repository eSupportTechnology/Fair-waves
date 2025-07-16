<?php $__env->startSection('dashboard-content'); ?>
<style>
    .dealer-products-container {
        height: calc(100vh - 200px);
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 0.5rem;
    }

    .dealer-products-container::-webkit-scrollbar {
        width: 6px;
    }

    .dealer-products-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .dealer-products-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .dealer-products-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .product-card {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 1rem;
        background: white;
        overflow: hidden;
    }

    .product-card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
        border-color: #dee2e6;
    }

    .product-card-header {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-bottom: 1px solid #dee2e6;
        padding: 1rem;
        border-radius: 0;
    }

    .product-card-body {
        padding: 1rem;
        background: white;
    }

    .affiliate-link-container {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem;
        margin: 0.75rem 0;
        position: relative;
    }

    .affiliate-link-input {
        border: none;
        background: transparent;
        font-size: 0.875rem;
        padding: 0.5rem;
        width: 100%;
        margin-bottom: 0.5rem;
        font-family: 'Courier New', monospace;
        color: #495057;
        word-break: break-all;
        resize: none;
    }

    .affiliate-link-input:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.8);
    }

    .copy-btn {
        background: linear-gradient(135deg, #6c757d, #545b62);
        border: none;
        border-radius: 6px;
        color: white;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        width: 100%;
        font-weight: 500;
    }

    .copy-btn:hover {
        background: linear-gradient(135deg, #545b62, #3e444a);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .action-buttons-desktop {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        align-items: stretch;
        justify-content: flex-start;
        height: 100%;
        padding-top: 0.5rem;
    }

    .action-buttons-mobile {
        display: block;
    }

    .action-btn {
        flex: 1;
        min-width: 120px;
        padding: 0.75rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .action-btn-view {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
    }

    .action-btn-view:hover {
        background: linear-gradient(135deg, #138496, #0f6674);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
    }

    .action-btn-delete {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    .action-btn-delete:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }

    /* Desktop specific styles */
    @media (min-width: 992px) {
        .action-buttons-desktop .action-btn {
            width: 100%;
            min-width: 140px;
            padding: 0.875rem 1rem;
            font-size: 0.9rem;
        }

        .product-card-body {
            min-height: 120px;
        }
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
        background: #f8f9fa;
        border-radius: 12px;
        border: 2px dashed #dee2e6;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #adb5bd;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        .dealer-products-container {
            padding: 0.5rem;
            height: calc(100vh - 150px);
            padding-right: 0.25rem;
        }

        .product-card {
            margin-bottom: 0.75rem;
        }

        .product-card-header {
            padding: 0.75rem;
        }

        .product-card-body {
            padding: 0.75rem;
        }

        .affiliate-link-container {
            padding: 0.5rem;
        }

        .affiliate-link-input {
            font-size: 0.75rem;
            padding: 0.25rem;
        }

        .action-buttons-mobile .action-buttons {
            flex-direction: column;
            gap: 0.75rem;
        }

        .action-buttons-mobile .action-btn {
            width: 100%;
            min-width: unset;
            padding: 0.875rem;
            font-size: 0.875rem;
        }

        .copy-btn {
            padding: 0.625rem 1rem;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .dealer-products-container {
            height: calc(100vh - 120px);
            padding: 0.25rem;
            padding-right: 0.125rem;
        }

        .product-card-header h5 {
            font-size: 1.1rem;
        }

        .affiliate-link-input {
            font-size: 0.7rem;
            word-break: break-all;
        }

        .action-buttons-mobile .action-btn {
            padding: 1rem;
            font-size: 0.85rem;
        }

        .copy-btn {
            padding: 0.75rem 1rem;
            font-size: 0.75rem;
        }

        .container-fluid {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
    }

    /* Landscape mode adjustments */
    @media (max-width: 896px) and (orientation: landscape) {
        .dealer-products-container {
            height: calc(100vh - 100px);
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">
                    <i class="fas fa-box text-primary me-2"></i>
                    My Product Links
                </h4>
                <span class="badge bg-secondary"><?php echo e(count($productLinks)); ?> Links</span>
            </div>

            <div class="dealer-products-container">
                <?php echo $__env->make('frontend.dealer.partials.dealer-products', ['productLinks' => $productLinks], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/frontend/dealer/dealer-products-dashboard.blade.php ENDPATH**/ ?>