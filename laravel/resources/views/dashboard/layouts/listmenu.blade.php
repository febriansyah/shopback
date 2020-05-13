@foreach ($collections as $menu)
<li class="auth_menu_name {{ (isset($menu_dashboard[$menu['id']])) ? 'treeview' : '' }}{{ (isset($active_menus[$menu['id']])) ? ' active' : '' }}">
    <a href="{{ ($menu['file'] == '#' || $menu['file'] == '') ? '#' : url('dashboard/'. $menu['file']) }}">
        <i class="{{ ($menu['icon_tags'] != '') ? $menu['icon_tags'] : 'fa fa-circle-o' }}"></i> <span class="auth_menu_name"{{ (strlen($menu['menu']) > 25) ? ' style=font-size:12px;' : '' }}>{{ $menu['menu'] }} </span>
        @if (isset($menu_dashboard[$menu['id']]))
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
        @endif
    </a>
    @if (isset($menu_dashboard[$menu['id']]))
        <ul class="treeview-menu ">
            @include('dashboard.layouts.listmenu', ['collections' => $menu_dashboard[$menu['id']]])
        </ul>
    @endif
</li>
@endforeach