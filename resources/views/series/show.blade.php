@extends('layouts.master')

@section('description')
{{ $series->description }}
@stop

@section('title')
{{ $series->title }}
@stop

@section('jumbotron')
<section class="page-jumbotron series-page-jumbotron">
    <div class="container">
        <h1>{{ $series->title }}</h1>
    </div>
</section>
@stop

@section('content')
<section class="series series--show">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-lg-offset-0 col-md-9 col-md-offset-0 col-sm-10 col-sm-offset-1">
                <ol class="breadcrumb">
                   <li><a href="{{ route('series') }}">系列</a></li>
                   <li class="active">{{ $series->title }}</li>
                </ol>

                @include('partials.description', ['obj' => $series])

                @include('partials.videoPlayer', ['video' => $series->videos->first()])

                @include('partials.share.share')

                @include('partials.videoPlaylist')
            </div>

            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
                @include('partials.categoryList')
            </div>
        </div>
    </div>
</section>
@stop

@section('script')
@include('partials.share.shareScript')
@stop
