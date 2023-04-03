
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
                                                $input_name = 'section_id';

                                            @endphp
                                            <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}}</label>

                                            <div class="col-sm-4">
                                                <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                                    <option value="">Select {{getLabelName($input_name)}}</option>
                                                </select>
                                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                            </div>
                                            @php
                                                $input_name = 'subject_id';
                                            @endphp
                                            <label for="{{$input_name}}" class="col-sm-2 col-form-label"> {{getLabelName($input_name)}} <code>*</code></label>

                                            <div class="col-sm-3">
                                                <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                                    <option value="">Select {{getLabelName($input_name)}}</option>
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
@push('js')
    <script type="text/javascript">
        $('#class_id').on('change', function () {
            getSectionsSubjects();
        });

        function getSectionsSubjects() {
            let class_id = $('#class_id').val();
            let sectionHtml = '<option value="">Select Section</option>';
            let subjectHtml = '<option value="">Select Subject</option>';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'post',
                url:"{{ url('scms/marks/get-sections-subjects') }}",
                dataType:'json',
                data:{class_id:class_id},
                success:function(data){
                    $.each(data.sections, function(key, value) {
                        sectionHtml += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                    $.each(data.subjects, function(key, value) {
                        subjectHtml += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                    $('#section_id').html(sectionHtml);
                    $('#subject_id').html(subjectHtml);
                },
                error:function (data) {
                    $('#section_id').html(sectionHtml);
                    $('#subject_id').html(subjectHtml);
                }
            });
        }


    </script>
@endpush

