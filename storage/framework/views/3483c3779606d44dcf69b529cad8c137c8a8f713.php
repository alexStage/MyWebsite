<?php $__env->startSection('content'); ?>
<div class="album py-5 bg-light">
    <div class="container">
        <?php $__currentLoopData = $voyages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voyage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row mb-4 shadow-lg p-4 bg-white">
                <div class="col-md-2">
                    <p class="text-muted text-center"><?php echo e($voyage->users[0]->pseudo); ?></p>
                    <?php if(isset($voyage->albums[0]->photos[0]->slug)): ?>
                    <img class="card-img-top" src="<?php echo e(asset($voyage->users[0]->photoSlug)); ?>" alt="Card image cap">
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <h5 class="card-title"><?php echo e($voyage->title); ?></h5>
                    <p class="d-inline">pays visités: </p>
                    <?php $__currentLoopData = $voyage->pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="d-inline text-muted"><?php echo e($pay->title); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <p class="card-text"><?php echo e($voyage->description); ?></p>
                        
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a class="btn btn-sm btn-outline-secondary" target="_self" href="<?php echo e(route('voyages.show', $voyage->id)); ?>">Voir</a>
                            <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->admin): ?>
                            <a class="btn btn-sm btn-outline-secondary" target="_self" href="<?php echo e(route('voyages.edit', $voyage)); ?>">Modifier</a>
                            <?php echo e(Form::open(['method'=>'DELETE', 'route'=>['voyages.destroy', $voyage], 'target'=>'_self'])); ?>

                                <?php echo e(Form::button('<a>Supprimer</a>', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary'))); ?>

                                <?php echo e(Form::close()); ?>

                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="pagination justify-content-center"><?php echo e($voyages->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/MyWebsite/resources/views/voyages/index.blade.php ENDPATH**/ ?>