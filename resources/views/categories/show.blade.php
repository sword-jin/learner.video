@extends('layouts.master')

@section('description')
Learner.video 下 {{ $category->name }} 的所有系列
@stop

@section('title')
{{ $category->name }}
@stop

@section('style')
<style>
    @media (min-width: 768px) {
        body {
            padding-top: 84px;
        }
    }
</style>
@stop

@section('jumbotron')
<section class="page-jumbotron category-page-jumbotron">
    <div class="container">
        <h1>
            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" width="60" class="img-circle">
            {{ $category->name }}
        </h1>
    </div>
</section>
@stop

@section('content')
<section class="series series--show">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-lg-offset-0 col-md-9 col-md-offset-0 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="row">
                    @if (count($category->series))
                        @foreach (array_chunk($category->series->all(), 4) as $row)
                            @foreach ($row as $series)
                                <div class="col-md-4 col-sm-6">
                                    @include('partials.seriesCard')
                                </div>
                            @endforeach
                        @endforeach
                    @else
                        <p>No Videos.</p>
                    @endif
                </div>
            </div>

            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
                @include('partials.categoryList')
            </div>
        </div>
    </div>
</section>
@stop
