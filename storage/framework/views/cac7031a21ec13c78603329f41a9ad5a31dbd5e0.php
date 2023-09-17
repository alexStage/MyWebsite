<?php $__env->startSection('content'); ?>
<p>zizi</p>
<div class="app">
    <photo-profile-form :data-user="<?php echo e(json_encode($user)); ?>"></photo-profile-form>
</div>
<script src="js/app.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/MyWebsite/resources/views/users/show.blade.php ENDPATH**/ ?>