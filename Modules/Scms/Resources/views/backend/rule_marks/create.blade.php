
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

                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="">
                                        @csrf

                                        <div class="form-group row">
                                            @php
                                                $input_name = 'class_id';
                                            @endphp
                                            <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>

                                            <div class="col-sm-4">
                                                <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                                    <option value="">Select {{getLabelName($input_name)}}</option>
                                                    @if(!empty($allClass))
                                                        @foreach($allClass as $value)
                                                            <option {{getSelectedOption($value->id, $input_name, $objData)}} value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            @php
                                                $input_name = 'exam_id';
                                            @endphp
                                            <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>

                                            <div class="col-sm-4">
                                                <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                                    <option value="">Select {{getLabelName($input_name)}}</option>
                                                    @if(!empty($exams))
                                                        @foreach($exams as $value)
                                                            <option {{getSelectedOption($value->id, $input_name, $objData)}} value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="section_id" class="col-sm-2 col-form-label"> </label>
                                            <div class="col-sm-3">
                                                <button type="submit" onclick="this.disabled=true;this. innerHTML='<i class=&quot;fas fa-spinner fa-pulse&quot;></i> Please Wait';this.form.submit();" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>&nbsp;&nbsp;
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>


                            <div class="card">
{{--                                <div class="card-header"></div>--}}
                                <div class="card-body">
                                    <table class="table table-bordered other_guest">
                                        <thead>
                                        <tr>
                                            <th width="10">#</th>
                                            <th>Subject (Code)</th>
                                            <th>Full Mark</th>
                                            <th>Pass Mark</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="offset-md-3 col-sm-9">
                                        @php
                                            $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                        @endphp
                                        <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>&nbsp;&nbsp;
                                        <a href="{{url($pageUrl)}}"  class="btn btn-warning">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection

