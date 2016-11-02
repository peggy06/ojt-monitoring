<?php $__env->startSection('content'); ?>

        <?php echo $__env->make('backend.admin.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Course and Section</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4><span class="fa fa-university fa-fw"></span>Course and Section | <span class="small">Note: You can add or remove the availability of course and section.</span></h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-8 col-sm-12 col-xs-12">
                                    <div class="chat-panel panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-7 col-xs-7">
                                                    <span class="fa fa-graduation-cap fa-fw"></span> Course
                                                </div>
                                                <div class="col-md-6 col-sm-5 col-xs-5">
                                                    <div class="tooltip-demo pull-right">
                                                        <button class="btn btn-success btn-circle small" data-toggle="tooltip" data-placement="top" title="Add Course" id="courseTrigger">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="panel-body">
                                            <div class="dataTable_wrapper">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                    <th>Title</th>
                                                    <th>Available</th>
                                                    <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach( $course->all() as $course): ?>
                                                        <tr class="odd gradeX">
                                                            <td><?php echo e($course->name); ?></td>
                                                            <td>
                                                                <?php if($course->available == 1): ?>
                                                                    <?php echo e('YES'); ?>

                                                                <?php else: ?>
                                                                    <?php echo e('NO'); ?>

                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($course->available == 1): ?>
                                                                    <a href="">Remove</a>
                                                                <?php else: ?>
                                                                    <a href="">Add</a>
                                                                <?php endif; ?>

                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="chat-panel panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-7 col-xs-7">
                                                    <span class="fa fa-tag fa-fw"></span> Sections
                                                </div>
                                                <div class="col-md-6 col-sm-5 col-xs-5">
                                                    <div class="tooltip-demo pull-right">
                                                        <button class="btn btn-success btn-circle small" data-toggle="tooltip" data-placement="top" title="Add Section" id="sectionTrigger">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="panel-body">
                                            <?php if(session()->has('failed-section')): ?>
                                                <div class="text-danger text-center">
                                                    <?php echo e(session()->get('failed')); ?>

                                                </div>
                                            <?php endif; ?>
                                            <div class="well well-sm"  id="addSection" style="display: none">
                                                <?php echo e(Form::open(['method' => 'post', 'url' => route('adminAddSection')])); ?>

                                                <fieldset>
                                                    <div class="form-group <?php echo e($errors->has('section') ? 'has-error' : ""); ?>">
                                                        <?php echo $errors->first('section', '<span class="text-danger">:message</span>'); ?>

                                                        <?php echo e(Form::text('section', null, ['placeholder' => 'Section /[A-Z]/', 'class' => 'form-control'])); ?>

                                                    </div>
                                                    <?php echo e(Form::submit('Add', ['class' => 'btn btn-primary btn-sm pull-right'])); ?>

                                                </fieldset>
                                                <?php echo e(Form::close()); ?>

                                            </div>
                                            <div class="dataTable_wrapper">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                    <th>Section</th>
                                                    <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach( $section->all() as $section): ?>
                                                        <tr class="odd gradeX">
                                                            <td><?php echo e($section->section); ?></td>
                                                            <td>
                                                                <a href="<?php echo e(route('adminRemoveSection', encrypt($section->id))); ?>" class="text-danger">Remove</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
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
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

<script>
    $(document).ready(function () {
        $("#sectionTrigger").click(function () {
            $("#addSection").fadeToggle("slow");
        })
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>