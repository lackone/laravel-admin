@extends('admin.layouts.sub')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form id="form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">规则名</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $auth['name'] }}">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">规则标题</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $auth['title'] }}">
                </div>
                <div class="mb-3">
                    @include('admin.common.radio', ['label' => '类型', 'name' => 'type', 'data' => $auth['type'], 'list' => \App\Models\AdminAuth::$typeList, 'default' => \App\Models\AdminAuth::TYPE_BUTTON])
                </div>
                <div class="mb-3">
                    @include('admin.common.select', ['label' => '父级', 'name' => 'pid', 'data' => $auth['pid'], 'list' => $auth_tree])
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">图标</label>
                    <input type="text" class="form-control" id="icon" name="icon" value="{{ $auth['icon'] }}">
                </div>
                <div class="mb-3">
                    @include('admin.common.radio', ['label' => '状态', 'name' => 'status', 'data' => $auth['status'], 'list' => \App\Models\AdminAuth::$statusList, 'default' => \App\Models\AdminAuth::STATUS_ENABLE])
                </div>
                <div class="mb-3">
                    <label for="sort" class="form-label">排序(越小越前)</label>
                    <input type="text" class="form-control" id="sort" name="sort" value="{{ $auth['sort'] }}">
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ adminAsset('admins/lib/formvalidation/js/formValidation.js') }}"></script>
    <script src="{{ adminAsset('admins/lib/formvalidation/js/framework/bootstrap.js') }}"></script>
    <script src="{{ adminAsset('admins/lib/formvalidation/js/language/zh_CN.js') }}"></script>
@endsection

@section('myjs')
    <script>
        $("#form").formValidation({
            //验证字段
            fields: {}
        }).on('success.form.fv', function (e) {
            //阻止表单提交
            e.preventDefault();
            //得到表单对象
            let $form = $(e.target);
            let data = $form.serialize();
            //得到序列化数据
            $.ajax({
                url: "{{ route('admin.auth.save', $auth['id']) }}",
                method: 'post',
                data: data,
            }).then(response => {
                if (response.code === 200) {
                    $.toasts({
                        type: 'success',
                        content: '保存成功',
                        autohide: true,
                        onHidden: function () {
                            parent.modalInstance.setData(true);
                            parent.modalInstance.close();
                        }
                    })
                } else {
                    $.toasts({
                        type: 'danger',
                        content: response.msg,
                    });
                }
            })
        });
    </script>
@endsection
