<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(trans('site.title')); ?></title>
    <link rel="stylesheet" href="<?php echo e(elixir("css/lib.css")); ?>">
    <link rel="stylesheet" href="<?php echo e(elixir("css/app.css")); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="<?php echo e(asset('layouts.meta_title')); ?>"/>
    <meta property="og:image" content="<?php echo e(asset('img/logo.png')); ?>" />
    <meta property="og:description" content="<?php echo $__env->yieldContent('description'); ?>" />
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords', trans('layouts.meta_keywords')); ?>">
    <meta name="author" content="<?php echo e(trans('layouts.meta_author')); ?>">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.2.0/respond.js"></script>
    <![endif]-->
    <?php echo $__env->yieldContent('style'); ?>
</head>
<body>

<?php echo $__env->make('layouts/partial/nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('jumbotron'); ?>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('layouts/partial/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->make('flashy::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
