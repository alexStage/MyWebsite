


<?php $__env->startSection('content'); ?>
<div class="container my-4">
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Créer un nouvel album</h3>
	</div>
	
	<div class="panel-body">
		<?php echo e(Form::open(array('route' => 'albums.store','files'=>'true', 'enctype' =>'multipart/form-data','target' => '_self'))); ?>

			<?php echo csrf_field(); ?>
			<div class="form-group">
				<?php echo e(Form::label('title', 'Intitulé de l\'album:')); ?>

				<?php echo e(Form::text('title',null, ['class'=>'form-control'])); ?>

			</div>
			<div class="form-group">
				<?php echo e(Form::label('content', 'descriptif de l\'album:')); ?>

				<?php echo e(Form::textarea('content',null, ['class'=>'form-control', 'rows'=>'3'])); ?>

			</div>
			<div class="form-group">
				<div class="custom-file">
				<label class="custom-file-label" for="validatedCustomFile">Sélectionner les photos</label>
				<input type="file" class="custom-file-input" name="photos[]" multiple="multiple" />
			</div>
	</div>

			<div class="form-group ">
				<?php echo e(Form::submit('Publier',['class'=>'btn btn-primary form-control'])); ?>

			</div>
			
		<?php echo e(Form::close()); ?>


	</div>

	<div class="progress">
		<div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
	</idv>

	<?php if($errors->any()): ?>
		<div class="alert alert-danger">
			<ul>
				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<p><?php echo e($error); ?></p>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
		</div>
	<?php endif; ?>
</div>
</div>

<script>
	$(document).ready(function(){
		$('form').ajaxForm({
			beforeSend:function(){
				$('#success').empty();
				$('.progress-bar').text('0%');
				$('.progress-bar').css('width', '0%');
			},
			uploadProgress:function(event, position, total, percentComplete){
				$('.progress-bar').text(percentComplete + '%');
				$('.progress-bar').css('width', percentComplete +'%');
			},
			success:function(data){
				if(data.success){
					$('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br /><br />');
					$('.progress-bar').text('Uploaded');
					$('.progress-bar').css('width', '100%');
				}
			}
		})
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dhaen\Documents\programmation\MyWebsite\resources\views/albums/create.blade.php ENDPATH**/ ?>