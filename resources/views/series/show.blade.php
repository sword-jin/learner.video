@inject('player', 'Learner\Services\Videos\Video')
@inject('category', 'Learner\Services\Layouts\Category')

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
            <div class="col-lg-9 col-lg-offset-0 col-md-9 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                <ol class="breadcrumb">
                   <li><a href="{{ route('series') }}">系列</a></li>
                   <li class="active">{{ $series->title }}</li>
                </ol>

                <p class="series__description">{!! $series->description !!}</p>

                <div class="video-wrapper">
                    {!! $player->setType($series->videos->first()->resource_type)
                              ->getIFrame($series->videos->first()->resource_id) !!}
                </div>

                <div class="videos">
                    <div class="videos__icon">
                        <img src="/{{ $series->categories->first()->image }}" class="img-circle">
                    </div>
                    <ul class="list-group">
                        @foreach ($series->videos as $video)
                            <a class="list-group-item"
                                href="{{ route('series.video.show', ['id' => $series->id, 'vid' => $video->id]) }}">
                                {{ $video->title }}

                                <i class="label label-danger label--new pull-right">New</i>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
                @include('partials.categoryList')
            </div>
        </div>
    </div>
</section>
@stop
