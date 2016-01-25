<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{ elixir("css/lib.css") }}">
    <link rel="stylesheet" href="./css/admin/admin.css">
    <meta name="token" id="token" value="{{ csrf_token() }}">
</head>
<body id="app" class="skin-blue">

    {{-- do something --}}

    <script src="{{ elixir('js/lib.js') }}"></script>
    <script src="js/admin/director.js" type="text/javascript"></script>
    <script src="{{ elixir('js/admin/admin.js') }}"></script>
</body>
</html>
