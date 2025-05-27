
<!DOCTYPE html>
<html lang="en" class="color-two font-exo">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> DK-Mart</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('frontend/assets/images/web-app-manifest-192x192.png')); ?>">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/bootstrap.min.css')); ?>">
    <!-- select 2 -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/select2.min.css')); ?>">
    <!-- Slick -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/slick.css')); ?>">
    <!-- Jquery Ui -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/jquery-ui.css')); ?>">
    <!-- animate -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/animate.css')); ?>">
    <!-- AOS Animation -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/aos.css')); ?>">
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/main.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />


</head>

<body>


<?php echo $__env->make('includes.navbar-2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 <!-- ============================ Banner Section start =============================== -->
    <?php echo $__env->yieldContent('content'); ?>
    
    <div class="preloader">
        <img src="<?php echo e(asset('frontend/assets/images/logo/preloader-new1.png')); ?>" alt="" style="width: 150px;">
    </div>

    <script>
                document.addEventListener('DOMContentLoaded', function() {
                    <?php if(session('success')): ?>
                        Swal.fire({
                            title: 'Success!',
                            text: "<?php echo e(session('success')); ?>",
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        Swal.fire({
                            title: 'Error!',
                            text: "<?php echo e(session('error')); ?>",
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });
                    <?php endif; ?>
                });

            </script>
  </div>

    <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



    <!-- Jquery js -->
    <script src="<?php echo e(asset('frontend/assets/js/jquery-3.7.1.min.js')); ?>"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="<?php echo e(asset('frontend/assets/js/bootstrap.bundle.min.js')); ?>"></script>
     <!-- Phosphor Icon -->
     <script src="<?php echo e(asset('frontend/assets/js/phosphor-icon.js')); ?>"></script>
    <!-- Select 2 -->
    <script src="<?php echo e(asset('frontend/assets/js/select2.min.js')); ?>"></script>
    <!-- Slick js -->
    <script src="<?php echo e(asset('frontend/assets/js/slick.min.js')); ?>"></script>
    <!-- Count Down js -->
    <script src="<?php echo e(asset('frontend/assets/js/count-down.js')); ?>"></script>
    <!-- jQuery UI js -->
    <script src="<?php echo e(asset('frontend/assets/js/jquery-ui.js')); ?>"></script>
     <!-- Wow js -->
     <script src="<?php echo e(asset('frontend/assets/js/wow.min.js')); ?>"></script>
    <!-- AOS Animation -->
    <script src="<?php echo e(asset('frontend/assets/js/aos.js')); ?>"></script>
    <!-- Marquee -->
    <script src="<?php echo e(asset('frontend/assets/js/marque.min.js')); ?>"></script>
     <!-- Vanilla Tilt -->
     <script src="<?php echo e(asset('frontend/assets/js/vanilla-tilt.min.js')); ?>"></script>
    <!-- Counter -->
    <script src="<?php echo e(asset('frontend/assets/js/counter.min.js')); ?>"></script>
    <!-- Main js -->
    <script src="<?php echo e(asset('frontend/assets/js/main.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.has-sub-submenu').forEach(item => {
    item.addEventListener('mouseenter', () => {
        const submenu = item.querySelector('.sub-submenu-column');
        submenu.style.visibility = 'visible';
        submenu.style.opacity = '1';
    });
    item.addEventListener('mouseleave', () => {
        const submenu = item.querySelector('.sub-submenu-column');
        submenu.style.visibility = 'hidden';
        submenu.style.opacity = '0';
    });
});
</script>
<script>
    $(document).ready(function() {
        $.get("<?php echo e(route('cart.count')); ?>", function(data) {
            if (data.cart_count !== undefined) {
                $('#cart-count').text(data.cart_count);
            }
        });

    });
</script>
<script>
    $(document).ready(function() {
        $.get("<?php echo e(route('wishlist.count')); ?>", function(data) {
            if (data.wishlist_count !== undefined) {
                $('#wishlist-count').text(data.wishlist_count);
            }
        });
    });
</script>

</body>

</html><?php /**PATH D:\DK-Mart\resources\views/frontend/master.blade.php ENDPATH**/ ?>