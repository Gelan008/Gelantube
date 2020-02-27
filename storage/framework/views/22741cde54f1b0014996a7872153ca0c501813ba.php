<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Comment</div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(isset($comment) ? url('/comment/update') : url('/comment/store')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">Comment</label>

                                <div class="col-md-6">
                                    <textarea rows="10" id="body" type="text" class="form-control" name="body" required autofocus ><?php echo e(isset($comment) ? $comment->body : ''); ?></textarea>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(isset($comment) ? 'Update' : 'Create'); ?> comment
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="id" id="id" value="<?php echo e(isset($comment) ? $comment->id : ''); ?>">

                            <?php if(isset($id_type_video)): ?>
                                <input type="hidden" name="id_type_video" id="id_type_video" value="<?php echo e($id_type_video); ?>">
                            <?php elseif(isset($id_type_user)): ?>
                                <input type="hidden" name="id_type_user" id="id_type_user" value="<?php echo e($id_type_user); ?>">
                            <?php endif; ?>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/Laravel/Gelantube/resources/views/newComment.blade.php ENDPATH**/ ?>