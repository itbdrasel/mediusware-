<li class="nav-item">
    <a href="{{url('hrms/dashboard')}}" class="nav-link {{activeMenu(2, 'dashboard')}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
    @if (dAuth()->hasAccess(['hrms.department']))
    <a href="{{url('hrms/department')}}" class="nav-link {{activeMenu(2, 'department')}}">
        <i class="nav-icon fas fa-building"></i>
        <p>Department</p>
    </a>
    @endif
    @if (dAuth()->hasAccess(['hrms.designation']))
    <a href="{{url('hrms/designation')}}" class="nav-link {{activeMenu(2, 'designation')}}">
        <i class="nav-icon fas fa-level-up-alt"></i>
        <p>Designation</p>
    </a>
    @endif
</li>
