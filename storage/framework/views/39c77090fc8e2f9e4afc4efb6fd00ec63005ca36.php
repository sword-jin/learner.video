<?php $navigation = app('Learner\Services\Layouts\Navigation'); ?>

<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#learner-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo e(url('/')); ?>" class="hidden-xs navbar-bread learner-bread learner-bread--hover">
                    L<span class="learner-bread--one">e</span><span class="learner-bread--two">a</span><span class="learner-bread--three">r</span><span class="learner-bread--four">n</span><span class="learner-bread--five">e</span><span class="learner-bread--six">r</span>
                </a>
                <a href="<?php echo e(url('/')); ?>" class="visible-xs navbar-bread">
                    <img src="<?php echo e(asset('img/logo.png')); ?>" class="learner-logo" alt="Logo">
                </a>
            </div> <!-- navbar-header -->

            <div id="learner-toggle" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php foreach($navigation->menus as $menu): ?>
                        <li class="<?php echo e(isActive($menu['route'])); ?>">
                            <a href="<?php echo e(route($menu['route'])); ?>"><?php echo e($menu['display_name']); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <?php if(Auth::guest()): ?>
                    <li class="<?php echo e(isActive('auth/login')); ?>">
                        <a href="<?php echo e(route('auth.login')); ?>">登陆</a>
                    </li>
                    <li  class="<?php echo e(isActive('auth/register')); ?>">
                        <a href="<?php echo e(route('auth.register')); ?>">注册</a>
                    </li>
                    <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img class="nav-avatar hidden-xs" src="<?php echo e(asset(Auth::user()->avatar)); ?>" alt="<?php echo e(Auth::user()->username); ?>">
                            <?php echo e(Auth::user()->username); ?> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <?php if(Auth::check() && Auth::user()->hasRole(['admin', 'boss'])): ?>
                            <li>
                                <a href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="fa fa-dashboard"></i>
                                    <?php echo e(lang('navigation.dashboard', "Dashboard")); ?>

                                </a>
                            </li>
                            <?php endif ?>
                            <li>
                                <a href="<?php echo e(route('auth.logout')); ?>">
                                    <i class="fa fa-btn fa-sign-out"></i>
                                    <?php echo e(lang('navigation.logout', 'Logout')); ?>

                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div> <!-- navbar -->
    </nav> <!-- nav -->
</header> <!-- header -->
