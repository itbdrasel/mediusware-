@extends('core::master')
@section('content')
    <section class="content data-body ">
        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-md-11 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{url($bUrl)}}" method="post">
                                        @csrf
                                        {!! validation_errors($errors) !!}
                                    <div class="form-group row">
                                        @php
                                            $input_name = 'class_id';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}<code> *</code></label>

                                        <div class="col-sm-3">
                                            <select id="{{$input_name}}" onchange="classBySections()" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                                <option value=""> Select Class </option>
                                                @if (!empty($allClass))
                                                    @foreach ($allClass as $value)
                                                        <option {{old($input_name, $class_id)==$value->id?'selected':''}}  value="{{$value->id}}"> {{$value->name}} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                        @php
                                            $input_name = 'section_id';
                                        @endphp
                                        <label for="{{$input_name}}" class="col-sm-2 col-form-label text-capitalize">{{str_replace(['_','id'],' ',$input_name)}}</label>

                                        <div class="col-sm-2" style="padding-left: 0">
                                            <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                                <option value=""> Select Section </option>
                                            </select>
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                        </div>
                                        <div class="col-sm-3 p-0 text-center">
                                            @php
                                                $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                            @endphp
                                            <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-search"></i> Search </button>&nbsp;
                                            <a href="{{url($bUrl)}}" class="btn btn-warning">Cancel</a>
                                        </div>
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        @if(!empty($allData) && count($allData) >0)
                        <div class="card">
                            <form action="{{url($bUrl.'/store')}}" method="post">
                                @csrf
                                <input type="hidden" name="class_id" value="{{$class_id}}">
                            <div class="card-body">

                                    {!! validation_errors($errors) !!}
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>Student Name And Code</th>
                                        <th width="45%">Optional Subject</th>
                                        <th width="20%">4th Subject</th>
                                    </tr>
                                    </tbody>
                                    <tbody>

                                            @foreach($allData as $data)
                                            <tr>
                                                <td>{{$data->name.' ('.$data->id_number}}) </td>
                                                <td>
                                                    @php
                                                        $opSubjects = json_decode($data->o_subjects, true);
                                                    @endphp
                                                    <div class="row">
                                                        @if(!empty($optionalSubject) && count($optionalSubject) >0)
                                                            @foreach($optionalSubject as $optSub)
                                                        <div class="col-md-4">
                                                            <div class="icheck-success">
                                                                <input id="obt_{{$data->id}}_{{$optSub->id}}" value="{{$optSub->id}}" name="ob_sub[{{$data->id}}][]" type="checkbox" {{isset($opSubjects[$optSub->id]) && $opSubjects[$optSub->id] ==$optSub->id ?'checked':''}}  >
                                                                <label for="obt_{{$data->id}}_{{$optSub->id}}" class="form-check-label">{{$optSub->name}}</label>
                                                            </div>
                                                        </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="student_id[]" value="{{$data->id}}">
                                                    <select name="four_sub[{{$data->id}}]"  class="select2 form-select">
                                                        <option value="" > ---- </option>
                                                        @if(!empty($fourSubject) && count($fourSubject) >0)
                                                            @foreach($fourSubject as $fourSub)
                                                        <option {{$data->four_subject==$fourSub->id?'selected':'' }} value="{{$fourSub->id}}" > {{$fourSub->name}} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                                <div class="card-footer">
                                    <div class="offset-md-4 col-sm-8">
                                        @php
                                            $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                        @endphp
                                        <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-save"></i> Save </button>&nbsp;
                                        <a href="{{url($bUrl)}}" class="btn btn-warning">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif

                    </div>
                    <!-- /.card-body -->

                    <!-- /.card-footer-->
                </div>

            </div>
        </div>
    </section>
@include('core::layouts.include.modal')
@endsection

@push('js')
    <script>
        $( document ).ready(function () {
            classBySections();
        });
        function classBySections() {
            let class_id    = $('#class_id').val();
            var _token      = $('meta[name="csrf-token"]').attr('content');
            let section_id  = '{{ old('section_id', $section_id)}}'
            $.ajax({
                url:"{{url('scms/ajax/class-by-sections')}}",
                type: 'POST',
                data: { _token : _token, class_id : class_id  },
                success:function (response) {
                    if (response !=false){
                        let html = '<option value=""> Select Section </option>';
                        for (var i = 0; i < response.length; i++) {
                            let select = section_id ==response[i].id?'selected':'';
                            html += '<option '+select+'  value="'+response[i].id+'">'+response[i].name+'</option>';
                        }
                        $('#section_id').html(html);
                    }
                }
            });
        }
    </script>

@endpush






