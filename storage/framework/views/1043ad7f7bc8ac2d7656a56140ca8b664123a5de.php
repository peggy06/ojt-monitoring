<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('frontend.users.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
        <a href="" id="get_coords">Get Coordinates</a>
        <div id="map">
            <?php echo e(Form::open(['method' => 'post', 'url' => route('location') ])); ?>

            <?php echo e(Form::input('text', 'latitude',null, ['class' => 'form-control', 'placeholder' => 'Email', 'id' => 'latitude'])); ?>

            <?php echo e(Form::input('text', 'longitude',null, ['class' => 'form-control', 'placeholder' => 'Email', 'id' => 'longitude'])); ?>

            <?php echo e(Form::input('text', 'searchmap',null, ['class' => 'form-control', 'id' => 'searchmap'])); ?>

            <?php echo e(Form::submit('Get Address')); ?>

            <?php echo e(Form::close()); ?>

        </div>
    </div>

    <div id="dvMap" style="width: 300px; height: 300px">
    </div>

    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">


        var searchBox = google.maps.places.SearchBox(document.getElementById('searchmap'))
    </script>

    <script>
        var c = function (pos) {
            var     _lat = pos.coords.latitude,
                    _lng = pos.coords.longitude;

            document.getElementById('latitude').setAttribute('value', ""+ _lat);
            document.getElementById('longitude').setAttribute('value', ""+ _lng);
        }
        window.onload = function () {
            navigator.geolocation.getCurrentPosition(c);
            return false;
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>