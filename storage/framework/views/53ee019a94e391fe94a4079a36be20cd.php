<!DOCTYPE html>
<html lang="en" class="color-two font-exo">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>FAIR WAVES</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('frontend\newstyle\assets\images\Fire Waves LOGO.png')); ?>">

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="<?php echo e(asset('frontend/newstyle/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/newstyle/mobile-nav.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/newstyle/mainmin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/newstyle/responsivemin.css')); ?>">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .bg-main-two-50 {
            background-color: rgba(255, 88, 0, 1) !important;
        }

        .text-main-600 {
            color: rgb(0, 0, 0) !important;
        }

        .bg-main-600 {
            background-color: #ff5800 !important;
        }

        .pagination .page-item.active .page-link {
            background-color: #ff5800 !important;
            border-color: #ff5800 !important;
            color: #ffffff !important;
        }

        .hover-bg-main-600:hover {
            background-color: #ff5800 !important;
        }

        .hover-border-main-600:hover {
            border-color: #ff5800 !important;
        }

        .text-gray-900:hover {
            color: #ff5800 !important;
        }

        .products-btn-set:hover {
            background-color: #ff5800 !important;
        }
    </style>
</head>

<body>
    <?php echo $__env->make('includes.navbar-2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/layouts/newheader.blade.php ENDPATH**/ ?>