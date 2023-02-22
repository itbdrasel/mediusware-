
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
                                        $input_name = 'class_group_id';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-3 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>

                                    <div class="col-sm-4">
                                        <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                            <option value="">Select {{getLabelName($input_name)}}</option>
                                            @if(!empty($class_groups))
                                                @foreach($class_groups as $value)
                                                    <option {{getSelectedOption($value->id, $input_name, $objData)}} value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                    @php
                                        $input_name = 'exam_id';
                                    @endphp
                                    <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>

                                    <div class="col-sm-3">
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
                                    <label class="col-sm-12 col-form-label"> Exam Rules </label>
                                    @if(!empty($exam_rules) && count($exam_rules) >0)
                                        @foreach($exam_rules as $value)
                                            <div class="col-md-3">
                                                <div class="icheck-success">
                                                    <input id="class_id_{{$value->id}}"   value="{{$value->id}}" name="class_id[{{$value->id}}]" type="checkbox">
                                                    <label for="class_id_{{$value->id}}" class="form-check-label">{{$value->name}} ({{$value->code}})</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
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

