<li class="nav-item">
    <a href="{{url('core/dashboard')}}" class="nav-link {{activeMenu(2, 'dashboard')}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
@if (dAuth()->hasAnyAccess(['core.permissions','core.role','core.module','core.user','core.branch','core.gender','core.religion', 'blood_group']))
    <li class="nav-item {{menuOpenActive(2, ['permissions','role','module','user','branch','gender','religion', 'blood-group'])}}">
        <a href="#" class="nav-link {{menuOpenActive(2, ['permissions','role','module','user','branch', 'gender','religion', 'blood-group'], true)}} ">
            <i class="nav-icon fas fa-assistive-listening-systems"></i>
            <p>System<i class="right fas fa-angle-down"></i></p>
        </a>
        <ul class="nav nav-treeview">
            @if (dAuth()->hasAccess(['core.user']))
                <li class="nav-item">
                    <a href="{{url('core/user')}}" class="nav-link {{activeMenu(2, 'user')}} ">
                        <i class="fas fa-circle"></i>
                        <p>User Manager</p>
                    </a>
                </li>
            @endif

            @if (dAuth()->hasAccess(['core.permissions']))
                <li class="nav-item">
                    <a href="{{url('core/permissions')}}" class="nav-link {{activeMenu(2, 'permissions')}}">
                        <i class="fas fa-circle"></i>
                        <p>Permissions</p>
                    </a>
                </li>
            @endif
            @if (dAuth()->hasAccess(['core.branch']))
                <li class="nav-item">
                    <a href="{{url('core/branch')}}" class="nav-link {{activeMenu(2, 'branch')}} ">
                        <i class="fas fa-circle"></i>
                        <p>Branch Manager</p>
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
                @if (dAuth()->hasAccess(['core.religion']))
                    <li class="nav-item">
                        <a href="{{url('core/religion')}}" class="nav-link {{activeMenu(2, 'religion')}} ">
                            <i class="fas fa-circle"></i>
                            <p>Religion Manager</p>
                        </a>
                    </li>
                @endif
                @if (dAuth()->hasAccess(['core.gender']))
                    <li class="nav-item">
                        <a href="{{url('core/gender')}}" class="nav-link {{activeMenu(2, 'gender')}} ">
                            <i class="fas fa-circle"></i>
                            <p>Gender Manager</p>
                        </a>
                    </li>
                @endif
				@if (dAuth()->hasAccess(['core.blood_group']))
                    <li class="nav-item">
                        <a href="{{url('core/blood-group')}}" class="nav-link {{activeMenu(2, 'blood-group')}} ">
                            <i class="fas fa-circle"></i>
                            <p>Blood Group</p>
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
