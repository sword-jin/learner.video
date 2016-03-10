@extends('layouts.master')

@section('description')
{{ $newsletter->title }} learner.video web newsletter 分享
@stop

@section('title')
{{ $newsletter->title }}
@stop

@section('jumbotron')
<section class="page-jumbotron newsletter-page-jumbotron">
    <div class="container">
        <h1>{{ $newsletter->title }}</h1>
    </div>
</section>
@stop

@section('content')
<section class="series series--show">
    <div class="container">
        <div class="row">
            @foreach ($newsletter->links as $link)
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <article class="newsletter__item">
                        <a href="{{ $link->link }}" target="_blank">
                            <h3>{{ $link->title }}</h3>
                        </a>
                        <p>{{ $link->note }}</p>
                        <p>{{ timeToDate($newsletter->updated_at) }}</p>
                    </article>
                </div>
            @endforeach
    </div>
    <div class="container">
        <div class="text-center">
        @include('partials.share.share')
        </div>
    </div>
</div>
@stop

@section('script')
@include('partials.share.shareScript')
@stop
