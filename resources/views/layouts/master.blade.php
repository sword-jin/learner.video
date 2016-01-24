<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - {{ trans('site.title') }}</title>
    <link rel="stylesheet" href="./css/app.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('style')
</head>
<body>

@include('layouts/partials/nav')

@yield('jumbotron')

@yield('content')

@include('layouts/partials/footer')

<script src="./js/app.js"></script>
</body>
</html>
