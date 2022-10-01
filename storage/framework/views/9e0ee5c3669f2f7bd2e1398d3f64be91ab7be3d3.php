
<?php $__env->startSection('content'); ?>
<div id="app">
<photos-search :data-etiquettes="<?php echo e(json_encode($etiquettes)); ?>"></photos-search>
</div>

<script src="js/app.js"></script>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
    //$("#btnIcon").toggleClass("fas fa-angle-double-right");
    if(document.getElementById('btnIcon').className=="fas fa-angle-double-left"){
        document.getElementById('btnIcon').className="fas fa-angle-double-right";
    }else if(document.getElementById('btnIcon').className=="fas fa-angle-double-right"){
        document.getElementById('btnIcon').className="fas fa-angle-double-left";
    }
    $("#wrapper").toggleClass("toggled");
    });
</script>
<!-- <script src="<?php echo e(asset('js/baguetteBox.min.js')); ?>" ></script>
<script> baguetteBox.run('.tz-gallery') </script> -->
<?php echo $__env->make('layouts/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dhaen\Documents\programmation\MyWebsite\resources\views/search/photos.blade.php ENDPATH**/ ?>