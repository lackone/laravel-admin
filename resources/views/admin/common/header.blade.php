<ul class="bsa-header">
    <!-- 侧边栏触发按钮(移动端时显示) -->
    <li class="bsa-sidebar-toggler" data-bsa-toggle="pushmenu">
        <div class="bsa-header-item">
            <i class="bi bi-list"></i>
        </div>
    </li>
    <!--  占位(可以让后面的li居右)  -->
    <li class="flex-grow-1"></li>
    <!--  通知(如果有新消息则添加类名.bsa-has-msg)  -->
    <li>
        <div class="bsa-header-item" data-qt-tab='{"title":"消息中心","url":""}'
             data-qt-target=".qtab">
            <i class="bi bi-bell bsa-has-msg"></i>
        </div>
    </li>
    <!--  全屏  -->
    <li class="bsa-fullscreen-toggler">
        <div class="bsa-header-item">
            <i class="bi bi-arrows-fullscreen"></i>
        </div>
    </li>
    <!--  主题配色  -->
    <li class="dropdown">
        <div class="bsa-header-item" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <i class="bi bi-palette"></i>
        </div>
        <div class="dropdown-menu dropdown-menu-end p-0">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between bg-body">
                    <span class="bsa-fs-15">主题配色</span>
                </div>
                <div class="card-body">
                    <!--    配色包裹      -->
                    <div class="bsa-theme-switcher-wrapper">
                        <input class="form-check-input" type="checkbox" value="light">
                        <input class="form-check-input" type="checkbox" value="dark">
                        <input class="form-check-input" type="checkbox" value="indigo">
                        <input class="form-check-input" type="checkbox" value="green">
                        <input class="form-check-input" type="checkbox" value="blue">
                        <input class="form-check-input" type="checkbox" value="yellow">
                        <input class="form-check-input" type="checkbox" value="pink">
                        <input class="form-check-input" type="checkbox" value="red">
                        <input class="form-check-input" type="checkbox" value="orange">
                        <input class="form-check-input" type="checkbox" value="cyan">
                        <input class="form-check-input" type="checkbox" value="teal">
                    </div>
                </div>
            </div>
        </div>
    </li>
    <!--    管理员信息    -->
    <li class="dropdown">
        <div class="bsa-header-item" data-bs-toggle="dropdown">
            <div class="bsa-user-area">
                <img src="{{ session('admin_info.avatar') ?: adminAsset('admins/img/avatar.png') }}" class="bsa-user-avatar" alt="用户头像">
                <div class="bsa-user-details">
                    <div class="bsa-ellipsis-1 bsa-fs-15">{{ session('admin_info.real_name') ?: session('admin_info.account') }}</div>
                    <!-- 管理员角色RBAC权限设计时可用(不需要可删除,上面的用户名可自动垂直居中)  -->
                    <div class="bsa-ellipsis-1 bsa-fs-13 text-muted">{{ implode(',', $role_name) }}</div>
                </div>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="javascript:"
                   data-qt-tab='{"title":"个人资料","url":"{{ route('admin.user.save', session('admin_id')) }}"}'
                   data-qt-target=".qtab">
                    <i class="bi bi-person me-2"></i>个人资料
                </a>
            </li>
            <li>
                <a class="dropdown-item bsa-clear-cache" href="javascript:"
                   data-qt-tab='{"title":"修改密码","url":"{{ route('admin.changePassword', ['id' => session('admin_id')]) }}"}'
                   data-qt-target=".qtab">
                    <i class="bi bi-key me-2"></i>修改密码
                </a>
            </li>
            <li>
                <div class="dropdown-divider"></div>
            </li>
            <li class="bsa-logout">
                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                    <i class="bi bi-box-arrow-right me-2"></i>退出登录
                </a>
            </li>
        </ul>
    </li>
</ul>
