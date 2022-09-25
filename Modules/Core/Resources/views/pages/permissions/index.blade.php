@extends('core::master')
@section('content')
    <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" >
                        <a href="{{url($bUrl.'/create')}}" class="btn bg-gradient-info btn-sm custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-plus-circle"></i> Add New </a>
                    </button>
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

                                <div class="col-sm-3">

                                    <select id="role" name="role_id" class="form-control" >
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
                                    <select id="module" name="module_id" class="form-control" >
                                        <option value=""> Select Module </option>
                                        @if (!empty($modules))
                                        @foreach($modules as $module)
                                            <option  {{ isset($module_id) && $module_id == $module->id ? 'selected' : '' }} value="{{$module->id}}">{{ucwords($module->name)}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <label for="section_id" class="col-sm-1 col-form-label">Section </label>

                                <div class="col-sm-3">
                                    <select id="section_id" name="section_id" class="form-control" >
                                        <option value=""> Select Section </option>
                                        @if (!empty($sections))

                                        @foreach($sections as $section)

                                            <option data-id="{{$section->module_id}}" data-name="{{ucfirst($section->section_name).' ('.ucwords($section->module->name??'').')'}}" {{ isset($section_id) && $section_id == $section->id ? 'selected' : '' }} value="{{$section->id}}">{{ucfirst($section->section_name).' ('.ucwords($section->module->name??'').')'}}</option>

                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                @php
                                    $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                @endphp
                                <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary">Search</button>&nbsp;&nbsp;

                            </div>

                        </form>
                    </div>
                </div>
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
            $("#section option").each(function()
            {
                let name = $(this).data("name");
                let id = $(this).data("id");
                if (module_id == id) {
                    html += '<option data-id="' + id + '" data-name="' + name + '" value="' + $(this).val() + '"> ' + name + '</option>'
                }

            });

            $("#section").html(html);
        });
    </script>
@endpush
