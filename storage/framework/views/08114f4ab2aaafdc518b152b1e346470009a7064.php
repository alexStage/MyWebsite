

<?php $__env->startSection('content'); ?>

	<div class="panel-body">
		<?php echo e(Form::open(array('route' => 'profile.edit','files'=>'true', 'enctype' =>'multipart/form-data','target' => '_self'))); ?>

			<div class="form-group">
				<div class="custom-file">
				<label class="custom-file-label" for="validatedCustomFile">Sélectionner votre photo de profile</label>
				<input type="file" class="custom-file-input" name="photo"/>
			</div>

			<div class="form-group ">
				<?php echo e(Form::submit('Publier',['class'=>'btn btn-primary form-control'])); ?>

			</div>
			
		<?php echo e(Form::close()); ?>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dhaen\Documents\programmation\MyWebsite\resources\views/profiles/photo.blade.php ENDPATH**/ ?>