
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
                                <a href="{{url($bUrl)}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-arrow-left"></i> Back</a>
                            </button>
                        </div>
                    </div>
                    <form method="post" action="{{url($bUrl.'/store')}}" >
                        @csrf
                    <div class="card-body">
                        <div class="col-md-11">

                            {!! validation_errors($errors) !!}

                            <input type="hidden"  value="{{ getValue($tableID, $objData) }}" id="id" name="{{$tableID}}">

                            <div class="form-group row">
                                @php
                                    $input_name = 'name';

                                @endphp
                                <label for="{{$input_name}}" class="col-sm-3 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>

                                <div class="col-sm-4">
                                    <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control @error($input_name) is-invalid @enderror">
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'phone';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>
                                <div class="col-sm-3">
                                    <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control @error($input_name) is-invalid @enderror">
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'address';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-3 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>
                                <div class="col-sm-4">
                                    <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control @error($input_name) is-invalid @enderror">
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'email';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>

                                <div class="col-sm-3">
                                    <input type="email" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control @error($input_name) is-invalid @enderror">
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>

                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'ssl_store_id';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-3 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} </label>

                                <div class="col-sm-4">
                                    <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control @error($input_name) is-invalid @enderror">
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'ssl_password';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} </label>
                                <div class="col-sm-3">
                                    <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control @error($input_name) is-invalid @enderror">
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                            @php
                                $input_name = 'description';
                            @endphp
                                <div class="col-sm-12">
                                    <textarea name="{{$input_name}}"  class="form-control editor" rows="3" placeholder="{{ucfirst(str_replace('_',' ',$input_name))}}..." style="margin-top: 0px; margin-bottom: 0px; height: 172px;">{{getValue($input_name,$objData)}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                @php
                                    $input_name = 'order_by';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-3 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} </label>

                                <div class="col-sm-4">
                                    <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control @error($input_name) is-invalid @enderror">
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                </div>
                                @php
                                    $input_name = 'status';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{ucfirst(str_replace('_',' ',$input_name))}} </label>

                                <div class="col-sm-3">
                                    <select name="{{$input_name}}" id="{{$input_name}}" class="form-control @error($input_name) is-invalid @enderror">
                                        <option {{(getValue($input_name, $objData) ==1 )?'selected':''}} value="1">Active</option>
                                        <option {{(getValue($input_name, $objData) =='0')?'selected':''}} value="0">Inactive</option>
                                    </select>
                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
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
                            <a href="{{url($pageUrl)}}"  class="btn btn-warning">Cancel</a>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    @endsection
@push('plugin')
    <script src="{{url('backend/plugins/tinymce/tinymce.min.js')}}"></script>
@endpush
