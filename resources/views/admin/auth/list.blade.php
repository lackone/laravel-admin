@extends('admin.layouts.sub')

@section('css')
    <link rel="stylesheet" href="{{ adminAsset('admin/lib/@ztree/ztree_v3/css/zTreeStyle/zTreeStyle.css') }}">
@endsection

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col col-1">
                    @if(checkAuth(session('admin_id'), authRoute('admin.auth.save')))
                        <a class="btn btn-primary add-btn" href="javascript:"
                           onclick="parent.Quicktab.get('.qtab').addTab({title:'添加权限',url:'{{ route('admin.auth.save') }}'})">
                            <i class="bi bi-plus"></i> 新增
                        </a>
                    @endif
                </div>
            </div>
            <div class="row" style="">
                <ul id="auth-list" class="ztree"></ul>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ adminAsset('admin//lib/@ztree/ztree_v3/js/jquery.ztree.all.min.js') }}"></script>
@endsection

@section('myjs')
    <script>
        $(function () {
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

                            let rule = ' [' + treeNode.name + '] ';

                            if (treeNode.type == '{{ \App\Models\AdminAuth::TYPE_MENU }}') {
                                type = ' [菜单] ';
                            } else if (treeNode.type == '{{ \App\Models\AdminAuth::TYPE_BUTTON }}') {
                                type = ' [按钮] ';
                            }
                            return name + rule + type;
                        },
                        title: function (title, treeNode) {
                            return title;
                        }
                    }
                },
                view: {
                    showIcon: false,
                    fontCss: function (treeId, treeNode) {
                        return treeNode.status == '{{ \App\Models\AdminAuth::STATUS_DISABLE }}' ? {color: "red"} : {};
                    },
                    addDiyDom: function (treeId, treeNode) {
                        let aObj = $("#" + treeNode.tId + "_a");

                        let editStr = ``;

                        if ("{{ checkAuth(session('admin_id'), authRoute('admin.auth.save')) ? '1' : '0' }}" == "1") {
                            editStr += `<i class="bi bi-plus me-2" role="button" id="addBtn_${treeNode.id}"></i>`;
                        }
                        if ("{{ checkAuth(session('admin_id'), authRoute('admin.auth.save')) ? '1' : '0' }}" == "1") {
                            editStr += `<i class="bi bi-pencil-square me-2" role="button" id="editBtn_${treeNode.id}"></i>`;
                        }
                        if ("{{ checkAuth(session('admin_id'), authRoute('admin.auth.delete')) ? '1' : '0' }}" == "1") {
                            editStr += `<i class="bi bi-x-lg" role="button" id="delBtn_${treeNode.id}"></i>`;
                        }

                        aObj.after(editStr);

                        //添加按钮
                        $("#addBtn_" + treeNode.id).on('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            let id = treeNode.id;
                            window.modalInstance = $.modal({
                                url: '{{ route('admin.auth.save') }}?pid=' + id,
                                title: '添加权限',
                                buttons: [],
                                modalDialogClass: 'modal-dialog-centered modal-lg',
                                onHidden: function (obj, data) {
                                    if (data === true) {
                                        parent.Quicktab.get('.qtab').refreshActiveTab();
                                    }
                                }
                            })
                        })

                        //编辑按钮
                        $("#editBtn_" + treeNode.id).on('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            let title = treeNode.title;
                            let id = treeNode.id;
                            window.modalInstance = $.modal({
                                url: '{{ route('admin.auth.save') }}/' + id,
                                title: '修改权限-' + title,
                                buttons: [],
                                modalDialogClass: 'modal-dialog-centered modal-lg',
                                onHidden: function (obj, data) {
                                    if (data === true) {
                                        parent.Quicktab.get('.qtab').refreshActiveTab();
                                    }
                                }
                            })
                        })

                        //删除按钮
                        $("#delBtn_" + treeNode.id).on("click", function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            let title = treeNode.title;
                            let id = treeNode.id;
                            $.modal({
                                body: '确定要删除-' + title + '?',
                                ok: function () {
                                    $.ajax({
                                        url: "{{ route('admin.auth.delete') }}",
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
                        });
                    }
                }
            }, JSON.parse('{!! jsonEncode($auth_list) !!}'));

            treeObj.expandAll(true);
        });
    </script>
@endsection
