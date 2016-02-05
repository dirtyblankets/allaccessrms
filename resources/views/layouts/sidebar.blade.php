<aside id="sidebar-wrapper">
    <ul class="nav sidebar-nav">
        <li {{ Request::is('dashboard') ? 'class=active' : '' }}>
            <a href="{{ URL::route('admin::dashboard') }}" title="Dashboard">
                <i class= "fa fa-fw fa-dashboard fa-2x fa-align-center"></i>
            </a>
        </li>
        <li {{ Request::is('events') ? 'class=active' : '' }}>
            <a href="{{ URL::route('admin::events') }}" title="Events">
                <i class= "fa fa-fw fa-calendar fa-2x fa-align-center"></i>
            </a>
        </li>
        <li {{ Request::is('users') ? 'class=active' : '' }}>
            <a href="{{ URL::route('admin::users') }}" title="Users">
                <i class="fa fa-fw fa-users fa-2x fa-align-center"></i>
            </a>
        </li>
        <li {{ Request::is('organizations') ? 'class=active' : '' }}>
            <a href="{{ URL::route('admin::organizations') }}" title="Organizations">
                <i class= "fa fa-fw fa-building-o fa-2x fa-align-center"></i>
            </a>
        </li>
    </ul>
</aside>