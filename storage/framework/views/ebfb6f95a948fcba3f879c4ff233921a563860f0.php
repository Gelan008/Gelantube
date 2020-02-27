<?php $__env->startSection('content'); ?>

    <div class="container">

        <div class="row my-2">
            <div class="col-lg-8 order-lg-2">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Videos</a>
                    </li>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->id == $user->id): ?>
                    <li class="nav-item">
                        <a href="" data-target="#your" data-toggle="tab" class="nav-link">Own comments</a>
                    </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                        <h4 class="mb-3"><?php echo e($user->name); ?> <?php echo e($user->surname); ?></h4>
                        <h5 class="mb-3"><?php echo e($user->email); ?></h5>
                        <!--/row-->
                    </div>
                    <div class="tab-pane" id="messages">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->id != $user->id): ?>
                                <a href="<?php echo e(url('/comment/user/new/'.$user->id)); ?>" class="btn btn-primary mb-1">New comment</a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <table class="table table-hover table-striped">
                            <tbody>
                        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <p class="float-right font-weight-bold">
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(Auth::user()->id == $comment->user_id): ?>
                                        <a href="<?php echo e(url('/comment/edit/'.$comment->id)); ?>" class="btn btn-secondary">Edit</a>
                                        <a href="<?php echo e(url('/comment/delete/'.$comment->id)); ?>" class="btn btn-danger">Delete</a></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php echo e($comment->body); ?>

                                    <p><small><?php echo e($comment->user->name); ?></small></p>
                                    <p><small><?php echo e($comment->created_at->diffForHumans()); ?></small></p>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="edit">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->id == $user->id): ?>
                        <a href="<?php echo e(url('/video/new')); ?>" class="btn btn-primary mb-5">Upload Video</a>
                            <?php endif; ?>
                        <?php endif; ?>
                            <div class="row">

                                <?php if(count($videos) > 0): ?>

                                    <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card col-5" >
                                            <img class="card-img-top" src="<?php echo e(route('getThumb', $video->id)); ?>" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo e($video->title); ?></h5>
                                                <p class="card-text"><?php echo e($video->description); ?></p>
                                                <a href="<?php echo e(url('/video/'.$video->id)); ?>" class="btn btn-primary ">View</a>
                                                <?php if(auth()->guard()->check()): ?>
                                                    <?php if(Auth::user()->id == $user->id): ?>
                                                <a href="<?php echo e(url('/video/edit/'.$video->id)); ?>" class="btn btn-secondary">Edit</a>
                                                <a href="<?php echo e(url('/video/delete/'.$video->id)); ?>" class="btn btn-danger">Delete</a>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <h5>No videos uploaded</h5>
                                <?php endif; ?>


                            </div>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->id == $user->id): ?>

                    <div class="tab-pane" id="your">
                        <?php if(count($ownComments) > 0): ?>
                            <table class="table table-hover table-striped">
                                <tbody>
                                <?php $__currentLoopData = $ownComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ownComment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <p class="float-right font-weight-bold">
                                                <a href="<?php echo e(url('/comment/edit/'.$ownComment->id)); ?>" class="btn btn-secondary">Edit</a>
                                                <a href="<?php echo e(url('/comment/delete/'.$ownComment->id)); ?>" class="btn btn-danger">Delete</a></p>
                                            <?php echo e($ownComment->body); ?>

                                            <p><small><?php echo e($ownComment->user->name); ?></small></p>
                                            <p><small><?php echo e($ownComment->created_at->diffForHumans()); ?></small></p>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        <?php else: ?>
                            <h4>No comments found</h4>
                        <?php endif; ?>
                    </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 order-lg-1 text-center">
                <img src="<?php echo e(route('getAvatar', $user->id)); ?>" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->id == $user->id): ?>
                        <a href="<?php echo e(url('/user/edit/'.$user->id)); ?>" class="btn btn-primary mt-3">Edit user</a>
                <?php endif; ?>
            <?php endif; ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/Laravel/Gelantube/resources/views/user.blade.php ENDPATH**/ ?>