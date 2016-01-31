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
                        <div class="col-lg-3 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                            @include('partials.seriesCard')
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
</section>
@stop
