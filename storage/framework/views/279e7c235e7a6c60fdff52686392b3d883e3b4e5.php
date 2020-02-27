<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Video</div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(isset($video) ? url('/video/update') : url('/video/store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="video" class="col-md-4 col-form-label text-md-right float-left">Video</label>
                                <?php if(isset($video)): ?>
                                    <video class="embed-responsive-item mx-auto d-block" controls>
                                        <source src="<?php echo e(route('getVideo', $video->id)); ?>" type="video/<?php echo e(pathinfo($video->video_path)['extension']); ?>">
                                    </video>
                                <?php endif; ?>




                                <div class="col-md-6 mx-auto mt-3">
                                    <input type="file" name="video" id="video" accept="video/*" required>
                                </div>


                            </div>

                            <div class="form-group row">
                                <label for="thumbnail" class="col-md-4 col-form-label text-md-right">Thumbnail</label>

                                <?php if(isset($video)): ?>
                                    <img class="img-fluid img-circle d-block mx-auto mb-3" src="<?php echo e(route('getThumb', $video->id)); ?>" alt="Card image cap">
                                <?php endif; ?>

                                <div class="col-md-6 mx-auto">
                                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="<?php echo e(isset($video) ? $video->title : ''); ?>" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea rows="10" id="description" type="text" class="form-control" name="description" required autofocus ><?php echo e(isset($video) ? $video->description : ''); ?></textarea>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(isset($video) ? 'Update' : 'Upload'); ?> video
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="id" id="id" value="<?php echo e(isset($video) ? $video->id : ''); ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/Laravel/Gelantube/resources/views/newVideo.blade.php ENDPATH**/ ?>