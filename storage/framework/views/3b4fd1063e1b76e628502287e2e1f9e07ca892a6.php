<?php $__env->startSection('style'); ?>
    <style>
        body {
            padding-top: 130px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	<?php echo e(lang('login.panel_title', 'Login')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <?php echo $__env->make("errors/list", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(lang('login.panel_title', 'Login')); ?></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('auth.login.post')); ?>">
                        <?php echo csrf_field(); ?>


                        <div class="form-group<?php echo e($errors->has('credential') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label"><?php echo e(lang('login.credential', 'Username/Email')); ?></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="credential" value="<?php echo e(old('credential')); ?>">
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label"><?php echo e(trans('login.password')); ?></label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> <?php echo e(lang('login.remember', 'Remember me?')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i><?php echo e(lang('login.submit', 'Login')); ?>

                                </button>

                                <a class="btn btn-link" href="<?php echo e(url('password/reset')); ?>"><?php echo e(lang('login.forget', 'Forget your password?')); ?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>