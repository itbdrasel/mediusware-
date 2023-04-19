
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
                    <form action="{{url($bUrl.'/print')}}" method="get" target="_blank" >
                    <div class="card-body">
                            {!! validation_errors($errors) !!}
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
                            @php
                                $input_name = 'student_id';
                            @endphp
                            <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>

                            <div class="col-sm-4">
                                <select name="{{$input_name}}" id="{{$input_name}}" class="select2 form-select @error($input_name) is-invalid @enderror">
                                    <option value="">Select {{getLabelName($input_name)}}</option>
                                    @if(!empty($students))
                                        @foreach($students as $value)
                                            <option {{getSelectedOption($value->id, $input_name, $objData)}} value="{{$value->id}}">{{$value->name}}{{$value->id_number?'('.$value->id_number.')':''}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="offset-md-2 col-sm-10">

                            <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> Search</button>&nbsp;&nbsp;
                            <a href="{{url($pageUrl)}}"  class="btn btn-warning">Cancel</a>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection

