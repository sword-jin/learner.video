@extends('user.template')

@section('right')

@include('errors.list')

<div class="panel panel-default user-setting">
    <div class="panel-heading">信息设置</div>
    <div class="panel-body">
        <form action="{{ route('user.profile.update') }}" method="POST" role="form" class="panel-form">
            {!! csrf_field() !!}
            <!-- Username field -->
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') ?:$user->username }}">
            </div>

            <!-- Nickname field -->
            <div class="form-group">
                <label for="nickname">昵称(用于显示)</label>
                <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname') ?:$user->nickname }}">
            </div>

            <!-- Email field -->
            <div class="form-group">
                <label>邮箱</label>
                <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success" value="更新">
            </div>
        </form>
    </div>
</div>
@stop
