@extends('layouts.master')

@section('description')
@RryLee 的博客.
@stop

@section('title')
RryLee 的博客
@stop

@section('jumbotron')
<section class="page-jumbotron blog-page-jumbotron">
    <div class="container">
        <h1>博客</h1>
    </div>
</section>
@stop

@section('content')
<section class="series series--show">
    <div class="container">
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                    <article class="blog">
                        <div class="category hidden-sm hidden-xs">
                            <a href="{{ route('blogs.show', $blog->id) }}">
                                <img src="{{ asset($blog->category->image) }}" alt="{{ $blog->title }}" class="img-circle">
                            </a>
                        </div>
                        <div class="blog__content">
                            <div class="blog__created_at">
                                {{ timeToDate($blog->created_at) }}
                            </div>
                            <h2 class="blog__title">
                                <a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                            </h2>
                        </div>
                    </article>
                </div>
            @endforeach

            <div class="text-center">
                {{ $blogs->render() }}
            </div>
        </div>
    </div>
</section>
@stop
