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
                                <label for="h_name" class="col-sm-1 col-form-label"> Role <code>*</code></label>

                                <div class="col-sm-3">

                                    <select id="role" name="role" class="form-control" >
                                        <option value=""> Select User</option>
                                        @if (!empty($roles))
                                        @foreach($roles as $role)
                                            @php
                                                $permissions =  str_replace('.','_',$role->permissions);
                                                $permissions = json_decode($permissions);
                                            @endphp
                                            <option {{ isset($roleId) && $roleId == $role->id ? 'selected' : '' }} value="{{$role->id}}">{{ucfirst($role->name)}}</option>

                                        @endforeach
                                        @endif
                                    </select>

                                </div>
                                <label for="section" class="col-sm-1 col-form-label">Modules </label>

                                <div class="col-sm-2">
                                    <select id="module" name="module" class="form-control" >
                                        <option value=""> Select Module </option>
                                        @if (!empty($modules))
                                        @foreach($modules as $section)
                                            <option {{ isset($module) && $module == $section->section_module_name ? 'selected' : '' }} value="{{$section->slug}}">{{ucwords($section->name)}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <label for="section" class="col-sm-1 col-form-label">Section </label>

                                <div class="col-sm-3">
                                    <select id="section" name="section" class="form-control" >
                                        <option value=""> Select Section </option>
                                        @if (!empty($sections))

                                        @foreach($sections as $section)

                                            <option {{ isset($sectionId) && $sectionId == $section->section_id ? 'selected' : '' }} value="{{$section->section_id}}">{{ucfirst($section->section_name).' ('.ucwords($section->section_module_name).')'}}</option>

                                        @endforeach
                                        @endif
                                    </select>
                                </div>


                                <button type="submit" class="btn btn-primary">Search</button>&nbsp;&nbsp;

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
