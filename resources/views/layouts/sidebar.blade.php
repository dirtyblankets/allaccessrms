<aside id="sidebar-wrapper">
    <ul class="nav sidebar-nav">
        @if (Auth::user()->is('owner'))
         <li {{ Request::is('dashboard') ? 'class=active' : '' }}>
            <a href="{{ URL::route('owner::dashboard') }}" title="Dashboard">
                <i class= "fa fa-fw fa-dashboard fa-2x fa-align-center"></i>
                <span class='nav-text'>Dashboard</span>
            </a>
        </li>
        <li {{ Request::is('events') ? 'class=active' : '' }}>
            <a href="{{ URL::route('owner::events') }}" title="Events">
                <i class= "fa fa-fw fa-calendar fa-2x fa-align-center"></i>
                <span class='nav-text'>Manage Events</span>
            </a>
        </li>
        @endif
        <li {{ Request::is('users') ? 'class=active' : '' }}>
            <a href="{{ URL::route('owner::users') }}" title="Users">
                <i class="fa fa-fw fa-users fa-2x fa-align-center"></i>
                <span class='nav-text'>Manage Users</span>
            </a>
        </li>
        <li {{ Request::is('organizations') ? 'class=active' : '' }}>
            <a href="{{ URL::route('owner::organizations') }}" title="Organizations">
                <i class= "fa fa-fw fa-building-o fa-2x fa-align-center"></i>
                <span class='nav-text'>Manage Partners</span>
            </a>
        </li>
    </ul>
</aside>