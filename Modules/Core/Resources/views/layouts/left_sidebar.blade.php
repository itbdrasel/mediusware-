
<style>
    .brand-link{
        white-space: initial !important;
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link top_title">
        <span class="w-100"><img style="margin: 0 auto; max-height:40px " class="d-block" src="{{url($logo)}}"></span>
        {{--        <p class="brand-text font-weight-light text-center">{{$appName}}</p>--}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @include($moduleName.'::layouts.nav_ber')

                <li class="nav-item">
                    <a href="{{url('core/logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
