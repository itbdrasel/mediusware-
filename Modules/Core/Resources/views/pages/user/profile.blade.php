
@extends("core::master")
@section("content")
    <section class="content guest-profile-area">
        <!-- Default box -->
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            {{--                            <button type="button" class="btn btn-tool" >--}}
                            {{--                                <a href="{{url('system/core/users')}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-arrow-left"></i> Back</a>--}}
                            {{--                            </button>--}}
                        </div>
                    </div>
                    <div class="card-body data-body">
                        <div class="col-md-{{$permission =='permission'?'12':'10'}} col-sm-12">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="guest-profile-box">
                                        <div class="guest-profile-pic">
                                            <img src="{{url('/backend/images')}}/default-avatar.png">
                                        </div>
                                        <div class="text-center">
                                            <h4>{{$objData->full_name}}</h4>
                                            <span>User Role : {{ $objData->name}}</span>
                                        </div>
                                    </div>

                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        @if($permission =='permission')
                                            <a class="nav-link active" id="pills-permission-tab" data-toggle="pill" href="#v-pills-permission" role="tab" aria-controls="v-pills-permission" aria-selected="false">Permissions</a>
                                        @else
                                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">User Information</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade @if($permission !='permission') show active @endif" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                            <div class="guest_info mb-4">
                                                <h2>User Information</h2>
                                                <div class="card-body">
                                                    <table class="table table-striped border">
                                                        <tbody><tr>
                                                            <th width="30%">Name </th>
                                                            <td> {{$objData->full_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>User Role </th>
                                                            <td> {{$objData->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>E-mail </th>
                                                            <td> {{$objData->email}}</td>
                                                        </tr>
                                                        @if(!empty($objData->phone))
                                                            <tr>
                                                                <th>Phone </th>
                                                                <td>{{$objData->phone}}</td>
                                                            </tr>
                                                        @endif
                                                        @if(!empty($objData->user_name))
                                                            <tr>
                                                                <th>User Name </th>
                                                                <td>{{$objData->user_name}}</td>
                                                            </tr>
                                                        @endif
                                                        @if(!empty($objData->branch_id) && !empty($objData->branch))
                                                            <tr>
                                                                <th>Branch </th>
                                                                <td>{{$objData->branch->name??''}}</td>
                                                            </tr>
                                                        @endif
                                                        @if(!empty($objData->activation))
                                                            <tr>
                                                                <th>Status </th>
                                                                <td>
                                                                    {!! $objData->activation->completed==1?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">Inactive</span>' !!}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade  @if($permission =='permission') show active @endif" id="v-pills-permission" role="tabpanel" aria-labelledby="v-pills-permission-tab">
                                            <div id="accordion">
                                                @if(!empty($modules) && count($modules) >0)
                                                    @foreach($modules as $module)
                                                        @if(!empty($module->getFeaturedSections($objData->role_id)) && count($module->getFeaturedSections($objData->role_id)) >0)
                                                            <div class="card">
                                                                <div class="card-header" id="{{$module->name}}">
                                                                    <h5 class="mb-0">
                                                                        @if(checkUncheck($objData->id))
                                                                            <input onclick="checkAll('{{$module->name}}')"  {{moduleCheck($objData->m_permission, $module->id)?'checked':''}} class="module_{{$module->name}}" value="{{$module->name}}" type="checkbox" id="{{$module->name}}">
                                                                        @else
                                                                            @if(moduleCheck($objData->m_permission, $module->id))
                                                                                <i style="color: #0075ff" class="fas fa-check-square"></i>
                                                                            @else
                                                                                <i style="color: red"  class="fas fa-window-close"></i>
                                                                            @endif
                                                                        @endif
                                                                        {{--                                                                            <label for="{{$m_name}}">{{$m_name}} Modules</label>--}}
                                                                        <label class="text-capitalize form-check-label" for="{{$module->name}}" >{{$module->name}} Modules</label>
                                                                        {{--                                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{$m_name}}" aria-expanded="true" aria-controls="collapse_{{$m_name}}">--}}
                                                                        {{--                                                                                {{$m_name}} Modules--}}
                                                                        {{--                                                                            </button>--}}

                                                                        <button type="button" style="float: right;
    line-height: 45px;" class="btn btn-tool pull-right"  data-card-widget="collapse" data-bs-toggle="collapse" title="Collapse" data-bs-target="#collapse_{{$module->name}}" aria-expanded="true" aria-controls="collapse_{{$module->name}}">
                                                                            <i class="fas fa-minus"></i>
                                                                        </button>
                                                                    </h5>
                                                                </div>
                                                                <div id="collapse_{{$module->name}}" class="collapse" aria-labelledby="{{$module->name}}" data-parent="#accordion">
                                                                    <div class="card-body">
                                                                        <table class="table table-bordered">
                                                                            <tr>
                                                                                <th width="15%" >Section Name</th>
                                                                                <th>Permissions</th>
                                                                            </tr>
                                                                            @foreach($module->getFeaturedSections($objData->role_id) as $section)
                                                                                <tr>
                                                                                    <td><strong>{{$section->section_name}}</strong></td>
                                                                                    <td>
                                                                                        @php
                                                                                            $action_route = json_decode($section->section_action_route);
                                                                                            $sl =0;
                                                                                        @endphp
                                                                                        <div class="row">
                                                                                            @foreach($action_route as $key => $value)
                                                                                                @php
                                                                                                    $roleUser = $objData->roles->first()
                                                                                                @endphp
                                                                                                @if($roleUser->hasAccess($key))
                                                                                                @php
                                                                                                    $for_level = str_replace('.','_',$key);
                                                                                                    $checked = $objData->hasAccess($key)?'checked':'';
                                                                                                @endphp
                                                                                                <div class="col-4 mb-2">
                                                                                                    @if ($objData->id != dAuth()->getUser()->id)
                                                                                                        <input id="{{$module->name.'_'.$for_level}}" type="checkbox" class="role-permission role_{{$module->name}}" {{$checked}} data-page="{{$key}}" data-action="{{$key}}" data-id="{{$objData->id}}">
                                                                                                    @else
                                                                                                        @if($checked =='checked')
                                                                                                            <i style="color: #0075ff" class="fas fa-check-square"></i>
                                                                                                        @else
                                                                                                            <i style="color: red"  class="fas fa-window-close"></i>
                                                                                                        @endif
                                                                                                    @endif
                                                                                                    @php
                                                                                                        $actionName = substr($key, strrpos($key, '.'));
                                                                                                    @endphp
                                                                                                    <label for="{{$module->name.'_'.$for_level}}" class="form-check-label">{{ ucfirst(str_replace(['_','.'],[' ',''],$actionName))  }}</label>&nbsp;
                                                                                                </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        {{$title}}
                    </div>
                </div>

            </div>

        </div>
        </div>
        </div>
    </section>

@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.role-permission', function(){
                var id = $(this).attr('data-id');
                var action = $(this).attr('data-action');
                var val = 0;
                if($(this).is(':checked')){ val = 1; }
                $.ajax({
                    type: "post",
                    url: "{{ url('core/permissions/user-permission') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        action: action,
                        value: val
                    },
                    success: function(){
                        // console.log('Assigned - ' + action + ' = ' + val + ' - to ' + id);
                    },
                    error: function(err){
                        console.log(err);
                    }
                });
            });
        });
        function checkAll(id) {
            var val = 0;
            if ($('.module_'+id).is(':checked')) {
                $('.role_'+id).prop('checked', 'checked');
                val = 1;
            }else{
                $('.role_'+id).prop('checked', '');
            }
            $.ajax({
                type: "post",
                url: "{{ url('core/permissions/user-module-permission') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: "{{$objData->id}}",
                    module_name: id,
                    value: val
                },
                success: function(){

                },
                error: function(err){

                }
            });
        }

    </script>
@endpush

