@extends('layouts.master')

@section('description')
Learner 全部视频列表,　涵盖各个方面
@stop

@section('title')
视频列表
@stop

@section('content')
<section class="series series--show">
    <div class="container">
        <div class="row">
            @foreach (array_chunk($videos->all(), 4) as $row)
                @foreach ($row as $video)
                    <div class="col-lg-3 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                        <div class="card">
                            @if (isNew($video->published_at))
                                <span class="card__update label label-danger">new!</span>
                            @endif
                            <span class="card__video-count">{{ secondForHuman($video->duration) }}</span>
                            <div class="card__img">
                                <a href="{{ route('series.video.show', ['slug' => $video->series->slug, 'vid' => $video->id]) }}">
                                    <img
                                        class="img-responsive"
                                        src="{{ $video->image }}" alt="{{ $video->title }}">
                                    <div class="card__overlay">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="card__details">
                                <h3 class="card__title">
                                    <a href="{{ route('series.video.show', ['slug' => $video->series->id, 'vid' => $video->id]) }}" class="card__title--a">
                                        {{ $video->title }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>

        <div class="pull-right">
            {!! $videos->render() !!}
        </div>
    </div>
</section>
@stop
