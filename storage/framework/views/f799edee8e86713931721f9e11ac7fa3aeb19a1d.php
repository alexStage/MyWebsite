
<?php $__env->startSection('content'); ?>

</br>   
<div class="container">
<ul class="list-group">
  <li class="list-group-item"><a href="<?php echo e(route('admin.users')); ?>" target="_self" >administrer les utilisateurs</a></li>
  <li class="list-group-item"><a href="<?php echo e(route('admin.photos')); ?>" target="_self" >administrer les photos</a></li>
</ul>
</div>

<?php echo $__env->make('layouts/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/MyWebsite/resources/views/admin/index.blade.php ENDPATH**/ ?>