@push('css')
    <style>
        table.blueTable {
            margin: 10px;
            border: 1px solid #1C6EA4;
            text-align: left;
        }
        table.blueTable td, table.blueTable th {
            border: 1px solid #AAAAAA;
            padding: 5px 5px;
        }
        td{
            vertical-align: middle !important;
        }
        .data-body .table td{ background: transparent !important;}

    </style>
@endpush
@php

@endphp
@extends('core::master')

@section('content')
    <section class="content data-body">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" >
                        <a href="{{url($bUrl)}}" class="btn bg-gradient-info btn-sm custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-arrow-left"></i> Back </a>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body" >
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="" >
                            @csrf

                            {!! validation_errors($errors) !!}
                            <div class="form-group row">
                                <label for="section" class="col-sm-2 col-form-label">Modules <code>*</code></label>
                                <div class="col-sm-3">
                                    <select id="module_id" name="module_id" class="form-select" >
                                        <option value=""> Select Module </option>
                                        @if (!empty($modules))
                                            @foreach($modules as $module)
                                                <option  {{ isset($module_id) && $module_id == $module->id ? 'selected' : '' }} value="{{$module->id}}">{{ucwords($module->name)}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="section_id" class="col-sm-2 col-form-label">Section </label>
                                <div class="col-sm-3">
                                    <select id="section_id" name="section_id[]" class="select2 form-select w-100" multiple="multiple" data-placeholder="Select Section"   >
                                        <option value=""> Select Section </option>
                                    @if(!empty($all_sections) && $all_sections->count() > 0)
                                            @foreach($all_sections as $section)
                                        <option {{!empty($section_id) && array_search($section->id,$section_id) !=''?'selected':''}}  value="{{$section->id}}"> {{$section->section_name}} </option>
                                            @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="section_id" class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-3">
                                        @php
                                            $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                        @endphp
                                        <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>&nbsp;&nbsp;
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                @if(!empty($sections) && $sections->count() > 0)
                <form method="post" action="{{url($bUrl.'/update')}}" >

                    @csrf
                    <input type="hidden" name="module_id" value="{{$module_id??''}}">
                <div class="panel-group" id="accordion">
                    @php
                        $sl = 0;
                        $array_key= 0;
                    @endphp


                        @foreach($sections as $section)
                            <input type="hidden" name="id[{{$section->id}}]" value="{{$section->id}}">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-title" data-bs-toggle="collapse" data-parent="#accordion" href="#section_{{$section->id}}">{{$section->section_name}}</a>
                        </div>
                        <div id="section_{{$section->id}}" class="card-body collapse  table-responsive" >
                            <table class="table table-bordered other_guest">
                                <thead>
                                <tr>
                                    <th width="30%">Route Name</th>
                                    <th>Role</th>
                                    <th width="5%" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $actions = json_decode($section->section_action_route);
                                @endphp
                                @if(!empty($actions))
                                @foreach($actions as $key => $value)
                                    <tr class="route_{{++$sl}} " @if (! Route::has($key) ) style="background-color: #f2dede;" @endif>
                                        <td style="vertical-align: middle">
                                            <input type="text" value="{{$key}}" id="route_name_{{$sl}}" onblur="routeCheck({{$sl}})" name="route_name[{{$section->id}}][{{$key}}]" class="form-control">
                                        </td>
                                        <td>
                                            <div class="row">
                                                @foreach($roles as $role_key=>$role)
                                                    @php

                                                        $checked = in_array($role->id, $value) ? "checked" : "";
                                                    @endphp
                                                    <div class="col-md-4 form-group">
                                                        <input id="role_{{$sl.'_'.$role->id}}" {{$checked}} value="{{$role->id}}" type="checkbox" name="roles[{{$section->id}}][{{$key}}][]" class="role-permission" >
                                                        <label for="role_{{$sl.'_'.$role->id}}" class="form-check-label">{{ucfirst($role->name)}}</label>&nbsp;
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle">
                                            <div class="guest-info-btn"><span class="remove bg-danger" id="route_{{$sl}}" data-value="{{$key}}" onclick="removeItem('{{$sl}}', '{{$section->id}}')" style="cursor: pointer"><i class="fas fa-times"></i></span></div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                        @endforeach

                </div>


                    <div class="card-footer">
                        <div class="offset-md-2 col-sm-9">
                            @php
                                $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                            @endphp
                            <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Update</button>&nbsp;&nbsp;
                            <a href="{{url($bUrl)}}"  class="btn btn-warning"><i class="fas fa-times"></i> Cancel</a>
                        </div>
                    </div>
                </form>
                @endif
            </div>



        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            // getModuleBySections();
        });
        $('#module_id').on('change', function (e) {
            e.preventDefault();
            getModuleBySections();
        });
        function getModuleBySections(){
        let module_id = $('#module_id').val();
        if (module_id !=''){
                $.ajax({
                    type: "post",
                    url: "{{ url('core/permissions/get-sections') }}",
                    data: {
                        "_token"        : "{{ csrf_token() }}",
                        module_id       : module_id,
                        {{--section_id      : "{{$section_id}}"--}}
                    },
                    success: function(data){
                        $('#section_id').html(data);
                    },
                    error: function(err){
                        $('#section_id').html('');
                    }
                });
            }
            $('#section_id').html('');
        }

        function removeItem(id, section_id) {
            var route_name = $('#route_name_'+id).val();
            if (confirm('Do you wont to remove?')) {
                $.ajax({
                    url: "{{url('core/permissions/route-remove')}}",
                    data:{
                        "_token"        : "{{ csrf_token() }}",
                        id              : section_id,
                        route           : route_name
                    },
                    type: 'post',
                    success: function (data) {
                        $('.route_'+id).remove();
                    }
                });
            }
        }

        function routeCheck(id) {
            var route_name = $('#route_name_'+id).val();
            var old_route_name = $('#old_route_name_'+id).val();
            $.ajax({
                url: '{{url('core/ajax/route-check')}}',
                data:{_token:"{{ csrf_token() }}",route_name:route_name},
                type: 'post',
                dataType:"json",
                success: function (data) {
                    if (data.error == false){
                        $('#route_name_'+id).val(old_route_name);
                        toastr.error(data.message);
                    }else {
                        $('#old_route_name_'+id).val(route_name);
                    }

                }
            });
        }
    </script>
    </script>
@endpush
