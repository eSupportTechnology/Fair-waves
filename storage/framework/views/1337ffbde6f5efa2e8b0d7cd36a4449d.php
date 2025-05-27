<header class="main-header navbar shadow-sm">
                <div class="col-search">
                    
                </div>
                <div class="col-nav">
                    <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
                    <ul class="nav">
                        
                        <li class="nav-item">
                            <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                        </li>
                        
                        <li class="dropdown nav-item">
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false">
                                <img class="img-xs rounded-circle" src="<?php echo e(asset('backend/assets/imgs/people/avatar-2.png')); ?>" alt="User" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                                <a class="dropdown-item" href="<?php echo e(route('mywebsites_page')); ?>">
                                    <i class="material-icons md-perm_identity"></i>Edit Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                
                                <!-- Logout Form -->
                                <form action="<?php echo e(route('aff.logout')); ?>" method="POST" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="material-icons md-exit_to_app"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </header><?php /**PATH D:\DK-Mart\resources\views/AffiliateDashBoard/Header.blade.php ENDPATH**/ ?>