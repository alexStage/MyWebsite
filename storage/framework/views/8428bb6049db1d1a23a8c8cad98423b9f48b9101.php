<?php $__env->startSection('content'); ?>
<div class="jumbotron text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-">
                <img src="<?php echo e($voyage->users[0]->photoSlug); ?>" height="100px" width="100pxpx" class="rounded-circle" alt="img">
            </div>
            <div class="col-lg- justify-content"></div>
                <h1 class="jumbotron-heading"><?php echo e($voyage->title); ?></h1>
                <p class="lead text-muted">publié par: <?php echo e($voyage->users[0]->pseudo); ?></p>
                <div class="panel-body">
                    <p class="lead-text"><?php echo e($voyage->description); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/MyWebsite/resources/views/voyages/show.blade.php ENDPATH**/ ?>