@extends('layouts.master')

@section('description')
{{ $user->username }} 的个人中心 -- Learner.video
@stop

@section('title')
{{ $user->username }} 的个人中心
@stop

@section('style')
@include('partials.body-padding-fix')
@stop

@section('jumbotron')
<section class="page-jumbotron user-page-jumbotron">
    <div class="container">
        <img src="{{ asset($user->avatar) }}" alt="{{ $user->username }}" width="50">
        <div class="loading">Waiting<span class="dot-one"> .</span><span class="dot-two"> .</span><span class="dot-three"> .</span></div>
    </div>
</section>
@stop

@section('content')
<section class="series series--show">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-0 col-md-10 col-md-offset-0 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="something">
                    说真的，感觉这么项目有点个人化，暂时没有想好这里可以做什么，有什么意见欢迎上
                    <a href="https://github.com/RryLee/learner.video">github</a> 提出，
                    或者博客进行讨论。
                </div>
            </div>
        </div>
    </div>
</section>
@stop
