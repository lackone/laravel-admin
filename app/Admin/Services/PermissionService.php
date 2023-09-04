<?php

namespace App\Admin\Services;

use App\Models\Admin;

class PermissionService
{
    /**
     * 控制查询
     * @param $query
     */
    public static function search($query)
    {
        if (session('admin_info.is_super') != Admin::IS_SUPER_YES &&
            !in_array(session('admin_id'), UserService::getAdminIds())
        ) {
            $query->where('admin_id', session('admin_id'));
        }
    }
}
