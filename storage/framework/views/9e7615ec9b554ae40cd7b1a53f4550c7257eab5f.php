<?php $__env->startSection('content'); ?>

    <div class="container">
        <?php if(isset($check)): ?>
            <?php if($check == 1): ?>
                <div class="alert alert-success" role="alert">
                    Succesfull sended
                </div>
            <?php elseif($check = 2): ?>
                <div class="alert alert-danger" role="alert">
                    Error to send
                </div>
            <?php endif; ?>




        <?php endif; ?>

            <?php if(Auth::user()->role == 1): ?>
                <div class="alert alert-success" role="alert">
                    You are a super user!, please, click in the button to send the mail
                </div>
                <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    You are not a super, get out of here!
                </div>
            <?php endif; ?>



        <div class="row">



            <div class="col-12">
                <form method="POST" action="<?php echo e(url('/sendnotification')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <?php if(Auth::user()->role == 1): ?>
                                <button type="submit" class="btn btn-primary">
                                    Send Notify
                                </button>
                            <?php endif; ?>

                        </div>
                    </div>
                </form>

            </div>


        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/Laravel/Gelantube/resources/views/sendNotification.blade.php ENDPATH**/ ?>