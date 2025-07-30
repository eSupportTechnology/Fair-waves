<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="en">

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
            <h2 class="content-title">Report - Orders</h2>
        </div>

        <!-- Room Form -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Room Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tableData" class="table table-hover display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>   
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index+1); ?></td>
                                        <td><?php echo e($order->order_code); ?></td>
                                        <td><b><?php echo e($order->customer_name); ?></b></td>
                                        <td><?php echo e($order->phone); ?></td>
                                        <td>Rs. <?php echo e(number_format($order->total_cost, 2)); ?></td>
                                        <td><?php echo e($order->payment_status); ?></td>
                                        <td><?php echo e($order->date); ?></td>
                                        <td>
                                            <span class="status 
                                    <?php echo e(strtolower(str_replace(' ', '-', $order->status))); ?>">
                                                <?php echo e($order->status); ?>

                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div>
                                                <a href="<?php echo e(route('order-details', $order->order_code)); ?>" class="btn btn-view btn-sm me-2">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                            </div>
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

    <!-- JavaScript to handle delete confirmation -->
    <script>
        $(document).ready(function() {
            var table = $('#tableData').DataTable({
                dom: 'Bfrtip', // Layout for DataTables with Buttons
                buttons: [{
                        extend: 'copyHtml5',
                        footer: true
                    },
                    {
                        extend: 'excelHtml5',
                        footer: true
                    },
                    {
                        extend: 'csvHtml5',
                        footer: true
                    },
                    {
                        extend: 'pdfHtml5',
                        footer: true,
                        title: 'Order Report',
                        customize: function(doc) {
                            // Set a margin for the footer
                            doc.content[1].margin = [0, 0, 0, 20];
                        }
                    },
                    {
                        extend: 'print',
                        footer: true,
                        title: 'Order Report',
                    }
                ],

            });


        });
    </script>

<style>
    .status.packed {
        background-color: #0275d8; /* Blue for Packed */
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* Pickup Done Status */
    .status.pickup-done {
        background-color: #5bc0de; /* Light Blue for Pickup Done */
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* Ready to Ship Status */
    .status.ready-to-ship {
        background-color: #f0ad4e; /* Orange for Ready to Ship */
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* In Transit Status */
    .status.in-transit {
        background-color: #6f42c1; /* Purple for In Transit */
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }
</style>



</body>

</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/AdminDashboard/Reports/order_report.blade.php ENDPATH**/ ?>