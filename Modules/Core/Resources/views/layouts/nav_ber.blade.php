<li class="nav-item">
    <a href="{{url('author/dashboard')}}" class="nav-link {{activeMenu(2, 'dashboard')}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
{{--@if (dAuth()->hasAnyAccess(['author.users.create','author.users','author.permissions','author.password.change_password']))--}}
    <li class="nav-item {{menuOpenActive(2, ['permissions','change-password'])}}">
        <a href="#" class="nav-link {{menuOpenActive(2, ['permissions','change-password'], true)}} ">
{{--            <i class="nav-icon fas fa-desktop"></i>--}}
            <i class="nav-icon fas fa-assistive-listening-systems"></i>
            <p>
                System
                <i class="right fas fa-angle-down"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
{{--            @if (dAuth()->hasAccess(['author.users']))--}}
                <li class="nav-item">
                    <a href="{{url('author/users')}}" class="nav-link {{activeMenu(2, 'users')}} ">
                        <!-- <i class="nav-icon fas fa-user-alt"></i> -->
                        <i class="fas fa-circle"></i>
                        <p>User Manager</p>
                    </a>
                </li>
{{--            @endif--}}

{{--            @if (dAuth()->hasAccess(['author.permission']))--}}
                <li class="nav-item">
                    <a href="{{url('core/permissions')}}" class="nav-link {{activeMenu(2, 'permissions')}}">
                        <!-- <i class="nav-icon fas fa-user-alt"></i> -->
                        <i class="fas fa-circle"></i>
                        <p>Permissions</p>
                    </a>
                </li>
{{--            @endif--}}
{{--            @if (dAuth()->hasAccess(['author.password.change_password']))--}}
                <li class="nav-item">
                    <a href="{{url('author/change-password')}}" class="nav-link {{activeMenu(2, 'change-password')}}">
                        <!-- <i class="nav-icon fas fa-user-alt"></i> -->
                        <i class="fas fa-circle"></i>
                        <p>Change Password</p>
                    </a>
                </li>
{{--            @endif--}}
        </ul>
    </li>
{{--@endif--}}

{{--@if (dAuth()->hasAccess(['author.base_setting']))--}}
    <li class="nav-item">
        <a href="{{url('core/settings')}}" class="nav-link {{activeMenu(2, 'settings')}}">
            <i class="nav-icon fas fa-cog"></i>
            <p>Settings</p>
        </a>
    </li>
{{--@endif--}}
