@extends('layouts.master')

@section('style')
<style>
    body {
        padding-top: 130px;
    }
</style>
@stop

@section('title')
	{{ lang('recovery.reset.panel_title', 'Reset Password') }}
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @include("errors/list")

            <div class="panel panel-default">
                <div class="panel-heading">{{ lang('recovery.reset.panel_title', 'Reset Password') }}</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('password/reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ lang('recovery.reset.panel_title', 'Email Address') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ lang('recovery.reset.password', 'Password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ lang('recovery.reset.password_confirmation', 'Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i>
                                    {{ lang('recovery.reset.submit', 'Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
