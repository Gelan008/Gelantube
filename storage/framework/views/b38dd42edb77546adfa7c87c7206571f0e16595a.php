<?php $__env->startSection('content'); ?>



    <div class="container mb-5">


        <div class="row">
            <div class="card-group d-flex ">
        <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card col-md-3">
                    <img class="card-img-top" src="<?php echo e(route('getThumb', $video->id)); ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($video->title); ?></h5>
                        <p class="card-text"><?php echo e($video->description); ?></p>
                        <a href="<?php echo e(url('/video/'.$video->id)); ?>" class="btn btn-primary">View</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?php echo e($video->created_at->diffForHumans()); ?></small>
                    </div>
                </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php echo e($videos->links()); ?>

        </div>

    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/Laravel/Gelantube/resources/views/home.blade.php ENDPATH**/ ?>