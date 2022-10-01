

<?php $__env->startSection('content'); ?>

<main role="main">
      <section class="jumbotron text-center">
          <h1 class="jumbotron-heading">Messages :</h1>
          <p class="lead text-muted">Petits messages ;)</p>
          <center>
              <?php echo e(Form::open(array('route' => 'messages.store','target' => '_self'))); ?>

                <div class="form-group col-6">
                  <?php echo e(Form::text('content',null, ['class'=>'form-control'])); ?>

                </div>
                <div class="form-group col-2">
                  <?php echo e(Form::submit('Laisser un message',['class'=>'btn btn-primary form-control'])); ?>

                </div>
              <?php echo e(Form::close()); ?>

              <!--<a href="#" class="btn btn-secondary my-2">Secondary action</a>-->
          </center>
          <?php if($errors->any()): ?>
            <div class="alert alert-danger">
              <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          <?php endif; ?>
          
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
          <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="media border p-3 shadow-lg p-4 mb-4 bg-white">
            <?php if($message->user->photo != NULL): ?>
            <img src="<?php echo e(asset('storage/photos/'.$message->user->photo->name)); ?>" class="mr-3 mt-3 rounded-circle" width=80px height="80px">
            <?php endif; ?>
            <div class="media-body">
              <h4><?php echo e($message->user->name); ?><small><i> Posté le: <?php echo e($message->created_at); ?></i></small></h4>
              <p><?php echo e($message->content); ?></p>
              <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <?php if(Auth::user()->id == $message->user->id || Auth::user()->admin): ?>
                        <?php echo e(Form::open(['method'=>'DELETE', 'route'=>['messages.destroy', $message], 'target'=>'_self'])); ?>

                          <?php echo e(Form::button('<a>Supprimer</a>', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary'))); ?>

                        <?php echo e(Form::close()); ?>

                      <?php endif; ?>
                    </div>
                  </div>      
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
      </div>
</main>

<?php echo $__env->make('layouts/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/MyWebsite/resources/views/messages/index.blade.php ENDPATH**/ ?>