

<?php $__env->startSection('content'); ?>

<style>
    .btn-view {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }
    .btn-view:hover {
        background-color: #138496;
        border-color: #117a8b;
        color: white;
    }
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }
    .btn-warning:hover {
        background-color: #ffca2c;
        border-color: #ffc720;
        color: #212529;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
        color: white;
    }
    .search-container {
        position: relative;
    }
    .search-container .form-control {
        padding-right: 45px;
    }
    .search-container .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
</style>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Dealers</h2>
    </div>
    <div class="d-flex align-items-center">
        <a href="<?php echo e(route('dealers.export', request()->query())); ?>" class="btn btn-primary rounded font-md">
            <i class="fas fa-file-excel me-2"></i>Export to Excel
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <form method="GET" action="<?php echo e(route('dealers')); ?>">
            <div class="search-container" style="max-width: 800px; margin: 0 auto;">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control form-control-lg" 
                           placeholder="Search dealers by name, email, or phone..." 
                           value="<?php echo e($search ?? ''); ?>"
                           style="border-radius: 30px 0 0 30px; padding-left: 20px;">
                    <button class="btn btn-primary btn-lg" type="submit" style="border-radius: 0 30px 30px 0; padding: 0 25px;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <?php if($search): ?>
                    <div class="mt-2">
                        <a href="<?php echo e(route('dealers')); ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-times"></i> Clear search
                        </a>
                        <span class="ms-2 text-muted">Search results for: <strong>"<?php echo e($search); ?>"</strong></span>
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <header class="card-header">
        <div class="row align-items-center">
            <!-- Removed the date filter form -->
        </div>
    </header>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover" id="dealerTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Dealer Code</th>
                            <th>Registered Date</th>
                            <th>Total Orders</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $dealers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dealer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($dealers->firstItem() + $index); ?></td>
                                <td><?php echo e($dealer->name); ?></td> 
                                <td><?php echo e($dealer->email); ?></td> 
                                <td><?php echo e($dealer->phone); ?></td>
                                <td><?php echo e($dealer->dealerProfile->dealer_code ?? 'N/A'); ?></td>
                                <td><?php echo e($dealer->created_at->format('Y-m-d')); ?></td> 
                                <td>
                                    
                                    
                                </td> 
                                <td class="text-end">
                                    <a href="<?php echo e(route('dealer-details', $dealer->id)); ?>" class="btn btn-view btn-sm me-2" data-bs-toggle="tooltip" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('dealer.edit', $dealer->id)); ?>" class="btn btn-warning btn-sm me-2" data-bs-toggle="tooltip" title="Edit Dealer">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('dealer.delete', $dealer->id)); ?>" method="POST" class="d-inline" id="delete-form-<?php echo e($dealer->id); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" onclick="confirmDelete('delete-form-<?php echo e($dealer->id); ?>', 'Are you sure you want to deactivate this dealer?')" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Deactivate Dealer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>                                  
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <!-- .col// -->
        </div>
        <!-- .row // -->
    </div>
    <!-- card-body end// -->
</div>
<!-- card end// -->

<!-- Pagination Area -->
<div class="pagination-area mt-30 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            <?php echo e($dealers->appends(request()->input())->links()); ?>  
        </ul>
    </nav>
</div>

<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Initialize DataTables but disable the built-in pagination since we're using Laravel's pagination
        $('#dealerTable').DataTable({
            "paging": false,
            "info": false,
            "searching": false,  // Disable built-in search since we have custom search
            "responsive": true,
            "order": [[0, 'asc']],
            "columnDefs": [
                { "orderable": false, "targets": 7 } // Disable ordering on action column
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/AdminDashboard/dealers.blade.php ENDPATH**/ ?>