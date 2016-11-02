<?php $__env->startSection('content'); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php echo $__env->make('backend.admin.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chat</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4><i class="fa fa-comments-o fa-fw"></i> Messages</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                    <div class="chat-panel panel panel-default" id="chat">
                                        <div class="panel-heading">
                                            <i class="fa fa-user fa-fw"></i>
                                            <?php echo e($users->where(['id' => $id])->first()->name); ?>

                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <ul class="chat list-unstyled">
                                                <?php if($chat->count() != 0): ?>
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
                                                <?php else: ?>
                                                    <li>
                                                        <div class="text-center text-muted">Send a message to say hello!</div>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        <!-- /.panel-body -->
                                        <div class="panel-footer">
                                                <?php echo e(Form::open(['method' => 'post', 'url' => route('adminMessageSend', [encrypt($id), $chat_id])])); ?>

                                                <div class="input-group">
                                                    <?php echo e(Form::text('message', null, ['id' => 'btn-input', 'class' => 'form-control input-sm', 'rows' => '1'])); ?>

                                                    <span class="input-group-btn">
                                                        <button class="btn btn-primary btn-sm" id="btn-chat">
                                                            Send
                                                        </button>
                                                    </span>
                                                </div>
                                                <?php echo e(Form::close()); ?>

                                        </div>
                                    </div>
                                    <!-- /.panel .chat-panel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>