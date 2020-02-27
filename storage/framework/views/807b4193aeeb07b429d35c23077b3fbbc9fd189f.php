<?php $__env->startComponent('mail::message'); ?>
# Hello <?php echo e($name); ?>


The API will be out of order the next week.

<?php $__env->startComponent('mail::button', ['url' => '']); ?>
Learn More
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /Applications/MAMP/htdocs/Laravel/Gelantube/resources/views/email/notification.blade.php ENDPATH**/ ?>