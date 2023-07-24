@extends('admin.layouts.sub')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body py-3">
            <form class="row row-cols-sm-auto g-3 align-items-center" method="get"
                  action="{{ route('admin.user.list') }}">
                <div class="col-12">
                    <div class="row">
                        <label for="account" class="col-sm-auto col-form-label">账号</label>
                        <div class="col">
                            <input type="text" class="form-control" id="account" name="account"
                                   value="{{ $params['account'] }}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <label for="phone" class="col-sm-auto col-form-label">手机号</label>
                        <div class="col">
                            <input type="text" class="form-control" id="phone" name="phone"
                                   value="{{ $params['phone'] }}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <label for="start_time" class="col-sm-auto col-form-label">创建时间</label>
                        <div class="col">
                            <div class="input-group">
                                <input type="text" readonly class="form-control" aria-label="q"
                                       placeholder="开始时间"
                                       name="start_time" id="start_time" value="{{ $params['start_time'] }}">
                                <span class="input-group-text"><i class="bi bi-arrow-left-right"></i></span>
                                <input type="text" readonly class="form-control" aria-label="q"
                                       placeholder="结束时间"
                                       name="end_time" id="end_time" value="{{ $params['end_time'] }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <label for="status" class="col-sm-auto col-form-label">用户状态</label>
                        <div class="col">
                            <select class="selectpicker" name="status">
                                <option value="">所有</option>
                                @foreach(\App\Models\Admin::$statusList as $key => $value)
                                    <option
                                        value="{{ $key }}" {{ $params['status'] == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 gap-2">
                    <button type="button" class="btn btn-light bsa-querySearch-btn">
                        <i class="bi bi-search"></i>搜索
                    </button>
                    <button type="button" class="btn btn-light bsa-reset-btn">
                        <i class="bi bi-arrow-clockwise"></i>重置
                    </button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="bootstrap-table bootstrap5">
                <div class="fixed-table-toolbar">
                    <div class="bs-bars float-left">
                        <div id="toolbar" class="d-flex flex-wrap gap-2 mb-2">
                            @if(checkAuth(session('admin_id'), authRoute('admin.user.save')))
                                <a class="btn btn-light add-btn" href="javascript:"
                                   onclick="parent.Quicktab.get('.qtab').addTab({title:'添加用户',url:'{{ route('admin.user.save') }}'})">
                                    <i class="bi bi-plus"></i> 新增
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="fixed-table-container">
                    <div class="fixed-table-body">
                        <table id="table" class="table table-bordered table-hover table-sm align-middle"
                               style="text-align:center">
                            <thead>
                            <tr>
                                <th>
                                    <div class="th-inner">ID</div>
                                </th>
                                <th>
                                    <div class="th-inner">账号</div>
                                </th>
                                <th>
                                    <div class="th-inner">头像/昵称/姓名</div>
                                </th>
                                <th>
                                    <div class="th-inner">所属角色</div>
                                </th>
                                <th>
                                    <div class="th-inner">手机号</div>
                                </th>
                                <th>
                                    <div class="th-inner">邮箱</div>
                                </th>
                                <th>
                                    <div class="th-inner">状态</div>
                                </th>
                                <th>
                                    <div class="th-inner">超级管理员</div>
                                </th>
                                <th>
                                    <div class="th-inner">备注</div>
                                </th>
                                <th>
                                    <div class="th-inner">创建时间/更新时间</div>
                                </th>
                                <th>
                                    <div class="th-inner">登录时间/IP</div>
                                </th>
                                <th>
                                    <div class="th-inner">操作</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $value)
                                <tr>
                                    <td>{{ $value['id'] }}</td>
                                    <td>{{ $value['account'] }}</td>
                                    <td>
                                        <img src="{{ $value['avatar'] ?: adminAsset('admins/img/avatar.png') }}" class="avatar">
                                        <br>
                                        {{ $value['nick'] }}
                                        <br>
                                        {{ $value['real_name'] }}
                                    </td>
                                    <td>
                                        @if($value['roles'])
                                            @foreach($value['roles'] as $role)
                                                {{ $role['name'] }}<br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $value['phone'] }}</td>
                                    <td>{{ $value['email'] }}</td>
                                    <td>{!! \App\Models\Admin::$statusHtmlList[$value['status']] !!}</td>
                                    <td>{{ \App\Models\Admin::$isSuperList[$value['is_super']] }}</td>
                                    <td>{{ $value['remark'] }}</td>
                                    <td>
                                        {{ $value['created'] ?: '-' }}
                                        <br>
                                        {{ $value['updated'] ?: '-' }}
                                    </td>
                                    <td>
                                        {{ paramConvert($value['last_login_time'], 'datetime') }}
                                        <br>
                                        {{ $value['last_login_ip'] }}
                                    </td>
                                    <td>
                                        @if(checkAuth(session('admin_id'), authRoute('admin.user.save')))
                                            <a class="btn btn-light btn-sm edit-btn" href="javascript:"
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               data-bs-title="修改用户"
                                               onclick="parent.Quicktab.get('.qtab').addTab({title:'修改用户-{{ $value['account'] }}',url:'{{ route('admin.user.save', $value['id']) }}'})">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endif

                                        @if(checkAuth(session('admin_id'), authRoute('admin.user.delete')))
                                            <a class="btn btn-light mx-1 btn-sm del-btn" href="javascript:"
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               data-bs-title="删除用户"
                                               data-id="{{ $value['id'] }}">
                                                <i class="bi bi-trash3"></i>
                                            </a>
                                        @endif

                                        @if(checkAuth(session('admin_id'), authRoute('admin.user.set_role')))
                                            <a class="btn btn-light btn-sm role-btn" href="javascript:"
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               data-bs-title="分配角色"
                                               onclick="parent.Quicktab.get('.qtab').addTab({title:'分配角色-{{ $value['account'] }}',url:'{{ route('admin.user.set_role', $value['id']) }}'})">
                                                <i class="bi bi-person-square"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('admin.common.pagination', ['results' => $list])
            </div>
        </div>
    </div>
@endsection

@section('myjs')
    <script>
        $(function () {
            $(".del-btn").on("click", function () {
                let id = $(this).data("id");
                $.modal({
                    body: '确定要删除?',
                    ok: function () {
                        $.ajax({
                            url: "{{ route('admin.user.delete') }}",
                            method: 'post',
                            data: {"id": id}
                        }).then(response => {
                            if (response.code === 200) {
                                $.toasts({
                                    type: 'success',
                                    content: '删除成功',
                                    onHidden: function () {
                                        parent.Quicktab.get('.qtab').refreshActiveTab();
                                    }
                                })
                            } else {
                                $.toasts({
                                    type: 'danger',
                                    content: response.msg,
                                });
                            }
                        });
                    }
                })
            })
        })
    </script>
@endsection
