<html>
<head>
    <?php echo $__env->make("layout.bootstrap", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>

<?php echo $__env->make("layout.navbar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent("content"); ?>

<?php echo $__env->make("layout.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>


</html>
<?php /**PATH /Applications/MAMP/htdocs/Laravel/Gelantube/resources/views/layout/template.blade.php ENDPATH**/ ?>