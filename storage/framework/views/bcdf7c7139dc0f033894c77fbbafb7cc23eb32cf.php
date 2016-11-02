<?php $__env->startSection('content'); ?>
    <ul class="chat list-unstyled">
        <?php foreach($chat as $msg): ?>
            <li>
                <?php if($msg->sender != auth('admin')->user()->id): ?>
                    <div class="text-left">
                        <span class="text-primary"><b><?php echo e($users->where('id', $msg->sender)->first()->name); ?></b></span><br>
                        <span><?php echo e($msg->message); ?></span><br>
                        <span class="small text-muted"><?php echo e($msg->created_at->format('M d')); ?> at <?php echo e($msg->created_at->format('h:i a')); ?> </span>
                    </div>
                <?php else: ?>
                    <div class="text-right">
                        <span class="text-primary"><b><?php echo e($users->where('id', $msg->sender)->first()->name); ?></b></span><br>
                        <span><?php echo e($msg->message); ?></span><br>
                        <span class="small text-muted"><?php echo e($msg->created_at->format('M d')); ?> at <?php echo e($msg->created_at->format('h:i a')); ?> </span>
                    </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>