<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="<?php echo e(URL::asset('/')); ?>" target="_blank">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/siteTahiti.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/simple-sidebar.css')); ?>">
        <link rel="icon" href="<?php echo e(asset('assets/seaTheWorld2.png')); ?>">
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css">
        <script src="<?php echo e(asset('js/app.js')); ?>" ></script>
        <script type="text/javascript" src="<?php echo e(url('js/jQuery.js')); ?>"></script>
        <script src="https://kit.fontawesome.com/ef75b9cf35.js" crossorigin="anonymous"></script>
        <title>Carnet de voyages</title>
    </head>
    <body>

    <nav id="nav" class="navbar navbar-expand-lg navbar-light bg-blue">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> 
        <div class="collapse navbar-collapse navbar-header" id="navbarTogglerDemo01">
            <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" target="_self" href="<?php echo e(route('albums.index')); ?>">Albums</a>
                    </li>
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item active">
                            <a class="nav-link" target="_self" href="<?php echo e(route('messages.index')); ?>">Messages</a>
                        </li>
                        <?php if(Auth::user()->isFamily()): ?>
                            <li class="nav-item active">
                                <a class="nav-link" target="_self" href="<?php echo e(route('archives')); ?>">Archives</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
            </ul>


            <ul class="navbar-nav navbar-center">
                <li><a class="navbar-brand" target="_self" href="#"><img src="<?php echo e(asset('assets/seaTheWorld2.png')); ?>" width="164" height="105" alt=""></a></li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                <?php if(Route::has('register')): ?>
                        <li>
                            <a class="nav-link" target="_self" href="<?php echo e(route('register')); ?>"><?php echo e(__('S\'enregistrer')); ?></a>
                        </li>
                <?php endif; ?>
                    <li>
                        <a class="nav-link" target="_self" href="<?php echo e(route('login')); ?>"><span class="glyphicon glyphicon-user"></span><?php echo e(__('Se connecter')); ?></a>
                    </li>
                <?php else: ?>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" target="_self" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <?php echo e(__('Se déconnecter')); ?>

                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('profile.photo')); ?>">
                            <?php echo e(__('ajouter photo de profile')); ?>

                        </a>
                        <?php if(Auth::user()->isAdmin()): ?>
                        <a class="dropdown-item" target="_self" href="<?php echo e(route('admin')); ?>">
                            <?php echo e(__('Admin')); ?>

                        </a>
                        <?php endif; ?>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>               
    </nav>
            <div class="container">
            <?php if(Session::has('danger')): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo e(session('danger')); ?>

                </div>
            <?php endif; ?>
            <?php if(Session::has('warning')): ?>
                <div class="alert alert-warning text-center" role="alert">
                    <?php echo e(session('warning')); ?>

                </div>
            <?php endif; ?>
            <?php if(Session::has('success')): ?>
                <div class="alert alert-success text-center" role="alert">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            </div>

            <?php echo $__env->yieldContent('content'); ?>
            

        <script type="text/javascript" src="<?php echo e(url('js/popper.min.js')); ?>"></script>        
        <script type="text/javascript" src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(url('js/button-folder.js')); ?>"></script>
        <script>
        $(document).ready(function() {
            // Send refresh second time to avoid display errors
            if (window.location.href.indexOf('?refresh') != -1) {
            window.location.href = window.location.href.replace('?refresh', '');
            return;
            }
            });
        </script>
        <!-- <script>
        $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        });
        </script> -->
        
    </body>
</html>
<?php /**PATH /home/vagrant/code/MyWebsite/resources/views/layouts/layout.blade.php ENDPATH**/ ?>