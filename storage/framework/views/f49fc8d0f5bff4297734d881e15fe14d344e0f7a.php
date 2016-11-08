<div id="wrapper">
    <!-- Navigation -->
    <?php echo $__env->make('frontend.users.students.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- Page Content -->
    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="<?php echo e(route('studentDashboard')); ?>" class="btn btn-info btn-circle"><span class="fa fa-arrow-left fa-fw"></span></a>  Recommendation Letter
                    </div>
                    <div class="panel-body">
                        <iframe src="<?php echo e(route('showRecommendationLetter', $company_choice->id)); ?>" frameborder="0" width="100%" height="1008"></iframe>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php echo $__env->make('templates.map', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>