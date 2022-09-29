@push('css')
    <style>
        table.blueTable {
            margin: 10px;
            border: 1px solid #1C6EA4;
            text-align: left;
        }
        table.blueTable td, table.blueTable th {
            border: 1px solid #AAAAAA;
            padding: 5px 5px;
        }
        td{
            vertical-align: middle !important;
        }
        .frontoffice-body .table td{ background: transparent !important;}

    </style>
@endpush
@php

@endphp
@extends('core::master')

@section('content')
    <section class="content frontoffice-body">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" >
                        <a href="{{url($bUrl)}}" class="btn bg-gradient-info btn-sm custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-arrow-left"></i> Back </a>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body" >
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="" >
                            @csrf

                            {!! validation_errors($errors) !!}
                            <div class="form-group row">
                                <label for="section" class="col-sm-2 col-form-label">Modules <code>*</code></label>
                                <div class="col-sm-3">
                                    <select id="module_id" name="module_id" class="form-control" >
                                        <option value=""> Select Module </option>
                                        @if (!empty($modules))
                                            @foreach($modules as $module)
                                                <option  {{ isset($module_id) && $module_id == $module->id ? 'selected' : '' }} value="{{$module->id}}">{{ucwords($module->name)}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="section_id" class="col-sm-2 col-form-label">Section </label>
                                <div class="col-sm-3">
                                    <select id="section_id" name="section_id[]" class="select2" multiple="multiple" data-placeholder="Select Section" style="width: 100%;"  >
                                        <option value=""> Select Section </option>
                                        @if(!empty($all_sections) && $all_sections->count() > 0)
                                            @foreach($all_sections as $section)
                                                <option {{!empty($section_id) && array_search($section->id,$section_id) !=''?'selected':''}}  value="{{$section->id}}"> {{$section->section_name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="section_id" class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-3">
                                    @php
                                        $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                    @endphp
                                    <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>&nbsp;&nbsp;
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                @if(!empty($sections))
                <form method="post" action="{{url($bUrl.'/section-update')}}" >
                    @csrf
                    <input type="hidden" name="module_id" value="{{$module_id??''}}">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">



                                @foreach($sections as $section)

                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <input type="text" value="{{$section->section_name}}"  name="section_name[{{$section->id}}]" class="form-control">
                                    </div>
                                </div>
                                @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="offset-md-2 col-sm-9">
                                @php
                                    $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                @endphp
                                <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Update</button>&nbsp;&nbsp;
                                <a href="{{url($bUrl)}}"  class="btn btn-warning"><i class="fas fa-times"></i> Cancel</a>
                            </div>
                        </div>
                    </div>


                </form>
                @endif
            </div>



        </div>
    </section>
@endsection
@push('js')
    <script>
        $('#module_id').on('change', function (e) {
            e.preventDefault();
            getModuleBySections();
        });
        function getModuleBySections(){
            let module_id = $('#module_id').val();
            if (module_id !=''){
                $.ajax({
                    type: "post",
                    url: "{{ url('core/permissions/get-sections') }}",
                    data: {
                        "_token"        : "{{ csrf_token() }}",
                        module_id       : module_id,
                    },
                    success: function(data){
                        $('#section_id').html(data);
                    },
                    error: function(err){
                        $('#section_id').html('');
                    }
                });
            }
            $('#section_id').html('');
        }
    </script>
@endpush

