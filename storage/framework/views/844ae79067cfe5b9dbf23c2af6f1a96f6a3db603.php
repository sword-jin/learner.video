<?php $__env->startSection('description'); ?>
这里有丰富的web学习视频，资料，另外，本站开源在 https://github.com/RryLee/learner.video
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
欢迎来到Learner
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
    @media (min-width: 768px) {
        body {
            padding-top: 84px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jumbotron'); ?>
    <section class="page-jumbotron newsletter">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="newsletter__letter">
                        <h1>订阅Learner.</h1>
                        <ul>
                            <li>半月一期</li>
                            <li>学习视频:laravel,angular,vue..</li>
                            <li>学习资源:挑选的优质博客</li>
                        </ul>
                        <p>一起成为更优秀的人.</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="newsletter__form">
                        <p>从现在开始!</p>
                        <form action="<?php echo e(route('subscribe')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <!-- Name field -->
                            <div class="form-group">
                                <input type="email" class="form-control newsletter__form__address" name="email" placeholder="name@domain.com">
                            </div>

                            <div class="from-group">
                                <input type="submit" class="btn btn-success" value="订阅 !">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="technique">
        <div class="container">
            <div class="technique__bar">
                <h3 class="technique__bar__title">What Learn</h3>
                <p class="technique__bar__decription">这里没有太多基础，有的是实用的技巧，最新的技术，有趣的项目</p>
            </div>
            <div class="row">
                <?php foreach($series as $row): ?>
                    <?php if(count($row->videos)): ?>
                        <div class="col-lg-3 col-lg-offset-0 col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                            <?php echo $__env->make('partials.seriesCard', ['series' => $row], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div>
                <a href="#" class="btn btn-success btn-wiggle">浏览更多</a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>