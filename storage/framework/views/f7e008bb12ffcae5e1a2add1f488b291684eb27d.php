<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">OJT Monitoring</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?php echo e(route('logout')); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li>
                    <a href="<?php echo e(route('profile')); ?>">
                        <div class="row">
                            <div class="col-md-3 col-sm-2 col-xs-2">
                                <?php if($users->find(auth('admin')->user()->id)->profile->picture): ?>
                                    <img src="<?php echo e(asset($users->find(auth('admin')->user()->id)->profile->picture)); ?>" alt="<?php echo e(auth('admin')->user()->name); ?>" class="img-circle" width="40" height="40" >
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/default.jpg')); ?>" alt="<?php echo e(auth('admin')->user()->name); ?>" class="img-circle" width="40" height="40" >
                                <?php endif; ?>
                            </div>
                            <div class="col-md-9 col-sm-10 col-xs-10">
                                <span class="pull-left"><?php echo e(auth('admin')->user()->name); ?> <br> <span class="small">View Profile</span></span><br>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider">&nbsp;</li>
                <li>
                    <a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo e(route('collectionAdviser')); ?>">Advisers</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('collectionStudent')); ?>">Students</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="<?php echo e(route('signature')); ?>"><i class="fa fa-edit fa-fw"></i> My Signature</a>
                </li>
                <li>
                    <a href="<?php echo e(route('activityLogs')); ?>"><i class="fa fa-list-alt fa-fw"></i> Activity Log</a>
                </li>
                <li>
                    <a href="<?php echo e(route('departments')); ?>"><i class="fa fa-university      fa-fw"></i> Departments</a>
                </li>
            </ul>
        </div>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>