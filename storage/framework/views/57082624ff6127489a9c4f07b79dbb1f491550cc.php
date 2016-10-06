<div class="profile">
    <div class="profile_pic">
        <img src="<?php echo e(asset("images/img.jpg")); ?>" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo e($current_user->name); ?></h2>
    </div>
</div>