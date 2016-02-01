@extends('layouts/master')

@section('description')
这里有丰富的web学习视频，资料，另外，本站开源在 https://github.com/RryLee/learner.video
@stop

@section('title')
未找到你想要的
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
<section class="page-jumbotron not-found-page-jumbotron">
    <div class="container">
        <h1>404</h1>
    </div>
</section>
@stop
