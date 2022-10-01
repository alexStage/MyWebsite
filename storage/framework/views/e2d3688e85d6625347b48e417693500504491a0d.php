
<?php $__env->startSection('content'); ?>

<?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class="container-fluid text-center">
        <a href="<?php echo e(Storage::disk('downloads')->url($file)); ?>" download="<?php echo e($file); ?>"><?php echo e($file); ?></a>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dhaen\Documents\programmation\MyWebsite\resources\views/downloads/show.blade.php ENDPATH**/ ?>