

<?php $__env->startSection('content'); ?>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Inquiries</h2>
    </div>
</div>

<div class="card mb-4">
    <header class="card-header">
        <div class="row align-items-center">
            <div class="col-md-2 col-6">
                <form method="GET" action="<?php echo e(route('admin.customer.inquiries')); ?>">
                    <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="form-control" />
            </div>
            <div class="col-md-2 col-6">
                <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="form-control" />
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            </form>
        </div>
    </header>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($inquiry->full_name); ?></td>
                                <td><?php echo e($inquiry->created_at->format('d.m.Y')); ?></td>
                                <td><?php echo e($inquiry->subject); ?></td>
                                <td>
                                    <span class="badge bg-warning"><?php echo e($inquiry->status); ?></span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-view btn-sm me-2" onclick="showInquiryModal('<?php echo e($inquiry->customer_name); ?>', '<?php echo e($inquiry->id); ?>', '<?php echo e($inquiry->subject); ?>', '<?php echo e($inquiry->message); ?>', '<?php echo e($inquiry->reply ?? ''); ?>')">
                                        <i class="fas fa-file"></i>
                                    </a>
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


<!-- Customer Inquiry Modal -->
<div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="inquiryModalLabel">Inquiry Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <strong class="fw-bold">Customer Name:</strong> <span id="customerName"></span>
                </div>
                <div class="mb-1">
                    <strong class="fw-bold">Subject:</strong> <span id="inquirySubject"></span>
                </div>
                <div class="mt-3 mb-3">
                    <strong class="fw-bold">Message:</strong>
                    <p id="inquiryMessage"></p>
                </div>
                <form id="replyForm" action="<?php echo e(route('admin.inquiries.reply', ['id' => ':inquiryId'])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="replyMessage" class="form-label fw-bold">Reply</label>
                        <textarea class="form-control" id="replyMessage" name="replyMessage" rows="4" placeholder="Type your reply..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Response</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
   function showInquiryModal(customerName, inquiryId, subject, message, existingReply = '') {
    document.getElementById('customerName').innerText = customerName;
    document.getElementById('inquirySubject').innerText = subject;
    document.getElementById('inquiryMessage').innerText = message;

    // Set the reply textarea value to the existing reply (if any)
    document.getElementById('replyMessage').value = existingReply;

    const modal = new bootstrap.Modal(document.getElementById('inquiryModal'));
    modal.show();

    // Set the action URL of the reply form dynamically
    const form = document.getElementById('replyForm');
    form.action = form.action.replace(':inquiryId', inquiryId);
}

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DK-Mart\resources\views/AdminDashboard/inquiries.blade.php ENDPATH**/ ?>