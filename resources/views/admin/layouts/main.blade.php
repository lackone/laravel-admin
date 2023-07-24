<!doctype html>
<html lang="{{ config('app.locale') }}">
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
    <link rel="stylesheet" href="{{ adminAsset('admins/lib/overlayscrollbars/styles/overlayscrollbars.min.css') }}">
    @yield('css')
    <link rel="stylesheet" href="{{ adminAsset('admins/css/bootstrap-admin.min.css') }}">
    @yield('mycss')
    <title>{{ config('admin.title') }}</title>
</head>
<body data-theme="light">
<!--头部导航-->
@include('admin.common.header')

<!--侧边栏-->
@include('admin.common.left')

<!--内容区域(.bsa-content-fixed类删除后即可变成单页版本)-->
<div class="bsa-content bsa-content-fixed">
    <div class="qtab" data-qt-tabs='[{"title":"欢迎页","url":"/admin/welcome","close":false}]'></div>
    @yield('content')
</div>

<!--版权信息-->
@include('admin.common.footer')

<script src="{{ adminAsset('admins/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ adminAsset('admins/lib/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ adminAsset('admins/lib/overlayscrollbars/browser/overlayscrollbars.browser.es6.min.js') }}"></script>
<script src="{{ adminAsset('admins/lib/bootstrap-quicktab/dist/js/bootstrap-quicktab.min.js') }}"></script>
@yield('js')
<script src="{{ adminAsset('admins/js/bootstrap-admin.min.js') }}"></script>
<script src="{{ adminAsset('admins/js/app.js') }}"></script>
@yield('myjs')
<script>
    $(document).ready(function () {
        Quicktab.get(".qtab")._option.onTabActivated = function (e) {
            e.target.refreshActiveTab();
        }

        //退出登录
        $(document).on('click', '.bsa-logout', function (e) {
            e.preventDefault();
            $.modal({
                body: '确定要退出吗？',
                cancelBtn: true,
                ok: function () {
                    //请求退出路由
                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.logout') }}',
                    }).then(response => {
                        if (response.code === 200) {//跳转到后台首页
                            $.toasts({
                                type: 'success',
                                content: '退出成功',
                                onHidden: function () {
                                    top.location.replace('{{ route('admin.login') }}');
                                }
                            })
                        }
                    });
                }
            })
        });
    });
</script>
</body>
</html>
