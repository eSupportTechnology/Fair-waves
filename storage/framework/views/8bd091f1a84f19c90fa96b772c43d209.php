

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Style for the export button */
        #exportBtn {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
        }
        
        #exportBtn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title">Report - Dealers</h2>
            </div>
            <div>
                <a href="<?php echo e(route('dealers.export', request()->query())); ?>" id="exportBtn" class="btn btn-primary rounded font-md">
                    <i class="fas fa-file-excel me-2"></i>Export to Excel
                </a>
            </div>
        </div>

        <!-- Dealer Report Table -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Dealer Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tableData" class="table table-hover display">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Shop Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Dealer Code</th>
                                        <th>Rank</th>
                                        <th>Tier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $dealers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=> $dealer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index+1); ?></td>
                                        <td><?php echo e($dealer->name ?? 'N/A'); ?></td>
                                        <td><?php echo e($dealer->dealerProfile->dealer_shop_name ?? 'N/A'); ?></td>
                                        <td><?php echo e($dealer->email ?? 'N/A'); ?></td>
                                        <td><?php echo e($dealer->phone ?? 'N/A'); ?></td>
                                        <td><?php echo e($dealer->dealerProfile->dealer_code ?? 'N/A'); ?></td>
                                        <td><?php echo e($dealer->dealerProfile->rank ?? 'N/A'); ?></td>
                                        <td>
                                            <?php if($dealer->dealerProfile && $dealer->dealerProfile->tier): ?>
                                                <span class="badge bg-info text-capitalize"><?php echo e($dealer->dealerProfile->tier); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript to handle DataTable -->
    <script>
        $(document).ready(function() {
            $('#tableData').DataTable({
                // Basic DataTable configuration without export buttons
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            });
        });
    </script>



</body>

</html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/AdminDashboard/Reports/dealer_report.blade.php ENDPATH**/ ?>