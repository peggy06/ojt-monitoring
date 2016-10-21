<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>OMS</title>
    <!-- Bootstrap core CSS -->

    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset("fonts/css/font-awesome.min.css")); ?>" rel="stylesheet">
    <link href="<?php echo e(asset("css/animate.min.css")); ?>" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo e(asset("css/custom.css")); ?>" rel="stylesheet">
    <link href="<?php echo e(asset("css/icheck/flat/green.css")); ?>" rel="stylesheet">


    <script src="<?php echo e(asset("js/jquery.min.js")); ?>"></script>

    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-md">

<!--Main Content-->
<div class="container body">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="<?php echo e(asset("js/bootstrap.min.js")); ?>"></script>
<!-- chart js -->
<?php /*<script src="<?php echo e(asset("js/chartjs/chart.min.js")); ?>"></script>*/ ?>
<!-- bootstrap progress js -->
<?php /*<script src="<?php echo e(asset("js/progressbar/bootstrap-progressbar.min.js")); ?>"></script>*/ ?>
<?php /*<script src="<?php echo e(asset("js/nicescroll/jquery.nicescroll.min.js")); ?>"></script>*/ ?>
<!-- icheck -->
<script src="<?php echo e(asset("js/icheck/icheck.min.js")); ?>"></script>

<script src="<?php echo e(asset("js/custom.js")); ?>"></script>

<!-- moris js -->
<?php /*<script src="<?php echo e(asset("js/moris/raphael-min.js")); ?>"></script>*/ ?>
<?php /*<script src="<?php echo e(asset("js/moris/morris.js")); ?>"></script>*/ ?>
<?php /*<script src="<?php echo e(asset("js/moris/example.js")); ?>"></script>*/ ?>
</body>
</html>