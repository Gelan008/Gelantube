<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <?php echo e(config('app.name', 'Laravel')); ?>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(url('/')); ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(url('/videos')); ?>">Videos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(url('/users')); ?>">Users</a>
                        </li>

                    </ul>
                </div>
            </ul>

            <!-- Right Side Of Navbar -->
            <form method="POST" class="form-inline my-auto my-lg-0" action="<?php echo e(action('SearchController@search')); ?>">
                <?php echo csrf_field(); ?>
                <input class="form-control mr-sm-2 col-md-6" type="search" name="search" placeholder="Search" aria-label="Search">
                <input class="form-control mr-sm-2" type="hidden" name="scope" value="<?php echo e(session('scope')); ?>" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <button type="submit" class="btn btn-outline-danger my-2 my-sm-0 ml-1" formaction="<?php echo e(url(session('scope') == 'video' ? 'videos' : 'users')); ?>">Clear</button>
            </form>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                    </li>
                    <?php if(Route::has('register')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>">
                               Dashboard
                            </a>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <?php echo e(__('Logout')); ?>

                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
<?php if(isset($word)): ?>
    <h5>Found <?php echo e(isset($videos) ? $videos->total() : $users->total()); ?> records '<?php echo e($word); ?>'</h5>

    <form action="<?php echo e(action('SearchController@search')); ?>" method="post">
        <?php echo csrf_field(); ?>

        <div class="input-group mb-3">

            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="submit">Order</button>
            </div>
            <select class="custom-select" id="order" name="order">

                <?php if(isset($order)): ?>
                    <option value="0" <?php echo e($order == 0 ? 'selected' : ''); ?>>Choose...</option>
                    <option value="1" <?php echo e($order == 1 ? 'selected' : ''); ?>>Oldest to newest</option>
                    <option value="2" <?php echo e($order == 2 ? 'selected' : ''); ?>>Newest to oldest</option>
                    <option value="3" <?php echo e($order == 3 ? 'selected' : ''); ?>>A to Z</option>
                <?php else: ?>
                    <option value="0" selected>Choose...</option>
                    <option value="1" >Oldest to newest</option>
                    <option value="2" >Newest to oldest</option>
                    <option value="3" >A to Z</option>
                <?php endif; ?>


            </select>

            <input type="hidden" value="<?php echo e($word); ?>" name="search"/>
            <input class="form-control mr-sm-2" type="hidden" name="scope" value="<?php echo e(session('scope')); ?>" placeholder="Search" aria-label="Search">


        </div>
    </form>
<?php endif; ?>
</div>
<?php /**PATH /Applications/MAMP/htdocs/Laravel/Gelantube/resources/views/layout/navbar.blade.php ENDPATH**/ ?>