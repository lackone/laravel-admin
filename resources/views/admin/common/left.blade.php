<div class="bsa-sidebar">
    <div class="card border-0 h-100">
        <!--  侧边栏头部(用于展示品牌logo)  -->
        <div class="card-header bg-body d-flex align-items-center flex-shrink-0">
            <img src="{{ adminAsset('admin/img/favicon-32x32.png') }}" class="bsa-logo-icon" alt="logo-icon">
            <div class="bsa-logo-text ms-2 bsa-ellipsis-2">后台管理系统</div>
        </div>
        <!--  侧边栏身体部分(用于主要的侧边栏菜单)  -->
        <div class="card-body p-0" data-overlayscrollbars-initialize>
            <!--   侧边栏的菜单     -->
            <ul class="bsa-menu" data-bsa-toggle="sidebar" data-accordion="true" data-click-close="true">
                <li>
                    <a href="/admin/welcome">
                        <i class="bi bi-house"></i>欢迎页
                    </a>
                </li>
                @if($menu_list)
                    @foreach($menu_list as $k => $v)
                        @if($v['children'])
                            <li>
                                <a href="javascript:" class="has-children">
                                    <i class="bi {{ $v['icon'] ?: 'bi-list-nested' }}"></i>{{ $v['title'] }}
                                </a>
                                <ul>
                                    @foreach($v['children'] as $kk => $vv)
                                        @if($vv['children'])
                                            <li>
                                                <a href="javascript:" class="has-children">{{ $vv['title'] }}</a>
                                                <ul>
                                                    @foreach($vv['children'] as $kkk => $vvv)
                                                        @if($vvv['children'])
                                                            <li>
                                                                <a href="javascript:"
                                                                   class="has-children">{{ $vvv['title'] }}</a>
                                                                <ul>
                                                                    @foreach($vvv['children'] as $kkkk => $vvvv)
                                                                        <li>
                                                                            <a href="{{ $vvvv['name'] }}">{{ $vvvv['title'] }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @else
                                                            <li><a href="{{ $vvv['name'] }}">{{ $vvv['title'] }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ $vv['name'] }}">{{ $vv['title'] }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ $v['name'] }}">{{ $v['title'] }}</a></li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
