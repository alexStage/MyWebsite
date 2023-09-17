
<?php $__env->startSection('content'); ?>
<div id="app">
<photos-admin :data-maj="<?php echo e(json_encode($maj)); ?>" :data-photos="<?php echo e(json_encode($photos)); ?>" :data-etiquettes="<?php echo e(json_encode($etiquettes)); ?>"></photos-admin>
</div>

<?php if($maj['missing']!=0||$maj['toDelete']!=0): ?>
</br>
    <div class="alert alert-warning text-center container" role="alert">
        <?php echo e($maj['missing']); ?> photos à ajouter et <?php echo e($maj['toDelete']); ?> photos à supprimer.
        <div class="container-fluid text-center">
            <a target="_self" href="<?php echo e(route('MAJBDD')); ?>"><button class="btn  btn-primary">Mettre à jour la BDD</button></a>
        </div>
    </div>
<?php endif; ?>

<script src="js/app.js"></script>

<?php echo $__env->make('layouts/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/MyWebsite/resources/views/admin/photos.blade.php ENDPATH**/ ?>