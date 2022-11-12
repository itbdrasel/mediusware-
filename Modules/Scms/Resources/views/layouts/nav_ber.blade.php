<li class="nav-item">
    <a href="{{url('scms/dashboard')}}" class="nav-link {{activeMenu(2, 'dashboard')}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
@if (dAuth()->hasAnyAccess(['scms.class']))
    <li class="nav-item {{menuOpenActive(2, ['class'])}}">
        <a href="#" class="nav-link {{menuOpenActive(2, ['class'], true)}} ">
            <i class="nav-icon fas fa-cocktail"></i>
            <p>Class<i class="right fas fa-angle-down"></i></p>
        </a>
        <ul class="nav nav-treeview">
            @if (dAuth()->hasAccess(['scms.class']))
                <li class="nav-item">
                    <a href="{{url('scms/class')}}" class="nav-link {{activeMenu(2, 'class')}} ">
                        <i class="fas fa-circle"></i>
                        <p>Class Manager</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if (dAuth()->hasAccess(['scms.group']))
    <li class="nav-item">
        <a href="{{url('scms/group')}}" class="nav-link {{activeMenu(2, 'group')}}">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>Group</p>
        </a>
    </li>
@endif

@if (dAuth()->hasAccess(['scms.shift']))
<li class="nav-item">
    <a href="{{url('scms/shift')}}" class="nav-link {{activeMenu(2, 'shift')}}">
        <i class="nav-icon fas fa-arrows-alt"></i>
        <p>Shift</p>
    </a>
</li>
@endif
