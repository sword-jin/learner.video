@extends('user.template')

@section('right')

@include('errors.list')

<div class="panel panel-default user-setting">
    <div class="panel-heading">账户设置</div>
    <div class="panel-body">
        <form action="{{ route('user.account.update') }}" method="POST" role="form" class="panel-form">
            {!! csrf_field() !!}
            <!-- CurrentPassword field -->

            @if ($user->password !== null)
            <div class="form-group">
                <label for="currentPassword">当前密码</label>
                <input type="password" class="form-control" name="currentPassword" id="currentPassword">
            </div>
            @endif

            <!-- New Password field -->
            <div class="form-group">
                <label for="password">新密码</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <!-- Password_confirmation field -->
            <div class="form-group">
                <label for="password_confirmation">确认密码</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="修改">
            </div>
        </form>
    </div>
</div>
@stop
