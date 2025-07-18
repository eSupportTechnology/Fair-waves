<?php $__env->startSection('dashboard-content'); ?>
<style>
    h4.py-2.px-2 {
        margin-bottom: 20px; /* Adjust the value to increase or decrease the space */
    }

    .dashboard-header {
        display: flex;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #e0e0e0;
        margin-top: 40px; Increased from 40px to 80px to move it further down */
    }

    .profile-info {
        margin-left: 20px;
    }

    .profile-info h4 {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
    }

    .profile-info p {
        margin: 0;
        font-size: 14px;
        color: #888;
    }

    .orders-section {
        margin-top: 30px;
        padding: 20px;
        border-bottom: 1px solid #e0e0e0;
        margin-bottom: 20px;
    }

    .orders-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .orders-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 100px;
        padding: 10px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .orders-box img {
        width: 40px;
        height: 40px;
        margin-bottom: 8px;
    }

    .orders-box p {
        margin: 0;
        font-size: 14px;
    }

    /* ✅ Responsive Fixes */
    @media (max-width: 576px) {
        .orders-box {
            width: 40%;
        }

        .orders-row {
            gap: 15px;
        }
    }

    @media (max-width: 400px) {
        .orders-box {
            width: 100%;
        }
    }
</style>

<?php if(!Auth::check()): ?>
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
    <?php exit; ?>
<?php endif; ?>



<!-- Dashboard Header -->
<h4 class="px-2 py-2">Dashboard</h4>
<div class="dashboard-header">
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJQAAACUCAMAAABC4vDmAAAAM1BMVEX///+ZmZmVlZXZ2dmQkJDk5OS8vLzo6OjS0tK1tbXz8/P7+/v39/fs7OykpKTHx8eqqqq8lpdBAAAEZUlEQVR4nO1b2ZasIAyUiCLt+v9fe1unZ7pdoBJA23Mu9S4WIQkhS1FkZGRkZGRkZGRkZGRcgO7R98ZUVWVM/+i+zeYJ09R2GhS9oIbJ1o35Hp9HNQ5aP4lsQFrrYaweX6BU1QPpHaE/aBrq6lpG/ag8hP4kpsa+KNqLKFkFGb14KdtfQslMmsfoJa7pfLXv2FL6kNa5bqId98bGoEXjiYplpgBKM/R0mmo12OLctM4RVmfDKT1B9gRWlVTBd6xUcmdaxjH6QZmWUxMpph9Qcz9OaVk1Eh/uhU7GqklFSaWTVZlMTgurJNpesX71G3kykMAztAxGWtmxKctmtApLlVT0/dxCP/6MAj72XuEogmwsqRH9QttNvGQskhaNcZwM+AEdeWno/XVUzNCCWIXUYVhpwBHSFHM5o8MbHO+ox+D/LuYAO8CJnOG3QV+GWyCwPJ8fLMGnwRZo/LtVk+9jFDmHvnGQlnttqEe6Hsap97sDdALg7APdgvUuCuPIU7SqB5wUSKs80PchohqBMx/QAmf4KrRRKP4aXZtyThW69eBG0XWg5YEV2ieOa2FkX0s5oduLIylEynVzOlHBUC36+BRJzw+uiBUdx6xS+xsgqViXwFliA8azCmgEdL5P+5NxQmGwwubHeOprWajAeKiDmBZF0px9bQC9sUJvXc67mmSeipW18+lpi9VcMSz4E93EWdJn0tilzAtMklAd+vPXos4DBMHUL0Q+nWHOP3CwYicjJTEVeiEBVvwEqcQn8ElRvVOLrmYntNwPxwPA6/hj3WkjrBLfUO+PJVeygNTTL6vRvMTVmZGRobqC1JznGGw9jrUdhBUAESnG1bddnptcjCAlWZ82kHx6hvWRXmr+K8wdAdxyl4gUz3mSsmX/2MUKbdeXVvEkJnGejGuGyPqjBMugJbpm8IVM2/zrHgaHGqILGabLBlbdAPpRWZLDH+RRzUykgiy8MMjzhsOSUpQ3UheGw17vKSr5+CIG4cPB88SS5iU8mRLhE8v9kpQX7JwnSNLHqCs7oQNSXcnWcsQJ4s0tcHgGcYLD5dODKoiOOqY4FXTsqYSOJflih0ajA0sq3eFiAVJPKCiHqALWOXrjBtekD7RKh+zwIKYKrKfMOAg7guogu8s0pnS481WBxbVdwSim9JtssW3ai8I5Fe12rVBV2BYhI1Rqv8PgRsu1VoU7hBlrpxDRMLEubMf1OKw9TERhe20zcV1GqwAman/tdA6pqGaJlSWnIxXXVrJShWSkYhtwPh9JcT1i79RsfKvSR1MX1WUE3i5hSNAa+3HBb5M+ErxXSdIYe8dGwXStpwundI2eN2w+vWebbipWKeU0o4xtR5+RuPU7RZP8cMLE0R3HCYooIyTdnDWlEjyiQmeOGYUN86hTh3mKW449zZANiKkrBsRm8Efp9FWjdAst5tBhfR2lBfN4ppsXfWE8c8FrkFVtz5Loa4OsL9xt5PcPy3B0daPh6IyMjIyMjIyMjIyM/wD/AKrlLaHofErWAAAAAElFTkSuQmCC" alt="Profile Image" class="rounded-circle">
    <div class="profile-info">
        <h4><?php echo e($user->name); ?></h4>
    </div>
</div>

<!-- My Orders Section -->
<div class="orders-section">
    <h5>My Orders</h5>
    <div class="orders-row">
        <a href="<?php echo e(route('user.unpaid.orders')); ?>" class="orders-box" style="text-decoration: none; color: inherit;">
            <img src="https://icons.veryicon.com/png/128/miscellaneous/bigmk_app_icon/unpaid-2.png" alt="Unpaid">
            <p>Unpaid</p>
        </a>
        <a href="<?php echo e(route('user.to.be.shipped')); ?>" class="orders-box" style="text-decoration: none; color: inherit;">
            <img src="https://icons.veryicon.com/png/128/miscellaneous/cb/to-be-shipped-25.png" alt="To be shipped">
            <p>To be shipped</p>
        </a>
        <a href="<?php echo e(route('user.shipped.orders')); ?>" class="orders-box" style="text-decoration: none; color: inherit;">
            <img src="https://icons.veryicon.com/png/128/miscellaneous/bigmk_app_icon/in-transit.png" alt="Shipped">
            <p>Shipped</p>
        </a>
        <div class="orders-box">
            <img src="https://icons.veryicon.com/png/128/miscellaneous/document-format/reviewed-5.png" alt="To be reviewed">
            <p>To be reviewed</p>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\pramu\Desktop\GIT Projects\Fair-waves\resources\views/user_dashboard/dashboard.blade.php ENDPATH**/ ?>