<?php
return [
    //名称
    'name' => 'Laravel-admin',

    //LOGO
    'logo' => '',

    //后台目录
    'directory' => app_path('Admin'),

    //标题
    'title' => 'Admin',

    //关键字
    'keywords' => '',

    //描述
    'description' => '',

    //图标
    'favicon' => '',

    'https' => env('ADMIN_HTTPS', false),

    //路由相关配置
    'route' => [
        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),
        'name' => env('ADMIN_ROUTE_NAME', 'admin.'),
        'namespace' => 'App\\Admin\\Controllers',
        'middleware' => ['LoginCheck', 'AuthCheck'],
    ],
];
