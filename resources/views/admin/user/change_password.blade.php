@extends('admin.layouts.sub')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form id="form">
                <div class="mb-3">
                    <label for="password" class="form-label">旧密码</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">新密码</label>
                    <input type="text" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="mb-3">
                    <label for="again_new_password" class="form-label">重复新密码</label>
                    <input type="text" class="form-control" id="again_new_password" name="again_new_password">
                </div>
                <input type="hidden" name="id" value="{{ session('admin_id') }}">
                <button type="submit" class="btn btn-primary">修改</button>
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
            fields: {
                password: {
                    validators: {
                        notEmpty: true
                    }
                },
                new_password: {
                    validators: {
                        notEmpty: true
                    }
                },
                again_new_password: {
                    validators: {
                        notEmpty: true
                    }
                },
            }
        }).on('success.form.fv', function (e) {
            //阻止表单提交
            e.preventDefault();
            //得到表单对象
            let $form = $(e.target);
            let data = $form.serialize();
            //得到序列化数据
            $.ajax({
                method: 'post',
                url: '{{ route('admin.change_password') }}',
                data: data,
            }).then(response => {
                if (response.code === 200) {
                    $.toasts({
                        type: 'success',
                        content: '修改成功',
                        onHidden: function () {

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
