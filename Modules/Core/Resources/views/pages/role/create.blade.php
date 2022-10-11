@extends('core::master')

@section('content')

    <section class="content ">
        <div class="row data-body">
            <div class="col-md-8 col-sm-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">  <i class="fa fa-book"></i> {{$title}}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool">
                                <a href="{{url($bUrl)}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-arrow-left"></i> Back</a>
                            </button>
                        </div>
                    </div>
                    <form method="post" action="{{url($bUrl.'/store')}}" >
                        @csrf
                    <div class="card-body">

                            {!! validation_errors($errors) !!}

                            <input type="hidden"  value="{{ getValue($tableID, $objData) }}" id="id" name="{{$tableID}}">

                            <div class="form-group row">
                                @php
                                    $input_name = 'name';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label"> Role Name <code>*</code></label>

                                <div class="col-sm-5">
                                    <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" class="form-control @error($input_name) is-invalid @enderror">
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>


                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'slug';
                                @endphp
                                <label for="h_name" class="col-sm-2 col-form-label"> Role Slug <code>*</code></label>
                                <div class="col-sm-5">
                                    <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" class="form-control @error($input_name) is-invalid @enderror">
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                @php
                                    $input_name = 'redirect_url';
                                @endphp
                                <label class="col-sm-2 col-form-label"> Redirect <code>*</code></label>
                                <div class="col-sm-5">
                                    <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}"  class="form-control @error($input_name) is-invalid @enderror">
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>

                        <div class="form-group row">
                            @php
                                $input_name = 'order_by';
                            @endphp
                            <label class="col-sm-2 col-form-label"> Order By <code>*</code></label>
                            <div class="col-sm-5">
                                <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}"  class="form-control @error($input_name) is-invalid @enderror">
                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-5">
                                <div class="icheck-success">
                                    <input id="active_directory" {{getValue('active_directory', $objData) ==1?'checked':''}}  type="checkbox" class="role-permission" value="1" name="active_directory">
                                    <label for="active_directory" class="form-check-label">Active Directory</label>&nbsp;
                                </div>
                                <div class="icheck-success">
                                    <input id="active_branch" {{getValue('active_branch', $objData) ==1?'checked':''}}  type="checkbox" class="role-permission" value="1" name="active_branch">
                                    <label for="active_branch" class="form-check-label">Active Branch</label>&nbsp;
                                </div>
                            </div>
                        </div>


                            <!-- /.card-body -->

                    </div>

                        <!-- /.card-footer-->
                    <div class="card-footer">
                        <div class="offset-md-2 col-sm-9">
                            @php
                                $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                            @endphp
                            <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;
                            <a href="{{url($pageUrl)}}"  class="btn btn-warning">Cancel</a>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </section>


    @endsection
