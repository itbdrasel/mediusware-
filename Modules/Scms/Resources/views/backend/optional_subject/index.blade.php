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
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th>Student Name And Code</th>
                                        <th width="45%">Optional Subject</th>
                                        <th width="20%">4th Subject</th>
                                    </tr>
                                    </tbody>
                                    <tbody>
                                        @if(!empty($allData) && count($allData) >0)
                                            @foreach($allData as $data)
                                            <tr>
                                                <td>{{$data->name}} </td>
                                                <td>
                                                    <div class="row">
                                                        @if(!empty($data->optionalSubject) && count($data->optionalSubject) >0)
                                                            @foreach($data->optionalSubject as $optionalSubject)
                                                        <div class="col-md-4">
                                                            <div class="icheck-success">
                                                                <input id="obt_{{$data->id}}_{{$optionalSubject->id}}" name="obt_[{{$data->id}}][]" type="checkbox" checked="" >
                                                                <label for="obt_{{$data->id}}_{{$optionalSubject->id}}" class="form-check-label">{{$optionalSubject->name}}</label>
                                                            </div>
                                                        </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

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






