<?php

namespace App\Admin\Controllers;

use App\Admin\Services\RBAC;
use App\Admin\Services\User;
use App\Models\AdminAuth;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页
     */
    public function index(Request $request)
    {
        $admin_id = $request->input('admin_id');

        $menu_list = RBAC::authTreeById($admin_id, AdminAuth::TYPE_MENU);
        $role_name = RBAC::roleNameById($admin_id);

        return view('admin.index.index', compact('menu_list', 'role_name'));
    }

    /**
     * 欢迎
     */
    public function welcome(Request $request)
    {
        return view('admin.index.welcome');
    }

    /**
     * 登录
     */
    public function login(Request $request)
    {
        $params = $request->all();

        if ($request->ajax()) {
            try {
                if (!$params['account'] || !$params['password']) {
                    return error('账号和密码不能为空');
                }

                $res = User::login($params['account'], $params['password']);

                return success($res);
            } catch (\Exception $e) {
                return error($e->getMessage());
            }
        }

        return view('admin.index.login');
    }

    /**
     * 登出
     */
    public function logout(Request $request)
    {
        session()->flush();

        if ($request->ajax()) {
            return success();
        }

        return redirect(route('admin.login'));
    }

    /**
     * 错误
     */
    public function forbidden(Request $request)
    {
        $msg = $request->input('msg');

        return view('admin.index.forbidden', compact('msg'));
    }

    /**
     * 文件上传
     * @param Request $request
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file->store('images/' . date('Ym') . '/' . date('d'));

            return success([
                'ext' => $request->file->extension(),
                'path' => '/' . ltrim($path, '/'),
                'url' => asset($path),
            ]);
        }

        return error('请重新上传文件');
    }
}
