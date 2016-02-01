<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learner 后台管理</title>
    <link rel="stylesheet" href="<?php echo e(elixir("css/lib.css")); ?>">
    <link rel="stylesheet" href="./css/admin/admin.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/select2/4.0.1/css/select2.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('js/admin/director.js')); ?>" type="text/javascript"></script>
    <script src="//cdn.bootcss.com/select2/4.0.1/js/select2.min.js"></script>
    <script src="//cdn.bootcss.com/select2/4.0.1/js/i18n/zh-CN.js"></script>
    <script src="<?php echo e(asset('js/admin/build.js')); ?>"></script>
</body>
</html>
