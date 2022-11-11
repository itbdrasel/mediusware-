<li class="nav-item">
    <a href="{{url('hrms/dashboard')}}" class="nav-link {{activeMenu(2, 'dashboard')}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
@if (dAuth()->hasAccess(['hrms.designation']))
    <li class="nav-item">
        <a href="{{url('scms/group')}}" class="nav-link {{activeMenu(2, 'group')}}">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>Group</p>
        </a>
    </li>
@endif

@if (dAuth()->hasAccess(['hrms.designation']))
<li class="nav-item">
    <a href="{{url('scms/shift')}}" class="nav-link {{activeMenu(2, 'shift')}}">
        <i class="nav-icon fas fa-arrows"></i>
        <p>Shift</p>
    </a>
</li>
@endif
