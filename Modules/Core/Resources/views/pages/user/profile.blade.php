
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
                    <div class="card-body frontoffice-body">
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
                                                @php
                                                    $rolePermissions = dAuth()->findRoleById($objData->role_id);
                                                @endphp
                                                @if(!empty($sectionNames ) && count($sectionNames) >0)
                                                    @foreach($sectionNames as $section)
                                                        @php
                                                            $sectionPermission = json_decode($section->section_roles_permission);
                                                        @endphp
                                                        @if(in_array($objData->role_id, $sectionPermission))
                                                        @endif
                                                    @endforeach
                                                @endif


                                                @php
                                                    $rolePermissions = dAuth()->findRoleById($objData->role_id);

                                                    $module_name='';
                                                    $end_module ='';
                                                @endphp
                                                @if( $sectionNames->count() > 0)

                                                @foreach($sectionNames as $sectionName)

                                                @php
                                                    $sectionPermission = json_decode($sectionName->section_roles_permission);
                                                    //see($sectionPermission);
                                                @endphp

                                                @if(in_array($objData->role_id, $sectionPermission) )
                                                @php
                                                    $m_name = $sectionName->module->id;
                                                @endphp
                                                @if ($sectionName->module->id !=$module_name)
                                                @php
                                                    $module_name = $sectionName->module->id;
                                                @endphp
                                                @if(!empty($end_module) && $module_name !=$end_module)

                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @php
                                        $end_module = $sectionName->module->id;
                                    @endphp
                                    <div class="card">
                                        <div class="card-header" id="{{$sectionName->module->id}}">
                                            <h5 class="mb-0">
                                                @if(checkUncheck($objData->id))
                                                    <input onclick="checkAll('{{$m_name}}')"  {{moduleCheck($objData->m_permission, $m_name)?'checked':''}} class="module_{{$m_name}}" value="{{$m_name}}" type="checkbox" id="{{$m_name}}">
                                                @else
                                                    @if(moduleCheck($objData->m_permission, $m_name))
                                                        <i style="color: #0075ff" class="fas fa-check-square"></i>
                                                    @else
                                                        <i style="color: red"  class="fas fa-window-close"></i>
                                                    @endif
                                                @endif
                                                {{--                                                                            <label for="{{$m_name}}">{{$m_name}} Modules</label>--}}
                                                <label class="text-capitalize form-check-label" for="{{$m_name}}" >{{$sectionName->module->name}} Modules</label>
                                                {{--                                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{$m_name}}" aria-expanded="true" aria-controls="collapse_{{$m_name}}">--}}
                                                {{--                                                                                {{$m_name}} Modules--}}
                                                {{--                                                                            </button>--}}

                                                <button type="button" style="float: right;
    line-height: 45px;" class="btn btn-tool pull-right"  data-card-widget="collapse" data-toggle="collapse" title="Collapse" data-target="#collapse_{{$m_name}}" aria-expanded="true" aria-controls="collapse_{{$m_name}}">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapse_{{$m_name}}" class="collapse" aria-labelledby="{{$m_name}}" data-parent="#accordion">
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="15%" >Section Name</th>
                                                        <th>Permissions</th>
                                                    </tr>
                                                    @endif
                                                    <tr>

                                                        <td>{{ $sectionName->section_name }} </td>

                                                        @php

                                                            $actions = json_decode($sectionName->section_action_route);
                                                            $permission = json_decode($objData->permissions, true);
                                                            $sl =0;

                                                        @endphp

                                                        <td>
                                                            <div class="row">
                                                            @foreach($actions as $key => $value)

                                                                @php
                                                                    $sl++;
                                                                        $checked = '';

                                                                @endphp

                                                                @if(in_array($objData->role_id, $value))

                                                                    <!-- check whether permission exist and is it set true  -->

                                                                        @if($rolePermissions->permissions)

                                                                            @if(array_key_exists($key, $rolePermissions->permissions))
                                                                                @php
                                                                                    $checked = $rolePermissions->permissions[$key] ? "checked" : "";
                                                                                @endphp
                                                                            @endif
                                                                        @endif
                                                                        @if(!empty($permission) && array_key_exists($key, $permission))
                                                                            @php
                                                                                $checked = $permission[$key]?'checked':'';
                                                                            @endphp
                                                                        @endif


                                                                        <div class="col-4 mb-2">
                                                                            @php
                                                                                $for_level = str_replace('.','_',$key);
                                                                            @endphp
                                                                            @if ($objData->id != dAuth()->getUser()->id)
                                                                                <input id="{{$m_name.'_'.$for_level}}" type="checkbox" class="role-permission role_{{$m_name}}" {{$checked}} data-page="{{$key}}" data-action="{{$key}}" data-id="{{$objData->id}}">
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

                                                                            <label for="{{$m_name.'_'.$for_level}}" class="form-check-label">{{ ucfirst(str_replace(['_','.'],[' ',''],$actionName))  }}</label>&nbsp;
                                                                        </div>


                                                                    @endif

                                                                @endforeach
                                                            </div>
                                                        </td>

                                                    </tr>

                                                    @endif
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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

