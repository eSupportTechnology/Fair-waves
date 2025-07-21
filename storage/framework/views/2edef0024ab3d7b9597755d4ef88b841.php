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
        <h2 class="content-title card-title">Customers</h2>
    </div>
    <div class="d-flex align-items-center">
        <a href="<?php echo e(route('customers.export', request()->query())); ?>" class="btn btn-primary rounded font-md">
            <i class="fas fa-file-excel me-2"></i>Export to Excel
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <form method="GET" action="<?php echo e(route('customers')); ?>">
            <div class="search-container" style="max-width: 800px; margin: 0 auto;">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control form-control-lg" 
                           placeholder="Search customers by name, email, or phone..." 
                           value="<?php echo e($search ?? ''); ?>"
                           style="border-radius: 30px 0 0 30px; padding-left: 20px;">
                    <button class="btn btn-primary btn-lg" type="submit" style="border-radius: 0 30px 30px 0; padding: 0 25px;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <?php if($search): ?>
                    <div class="mt-2">
                        <a href="<?php echo e(route('customers')); ?>" class="btn btn-sm btn-outline-secondary">
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
                    <table class="table table-hover" id="customerTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Registered Date</th>
                            <th>Total Orders</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($customers->firstItem() + $index); ?></td> <!-- Display correct customer number -->
                                <td><?php echo e($customer->name); ?></td> 
                                <td><?php echo e($customer->email); ?></td> 
                                <td><?php echo e($customer->phone); ?></td> 
                                <td><?php echo e($customer->created_at->format('Y-m-d')); ?></td> 
                                
                                
                                <td>-</td> <!-- Placeholder for future Total Orders column -->
                                <td class="text-end">
                                    <a href="<?php echo e(route('customer-details', $customer->id)); ?>" class="btn btn-view btn-sm me-2" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('customer.edit', $customer->id)); ?>" class="btn btn-warning btn-sm me-2" title="Edit Customer">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" title="Delete Customer"
                                            data-id="<?php echo e($customer->id); ?>"
                                            data-name="<?php echo e($customer->name); ?>"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteCustomerModal">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
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
            <?php echo e($customers->appends(request()->input())->links()); ?>  
        </ul>
    </nav>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTables but disable the built-in pagination since we're using Laravel's pagination
        $('#customerTable').DataTable({
            "paging": false,
            "info": false,
            "searching": false,  // Disable built-in search since we have custom search
            "responsive": true,
            "order": [[0, 'asc']],
            "columnDefs": [
                { "orderable": false, "targets": 6 } // Disable ordering on action column
            ]
        });

        // Delete customer confirmation modal setup
        $('.delete-btn').on('click', function() {
            const customerId = $(this).data('id');
            const customerName = $(this).data('name');
            
            $('#deleteCustomerName').text(customerName);
            $('#deleteCustomerForm').attr('action', '<?php echo e(route("customer.delete", "")); ?>/' + customerId);
        });
    });
</script>

<!-- Delete Customer Confirmation Modal -->
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteCustomerModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-user-slash fa-4x text-danger mb-3"></i>
                    <p class="fs-5">Are you sure you want to delete customer <strong id="deleteCustomerName"></strong>?</p>
                    <p class="text-muted">This will set the customer's status to inactive. They will no longer appear in the customers list.</p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cancel
                </button>
                <form id="deleteCustomerForm" action="" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-1"></i> Delete Customer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/AdminDashboard/customer.blade.php ENDPATH**/ ?>