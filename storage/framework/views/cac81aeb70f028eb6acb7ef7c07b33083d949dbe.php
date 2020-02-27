<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div align="center" class="embed-responsive embed-responsive-16by9">

                    <video class="embed-responsive-item" controls>
                        <source src="<?php echo e(route('getVideo', $video->id)); ?>" type="video/<?php echo e(pathinfo($video->video_path)['extension']); ?>">
                    </video>
                </div>
            </div>
            <div class="col-6">
                <h3><?php echo e($video->title); ?></h3>
                <p><?php echo e($video->description); ?></p>
                <p><small><?php echo e($video->user->name); ?></small></p>
                <p><?php echo e($video->created_at->diffForHumans()); ?></p>
            </div>

        </div>
        <div class="row mt-5">

            <div class="col-12">
                <h2>
                <?php if(auth()->guard()->check()): ?>
                <a class="btn btn-primary" href="<?php echo e(url('/comment/video/new/'.$video->id)); ?>" role="button">New comment</a>
                <?php endif; ?>
                    Comments</h2>
                <table class="table table-hover table-striped">
                    <tbody>
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php if(auth()->guard()->check()): ?>
                                    <?php if(Auth::user()->id == $comment->user_id): ?>
                                <p class="float-right font-weight-bold">
                                    <a href="<?php echo e(url('/comment/edit/'.$comment->id)); ?>" class="btn btn-secondary">Edit</a>
                                    <a href="<?php echo e(url('/comment/delete/'.$comment->id)); ?>" class="btn btn-danger">Delete</a>
                                </p>
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

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/Laravel/Gelantube/resources/views/video.blade.php ENDPATH**/ ?>