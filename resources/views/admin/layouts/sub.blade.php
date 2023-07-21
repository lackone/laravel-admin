<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ adminAsset('admin/img/favicon-32x32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ adminAsset('admin/img/favicon-16x16.png') }}" sizes="16x16" type="image/png">
    <meta name="keywords" content="{{ config('admin.keywords') }}">
    <meta name="description" content="{{ config('admin.description') }}">
    <link rel="stylesheet" href="{{ adminAsset('admin/lib/bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ adminAsset('admin/lib/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ adminAsset('admin/lib/bootstrap-table/dist/bootstrap-table.min.css') }}">
    <link rel="stylesheet"
          href="{{ adminAsset('admin/lib/bootstrap-table/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.css') }}">
    <link rel="stylesheet"
          href="{{ adminAsset('admin/lib/@eonasdan/tempus-dominus/dist/css/tempus-dominus.min.css') }}"/>
    <link rel="stylesheet" href="{{ adminAsset('admin/lib/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ adminAsset('admin/lib/overlayscrollbars/styles/overlayscrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ adminAsset('admin/lib/select2/dist/css/select2.min.css') }}"/>
    <link rel="stylesheet"
          href="{{ adminAsset('admin/lib/select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css') }}"/>
    @yield('css')
    <link rel="stylesheet" href="{{ adminAsset('admin/css/bootstrap-admin.min.css') }}">
    @yield('mycss')
    <title>{{ config('admin.title') }}</title>
    <style>
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-body-tertiary py-3">
<div class="container-fluid">
    @include('admin.common.message')

    @yield('content')
</div>

<!--回到顶部开始-->
<a href="javaScript:" class="bsa-back-to-top"><i class='bi bi-arrow-up-short'></i></a>
<!--回到顶部结束-->

<script src="{{ adminAsset('admin/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ adminAsset('admin/lib/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ adminAsset('admin/lib/@popperjs/core/dist/umd/popper.min.js') }}"></script>
<script src="{{ adminAsset('admin/lib/@eonasdan/tempus-dominus/dist/js/tempus-dominus.min.js') }}"></script>
<script src="{{ adminAsset('admin/lib/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ adminAsset('admin/lib/bootstrap-select/dist/js/i18n/defaults-zh_CN.min.js') }}"></script>
<script src="{{ adminAsset('admin/lib/overlayscrollbars/browser/overlayscrollbars.browser.es6.min.js') }}"></script>
<script src="{{ adminAsset('admin/lib/bootstrap-quicktab/dist/js/bootstrap-quicktab.min.js') }}"></script>
<script src="{{ adminAsset('admin/lib/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ adminAsset('admin/lib/select2/dist/js/i18n/zh-CN.js') }}"></script>
@yield('js')
<script src="{{ adminAsset('admin/js/bootstrap-admin.min.js') }}"></script>
<script src="{{ adminAsset('admin/js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        $(".bsa-reset-btn").on("click", function () {
            $("form")[0].reset();
        })

        $(".bsa-querySearch-btn").on('click', function () {
            $("form")[0].submit();
        })

        //==============================日期时间插件====================================
        //日期时间的翻译，由于该插件没有内置中文翻译，需要手动通过选项进行翻译
        let td_zh = {
            today: '回到今天',
            clear: '清除选择',
            close: '关闭选取器',
            selectMonth: '选择月份',
            previousMonth: '上个月',
            nextMonth: '下个月',
            selectYear: '选择年份',
            previousYear: '上一年',
            nextYear: '下一年',
            selectDecade: '选择十年',
            previousDecade: '上一个十年',
            nextDecade: '下一个十年',
            previousCentury: '上一个世纪',
            nextCentury: '下一个世纪',
            pickHour: '选取时间',
            incrementHour: '增量小时',
            decrementHour: '递减小时',
            pickMinute: '选取分钟',
            incrementMinute: '增量分钟',
            decrementMinute: '递减分钟',
            pickSecond: '选取秒',
            incrementSecond: '增量秒',
            decrementSecond: '递减秒',
            toggleMeridiem: '切换上下午',
            selectTime: '选择时间',
            selectDate: '选择日期',
        }

        //自定义日期格式插件
        if (document.getElementById('start_time')) {
            var td6 = new tempusDominus.TempusDominus(document.getElementById('start_time'), {
                //本地化控制
                localization: {
                    ...td_zh,//展开语法
                    format: 'yyyy-MM-dd HH:mm:ss',
                },
                //布局控制
                display: {
                    //视图模式(选择年份视图最先开始)
                    viewMode: 'calendar',
                    components: {
                        //是否开启日历，false:则是时刻模式
                        calendar: true,
                        //支持年份选择
                        year: true,
                        //是否开启月份选择
                        month: true,
                        //支持日期选择
                        date: true,
                        //底部按钮中那个时刻选择是否启用，false则表示隐藏，下面三个需要该选项为true时有效
                        clock: true,
                        //时
                        hours: true,
                        //分
                        minutes: true,
                        //秒
                        seconds: true
                    },
                    //图标
                    icons: {
                        time: 'bi bi-clock',
                        date: 'bi bi-calendar',
                        up: 'bi bi-arrow-up',
                        down: 'bi bi-arrow-down',
                        previous: 'bi bi-chevron-left',
                        next: 'bi bi-chevron-right',
                        today: 'bi bi-calendar-check',
                        clear: 'bi bi-trash',
                        close: 'bi bi-x',
                    },
                    //视图底部按钮
                    buttons: {
                        today: true,
                        clear: true,
                        close: true,
                    },
                }
            });
        }
        if (document.getElementById('end_time')) {
            var td7 = new tempusDominus.TempusDominus(document.getElementById('end_time'), {
                //本地化控制
                localization: {
                    ...td_zh,//展开语法
                    format: 'yyyy-MM-dd HH:mm:ss',
                    //是否使用24小时制,比如3.15分会变成15.15
                    // hourCycle: 'h24'
                },
                //布局控制
                display: {
                    //视图模式(选择年份视图最先开始)
                    viewMode: 'calendar',
                    components: {
                        //是否开启日历，false:则是时刻模式
                        calendar: true,
                        //支持年份选择
                        year: true,
                        //是否开启月份选择
                        month: true,
                        //支持日期选择
                        date: true,
                        //底部按钮中那个时刻选择是否启用，false则表示隐藏，下面三个需要该选项为true时有效
                        clock: true,
                        //时
                        hours: true,
                        //分
                        minutes: true,
                        //秒
                        seconds: true
                    },
                    //图标
                    icons: {
                        time: 'bi bi-clock',
                        date: 'bi bi-calendar',
                        up: 'bi bi-arrow-up',
                        down: 'bi bi-arrow-down',
                        previous: 'bi bi-chevron-left',
                        next: 'bi bi-chevron-right',
                        today: 'bi bi-calendar-check',
                        clear: 'bi bi-trash',
                        close: 'bi bi-x',
                    },
                    //视图底部按钮
                    buttons: {
                        today: true,
                        clear: true,
                        close: true,
                    },
                }
            });
        }
        //事件监听设定起始时间为td7实例的选中时间
        if (document.getElementById('start_time')) {
            td6.subscribe(tempusDominus.Namespace.events.change, (e) => {
                td7.updateOptions({
                    restrictions: {
                        minDate: e.date,
                    },
                });
            });
        }
        //事件监听设定起始时间为td6实例的选中时间
        if (document.getElementById('end_time')) {
            td7.subscribe(tempusDominus.Namespace.events.change, (e) => {
                td6.updateOptions({
                    restrictions: {
                        maxDate: e.date,
                    },
                });
            });
        }

        //下拉框美化插件，原生的bootstrap它会调用系统的那个下拉菜单
        $(".selectpicker").selectpicker();

        $(".select2").select2({
            theme: "bootstrap-5",
            placeholder: "请选择",
            allowClear: true,
            width: '100%',
        });
    })
</script>
@yield('myjs')
</body>
</html>
