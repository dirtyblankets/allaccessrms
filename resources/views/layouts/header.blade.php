<header class="main-header">
    <!-- Logo -->
    @if (Auth::user()->is('owner'))
    <a href="{{ URL::route('owner::dashboard') }}" class="logo">
      <!-- logo for regular state and mobile devices -->
        AA<b>RMS</b>
    </a>
    @elseif (Auth::user()->is('admin'))
        <a href="{{ URL::route('admin::dashboard') }}" class="logo">
            <!-- logo for regular state and mobile devices -->
            AA<b>RMS</b>
        </a>
    @endif
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
            </div>
            <!--Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> {{ Auth::user()->getFullName() }}<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href='{{ URL::route('settings') }}'><i class="fa fa-fw fa-gear"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href='{{ URL::route('logout') }}'><i class="fa fa-fw fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>