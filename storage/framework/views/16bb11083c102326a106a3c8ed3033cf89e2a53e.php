<?php $__env->startSection('content'); ?>

<section class="jumbotron text-center">
  <div class="container">
    <?php echo e(Form::open(array('route' => array('albums.update', $album), 'method' => 'put','target'=>'_self'))); ?>

    <div class="form-group">
    <?php echo e(Form::label('title', 'Nom de l\'album')); ?>

    <?php echo e(Form::text( 
            'title', 
            $album->title , 
            array( 'class' => 'form-control', 'id' => 'title', 'placeholder' => 'titre' ))); ?>

    </div>
    <div class="form-group">
    <?php echo e(Form::label('content', 'description de l\'album')); ?>

    <?php echo e(Form::textarea( 
            'content', 
            $album->content , 
            array( 'class' => 'form-control', 'rows' => '2', 'id' => 'content', 'placeholder' => 'description' ))); ?>

    </br>
    <?php echo e(Form::button('<a>modifier l\'album</a>', array('type' => 'submit', 'class' => 'btn btn-primary'))); ?>

    <?php echo e(Form::close()); ?>

    </div>
  <small>publié par: <?php echo e($album->user->name); ?></small>
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
            <img class="card-img-top" src="<?php echo e(asset($photo->slug)); ?>">
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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/MyWebsite/resources/views/albums/edit.blade.php ENDPATH**/ ?>