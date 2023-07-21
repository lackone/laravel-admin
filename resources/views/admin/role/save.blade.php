@extends('admin.layouts.sub')

@section('css')
    <link rel="stylesheet" href="{{ adminAsset('admin/lib/@ztree/ztree_v3/css/zTreeStyle/zTreeStyle.css') }}">
@endsection

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form id="form" method="post" action="{{ route('admin.role.save', $role['id']) }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">名称</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $role['name'] }}">
                </div>
                <div class="mb-3">
                    <label for="remark" class="form-label">权限</label>
                    <input type="hidden" id="auth_ids" name="auth_ids" value="">
                    <div class="" style="max-height:640px;overflow-y:auto;">
                        <ul id="auth-list" class="ztree"></ul>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="remark" class="form-label">备注</label>
                    <input type="text" class="form-control" id="remark" name="remark" value="{{ $role['remark'] }}">
                </div>
                <div class="mb-3">
                    @include('admin.common.radio', ['label' => '状态', 'name' => 'status', 'data' => $role['status'], 'list' => \App\Models\AdminRole::$statusList])
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ adminAsset('admin//lib/@ztree/ztree_v3/js/jquery.ztree.all.min.js') }}"></script>
@endsection

@section('myjs')
    <script>
        $(function () {
            $("form").on("submit", function() {
                let nodes = treeObj.getCheckedNodes(true);
                let ids = [];
                if (nodes) {
                    for (let ix in nodes) {
                        ids.push(nodes[ix].id);
                    }
                }
                $("#auth_ids").val(ids.join(","));
            })

            let treeObj = $.fn.zTree.init($("#auth-list"), {
                view: {
                    showIcon: false,
                },
                check: {
                    //是否开启选择框
                    enable: true,
                    chkStyle: 'checkbox',
                    chkboxType: {"Y": "ps", "N": "ps"}
                },
                data: {
                    simpleData: {
                        enable: true,
                        idKey: "id",
                        pIdKey: "pid",
                    },
                    key: {
                        name: "title"
                    },
                    render: {
                        name: function (name, treeNode) {
                            let type = '';
                            if (treeNode.type == '{{ \App\Models\AdminAuth::TYPE_MENU }}') {
                                type = ' [菜单] ';
                            } else if (treeNode.type == '{{ \App\Models\AdminAuth::TYPE_BUTTON }}') {
                                type = ' [按钮] ';
                            }
                            return name + type;
                        },
                        title: function (title, treeNode) {
                            return title;
                        }
                    }
                }
            }, JSON.parse('{!! jsonEncode($auth_list) !!}'));

            treeObj.expandAll(true);
        });
    </script>
@endsection
