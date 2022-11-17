
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
        <!-- Left navbar links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 10px">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item" id="running_year_static">
                <a href="" target="_blank" class="nav-link"><span class="d-none d-sm-inline-block">  Running Year : {{getTopBerYear()}} <i class="nav-icon fas fa-angle-down"></i></span></a>
            </li>


        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav">

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item">
                <a href="{{url('/')}}" target="_blank" class="nav-link"><i class="nav-icon fas fa-globe"></i><span class="d-none d-sm-inline-block"> Website</span></a>
            </li>
            <style>
                .dropdown-menu-lg{
                    min-width: auto;
                }
            </style>
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="nav-icon fas fa-user-circle"></i> <span class="d-none d-sm-inline-block">{{dAuth()->getUser()->full_name}} ({{dAuth()->getUser()->roles->first()->name}})</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="{{url('core/user/profile/'. dAuth()->getUser()->id)}}" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Your Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('core/logout')}}" class="dropdown-item">
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
    @push('js')
        <script type="text/javascript">
            function get_session_changer()
            {
                $.ajax({
                    url: 'ajax/running-year-static',
                    success: function(response)
                    {
                        $('#running_year_static').html(response);
                    }
                });
            }
        </script>
    @endpush