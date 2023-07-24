@extends('admin.layouts.sub')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body py-3">
            <form class="row row-cols-sm-auto g-3 align-items-center" method="get"
                  action="{{ route('admin.role.list') }}">
                <div class="col-12">
                    <div class="row">
                        <label for="name" class="col-sm-auto col-form-label">名称</label>
                        <div class="col">
                            <input type="text" class="form-control" id="account" name="name"
                                   value="{{ $params['name'] }}">
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
                        <label for="status" class="col-sm-auto col-form-label">角色状态</label>
                        <div class="col">
                            <select class="selectpicker" name="status">
                                <option value="">所有</option>
                                @foreach(\App\Models\AdminRole::$statusList as $key => $value)
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
                            @if(checkAuth(session('admin_id'), authRoute('admin.role.save')))
                                <a class="btn btn-light add-btn" href="javascript:"
                                   onclick="parent.Quicktab.get('.qtab').addTab({title:'添加角色',url:'{{ route('admin.role.save') }}'})">
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
                                    <div class="th-inner">角色名称</div>
                                </th>
                                <th>
                                    <div class="th-inner">状态</div>
                                </th>
                                <th>
                                    <div class="th-inner">备注</div>
                                </th>
                                <th>
                                    <div class="th-inner">创建时间/更新时间</div>
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
                                    <td>{{ $value['name'] }}</td>
                                    <td>{!! \App\Models\AdminRole::$statusHtmlList[$value['status']] !!}</td>
                                    <td>{{ $value['remark'] }}</td>
                                    <td>
                                        {{ $value['created'] ?: '-' }}
                                        <br>
                                        {{ $value['updated'] ?: '-' }}
                                    </td>
                                    <td>
                                        @if(checkAuth(session('admin_id'), authRoute('admin.role.save')))
                                            <a class="btn btn-light btn-sm edit-btn" href="javascript:"
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               data-bs-title="修改角色"
                                               onclick="parent.Quicktab.get('.qtab').addTab({title:'修改角色-{{ $value['name'] }}',url:'{{ route('admin.role.save', $value['id']) }}'})">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endif

                                        @if(checkAuth(session('admin_id'), authRoute('admin.role.delete')))
                                            <a class="btn btn-light mx-1 btn-sm del-btn" href="javascript:"
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               data-bs-title="删除角色"
                                               data-id="{{ $value['id'] }}">
                                                <i class="bi bi-trash3"></i>
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
                            url: "{{ route('admin.role.delete') }}",
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
