
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
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="POST">
                                        {!! validation_errors($errors) !!}

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                @php
                                                    $input_name = 'year';
                                                @endphp
                                                <label class="col-sm-12 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>
                                                <div class="col-sm-12">
                                                    <input disabled type="text" value="{{getTopBerYear()}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                @php
                                                    $input_name = 'class_id';
                                                @endphp
                                                <label for="{{$input_name}}" class="col-sm-12 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>
                                                <div class="col-sm-12">
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
                                            </div>

                                            <div class="col-sm-4">
                                                @php
                                                    $input_name = 'section_id';
                                                @endphp
                                                <label for="{{$input_name}}" class="col-sm-12 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>
                                                <div class="col-sm-12">
                                                    <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                                        <option value="">Select {{getLabelName($input_name)}}</option>
                                                    </select>
                                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <h4 style="font-size: 18px;"> Promote Students In Next Year</h4>
                                            <div class="col-sm-4">
                                                @php
                                                    $input_name = 'promote_year';
                                                @endphp
                                                <label class="col-sm-12 col-form-label"> Year <code>*</code></label>
                                                <div class="col-sm-12">
                                                    @php
                                                        $runningYear = getFormatYear(getRunningYear(), true);

                                                           $options = '';
                                                           for($x = 0; $x <= 10; $x++) {
                                                               $year1 = $runningYear + $x;
                                                               $year2 = $year1 + 1;
                                                               $promoteYear = "{$year1}-{$year2}";
                                                               $selected = $promoteYear == $promote_year ? 'selected' : '';
                                                               $options .= '<option '.$selected.' value="'.$promoteYear.'">'.$year2.'</option>';
                                                           }
                                                    @endphp
                                                    <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                                        {!! $options !!}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                @php
                                                    $input_name = 'promote_class_id';
                                                @endphp
                                                <label for="{{$input_name}}" class="col-sm-12 col-form-label"> Class <code>*</code></label>
                                                <div class="col-sm-12">
                                                    <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                                        <option value="">Select {{getLabelName($input_name)}}</option>
                                                        @if(!empty($allClass))
                                                            @foreach($allClass as $value)
                                                                <option {{getSelectedOption($value->id, $input_name, $objData,$promote_class_id??'')}} value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                @php
                                                    $input_name = 'promote_section_id';
                                                @endphp
                                                <label for="{{$input_name}}" class="col-sm-12 col-form-label"> Section<code>*</code></label>
                                                <div class="col-sm-12">
                                                    <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                                        <option value="">Select {{getLabelName($input_name)}}</option>
                                                    </select>
                                                    <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-12 text-end">
                                                <button type="submit" onclick="this.disabled=true;this. innerHTML='<i class=&quot;fas fa-spinner fa-pulse&quot;></i> Please Wait';this.form.submit();" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>&nbsp;&nbsp;
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        <form method="post" action="{{url($bUrl.'/store')}}" >
                            @csrf

                            <input type="hidden" name="class_id" value="{{$class_id??''}}">
                            <input type="hidden" id="sectionId" name="section_id" value="{{$section_id??''}}">
                            <input type="hidden" name="promote_class_id" value="{{$promote_class_id??''}}">
                            <input type="hidden" id="promoteSectionId" name="promote_section_id" value="{{$promote_section_id??''}}">
                            <input type="hidden" name="promote_year" value="{{$promote_year}}">
                            @if(isset($students) && count($students) >0)
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name (Id No)</th>
                                                    <th width="200">Section</th>
                                                    <th width="200">Roll Number</th>
                                                    <th width="300">Next Year Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($students as $student)
                                                <tr>
                                                    <td>
                                                        {{$student->student->name??''}} ({{$student->student->id_number??''}})
                                                        <input type="hidden" value="{{$student->student_id}}" name="students[{{$student->student_id}}]">
                                                        <input type="hidden" name="group_id[{{$student->student_id}}]" value="{{$student->group_id}}">
                                                        <input type="hidden" name="shift[{{$student->student_id}}]" value="{{$student->shift}}">
                                                        <input type="hidden" name="roll[{{$student->student_id}}]" value="{{$student->roll}}">

                                                    </td>
                                                    <td>
                                                        <select name="section[{{$student->student_id}}]" class="form-select">
                                                        @if(isset($sections) && !empty($sections))
                                                            @foreach($sections as $value)
                                                            <option {{$value->id == $promote_section_id?'selected':''}} value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" value="{{$student->roll}}" name="role[{{$student->student_id}}]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <div class="radio-inline">
                                                            <label style=" cursor: pointer"><input type="radio" name="status[{{$student->student_id}}]" checked="checked" value="countinue">
                                                                Continue
                                                            </label>
                                                            <label style="margin-left: 5px; cursor: pointer"><input type="radio" name="status[{{$student->student_id}}]"  value="leave">
                                                                Leave
                                                            </label>
                                                        </div>
                                                    </td>

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
                            @endif
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('js')
    <script type="text/javascript">
        $('#class_id').on('change', function () {
            getSection();
        });
        $('#promote_class_id').on('change', function () {
            getPromotionSection();
        });
        $(document).ready(function () {
            getSection()
            getPromotionSection()
        });

        function getSection() {
            let selectedVal = $('#sectionId').val();
            getAjaxSections('class_id', 'section_id', selectedVal)
        }

        function getPromotionSection() {
            let selectedVal = $('#promoteSectionId').val();
            getAjaxSections('promote_class_id', 'promote_section_id', selectedVal)
        }

        function getAjaxSections(class_id, section_id, selectedVal='') {
            let classId = $('#'+class_id).val();
            let sectionHtml = '<option  value="">Select Section</option>';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'post',
                url:"{{url($bUrl.'/get-sections')}}",
                dataType:'json',
                data:{classId:classId},
                success:function(data){
                    // Section
                    $.each(data.sections, function(key, value) {
                        selectted = value.id == selectedVal?'selected':'';
                        sectionHtml += '<option  '+selectted+' value="'+value.id+'">'+value.name+'</option>';
                    });

                    $('#'+section_id).html(sectionHtml);
                },
                error:function (data) {
                    $('#'+section_id).html(sectionHtml);
                }
            });
        }


    </script>
@endpush

