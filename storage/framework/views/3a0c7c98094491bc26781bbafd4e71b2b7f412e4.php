<?php $__env->startSection('content'); ?>
    <ul class="list-unstyled">
        <?php if($permissions->where(['accepted' => 0, 'to' => auth()->user()->id])->count() == 0): ?>
            <li style="padding: 5px 15px 0px 15px;">
                <div>
                    <strong>No Request found</strong>
                </div>
            </li>
        <?php else: ?>
            <?php foreach($sorted_permission as $permit): ?>
                <li style="padding: 5px 15px 0px 15px;">
                    <div>
                        <strong><?php echo e($users->where('id', $permit['user_id'])->first()->name); ?></strong>
                        <span class="pull-right text-muted"><?php echo e($permissions->where('created_at', $permit['created_at'])->first()->created_at->diffForHumans()); ?></span>
                    </div>
                    <div>
                        <?php echo e($permit['request']); ?><br>
                    </div>
                    <br>
                    <div class="text-right">
                        <a href="<?php echo e(route('adminRequestAccept', encrypt($permit['id']))); ?>" class="btn btn-success btn-sm">Accept</a>
                        <a href="<?php echo e(route('adminRequestReject', encrypt($permit['id']))); ?>" class="btn btn-default btn-sm">Reject</a>
                    </div>
                </li>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>