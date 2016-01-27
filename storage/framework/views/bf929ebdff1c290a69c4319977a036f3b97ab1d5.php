<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learner 后台管理</title>
    <link rel="stylesheet" href="<?php echo e(elixir("css/lib.css")); ?>">
    <link rel="stylesheet" href="./css/admin/admin.css">
    <meta name="token" id="token" value="<?php echo e(csrf_token()); ?>">
</head>
<body id="app" class="skin-black">

    <main-header :username="auth.username"></main-header>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <siderbar :auth="auth"></siderbar>

        <aside class="right-side">
            <section class="content">
                <router-view :roles="auth.roles"></router-view>
            </section>
        </aside>
    </div>

    <script src="<?php echo e(elixir('js/lib.js')); ?>"></script>
    <script src="<?php echo e(asset('js/admin/director.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/admin/build.js')); ?>"></script>
</body>
</html>
