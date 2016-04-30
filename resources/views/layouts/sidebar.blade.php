<aside id="sidebar-wrapper">
    <ul class="nav sidebar-nav">
        @if (Auth::user()->is('owner|admin'))
             <li {{ Request::is('dashboard') ? 'class=active' : '' }}>
                <a href="{{ URL::route('dashboard') }}" title="Dashboard" data-toggle="tooltip" data-placement="right" >
                    <i class= "fa fa-fw fa-home fa-2x"></i>
                </a>
            </li>
            @if (Auth::user()->can('view.events'))
                <li {{ Request::is('events') ? 'class=active' : '' }}>
                    <a href="{{ URL::route('events') }}" title="Manage Events" data-toggle="tooltip" data-placement="right">
                        <i class= "fa fa-fw fa-calendar fa-2x fa-align-center"></i>
                    </a>
                </li>
            @endif
            @if (Auth::user()->can('view.users'))
                <li {{ Request::is('users') ? 'class=active' : '' }}>
                    <a href="{{ URL::route('users') }}" title="Manage Users" data-toggle="tooltip" data-placement="right">
                        <i class="fa fa-fw fa-users fa-2x fa-align-center"></i>
                    </a>
                </li>
            @endif
            @if (Auth::user()->can('view.organizations'))            
                <li {{ Request::is('organizations') ? 'class=active' : '' }}>
                    <a href="{{ URL::route('organizations') }}" title="Manage Partners" data-toggle="tooltip" data-placement="right">
                        <i class= "fa fa-fw fa-building-o fa-2x fa-align-center"></i>
                    </a>
                </li>
            @endif
        @endif
    </ul>
</aside>