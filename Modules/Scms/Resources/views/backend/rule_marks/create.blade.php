
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
                        <div class="card-body">
                            @if(empty($objData))
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="post">
                                        @csrf
{{--                                    <form>--}}
                                        {!! validation_errors($errors) !!}

                                     <input type="hidden" name="_method" value="POST">
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
                                                            <option {{getSelectedOption($value->id, $input_name, $objData,$class_id??'')}} value="{{$value->id}}">{{$value->name}}</option>
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
                                                            <option {{getSelectedOption($value->id, $input_name, $objData, $exam_id??'')}} value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            @php
                                                $input_name = 'start_year';

                                            @endphp
                                            <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}}</label>

                                            <div class="col-sm-4">
                                                <input type="text" value="{{getValue($input_name, $objData, $start_year??'')}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control onlyNumber @error($input_name) is-invalid @enderror">
                                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                            </div>
                                            @php
                                                $input_name = 'end_year';
                                            @endphp
                                            <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}} </label>

                                            <div class="col-sm-3">
                                                <input type="text" value="{{getValue($input_name, $objData, $end_year??'')}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control onlyNumber">
{{--                                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>--}}
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
                            @endif
                        @if(isset($subjects) && count($subjects) >0)
                        <form method="post" action="{{url($bUrl.'/store')}}" >
                            @csrf
                            <input type="hidden" name="id" value="{{getValue('id', $objData)}}">
                            <input type="hidden" name="class_id" value="{{$class_id??''}}">
                            <input type="hidden" name="exam_id" value="{{$exam_id??''}}">
                            <input type="hidden" name="rules_group_id" value="{{$rules_group_id??''}}">
                            <div class="card">
                                <div class="card-body">
                                    @if (!empty($objData))
                                    {!! validation_errors($errors) !!}
                                    @endif
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'calculation_subject';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-2 col-form-label"> Calculation Subject <code>*</code></label>
                                        <div class="col-sm-3">
                                            <input type="text" value="{{getValue($input_name, $objData)}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control onlyNumber @error($input_name) is-invalid @enderror">
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                        @php
                                            $input_name = 'start_year';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}}</label>
                                        <div class="col-sm-3">
                                            <input type="text" value="{{getValue($input_name, $objData, $start_year??'')}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control onlyNumber @error($input_name) is-invalid @enderror">
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'end_year';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}}</label>
                                        <div class="col-sm-3">
                                            <input type="text" value="{{getValue($input_name, $objData, $end_year??'')}}" name="{{$input_name}}" id="{{$input_name}}"  class="form-control onlyNumber ">
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered other_guest">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Subject (Code)</th>
                                                <th>Full Mark</th>
                                                <th>Pass Mark</th>
                                                @if(!empty($rules))
                                                    @foreach($rules as $rule)
                                                <th>{{$rule->ruleName->code??''}}</th>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        function getSubjectMarks($subjectId, $ruleMarks=[]){
                                                 if (empty($ruleMarks)) return false;
                                                  $array = $ruleMarks->toArray();
                                                  $haystack = array_filter($array, function($ar) use ($subjectId) {
                                                       return ($ar['subject_id'] == $subjectId)?$ar:[];
                                                    });
                                                    $haystack =  array_values($haystack);
                                                  return isset($haystack[0])?(object)$haystack[0]:[];
                                            }
                                        @endphp
                                        @foreach($subjects as $subject)
                                            @php
                                                $ruleMarkObj =  getSubjectMarks($subject->id, $objData->ruleMarks??'');
                                                $ruleMarks  = [];
                                                if (!empty($ruleMarkObj)){
                                                    $ruleMarks = json_decode($ruleMarkObj->rule_mark, true);
                                                }
                                            @endphp
                                            <tr>
                                                <td class="text-center">
                                                    <input id="subject_id{{$subject->id}}" name="subject_id[{{$subject->id}}]" value="{{$subject->id}}" type="checkbox" class="role-permission"
                                                        {{getChecked($subject->id,'subject_id', $ruleMarkObj, empty($objData)?$objData:'')}}>
                                                </td>
                                                <td>{{$subject->name}} ({{$subject->subject_code}})</td>
                                                <td>
                                                    <input type="text" name="full_mark[{{$subject->id}}]" value="{{$ruleMarkObj->full_mark??''}}" placeholder="Full Mark" class="form-control onlyNumber" >
                                                </td>
                                                <td>
                                                    <input type="text" name="pass_mark[{{$subject->id}}]" placeholder="Pass Mark" value="{{$ruleMarkObj->pass_mark??''}}"   class="form-control onlyNumber" >
                                                </td>
                                                @if(!empty($rules))
                                                    @foreach($rules as $rule)
                                                    <td>
                                                        <input name="marks[{{$subject->id}}][{{$rule->id}}]" type="text" class="form-control onlyNumber" value="{{$ruleMarks[$rule->id]??''}}" placeholder="{{$rule->code}}">
                                                    </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
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
                        </form>
                            @endif

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

