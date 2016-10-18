<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo e(isset($page_title) ? $page_title : "BulSU-OJT Monitoring"); ?></title>
	<!-- My Custom CSS -->
	<link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">

	<!-- Plugins Bootstrap Core CSS -->
	<link href="<?php echo e(asset('plugins/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">

	<!-- Plugins MetisMenu CSS -->
	<link href="<?php echo e(asset('plugins/metisMenu/dist/metisMenu.min.css')); ?>" rel="stylesheet">

	<!-- Plugins Custom CSS -->
	<link href="<?php echo e(asset('plugins/css/sb-admin-2.css')); ?>" rel="stylesheet">

	<!-- Plugins Custom Fonts -->
	<link href="<?php echo e(asset('plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- Plugins jQuery -->

	<script src="<?php echo e(asset('plugins/jquery/dist/jquery.min.js')); ?>"></script>

</head>

<body>

<?php echo $__env->yieldContent('content'); ?>


<!-- Plugins Bootstrap Core JavaScript -->
<script src="<?php echo e(asset('plugins/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>

<!-- Plugins Metis Menu Plugin JavaScript -->
<script src="<?php echo e(asset('plugins/metisMenu/dist/metisMenu.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')); ?>"></script>

<!-- Plugins Custom Theme JavaScript -->
<script src="<?php echo e(asset('plugins/js/sb-admin-2.js')); ?>"></script>
<script>
	$(document).ready(function() {
		$('#dataTables-example').DataTable({
			responsive: true
		});
	});
</script>
<script>
	$('.tooltip-demo').tooltip({
		selector: "[data-toggle=tooltip]",
		container: "body"
	})

	// popover demo
	$("[data-toggle=popover]")
			.popover()
</script>


</body>

</html>
