@extends('core::master')
@section('content')
    <section class="content data-body">
        <!-- Default box -->
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <form action="{{url($bUrl.'/store')}}" method="post">
                    @csrf()
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fa fa-plus"></i> {{$add_title}}</h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! validation_errors($errors) !!}
                            <div class="input-group mb-3">
                                @php
                                    $input_name = 'class_id';
                                @endphp
                                <label for="{{$input_name}}" class="w-100">{{ucfirst(str_replace(['_id','_'],' ',$input_name))}}<code>*</code></label>
                                <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                    @if(!empty($allClass))
                                        @foreach($allClass as $value)
                                            <option {{(getValue($input_name, $objData) ==$value->id)?'selected':''}} value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                            </div>
                            <div class="input-group mb-3">
                                @php
                                    $input_name = 'exam_id';
                                @endphp
                                <label for="{{$input_name}}" class="w-100">{{ucfirst(str_replace(['_id','_'],' ',$input_name))}}<code>*</code></label>
                                <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                    @if(!empty($exams))
                                        @foreach($exams as $value)
                                    <option {{(getValue($input_name, $objData) ==$value->id)?'selected':''}} value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                            </div>
                            <div class="input-group mb-3">
                                @php
                                    $input_name = 'year';
                                @endphp
                                <label for="{{$input_name}}" class="w-100">{{ucfirst(str_replace('_',' ',$input_name))}}<code>*</code></label>
                                <select name="{{$input_name}}" id="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror">
                                    @php
                                        $year           = date('Y')-10;
                                        $year_2         = $year+1;
                                    @endphp
                                    @for($x = 0; $x <= 10; $x++)
                                        @php
                                            $y = $year + $x;
                                            $y_2 = $year_2 + $x;
                                            $format_year = $y.'-' .$y_2;
                                        @endphp
                                        <option {{(getValue($input_name, $objData, getRunningYear()) ==$format_year)?'selected':''}} value="{{$format_year}}">{{getFormatYear($format_year)}}</option>
                                    @endfor
                                </select>

                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                            </div>

                        </div>
                        <!-- /.login-card-body -->
                        <div class="card-footer">
                            <div class="offset-md-3 col-sm-10">
                                @php
                                    $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                @endphp
                                <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"> <i class="fas fa-save"></i>  Save</button>&nbsp;&nbsp;
                                <a href="{{url($bUrl)}}"  class="btn btn-warning">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <input type="hidden"  data-row="" id="sortBy">
                    <div id="tableData">
                        @include($view_path.'data')
                    </div>

                </div>

            </div>
        </div>
    </section>
    @include('core::layouts.include.modal_delete')
    @include('core::layouts.include.blank_modal')
@endsection
@push('js')
    <script src="{{url('backend/js/index_page.js')}}"></script>
@endpush







