@extends('layouts.master')

@section('description')
learner.video web newsletter 分享
@stop

@section('title')
learner.video newsletter
@stop

@section('jumbotron')
<section class="page-jumbotron newsletter-page-jumbotron">
    <div class="container">
        <h1>Learner Newsletter</h1>
    </div>
</section>
@stop

@section('content')
<section class="series series--show">
    <div class="container">
        <div class="row">
            @foreach ($newsletters as $newsletter)
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <article class="newsletter__item">
                        <a href="{{ route('newsletters.show', $newsletter->id) }}">
                            <h3>{{ $newsletter->title }}</h3>
                        </a>
                        <p>{{ timeToDate($newsletter->updated_at) }}</p>
                    </article>
                </div>
            @endforeach
        </div>

        <div class="pull-right">
            {!! $newsletters->render() !!}
        </div>
    </div>
</section>
@stop
