@extends('core::master')

@section('content')
    <section class="content">
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
            <form method="post" action="{{url($bUrl.'/store')}}" enctype="multipart/form-data">
                @csrf

            <div class="card-body" >
                {!! validation_errors($errors) !!}
                <div class="form-group row">

                    @php
                        $input_name = 'module_name';
                    @endphp
                    <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>
                    <div class="col-sm-3">
                        <select id="{{$input_name}}" name="{{$input_name}}" class="form-control @error($input_name) is-invalid @enderror">
                            @if (!empty($modules))
                                @foreach($modules as $module)
                            <option {{old($input_name) ==$module->id?'selected':''}} value="{{$module->id}}"> {{$module->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                    </div>
                </div>

                <div class="form-group row">
                    @php
                        $input_name = 'section_name';
                    @endphp
                    <label for="{{$input_name}}" class="col-sm-2 col-form-label">  {{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>
                    <div class="col-sm-3">
                        <input type="text" value="{{old($input_name)}}" name="{{$input_name}}"  id="{{$input_name}}"    class="form-control @error($input_name) is-invalid @enderror">
                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    @php
                        $input_name = 'route_name';
                    @endphp
                    <label for="{{$input_name}}" class="col-sm-2 col-form-label">  {{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>
                    <div class="col-sm-3">
                        <input type="text" value="{{old($input_name)}}" name="{{$input_name}}"  id="{{$input_name}}"    class="form-control @error($input_name) is-invalid @enderror">
                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                    </div>

                </div>
                <div class="form-group row">

                    @php
                        $input_name = 'route_name';
                    @endphp
                    <label for="{{$input_name}}" class="col-sm-2 col-form-label">  {{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>
                    <div class="col-sm-6">
                        @if (!empty($roles))
                            @foreach($roles as $role)
                                <div class="form-group clearfix">
                                    <div class="icheck-success">
                                        <input name="role[]" type="checkbox" id="role{{$role->id}}" >
                                        <label for="role{{$role->id}}">{{ucfirst($role->name)}}</label>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
                <div class="card-footer">
                    <div class="offset-md-2 col-sm-9">
                        @php
                            $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                        @endphp
                        <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary">Save</button>&nbsp;&nbsp;
                        <a href="{{url($bUrl)}}"  class="btn btn-warning">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
