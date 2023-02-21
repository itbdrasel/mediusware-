<li class="nav-item">
    <a href="{{url('scms/dashboard')}}" class="nav-link {{activeMenu(2, 'dashboard')}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
@if (dAuth()->hasAnyAccess(['scms.student']))
    <li class="nav-item {{menuOpenActive(2, ['student'])}}">
        <a href="#" class="nav-link {{menuOpenActive(2, ['student'], true)}} ">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>Student<i class="right fas fa-angle-down"></i></p>
        </a>
        <ul class="nav nav-treeview">
            @if (dAuth()->hasAccess(['scms.student']))
                <li class="nav-item">
                    <a href="{{url('scms/student')}}" class="nav-link {{activeMenu(2, 'student')}} ">
                        <i class="fas fa-circle"></i>
                        <p>Student Manager</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if (dAuth()->hasAnyAccess(['scms.class']))
    <li class="nav-item {{menuOpenActive(2, ['subject', 'optional-subject'])}}">
        <a href="#" class="nav-link {{menuOpenActive(2, ['subject', 'optional-subject'], true)}} ">
            <i class="nav-icon fas fa-book"></i>
            <p>Subject<i class="right fas fa-angle-down"></i></p>
        </a>
        <ul class="nav nav-treeview">
            @if (dAuth()->hasAccess(['scms.class']))
                <li class="nav-item">
                    <a href="{{url('scms/subject')}}" class="nav-link {{activeMenu(2, 'subject')}} ">
                        <i class="fas fa-circle"></i>
                        <p>Subject Manager</p>
                    </a>
                </li>
            @endif
            @if (dAuth()->hasAccess(['scms.class']))
                <li class="nav-item">
                    <a href="{{url('scms/optional-subject')}}" class="nav-link {{activeMenu(2, 'optional-subject')}} ">
                        <i class="fas fa-circle"></i>
                        <p>Optional Subject</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if (dAuth()->hasAnyAccess(['scms.class', 'scms.section']))
    <li class="nav-item {{menuOpenActive(2, ['class', 'section', 'class-group'])}}">
        <a href="#" class="nav-link {{menuOpenActive(2, ['class','section', 'class-group'], true)}} ">
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
            @if (dAuth()->hasAccess(['scms.section']))
                <li class="nav-item">
                    <a href="{{url('scms/section')}}" class="nav-link {{activeMenu(2, 'section')}} ">
                        <i class="fas fa-circle"></i>
                        <p>Section Manager</p>
                    </a>
                </li>
            @endif

            @if (dAuth()->hasAccess(['scms.class']))
                <li class="nav-item">
                    <a href="{{url('scms/class-group')}}" class="nav-link {{activeMenu(2, 'class-group')}} ">
                        <i class="fas fa-circle"></i>
                        <p>Class Group</p>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if (dAuth()->hasAnyAccess(['scms.class', 'scms.section']))
    <li class="nav-item {{menuOpenActive(2, ['exam', 'result-publish'])}}">
        <a href="#" class="nav-link {{menuOpenActive(2, ['exam','result-publish'], true)}} ">
            <i class="nav-icon fas fa-graduation-cap"></i>
            <p>Exam<i class="right fas fa-angle-down"></i></p>
        </a>
        <ul class="nav nav-treeview">
            @if (dAuth()->hasAccess(['scms.class']))
                <li class="nav-item">
                    <a href="{{url('scms/result-publish')}}" class="nav-link {{activeMenu(2, 'result-publish')}} ">
                        <i class="fas fa-circle"></i>
                        <p>Result Publish</p>
                    </a>
                </li>
            @endif
            @if (dAuth()->hasAccess(['scms.class']))
                <li class="nav-item">
                    <a href="{{url('scms/exam')}}" class="nav-link {{activeMenu(2, 'exam')}} ">
                        <i class="fas fa-circle"></i>
                        <p>Exam Manager</p>
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

@if (dAuth()->hasAccess(['scms.shift']))
    <li class="nav-item">
        <a href="{{url('scms/settings')}}" class="nav-link {{activeMenu(2, 'settings')}}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Settings</p>
        </a>
    </li>
@endif
