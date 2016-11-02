<?php $__env->startSection('content'); ?>
    <ul class="list-unstyled">
        <?php if($notifications->where(['removed' => 0, 'to' => auth()->user()->id])->count() == 0): ?>
            <li style="padding: 5px 15px 0px 15px;">
                <div>
                    <strong>No Notifications found</strong>
                </div>
            </li>
        <?php else: ?>
            <?php foreach($sorted_notifications as $notif): ?>
                <li style="padding: 5px 15px 0px 15px;">
                    <div>
                        <strong><?php echo e($users->where('id', $notif['poser'])->first()->name); ?></strong>
                        <span class="pull-right text-muted"><?php echo e($notifications->where('created_at', $notif['created_at'])->first()->created_at->diffForHumans()); ?>

                            <a href="<?php echo e(route('adviserRemoveNotification', encrypt($notif['id']))); ?>"><i class="fa fa-times fa-fw pull-right"></i></a></span>
                    </div>
                    <div>
                        <br>
                        <?php echo e($notif['event']); ?><br>
                    </div>
                </li>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>