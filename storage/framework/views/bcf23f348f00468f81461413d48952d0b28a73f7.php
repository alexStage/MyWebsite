
<?php $__env->startSection('content'); ?>
<!-- importe le css nécessaire au fonctionnement de la gallery photo -->
<link rel="stylesheet" href="<?php echo e(asset('css/baguetteBox.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/gallery.css')); ?>">

<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading"><?php echo e($album->title); ?></h1>
    <p class="lead text-muted"><?php echo e($album->content); ?></p>
    <small>publié par: <?php echo e($album->user->name); ?></small>
      <div class="panel-body">
      <?php echo e(Form::open(['route'=>['albums.comment', $album]])); ?>   
        <div class="form-group">
          <?php echo e(Form::label('content', 'laissez un commentaire:')); ?>

          <?php echo e(Form::text('content',null, ['class'=>'form-control'])); ?>

        </div>
        <div class="form-group"></div>
          <?php echo e(Form::submit('Commenter',['class'=>'btn btn-primary form-control'])); ?>

        </div>
        
        <?php echo e(Form::close()); ?>

    </div>

  <?php if(session('success')): ?>
    <div class="container">
      <div class="alert alert-success">
        <strong><?php echo e(session('success')); ?></strong> 
      </div>
    </div> 
  <?php endif; ?>
</section>
    <!-- <div class="container-fluid text-center">
      <div class="row">
	     <div class="col">
        <div class="album py-5 bg-light">
          <div class="container">
            <div class="row">
              <?php $__currentLoopData = $album->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                  <a href="<?php echo e(asset($photo->slug)); ?>"><img class="card-img-top" src="<?php echo e(asset($photo->slug)); ?>" alt="Card image cap"></a>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div> -->

        <div class="container gallery-container">
          <div class="tz-gallery">
              <div class="row">
                  <?php $__currentLoopData = $album->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <a class="lightbox" href="<?php echo e(asset($photo->slug)); ?>">
                          <img src="<?php echo e(asset($photo->slug)); ?>">
                      </a>
                    </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
          </div>
        </div>

        <?php if($album->comments()->count() >= 1): ?>
        <div class="row">
          <div class="col">
            <h1>Commentaires</h1>
            <?php $__currentLoopData = $album->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="media border p-3">
              <div class="media-body">
                  <h4><?php echo e($comment->user->name); ?><small><i> posté le: <?php echo e($comment->created_at); ?></i></small></h4>
                  <p><?php echo e($comment->content); ?></p>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
        <?php endif; ?>
    </div>
    <script src="/js/app.js"></script>
    <script src="<?php echo e(asset('js/baguetteBox.min.js')); ?>" ></script>
    <script> baguetteBox.run('.tz-gallery') </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dhaen\Documents\programmation\MyWebsite\resources\views/albums/show.blade.php ENDPATH**/ ?>