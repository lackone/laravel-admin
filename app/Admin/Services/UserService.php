<?php

namespace App\Admin\Services;

use App\Models\Admin;
use App\Models\AdminRoleAssoc;
use Illuminate\Support\Str;

class UserService
{
    //管理员角色ID
    const ADMIN_ROLE_ID = 1;

    /**
     * 用户登录
     */
    public static function login($account, $password)
    {
        $admin = Admin::where('account', $account)->first();
        if (!$admin) {
            throw new \Exception('未找到账号');
        }

        if ($admin['password'] != self::makePassword($admin['salt'], $password)) {
            throw new \Exception('密码错误');
        }

        $admin->last_login_ip = getRealIp();
        $admin->last_login_time = time();
        $admin->save();

        session([
            'admin_id' => $admin['id'],
            'admin_info' => $admin->toArray(),
        ]);

        return self::loginInfoFormat($admin);
    }

    /**
     * 修改密码
     * @return bool
     */
    public static function changePassword($admin_id, $new_password)
    {
        $admin = Admin::find($admin_id);
        $salt = Str::random(6);
        $admin->salt = $salt;
        $admin->password = self::makePassword($salt, $new_password);
        $admin->save();

        return true;
    }

    /**
     * 登录信息格式化
     * @param $admin
     * @return mixed
     */
    public static function loginInfoFormat($admin)
    {
        unset($admin['salt'], $admin['password']);

        return $admin;
    }

    /**
     * 生成密码
     * @param $salt
     * @param $password
     * @return string
     */
    public static function makePassword($salt, $password)
    {
        return md5(md5($salt) . $password);
    }

    /**
     * 获取管理员的IDS
     */
    public static function getAdminIds()
    {
        return AdminRoleAssoc::where('role_id', self::ADMIN_ROLE_ID)->pluck('admin_id')->toArray();
    }
}
