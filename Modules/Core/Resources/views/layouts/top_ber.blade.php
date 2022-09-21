
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item">
                <a href="{{url('/')}}" target="_blank" class="nav-link"><i class="nav-icon fas fa-globe"></i> Website</a>
            </li>
            <style>
                .dropdown-menu-lg{
                    min-width: auto;
                }
            </style>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="nav-icon fas fa-user-circle"></i> {{dAuth()->getUser()->full_name}} ({{dAuth()->getUser()->roles->first()->name}})
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="{{url('author/profile/'. dAuth()->getUser()->id)}}" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Your Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('author/logout')}}" class="dropdown-item">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->
