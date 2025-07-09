<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Jquery js -->
<script src="<?php echo e(asset('frontend/assets/js/jquery-3.7.1.min.js')); ?>"></script>
<!-- Bootstrap Bundle Js -->
<script src="<?php echo e(asset('frontend/assets/js/boostrap.bundle.min.js')); ?>"></script>
<!-- Phosphor Icon -->
<script src="<?php echo e(asset('frontend/assets/js/phosphor-icon.js')); ?>"></script>
<!-- Select 2 -->
<script src="<?php echo e(asset('frontend/assets/js/select2.min.js')); ?>"></script>
<!-- Slick js -->
<script src="<?php echo e(asset('frontend/assets/js/slick.min.js')); ?>"></script>
<!-- Jquery UI -->
<script src="<?php echo e(asset('frontend/assets/js/jquery-ui.min.js')); ?>"></script>
<!-- AOS Animation -->
<script src="<?php echo e(asset('frontend/assets/js/aos.js')); ?>"></script>
<!-- Main js -->
<script src="<?php echo e(asset('frontend/assets/js/main.js')); ?>"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<!-- Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

<div class="preloader">
    <img src="<?php echo e(asset('frontend/newstyle/assets/images/logo.png')); ?>" alt="" style="width: 250px;">
</div>

</body>
</html>
<?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/layouts/newfooter.blade.php ENDPATH**/ ?>