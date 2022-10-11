@extends('core::master')
@section('content')
    <section class="content data-body">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                <div class="card-tools">
                    @if (dAuth()->hasAccess(['core.permissions.section_edit']))
                    <button type="button" class="btn btn-tool" >
                        <a href="{{url($bUrl.'/section-edit')}}" class="btn bg-gradient-secondary btn-sm custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-edit"></i> Section Edit </a>
                    </button>
                    @endif
                    @if (dAuth()->hasAccess(['core.permissions.edit']))
                    <button type="button" class="btn btn-tool" >
                        <a href="{{url($bUrl.'/edit')}}" class="btn bg-gradient-primary btn-sm custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-edit"></i> Route Edit </a>
                    </button>
                    @endif
                    @if (dAuth()->hasAccess(['core.permissions.create']))
                    <button type="button" class="btn btn-tool form-group-sm" >
                        <a href="{{url($bUrl.'/create')}}" class="btn bg-gradient-info btn-sm custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-plus-circle"></i> Add New </a>
                    </button>
                    @endif
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="" >
                            @csrf

                            {!! validation_errors($errors) !!}
                            <div class="form-group row">
                                <label for="role" class="col-sm-1 col-form-label"> Role <code>*</code></label>

                                <div class="col-sm-2">

                                    <select id="role" name="role_id" class="form-select" >
                                        <option value=""> Select User</option>
                                        @if (!empty($roles))
                                        @foreach($roles as $role)
                                            @php
                                                $permissions =  str_replace('.','_',$role->permissions);
                                                $permissions = json_decode($permissions);
                                            @endphp
                                            <option {{ isset($role_id) && $role_id == $role->id ? 'selected' : '' }} value="{{$role->id}}">{{ucfirst($role->name)}}</option>

                                        @endforeach
                                        @endif
                                    </select>

                                </div>
                                <label for="section" class="col-sm-1 col-form-label">Modules </label>

                                <div class="col-sm-2">
                                    <select id="module" name="module_id" class="form-select selectpicker" >
                                        <option value=""> Select Module </option>
                                        @if (!empty($modules))
                                        @foreach($modules as $module)
                                            <option  {{ isset($module_id) && $module_id == $module->id ? 'selected' : '' }} value="{{$module->id}}">{{ucwords($module->name)}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <label for="section_id" class="col-sm-1 col-form-label">Section </label>

                                <div class="col-sm-3 form-group">
                                    <select id="section_id" name="section_id" class="form-select" >
                                        <option value=""> Select Section </option>
                                        @if (!empty($sections))

                                        @foreach($sections as $section)

                                            <option data-id="{{$section->module_id}}" data-name="{{ucfirst($section->section_name).' ('.ucwords($section->module->name??'').')'}}" {{ isset($section_id) && $section_id == $section->id ? 'selected' : '' }} value="{{$section->id}}">{{ucfirst($section->section_name).' ('.ucwords($section->module->name??'').')'}}</option>

                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-2 form-group">

                                @php
                                    $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                @endphp
                                <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary">Search</button>&nbsp;&nbsp;
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                @if(!empty($sectionNames) && $sectionNames->count() > 0)
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="15%">User Role</th>
                                <th width="15%">Section Name</th>
                                <th width="60%">Permissions</th>
                                <th width="12%" class="text-center">Action</th>
                            </tr>
                                @php
                                $sl =1;
                                @endphp
                                @foreach($sectionNames as $sectionName)
                                    @php
                                        $sl =$sl+1;
                                        $sectionPermission = json_decode($sectionName->section_roles_permission);
                                    @endphp
                                    @if(in_array($role_id, $sectionPermission) )
                                        <tr>
                                            <td>{{ ucfirst($rolePermissions->name) }} </td>
                                            <td>{{ $sectionName->section_name }} </td>
                                            @php
                                                $actions = json_decode($sectionName->section_action_route);
                                            @endphp
                                            <td>
                                                <div class="row">
                                                @foreach($actions as $key => $value)
                                                    @php
                                                        $sl = $sl+1;
                                                        $checked = '';
                                                    @endphp

                                                    @if(in_array($role_id, $value))

                                                            @if($rolePermissions->permissions)
                                                                @if(array_key_exists($key, $rolePermissions->permissions))
                                                                    @php
                                                                        $checked = $rolePermissions->permissions[$key] ? "checked" : "";
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                            @php
                                                                $actionName = substr($key, strrpos($key, '.') );
                                                                $actionName = trim($actionName,'.');
                                                            @endphp
                                                            <div class="col-md-4">
                                                                <div class="icheck-success">
                                                                    <input id="per_{{$sl}}" type="checkbox" class="role-permission" {{$checked}} data-page="{{$key}}" data-section="{{$sectionName->section_name }}" data-name="{{ ucfirst(str_replace('_',' ',$actionName))  }}" data-action="{{$key}}" data-role="{{$rolePermissions->name}}">
                                                                    <label for="per_{{$sl}}" class="form-check-label">{{ ucfirst(str_replace('_',' ',$actionName))  }}</label>&nbsp;
                                                                </div>
                                                            </div>


                                                        @endif

                                                    @endforeach
                                                </div>
                                            </td>

                                            <td>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                        </table>
                    </div>
                </div>
                @endif

            </div>
            <div class="card-footer">
                {{ $title }}
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript">
        $('#module').on('change', function () {
            let module_id =  $('#module').val();
            let html = '<option value=""> Select Section </option>'
            $("#section_id option").each(function()
            {
                let name = $(this).data("name");
                let id = $(this).data("id");
                if (module_id == id) {
                    html += '<option data-id="' + id + '" data-name="' + name + '" value="' + $(this).val() + '"> ' + name + '</option>'
                }

            });
            $("#section_id").html(html);
        });


        $(document).ready(function(){
            $(document).on('click', '.role-permission', function(){
                var roleName = $(this).attr('data-role');
                var action = $(this).attr('data-action');
                var name = $(this).attr('data-name');
                var section = $(this).attr('data-section');
                var val = 0;
                if($(this).is(':checked')){ val = 1; }
                $.ajax({
                    type: "post",
                    url: "{{ url('core/permissions/add-remove') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        role    : roleName,
                        action  : action,
                        value   : val,
                        section : section,
                        name    : name
                    },
                    success: function(){
                        console.log('Assigned - ' + action + ' = ' + val + ' - to ' + roleName);
                    },
                    error: function(err){
                        toastr.error(err);
                        console.log(err);
                    }
                });
            });
        });

    </script>
@endpush
