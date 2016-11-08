<?php $__env->startSection('content'); ?>
    <script>
        function printDocument(){
            document.getElementById('printer').setAttribute('style', 'display: none');
            window.print();

            document.getElementById('printer').setAttribute('style', 'margin-right: 80px; display: block');
        }
    </script>
    <a href="javascript:printDocument()" class="pull-right btn btn-success btn-sm" id="printer" style="margin-right: 80px;"><span class="fa fa-print "></span> Print</a>
    <div style="background-color: #5e5e5e">
        <div class="legal margin-default">
            <img src="<?php echo e(asset('images/bsu_logo.jpeg')); ?>" alt="" width="90" class="logo">
            <div class="text-center">
                       <p>
                           <i style="font-size: 12pt">Republic of the Philippines</i><br>
                           <b style="font-size: 16pt">Bulacan State University</b><br>
                           <b style="font-size: 18pt">Sarmiento Campus</b><br>
                           <i style="font-size: 12pt">City of San Jose del Monte Bulacan</i><br>
                           <i style="font-size: 12pt">Tel. / Fax 044-691-63-67</i><br><br>
                       </p>
                <hr style="border: double">

            </div>
            <br>
            <br>
            <br>
            <br>
            <?php echo e(Carbon\Carbon::now()->format('F d, Y')); ?>

            <br>
            <br>
            <b><?php echo e($company_choice->name); ?></b> <br>
                <div style="padding-right: 400px;"><?php echo e($company_choice->address); ?></div>
            <br>
            <br>
            <br>
            <br>
            Sir/Madam:
            <br>
            <br>
            <p class="text-justify">
                In pursuance with the University's objective to upgrade the skills of its Information Technology students, the undersigned request your good office that the students be accommodated for their ON-THE-JOB TRAINING in your establishment.
            </p>
            <br>
            <p class="text-justify">
                As a major requirement of the course, they are to undergo training for <b><?php echo e($hours->hours); ?> hours</b> during the Second Semester of the School Year <?php echo e($hours->academicYear); ?>. All pertinent records shall be submitted to your good office at the commencement of their training.
            </p>
            <br>
            <p class="text-justify">
                The undersigned wishes to take this opportunity to extend sincere appreciation for your kind support on the In-Plant-Training Program of the University.
            </p>
            <br>
            <br>
            <br>
            <br>
            <b>Very truly yours,</b><br><br>
            <b><ins>DR. CECILIA GASCON</ins></b><br>
            <span class="center-block">University President</span><br>
            <br>
            <br>
            <b>By:</b> <br>
            <br><ins><b><?php echo e(strtoupper($users->where('id', auth()->user()->under_to)->first()->name)); ?></b></ins><br>
            OJT Coordinator

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>