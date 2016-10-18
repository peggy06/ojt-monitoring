<?php $__env->startSection('content'); ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php echo $__env->make('backend.admin.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- Page Content -->
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Profile</h1>

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4><i class="fa fa-user fa-fw"></i> User Profile</h4>

                        </div>


                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <?php if($users->find(auth('admin')->user()->id)->profile->picture): ?>
                                    <img src="<?php echo e(asset($users->find(auth('admin')->user()->id)->profile->picture)); ?>" alt="<?php echo e(auth('admin')->user()->name); ?>" class="img-thumbnail" width="200" height="200">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/default.jpg')); ?>" alt="<?php echo e(auth('admin')->user()->name); ?>" class="img-thumbnail" width="200" height="200">
                                <?php endif; ?>
                                <br><br>
                                <div class="panel panel-primary">
                                    <div class="panel-heading" id="dpTrigger">
                                        <button style="border: transparent;background: transparent" ><span class="fa fa-image fa-fw"></span>Change Profile Picture</button>
                                    </div>
                                    <div class="panel-body" style="display: none" id="dpChangePanel">
                                        <?php echo $__env->make('backend.admin.templates.dpChangePanel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="dataTable_wrapper">
                                    <?php if(session()->has('success')): ?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <?php echo e(session()->get('success')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td><?php echo e(auth('admin')->user()->name); ?></td>
                                            <td><a href=""><span class="small"><span class="fa fa-edit fa-fw "></span> Change name</span></a></td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td ><?php echo e(auth('admin')->user()->email); ?></td>
                                            <td><a href="<?php echo e(route('setEmail')); ?>"><span class="small"><span class="fa fa-edit fa-fw "></span> Change email</span></a></td>
                                        </tr>
                                        <tr>
                                            <td>Password:</td>
                                            <td>******</td>
                                            <td><a href="<?php echo e(route('setPass')); ?>"><span class="small"><span class="fa fa-edit fa-fw "></span> Change password</span></a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#dpTrigger").click(function(){
                $("#dpChangePanel").slideToggle("slow");
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>