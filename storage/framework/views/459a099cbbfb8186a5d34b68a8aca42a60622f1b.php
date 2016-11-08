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
                            <?php if($users->find(auth()->user()->id)->profile->company_id == 0): ?>
                                Map
                            <?php else: ?>
                                Profile
                            <?php endif; ?>
                        </div>
                        <div class="panel-body">
                            <?php if($users->find(auth()->user()->id)->profile->company_id == 0): ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php echo $__env->make('frontend.users.students.templates.map', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                    <div class="col-md-6">
                                        Company Name: <br>
                                        <strong id="name"> N/A</strong><br><br>
                                        Address: <br>
                                        <strong id="address"> N/A</strong>
                                        <?php echo e(Form::open(['method' => 'post', 'url' => route('studentAddCompany')])); ?>

                                        <?php echo e(Form::hidden('company_name', null, ['id' => 'company_name'])); ?>

                                        <?php echo e(Form::hidden('company_address', null, ['id' => 'company_address'])); ?>

                                        <?php echo e(Form::hidden('company_lat', null, ['id' => 'company_lat'])); ?>

                                        <?php echo e(Form::hidden('company_lng', null, ['id' => 'company_lng'])); ?>

                                        <?php echo e(Form::submit('Add as Company Choice', ['class' => 'btn btn-primary btn-sm pull-right', 'style' => 'display: none', 'id' => 'addCompany'])); ?>

                                        <?php echo e(Form::close()); ?>

                                        <br>
                                        <hr>
                                        <?php if($choices->count() != 0): ?>
                                            <div class="chat-panel panel panel-default">
                                                <div class="panel-heading">Company Choice</div>
                                                <div class="panel-body">
                                                    <table class="table table-striped table-bordered table-hover ">
                                                        <thead>
                                                        <tr class="small">
                                                            <td>Company Name</td>
                                                            <td>Action</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="small">
                                                        <?php foreach($choices as $choice): ?>
                                                            <tr>
                                                                <td><?php echo e($choice->name); ?></td>
                                                                <td>
                                                                    <a href="<?php echo e(route('studentSetCompany', $choice->id)); ?>" class="btn btn-success btn-xs">Set as OJT Company</a>
                                                                    <a href="<?php echo e(route('showRecommendation', $choice->id)); ?>" class="btn btn-primary btn-xs">View Letter</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <span class="fa fa-user fa-fw"></span> Personal Information
                                            </div>
                                            <div class="panel-body">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span class="lead">
                                                            <?php echo e(auth()->user()->name); ?>

                                                        </span><br>
                                                        <span class="small text-muted">
                                                            <span class="fa fa-phone fa fw"></span>&nbsp; 0<?php echo e($users->find(auth()->user()->id)->profile->contact); ?>

                                                        </span><br>
                                                        <span class="small text-muted">
                                                            @&nbsp; <?php echo e(auth()->user()->email); ?>

                                                        </span><br>
                                                        <span class="small text-muted">
                                                            <span class="fa fa-institution fa-fw"></span>&nbsp; <?php echo e($course->code); ?>

                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <span class="fa fa-building fa-fw"></span> Company Information
                                            </div>
                                            <div class="panel-body" style="overflow-y: scroll">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span class="lead">
                                                            <?php echo e($company->find($users->find(auth()->user()->id)->profile->company_id)->first()->name); ?>

                                                        </span><br>
                                                        <span class="small text-muted">
                                                            <span class="fa fa-phone fa fw"></span>&nbsp; 0
                                                        </span><br>
                                                        <span class="small text-muted">
                                                            <span class="fa fa-map-marker fa-fw"></span>&nbsp; <?php echo e($company->find($users->find(auth()->user()->id)->profile->company_id)->first()->address); ?>

                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <span class="fa fa-bar-chart fa-fw"></span> Progress
                                            </div>
                                            <div class="panel-body">
                                                <span class="lead">
                                                    <?php echo e(number_format($progress, 2)); ?>%
                                                </span><br>
                                                        <br>
                                                <span class="small">
                                                    Total Hour(s) Rendered: <?php echo e(number_format($users->find(auth()->user()->id)->profile->number_of_hours_rendered  / 60 / 60, 0)); ?> hrs <br>
                                                    No. of Training Hours Required: <?php echo e($hours->hours); ?> hrs
                                                </span><br>&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="chat-panel panel panel-default" style="">
                                            <div class="panel-heading">
                                                <span class="fa fa-clock-o fa-fw"></span> DTR <span class="small text-muted">(Daily Time Record)</span>
                                            </div>
                                            <div class="panel-body">

                                                <div id="loadingCoordinates" class="panel-body text-center" style="display:none;position: absolute;top: 0; left: 0;width: 100%;height: 100%; background-color: #e2e2e2;z-index: 1;opacity: 0.8">
                                                    <br><span class="lead">
                                                        Please wait for a while ... <br>
                                                        <span class="small text-muted">We're fetching your coordinates</span>
                                                    </span>
                                                </div>
                                                <div class="well well-md">
                                                    <?php echo e(Form::open(['method' => 'post', 'url' => route('timeIn')])); ?>

                                                    <?php echo e(Form::hidden('myLat', null, ['id' => 'myLat'] )); ?>

                                                    <?php echo e(Form::hidden('myLng', null, ['id' => 'myLng'] )); ?>

                                                    <span class="text-danger" id="coordinatesAlert">
                                                        <?php if(session()->has('far')): ?>
                                                            <?php echo e(session()->get('far')); ?>

                                                        <?php endif; ?>
                                                    </span><br>
                                                    <div class="btn-group">
                                                        <?php if($today_record->count() != 0): ?>
                                                        <button type="submit" class="btn <?php echo e($today_record->first()->status == 1 ? 'btn-default disabled' : 'btn-success'); ?>" id="btnTimeIn" <?php echo e($today_record->first()->status == 1 ? 'disabled' : ''); ?>> <span class="fa fa-clock-o fa-fw"></span> Time-in</button>
                                                        <a data-toggle="modal" data-target="#timeOutModal" class="btn <?php echo e($today_record->first()->status == 1 ? 'btn-danger' : 'disabled btn-default'); ?>"> <span class="fa fa-sign-out fa-fw"></span>Time out</a>
                                                        <?php else: ?>
                                                            <button type="submit" class="btn btn-success" id="btnTimeIn"> <span class="fa fa-clock-o fa-fw"></span> Time-in</button>
                                                            <a data-toggle="modal" data-target="#timeOutModal" class="btn disabled btn-default"> <span class="fa fa-sign-out fa-fw"></span>Time out</a>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php echo e(Form::close()); ?>


                                                </div>
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <td>Date</td>
                                                            <td>Time-in</td>
                                                            <td>Time-out</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($dtr as $time_record): ?>
                                                            <tr>
                                                                <td><?php echo e($time_record->date); ?></td>
                                                                <td><?php echo e($time_record->created_at->format('h:i:s a')); ?></td>
                                                                <td><?php echo e($time_record->updated_at->format('h:i:s a')); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="chat-panel panel panel-default">
                                            <div class="panel-heading">
                                                users
                                            </div>
                                            <div class="panel-body">
                                                &nbsp;
                                                <?php echo e(Carbon\Carbon::now()->diffInWeeks(\Carbon\Carbon::create(2016, 10, 31 ))); ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <div class='modal fade' id='timeOutModal' role='dialog'>
                            <div class='modal-dialog modal-sm'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                        <h4 class='modal-title'>Time-out</h4>
                                    </div>
                                    <div class='modal-body'>
                                        <div class="article">

                                           <span class="fa fa-exclamation-triangle fa-3x pull-left text-danger"></span>
                                            <?php if($today_record->first()->created_at->diffInHours(Carbon\Carbon::now()) < 8): ?>
                                                <span class="text-danger small">This will be register as UNDERTIME</span><br>
                                            <?php endif; ?>
                                            Are you sure you want to Time out ?
                                            <br>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <div class="pull-right">
                                            <a href="<?php echo e(route('timeOut')); ?>" class="btn btn-danger btn-md"> Yes</a>
                                            <button type='button' class='btn btn-primary' data-dismiss='modal'> No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <?php /*<script>*/ ?>
                                <?php /*window.onload = function () {*/ ?>
                                    <?php /*navigator.geolocation.getCurrentPosition(c);*/ ?>
                                    <?php /*return false;*/ ?>
                                <?php /*}*/ ?>

                                <?php /*var c = function (pos) {*/ ?>
                                    <?php /*var myLat = pos.coords.latitude;*/ ?>
                                    <?php /*var myLng = pos.coords.longitude;*/ ?>

                                    <?php /*document.getElementById('myLat').value=myLat;*/ ?>
                                    <?php /*document.getElementById('myLng').value=myLng;*/ ?>
                                    <?php /*var deg2rad = Math.PI/180;*/ ?>
<?php /*//                                    var latFrom = myLat * deg2rad;*/ ?>
<?php /*//                                    var lngFrom = myLng * deg2rad;*/ ?>
                                    <?php /*var latFrom = 0.25814353388146; //tentative , to test time-in*/ ?>
                                    <?php /*var lngFrom = 2.1131014365963;*/ ?>
                                    <?php /*var latTo = <?php echo e(deg2rad($company->find($users->find(auth()->user()->id)->profile->company_id)->first()->latitude)); ?>;*/ ?>
                                    <?php /*var lngTo = <?php echo e(deg2rad($company->find($users->find(auth()->user()->id)->profile->company_id)->first()->longitude)); ?>;*/ ?>
                                    <?php /*var earthRadius = 6371000;*/ ?>

                                    <?php /*var latDelta = latTo - latFrom;*/ ?>
                                    <?php /*var lngDelta = lngTo - lngFrom;*/ ?>
                                    <?php /*var angle = 2 * Math.asin(Math.sqrt(Math.pow(Math.sin(latDelta / 2), 2) + Math.cos(latFrom) * Math.cos(latTo) * Math.pow(Math.sin(lngDelta / 2), 2)));*/ ?>
                                    <?php /*var distance = angle * earthRadius;*/ ?>

                                    <?php /*if(distance > 50){*/ ?>
                                        <?php /*document.getElementById('btnTimeIn').setAttribute('disabled', 'true');*/ ?>
                                        <?php /*document.getElementById('coordinatesAlert').innerHTML="Too far from the company";*/ ?>
                                    <?php /*}*/ ?>

                                    <?php /*if(document.getElementById('myLat').value != 0){*/ ?>
                                        <?php /*document.getElementById('loadingCoordinates').setAttribute('style', 'display: none');*/ ?>
                                    <?php /*}*/ ?>

                                <?php /*}*/ ?>
                            <?php /*</script>*/ ?>
                        <?php endif; ?>
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