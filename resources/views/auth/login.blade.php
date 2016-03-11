@extends('layouts.master')

@section('description')
登陆 - Learner.video
@stop

@section('style')
<style>
    body {
        padding-top: 130px;
    }
</style>
@stop

@section('title')
{{ lang('login.panel_title', 'Login') }}
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @include("errors/list")

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ lang('login.panel_title', 'Login') }}
                    <div class="pull-right social-group">
                        <a href="{{ route('auth.github.login') }}"><i class="fa fa-github"></i></a>
                        <a href="{{ route('auth.twitter.login') }}"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.login.post') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('credential') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ lang('login.credential', 'Username/Email') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="credential" value="{{ old('credential') }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('login.password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ lang('login.remember', 'Remember me?') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>{{ lang('login.submit', 'Login') }}
                                </button>

                                <a class="btn btn-link no-hover-decoration" href="{{ url('password/reset') }}">{{ lang('login.forget', 'Forget your password?') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
