
@extends('core::master')

@section('content')
    <section class="content ">
        <div class="row data-body">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">  <i class="fa fa-book"></i> {{$title}}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool">
                                <a href="{{paramUrl($bUrl)}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-arrow-left"></i> Back</a>
                            </button>
                        </div>
                    </div>
                    <form method="post" action="{{paramUrl($bUrl.'/store')}}" >
                        @csrf
                        <div class="card-body">
                            <div class="col-md-11">

                                {!! validation_errors($errors) !!}

                                <input type="hidden"  value="{{ getValue($tableID, $objData) }}" id="id" name="{{$tableID}}">
                                <div class="form-group row">
                                    @php
                                        $input_name = 'name';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-3 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>
                                    <div class="col-sm-4">
                                        <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control @error($input_name) is-invalid @enderror">
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'grade_point';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}}  <code>*</code></label>
                                    <div class="col-sm-3">
                                        <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control number @error($input_name) is-invalid @enderror">
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    @php
                                        $input_name = 'full_mark';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-3 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>
                                    <div class="col-sm-4">
                                        <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control onlyNumber @error($input_name) is-invalid @enderror">
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'mark_from';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}}  <code>*</code></label>
                                    <div class="col-sm-3">
                                        <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control onlyNumber @error($input_name) is-invalid @enderror">
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @php
                                        $input_name = 'mark_upto';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-3 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>
                                    <div class="col-sm-4">
                                        <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control onlyNumber @error($input_name) is-invalid @enderror">
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'out_of_id';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}}  <code>*</code></label>
                                    <div class="col-sm-3">
                                        <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                            <option {{(getValue($input_name, $objData) ==1 )?'selected':''}} value="1">Out of - 5</option>
                                            <option {{(getValue($input_name, $objData) ==2)?'selected':''}} value="2">Out of - 4</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    @php
                                        $input_name = 'comment';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-3 col-form-label"> {{getLabelName($input_name)}} </label>
                                    <div class="col-sm-4">
                                        <textarea name="{{$input_name}}" class="form-control" id="{{$input_name}}" cols="30" rows="4" spellcheck="false">{{getValue($input_name, $objData)}}</textarea>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'status';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}}  <code>*</code></label>
                                    <div class="col-sm-3">
                                        <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                            <option {{(getValue($input_name, $objData) ==1 )?'selected':''}} value="1">Active</option>
                                            <option {{(getValue($input_name, $objData) ==2)?'selected':''}} value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                        <!-- /.card-footer-->
                        <div class="card-footer">
                            <div class="offset-md-3 col-sm-9">
                                @php
                                    $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                @endphp
                                <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;
                                <a href="{{paramUrl($pageUrl)}}"  class="btn btn-warning">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection

