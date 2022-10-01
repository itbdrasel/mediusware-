<li class="nav-item">
    <a href="{{url('core/dashboard')}}" class="nav-link {{activeMenu(2, 'dashboard')}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
@if (dAuth()->hasAnyAccess(['core.permissions','core.role','core.module']))
    <li class="nav-item {{menuOpenActive(2, ['permissions','role','module'])}}">
        <a href="#" class="nav-link {{menuOpenActive(2, ['permissions','role','module'], true)}} ">
            <i class="nav-icon fas fa-assistive-listening-systems"></i>
            <p>System<i class="right fas fa-angle-down"></i></p>
        </a>
        <ul class="nav nav-treeview">
{{--            @if (dAuth()->hasAccess(['author.users']))--}}
                <li class="nav-item">
                    <a href="{{url('author/users')}}" class="nav-link {{activeMenu(2, 'users')}} ">
                        <i class="fas fa-circle"></i>
                        <p>User Manager</p>
                    </a>
                </li>
{{--            @endif--}}

            @if (dAuth()->hasAccess(['core.permissions']))
                <li class="nav-item">
                    <a href="{{url('core/permissions')}}" class="nav-link {{activeMenu(2, 'permissions')}}">
                        <i class="fas fa-circle"></i>
                        <p>Permissions</p>
                    </a>
                </li>
            @endif
            @if (dAuth()->hasAccess(['core.role']))
                <li class="nav-item">
                    <a href="{{url('core/role')}}" class="nav-link {{activeMenu(2, 'role')}}">
                        <i class="fas fa-circle"></i>
                        <p>Role</p>
                    </a>
                </li>
            @endif
            @if (dAuth()->hasAccess(['core.module']))
                <li class="nav-item">
                    <a href="{{url('core/module')}}" class="nav-link {{activeMenu(2, 'module')}}">
                        <i class="fas fa-circle"></i>
                        <p>Module</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (dAuth()->hasAccess(['core.settings']))
    <li class="nav-item">
        <a href="{{url('core/settings')}}" class="nav-link {{activeMenu(2, 'settings')}}">
            <i class="nav-icon fas fa-cog"></i>
            <p>Settings</p>
        </a>
    </li>
@endif
