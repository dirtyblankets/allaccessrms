<header class="main-header">
    <!-- Logo -->
    <a href="{{ URL::route('admin::dashboard') }}" class="logo">
      <!-- logo for regular state and mobile devices -->
        AA<b>RMS</b>
    </a>    
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <!--Sidebar Toggle Button
                <a href="#" id="sidebar-toggle" type="button">
                    <span class="sr-only">
                        Toggle navigation
                    </span>
                    <span class="fa fa-bars"></span> 
                </a>-->
            </div>
            <!--Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> {{ Auth::user()->getFullName() }}<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <!--<li><a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a></li>-->
                        <li class="divider"></li>
                        <li><a href='{{ URL::route('logout') }}'> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>