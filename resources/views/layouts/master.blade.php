<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - {{ trans('site.title') }}</title>
    <link rel="stylesheet" href="{{ elixir("css/lib.css") }}">
    <link rel="stylesheet" href="{{ elixir("css/app.css") }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('style')
</head>
<body>

@include('layouts/partial/nav')

@yield('jumbotron')

@yield('content')

@include('layouts/partial/footer')

<script src="{{ elixir("js/lib.js") }}"></script>
@include('flashy::message')
</body>
</html>
