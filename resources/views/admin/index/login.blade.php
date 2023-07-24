<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ adminAsset('admins/img/favicon-32x32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ adminAsset('admins/img/favicon-16x16.png') }}" sizes="16x16" type="image/png">
    <meta name="keywords" content="{{ config('admin.keywords') }}">
    <meta name="description" content="{{ config('admin.description') }}">
    <link rel="stylesheet" href="{{ adminAsset('admins/lib/bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ adminAsset('admins/lib/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ adminAsset('admins/css/bootstrap-admin.min.css') }}">
    <title>{{ config('admin.title') }}</title>
</head>
<body>
<div class="min-vh-100  p-2 bg-body-tertiary d-flex flex-column align-items-center justify-content-center">
    <h2>后台管理系统</h2>
    <p class="text-secondary"></p>
    <form id="form" class="form" style="width:380px;max-width:100%">
        @csrf
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white "><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" placeholder="请输入用户" name="account" id="account"
                       aria-label="account">
            </div>
        </div>

        <div class="mb-3">
            <div class="input-group bsa-show_hide_password">
                <span class="input-group-text bg-white"><i class="bi bi-person-lock"></i></span>
                <input type="password" class="form-control" placeholder="请输入密码"
                       name="password"
                       autocomplete="off"
                       id="password" aria-label="password">
                <span class="input-group-text bg-white bsa-cursor-pointer"><i class="bi bi-eye-slash"></i></span>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-outline-success" type="submit"><i class="bi bi-box-arrow-in-right"></i> 登入</button>
        </div>
    </form>
</div>

<script src="{{ adminAsset('admins/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ adminAsset('admins/lib/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ adminAsset('admins/lib/formvalidation/js/formValidation.js') }}"></script>
<script src="{{ adminAsset('admins/lib/formvalidation/js/framework/bootstrap.js') }}"></script>
<script src="{{ adminAsset('admins/lib/formvalidation/js/language/zh_CN.js') }}"></script>
<script src="{{ adminAsset('admins/js/bootstrap-admin.min.js') }}"></script>
<script src="{{ adminAsset('admins/js/app.js') }}"></script>
<script>
    $(function () {
        //前端表单验证
        $('#form').formValidation({
            fields: {
                account: {
                    validators: {
                        notEmpty: true,
                    }
                },
                password: {
                    validators: {
                        notEmpty: true,
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            //阻止表单提交
            e.preventDefault();
            //得到表单对象
            let $form = $(e.target);
            //获取数据
            let data = $form.serialize();
            //发起ajax请求
            $.ajax({
                method: 'post',
                url: '{{ route('admin.login') }}',
                data: data,
            }).then(response => {
                if (response.code === 200) {
                    $.toasts({
                        type: 'success',
                        content: '登录成功',
                        onHidden: function () {
                            top.location.replace('{{ route('admin.index') }}');
                        }
                    })
                } else {
                    $.toasts({
                        type: 'danger',
                        content: response.msg,
                    });
                }
            });
        });
    })
</script>
</body>
</html>
