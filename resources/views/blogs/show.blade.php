@inject('parsedown', 'Parsedown')

@extends('layouts.master')

@section('description')
@RryLee 的博客, {{ $blog->title }}
@stop

@section('title')
{{ $blog->title }}
@stop

@section('style')
<link rel="stylesheet" href="//cdn.bootcss.com/highlight.js/9.1.0/styles/github-gist.min.css">
<style>
pre {
    background-color: transparent;
}
</style>
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
        <div class="col-md-8 col-md-offset-2">
            <div class="blog__body">
                {!! $parsedown->text($blog->body) !!}
            </div>

            @include('partials.share.share')

            @include('partials.comments')
        </div>
    </div>
</div>
@stop

@section('script')
<script src="//cdn.bootcss.com/highlight.js/9.1.0/highlight.min.js"></script>
@include('partials.share.shareScript')
<script>hljs.initHighlightingOnLoad();</script>
@stop
