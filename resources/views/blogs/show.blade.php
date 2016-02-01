@inject('parsedown', 'Parsedown')

@extends('layouts.master')

@section('description')
@RryLee 的博客, {{ $blog->title }}
@stop

@section('title')
{{ $blog->title }}
@stop

@section('style')
<link rel="stylesheet" href="//cdn.bootcss.com/prism/0.0.1/prism.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('build/css/prism-cop.css') }}">
@stop

@section('jumbotron')
<section class="page-jumbotron blog-page-jumbotron">
    <div class="container">
        <h1>{{ $blog->title }}</h1>
    </div>
</section>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="blog__body">
                {!! $parsedown->text($blog->body) !!}
            </div>

            @include('partials.comments')
        </div>
    </div>
</div>
@stop

@section('script')
<script src="//cdn.bootcss.com/prism/0.0.1/prism.min.js"></script>
@stop
