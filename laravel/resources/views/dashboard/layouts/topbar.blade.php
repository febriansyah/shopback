
<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboard.index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>MEGAZINE</b> CMS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <span class="app-title">Megazine</span>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                       
                        <span class="hidden-xs">Hi! {{ $users->name }} </span>&nbsp;
                        <i class="fa fa-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            
                            <p>
                                
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                              <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                            </div>
                            <div class="pull-right">
                                <a href="{{url('dashboard/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                    <!--/.dropdown-menu-->
                </li>
                <!--/.user-menu-->
            </ul>
            <!--/.nav-->
        </div>
    </nav>
</header>