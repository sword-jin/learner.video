@extends('layouts.master')

@section('description')
Learner 全部视频列表,　涵盖各个方面
@stop

@section('title')
视频列表
@stop

@section('style')
<style>
/* style for waterfall grid */
.wf-container {
    margin: 0 auto;
}
.wf-container:before,.wf-container:after {
    content: '';
    display: table;
}
.wf-container:after {
    clear: both;
}
.wf-box {
    margin: 10px;
}
.wf-box img {
    display: block;
    width: 100%;
}
.wf-box .content {
    border: 1px solid #ccc;
    border-top-width: 0;
    padding: 5px 8px;
}
.wf-column {
    float: left;
}

@media screen and (min-width: 768px) {
    .wf-container { width: 750px; }
}
@media screen  and (min-width: 992px) {
    .wf-container { width: 970px; }
}
@media screen and (min-width: 1200px) {
    .wf-container { width: 1170px; }
}
</style>
@stop

@section('content')
<section class="series series--show">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="waterfall-container">
                    @foreach ($videos as $video)
                        <div class="card">
                            @if (isNew($video->published_at))
                                <span class="card__update label label-danger">new!</span>
                            @endif
                            <span class="card__video-count">{{ secondForHuman($video->duration) }}</span>
                            <div class="card__img">
                                <a href="{{ route('series.video.show', ['slug' => $video->series->slug, 'vid' => $video->id]) }}">
                                    <img
                                        class="img-responsive"
                                        src="{{ $video->image }}"
                                        alt="{{ $video->title }}">
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
                    @endforeach
                </div>
            </div>
        </div>

        <div class="pull-right">
            {!! $videos->render() !!}
        </div>
    </div>
</section>
@stop

@section('script')
<script src="{{ asset('js/waterfall.js') }}"></script>
<script>
    $(document).ready(function () {
        var waterfall = new Waterfall({
            containerSelector: '.waterfall-container',
            boxSelector: '.card',
            minBoxWidth: 250
        });
    });
</script>
@stop
