

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
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .card-header h4 {
        margin-bottom: 0;
        font-size: 1.1rem;
        font-weight: 600;
    }
</style>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Edit Customer</h2>
    </div>
    <div>
        <a href="<?php echo e(route('customers')); ?>" class="btn btn-light rounded font-md">
            <i class="fas fa-arrow-left"></i> Back to Customers
        </a>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Customer Information</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('customer.update', $customer->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="name" class="form-label">Full Name <i class="text-danger">*</i></label>
                                <input type="text" name="name" id="name" value="<?php echo e(old('name', $customer->name)); ?>" 
                                       placeholder="Enter full name" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address <i class="text-danger">*</i></label>
                                <input type="email" name="email" id="email" value="<?php echo e(old('email', $customer->email)); ?>" 
                                       placeholder="Enter email address" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" id="phone" value="<?php echo e(old('phone', $customer->phone)); ?>" 
                                       placeholder="Enter phone number" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" name="dob" id="dob" value="<?php echo e(old('dob', $customer->dob)); ?>" 
                                       class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="">Select Gender</option>
                                    <option value="male" <?php echo e(old('gender', $customer->gender) == 'male' ? 'selected' : ''); ?>>Male</option>
                                    <option value="female" <?php echo e(old('gender', $customer->gender) == 'female' ? 'selected' : ''); ?>>Female</option>
                                    <option value="other" <?php echo e(old('gender', $customer->gender) == 'other' ? 'selected' : ''); ?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" value="<?php echo e(ucfirst($customer->role)); ?>" class="form-control" readonly />
                                <small class="text-muted">Role cannot be changed</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" placeholder="Enter full address" 
                                  class="form-control" rows="3"><?php echo e(old('address', $customer->address)); ?></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?php echo e(route('customers')); ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Customer Stats</h4>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="p-3 bg-light rounded">
                            
                            
                            <h5 class="mb-1">-</h5> <!-- Placeholder for future Total Orders display -->
                            <small class="text-muted">Total Orders</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="p-3 bg-light rounded">
                            <h5 class="mb-1"><?php echo e($customer->created_at->format('Y-m-d')); ?></h5>
                            <small class="text-muted">Registered</small>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <p class="mb-1"><strong>Customer ID:</strong> #<?php echo e(str_pad($customer->id, 4, '0', STR_PAD_LEFT)); ?></p>
                    <p class="mb-1"><strong>Status:</strong> 
                        <span class="badge bg-success">Active</span>
                    </p>
                    <p class="mb-0"><strong>Last Updated:</strong> <?php echo e($customer->updated_at->format('Y-m-d H:i')); ?></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Quick Actions</h4>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('customer-details', $customer->id)); ?>" class="btn btn-outline-primary">
                        <i class="fas fa-eye"></i> View Details
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('AdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/AdminDashboard/edit-customer.blade.php ENDPATH**/ ?>