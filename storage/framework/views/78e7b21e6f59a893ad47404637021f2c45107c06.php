
<?php $__env->startSection('content'); ?>
    <div id="app">
        <directories-item :data-directories=<?php echo json_encode($directories); ?>></directories-item>
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
<script src="<?php echo e(asset('js/button-folder.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/MyWebsite/resources/views/archive/index.blade.php ENDPATH**/ ?>