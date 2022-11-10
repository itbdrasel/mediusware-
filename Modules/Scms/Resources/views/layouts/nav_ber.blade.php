<li class="nav-item">
    <a href="{{url('hrms/dashboard')}}" class="nav-link {{activeMenu(2, 'dashboard')}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
@if (dAuth()->hasAccess(['hrms.department']))
    <li class="nav-item">
        <a href="{{url('hrms/employee')}}" class="nav-link {{activeMenu(2, 'employee')}}">
            <i class="nav-icon fas fa-users"></i>
            <p>Employee</p>
        </a>
    </li>
@endif
@if (dAuth()->hasAccess(['hrms.department']))
<li class="nav-item">
    <a href="{{url('hrms/department')}}" class="nav-link {{activeMenu(2, 'department')}}">
        <i class="nav-icon fas fa-building"></i>
        <p>Department</p>
    </a>
</li>
@endif
@if (dAuth()->hasAccess(['hrms.designation']))
<li class="nav-item">
    <a href="{{url('hrms/designation')}}" class="nav-link {{activeMenu(2, 'designation')}}">
        <i class="nav-icon fas fa-level-up-alt"></i>
        <p>Designation</p>
    </a>
</li>
@endif
