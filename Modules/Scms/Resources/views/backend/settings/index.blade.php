@push('css')
    <style type="text/css">
        #settings .tab-content{ padding: 20px 10px;}
        #settings .nav-tabs .nav-link{ background: none; font-weight: bold; color: #666; outline: none;}
        #settings .nav-tabs .nav-link:hover{ border-color: white; border-bottom: 1px solid #1e2e8b;}
        #settings .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
            border: none;
            border-bottom: 1px solid #1e2e8b;
            color: #1e2e8b !important;
        }

        legend {
            font-size: 19px !important;
            font-weight: bold;
            color: #666;
            border-bottom: 1px solid #e5e5e5;
            display: block;
            width: 100%;
            padding: 0;
            margin-bottom: 20px !important;
            line-height: inherit;
        }
    </style>
@endpush
@extends("core::master")
@section("content")
    <!-- Main content -->

    <section class="content">
        <form method="post" action="{{url($bUrl.'/store')}}" enctype="multipart/form-data" >
        @csrf
        <!-- Default box -->
            <div class="card card-outline card-info">
                <div class="card-body" id="settings">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="settingsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true"> General </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sms_email-tab" data-bs-toggle="tab" data-bs-target="#sms_email" type="button" role="tab" aria-controls="sms_email" aria-selected="true"> SMS/Email </button>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div class="col-sm-8"> {!! validation_errors($errors) !!}</div>

                        <!-- General Setting  -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Running Year <code>*</code></label>
                                    <div class="col-sm-7">
                                        <input type="text" value="{{$running_year}}" name="running_year"class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Year Format <code>*</code></label>
                                    <div class="col-sm-7">
                                        <select class="form-select"  name="r_year_format">
                                            <option {{$r_year_format==1?'selected':''}} value="1">{{date('Y')}}</option>
                                            <option {{$r_year_format==2?'selected':''}} value="2">{{date('Y')-1}}-{{date('Y')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Version Type <code>*</code></label>
                                    <div class="col-sm-7">
                                        <select class="form-select"  name="vtype">
                                            @if(!empty($versions) && count($versions) >0)
                                                @foreach($versions as $version)
                                            <option {{$version->id ==$vtype?'selected':''}} value="{{$version->id}}">{{$version->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <!-- SMS Email Setting  -->
                        <div class="tab-pane fade" id="sms_email" role="tabpanel" aria-labelledby="sms_email-tab">
                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">E-mail <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{config('settings')['email']}}" name="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">App Address <code>*</code></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="3" name="app_address" >{{config('settings')['appAddress']}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label  class="col-sm-3 col-form-label">Contact <code>*</code></label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{config('settings')['contact']}}" name="contact" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <div class="offset-md-1 col-sm-9">
                        <button type="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;
                        <a href="{{url($bUrl)}}"  class="btn btn-warning">Cancel</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </form>

    </section>
    <!-- /.content -->


    <!-- Modal -->
    @include('core::layouts.include.modal')

@endsection

@push('js')
    <script>
        $(document).ready(function(){

            $('#settingsTab button').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            $("#settingsTab button[data-bs-toggle='tab']").on("shown.bs.tab", function(e) {

                if($(e.target).attr('id') === 'logo-tab') $('.card-footer').hide();
                else $('.card-footer').show();
                localStorage.setItem('activeTab', $(e.target).attr('data-bs-target'));
            });

            var activeTab = localStorage.getItem('activeTab');

            if (activeTab) {
                $('#settingsTab button[data-bs-target="'+activeTab+'"]').tab('show');
            }
        });
    </script>


    <script type="text/javascript">
        count = {{count($social_all??[])}};
        $('.input_add').on('click', function () {
            var html ='' +
                '<div class="form-group row" id="remove_div_'+count+'">' +
                '<label  class="col-sm-3 col-form-label"></label>' +
                '<div class="col-sm-3">' +
                '<input type="text" placeholder="Network Name" value="" name="network_name[]" class="form-control">' +
                '</div>' +
                '<div class="col-sm-4">' +
                ' <input type="text" value="" placeholder="Network Link" name="network_link[]" class="form-control">' +
                '</div>' +
                '<div class="col-sm-1">' +
                '<a style="cursor: pointer" onclick="removeSocialDiv('+count+')"  class="input_remove btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>' +
                '</div>' +
                '</div>';
            $('#social_aria').append(html);
            count++;
        })
        function removeSocialDiv(id) {
            $('#remove_div_'+id).remove();
        }
    </script>
@endpush
