
<?php $__env->startSection('content'); ?>

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading"><?php echo e($album->title); ?></h1>
    <p class="lead text-muted"><?php echo e($album->content); ?></p>
    <small>publié par: <?php echo e($album->user->name); ?></small>
    <center>
      <?php echo e(Form::open(array('route' => array('albums.update', $album),'files'=>'true', 'enctype' =>'multipart/form-data','target' => '_self'))); ?>

        <?php echo method_field('PUT'); ?>
        <div class="custom-file">
        <label class="custom-file-label" for="validatedCustomFile">Ajouter des photos</label>
        <input type="file" class="custom-file-input" name="photos[]" multiple="multiple" />
      </div>
      <div class="form-group ">
        <?php echo e(Form::submit('Publier',['class'=>'btn btn-primary form-control'])); ?>

      </div>
      <?php echo e(Form::close()); ?>

      <!--<a href="#" class="btn btn-secondary my-2">Secondary action</a>-->
    </center>
  </div>
  <?php if(session('success')): ?>
    <div class="container">
      <div class="alert alert-success">
        <strong><?php echo e(session('success')); ?></strong> 
      </div>
    </div>
  <?php endif; ?>
</section>
  
<div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        <?php $__currentLoopData = $album->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <img class="card-img-top" src="<?php echo e(asset('storage/photos/'.$photo->name)); ?>" alt="Card image cap">
            <?php if(Auth::user()->id == $album->user->id || Auth::user()->is_admin): ?>
              <?php echo e(Form::open(['method'=>'DELETE', 'route'=>['photos.destroy', $photo], 'target'=>'_self'])); ?>

                <?php echo e(Form::button('<a>Supprimer</a>', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary'))); ?>

              <?php echo e(Form::close()); ?>

            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/MyWebsite/resources/views/albums/edit.blade.php ENDPATH**/ ?>