@extends('layouts.master')

@section('description')
{{ $user->displayName() }} 的个人中心 -- Learner.video
@stop

@section('title')
{{ $user->displayName() }} 的个人中心
@stop

@section('jumbotron')
<section class="page-jumbotron user-page-jumbotron">
    <div class="container">
        <img src="{{ asset($user->avatar) }}" alt="{{ $user->displayName() }}" width="120">
    </div>
</section>
@stop

@section('content')
<section class="series series--show">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default user-setting">
                    <div class="panel-heading">设置中心</div>
                    <div class="panel-body">
                        <div class="list-group">
                            <a class="list-group-item{{ useSettingActive('user.profile') }}" href="{{ route('user.profile') }}">个人信息</a>
                            <a class="list-group-item{{ useSettingActive('user.account') }}" href="{{ route('user.account') }}">账户设置</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                @yield('right')
            </div>
        </div>
    </div>
</section>
@stop
