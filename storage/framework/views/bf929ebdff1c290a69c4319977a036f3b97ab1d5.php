<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo e(elixir("css/lib.css")); ?>">
    <link rel="stylesheet" href="./css/admin/admin.css">
    <meta name="token" id="token" value="<?php echo e(csrf_token()); ?>">
</head>
<body id="app" class="skin-blue">

    <h1>Hello App!</h1>
    <p>
        <a v-link="{ path: '/foo' }">Go to Foo</a>
        <a v-link="{ path: '/bar' }">Go to Bar</a>
    </p>

    <router-view></router-view>

    <script src="<?php echo e(elixir('js/lib.js')); ?>"></script>
    <script src="js/admin/director.js" type="text/javascript"></script>
    <script src="<?php echo e(elixir('js/admin/admin.js')); ?>"></script>
</body>
</html>
