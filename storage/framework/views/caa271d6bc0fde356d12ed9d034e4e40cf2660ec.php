
<?php $__env->startSection('content'); ?>
<div id="app">
<users-list :data-users=<?php echo e(json_encode($users)); ?>></users-list>
</div>
<script src="js/app.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dhaen\Documents\programmation\MyWebsite\resources\views/admin/users.blade.php ENDPATH**/ ?>