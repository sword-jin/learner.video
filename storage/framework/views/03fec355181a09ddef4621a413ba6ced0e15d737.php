<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(trans('site.title')); ?></title>
    <link rel="stylesheet" href="<?php echo e(elixir("css/lib.css")); ?>">
    <link rel="stylesheet" href="<?php echo e(elixir("css/app.css")); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $__env->yieldContent('style'); ?>
</head>
<body>

<?php echo $__env->make('layouts/partial/nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('jumbotron'); ?>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('layouts/partial/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script src="<?php echo e(elixir("js/lib.js")); ?>"></script>
<?php echo $__env->make('flashy::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
