@extends('layouts.master')

@section('description')
Learner视频学习资源
@stop

@section('title')
系列视频
@stop

@section('jumbotron')
<section class="page-jumbotron series-page-jumbotron">
    <div class="container">
        <h1>Learning by doing.</h1>
    </div>
</section>
@stop

@section('content')
<section class="series">
    <div class="container">
        <div class="row">
            @foreach (array_chunk($series->all(), 4) as $row)
                @foreach ($row as $series)
                    @if (count($series->videos))
                        <div class="col-lg-3 col-lg-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                            <div class="card">
                                @if (isNew($series->videos->last()->published_at))
                                    <span class="card__update label label-danger">update!</span>
                                @endif
                                <span class="card__video-count">{{ count($series->videos) }} Videos</span>
                                <div class="card__img">
                                    <a href="{{ route('series.show', $series->slug) }}">
                                        <img
                                            class="img-responsive"
                                            src="{{ $series->image }}" alt="">
                                        <div class="card__overlay">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="card__details">
                                    <ul class="card__category">
                                        @foreach ($series->categories as $category)
                                            <li class="label label--{{ $category->name }}">{{ $category->name }}</li>
                                        @endforeach
                                    </ul>
                                    <h3 class="card__title">
                                        <a href="{{ route('series.show', $series->slug) }}" class="card__title--a">{{ $series->title }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
</section>
@stop
