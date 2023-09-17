<?php $__env->startSection('content'); ?>
<main role="main">

<!--     <?php if(session('success')): ?>
      <section class="jumbotron text-center">
         <div class="container">
          <h1 class="jumbotron-heading">Albums :</h1>
          <p class="lead text-muted">Albums souvenirs de voyage ;)</p>
          <p>
            <a href="<?php echo e(route('home')); ?>" class="btn btn-primary my-2" target="_self">Créer un album</a>
            <a href="#" class="btn btn-secondary my-2">Secondary action</a>
          </p>
        </div> 
        
          <div class="container">
            <div class="alert alert-success">
              <strong><?php echo e(session('success')); ?></strong> 
            </div>
          </div>
        
      </section>
    <?php endif; ?> -->
      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
          	<?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 ">
              <div class="card mb-4 shadow-lg p-4 mb-4 bg-white">
                <?php if(isset($album->photos[0])): ?>
                <img class="card-img-top" src="<?php echo e(asset($album->photos[0]->slug)); ?>" alt="Card image cap">
                <?php endif; ?>
                <div class="card-body">
                  <p class="card-text"><?php echo e($album->content); ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a class="btn btn-sm btn-outline-secondary" target="_self" href="<?php echo e(route('albums.show', $album)); ?>">Voir</a>
                      <?php if(auth()->guard()->check()): ?>
                      <?php if(Auth::user()->id == $album->user->id || Auth::user()->admin): ?>
                      <a class="btn btn-sm btn-outline-secondary" target="_self" href="<?php echo e(route('albums.edit', $album)); ?>">Modifier</a>
                      <?php echo e(Form::open(['method'=>'DELETE', 'route'=>['albums.destroy', $album], 'target'=>'_self'])); ?>

                          <?php echo e(Form::button('<a>Supprimer</a>', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary'))); ?>

                        <?php echo e(Form::close()); ?>

                      <?php endif; ?>
                      <?php endif; ?>
                    </div>
                    <small class="text-muted"><?php echo e($album->user->name); ?></small>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      <div class="pagination justify-content-center"><?php echo e($albums->links()); ?></div>

      </div>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/MyWebsite/resources/views/albums/index.blade.php ENDPATH**/ ?>