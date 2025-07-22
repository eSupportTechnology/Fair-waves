<?php $__env->startSection('dashboard-content'); ?>
<?php if(!Auth::check()): ?>
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
    <?php exit; ?>
<?php endif; ?>
<style>
    .btn-primary {
        background-color: #ff3c00 !important;
        border-color: #ff3c00 !important;
    }

    .form-control:focus, .form-select:focus {
        border-color: hsl(14, 72%, 69%) !important;
        box-shadow: 0 0 0 0.2rem hsla(12, 81%, 40%, 0.251) !important;
    }

    #profileImageInput {
        display: none;
    }

    .profile-image-container {
        position: relative;
        display: inline-block;
    }

    .profile-image-wrapper {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .profile-image-preview {
        cursor: pointer;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .profile-image-preview:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(255, 60, 0, 0.4) !important;
    }

    .profile-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
        font-size: 14px;
    }

    .profile-image-wrapper:hover .profile-image-overlay {
        opacity: 1;
    }

    .profile-image-overlay i {
        font-size: 24px;
        margin-bottom: 5px;
    }

    .upload-success {
        color: #10b981;
        font-weight: 500;
    }

    .upload-error {
        color: #ef4444;
        font-weight: 500;
    }
</style>

<h4 class="px-2 py-2">Edit Profile</h4>
<div class="container p-4">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('user.profile.update')); ?>" method="POST" enctype="multipart/form-data" id="profileForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3 text-center">
            <!-- Profile image preview -->
            <div class="profile-image-container mb-3">
                <div class="profile-image-wrapper" onclick="document.getElementById('profileImageInput').click();">
                    <?php if($user->profile_image): ?>
                        <img src="<?php echo e($user->profile_image_url); ?>" 
                             alt="Profile Image" 
                             class="profile-image-preview" 
                             id="profileImagePreview"
                             style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #ff3c00; cursor: pointer; box-shadow: 0 4px 12px rgba(255, 60, 0, 0.3);">
                    <?php else: ?>
                        <div class="profile-image-placeholder" 
                             id="profileImagePreview"
                             style="width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #ff3c00, #ff6b3d); display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 12px rgba(255, 60, 0, 0.3); color: white; font-size: 60px;">
                            <i class="fas fa-user"></i>
                        </div>
                    <?php endif; ?>
                    <div class="profile-image-overlay">
                        <i class="fas fa-camera"></i>
                        <span>Click to upload</span>
                    </div>
                </div>
            </div>
            
            <p class="text-muted small mb-4">
                <i class="fas fa-info-circle me-1"></i>
                Click on the image to upload a new profile picture<br>
                <small>Accepted formats: JPG, PNG, JPEG (Max: 2MB)</small>
            </p>

            <!-- Hidden file input for image upload -->
            <input type="file" id="profileImageInput" name="profile_image" accept="image/*" style="display: none;">
            
            <!-- Upload status message -->
            <div id="uploadStatus" class="mt-2"></div>
        </div>

        <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input
                type="text"
                class="form-control"
                id="fullName"
                name="full_name"
                value="<?php echo e(old('full_name', $user->name)); ?>"
                placeholder="Enter your full name"
            >
        </div>

        <div class="row ">
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email Address</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="<?php echo e(old('email', $user->email)); ?>"
                    placeholder="Enter your email"
                >
            </div>
            <div class="mb-3 col-md-6">
                <label for="mobile" class="form-label">Mobile</label>
                <input
                    type="tel"
                    class="form-control"
                    id="mobile"
                    name="phone_num"
                    value="<?php echo e(old('phone_num', $user->phone)); ?>"
                    placeholder="Enter your mobile number"
                >
            </div>
        </div>

        <div class="row mt-3">
            <div class="mb-3 col-md-6">
                <label for="birthday" class="form-label">Birthday</label>
                <input
                    type="date"
                    class="form-control"
                    id="birthday"
                    name="date_of_birth"
                    value="<?php echo e(old('date_of_birth', $user->dob)); ?>"
                >
            </div>
            <div class="mb-3 col-md-6">
            <label for="address" class="form-label">Address</label>
            <input
                type="text"
                class="form-control"
                id="address"
                name="address"
                value="<?php echo e(old('address', $user->address)); ?>"
                placeholder="Enter your address"
            >
        </div>
        </div>

        <button type="submit" class="mt-3 btn btn-primary">Save Changes</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileImageInput = document.getElementById('profileImageInput');
    const profileImagePreview = document.getElementById('profileImagePreview');
    const uploadStatus = document.getElementById('uploadStatus');
    
    // Handle file selection
    profileImageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            // Validate file
            if (!validateFile(file)) {
                return;
            }
            
            // Show preview
            showImagePreview(file);
            
            // Show success message
            showStatus('Image selected successfully! Click "Save Changes" to upload.', 'success');
        }
    });
    
    function validateFile(file) {
        // Check file size (2MB limit)
        if (file.size > 2 * 1024 * 1024) {
            showStatus('File size must be less than 2MB', 'error');
            profileImageInput.value = '';
            return false;
        }
        
        // Check file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!allowedTypes.includes(file.type)) {
            showStatus('Please select a valid image file (JPG, PNG, JPEG)', 'error');
            profileImageInput.value = '';
            return false;
        }
        
        return true;
    }
    
    function showImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imageUrl = e.target.result;
            
            // Create new image element
            const newImg = document.createElement('img');
            newImg.src = imageUrl;
            newImg.alt = 'Profile Image';
            newImg.className = 'profile-image-preview';
            newImg.id = 'profileImagePreview';
            newImg.style.cssText = 'width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #ff3c00; cursor: pointer; box-shadow: 0 4px 12px rgba(255, 60, 0, 0.3);';
            
            // Replace current element with new image
            const wrapper = profileImagePreview.parentElement;
            wrapper.replaceChild(newImg, profileImagePreview);
        };
        reader.readAsDataURL(file);
    }
    
    function showStatus(message, type) {
        uploadStatus.innerHTML = `<div class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;
        
        // Auto-hide after 3 seconds
        setTimeout(() => {
            const alert = uploadStatus.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 3000);
    }
    
    // Form submission handler
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        const formData = new FormData(this);
        const file = formData.get('profile_image');
        
        if (file && file.size > 0) {
            console.log('Uploading profile image:', file.name, 'Size:', file.size);
            showStatus('Uploading profile image...', 'info');
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Manulas Doc\Project\Intern\Project\Fair-waves\resources\views/user_dashboard/edit-profile.blade.php ENDPATH**/ ?>