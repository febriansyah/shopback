
<aside class="main-sidebar">
    <section class="sidebar">

    	<div id="sidebar-auth">

	        <ul class="sidebar-menu list" data-widget="tree" id="sidebar-auth-menu">
	            <li class="header">MAIN NAVIGATION</li>
	            <li {!! ( ! request()->segment(2) ) ? ' class="active"' : '' !!}><a href="{{ route('master.index') }}"><i class="fa fa-dashboard"></i> <span class="auth_menu_name">Dashboard</span></a></li>

				@include('master.layouts.listmenu', ['collections' => $menu_dashboard['root']])
	        </ul><!-- /.sidebar-menu -->
        </div>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- /.main-sidebar -->

