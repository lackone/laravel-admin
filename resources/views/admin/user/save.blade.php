@extends('admin.layouts.sub')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form id="form" method="post" action="{{ route('admin.user.save', $admin['id']) }}">
                @csrf
                <div class="mb-3">
                    <label for="account" class="form-label">账号(登录使用)</label>
                    <input type="text" class="form-control" id="account" name="account" value="{{ $admin['account'] }}">
                </div>
                <div class="mb-3">
                    <label for="nick" class="form-label">昵称</label>
                    <input type="text" class="form-control" id="nick" name="nick" value="{{ $admin['nick'] }}">
                </div>
                <div class="mb-3">
                    <label for="real_name" class="form-label">真实姓名</label>
                    <input type="text" class="form-control" id="real_name" name="real_name"
                           value="{{ $admin['real_name'] }}">
                </div>
                <div class="mb-3">
                    <label for="real_name" class="form-label">头像</label>
                    <div class="col">
                        @include('admin.common.croppie', ['name' => 'avatar', 'value' => $admin['avatar']])
                    </div>
                </div>
                <div class="mb-3">
                    @include('admin.common.radio', ['label' => '性别', 'name' => 'sex', 'data' => $admin['sex'], 'list' => \App\Models\Admin::$sexList, 'default' => \App\Models\Admin::SEX_UNKNOWN])
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">密码</label>
                    <input type="text" class="form-control" id="password" name="password" value="">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">手机号</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $admin['phone'] }}">
                </div>
                <div class="mb-3">
                    <label for="tel" class="form-label">座机</label>
                    <input type="text" class="form-control" id="tel" name="tel" value="{{ $admin['tel'] }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">邮箱</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $admin['email'] }}">
                </div>
                <div class="mb-3">
                    <label for="weixin" class="form-label">微信</label>
                    <input type="text" class="form-control" id="weixin" name="weixin" value="{{ $admin['weixin'] }}">
                </div>
                <div class="mb-3">
                    @include('admin.common.radio', ['label' => '超级管理员', 'name' => 'is_super', 'data' => $admin['is_super'], 'list' => \App\Models\Admin::$isSuperList, 'default' => \App\Models\Admin::IS_SUPER_NO])
                </div>
                <div class="mb-3">
                    @include('admin.common.radio', ['label' => '状态', 'name' => 'status', 'data' => $admin['status'], 'list' => \App\Models\Admin::$statusList, 'default' => \App\Models\Admin::STATUS_ENABLE])
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">地址</label>
                    <textarea class="form-control" name="address" id="address" rows="3">{{ $admin['address'] }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="remark" class="form-label">备注</label>
                    <textarea class="form-control" name="remark" id="remark" rows="3">{{ $admin['remark'] }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
@endsection
