
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
        <!-- Left navbar links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 10px">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item" id="running_year_static">
                <a style="cursor: pointer" onclick="get_session_changer()" class="nav-link"><span class="d-none d-sm-inline-block">  Running Year : {{getTopBerYear()}} <i class="nav-icon fas fa-angle-down"></i></span></a>
            </li>


        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav">

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item">
                <a href="{{url('/')}}"  class="nav-link"><i class="nav-icon fas fa-globe"></i><span class="d-none d-sm-inline-block"> Website</span></a>
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
                let year           = '{{date('Y')-10}}';
                let running_year    = '{{getRunningYear()}}';
                let year_2         = parseInt(year)+1;
                let html           = '<select onchange="runningYearChange(event)" id="running_year_top" name="running_year_top" class="form-select "> <option disabled value="">Select Running Year</option>';
                for(let x = 0; x <= 10; x++) {
                    let y = parseInt(year) + parseInt(x);
                    let y_2 = year_2 + parseInt(x);
                    let format_year = y + '-' + y_2;
                    let selected   = format_year == running_year?'selected':'';
                    let format      = get_formatYear(format_year)
                    html += '<option '+ selected +' value="'+ format_year +'">'+format+'</option>';
                }
                html +='</select>';
                $('#running_year_static').html(html);
            }

            function get_formatYear(year){
                year_format    = '{{config('sc_setting.r_year_format')}}';
                if (year_format ==1) {
                    return year.substr(5,14);
                }
                return year;
            }


            function runningYearChange(){
                let year    = $('#running_year_top').val();
                var _token  =  $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:"{{url('scms/ajax/running-year-change')}}",
                    type: 'POST',
                    data: { _token : _token, year : year  },
                    dataType: 'JSON',
                    success:function (response) {
                        if (response ==true){
                            toastr.success('Successfully running year change');
                        }
                        location.reload();
                    }
                });
            }
        </script>
    @endpush
