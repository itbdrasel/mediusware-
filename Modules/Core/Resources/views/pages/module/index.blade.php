@extends('core::master')

@section('content')
    <section class="content frontoffice-body">
        <!-- Default box -->
        <div class="row">
            <div class="col-4">
                <form action="{{url($bUrl.'/store')}}" method="post">
                    @csrf()
                    <div class="card card-outline card-primary">
                        {!! validation_errors($errors) !!}
                        <div class="card-header">
                            <h2 class="card-title"><i class="fa fa-plus"></i> Add New Module</h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                @php
                                    $input_name = 'name';
                                @endphp
                                <label for="guest_type_title" class="w-100">{{ucfirst(str_replace('_',' ',$input_name))}}<code>*</code></label>
                                <input type="text" value="{{ old($input_name) }}" id="{{$input_name}}" name="{{$input_name}}"  class="form-control  @error($input_name) is-invalid @enderror ">

                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                            </div>
                            <div class="input-group mb-3">
                                @php
                                    $input_name = 'slug';
                                @endphp
                                <label for="guest_type_title" class="w-100">{{ucfirst(str_replace('_',' ',$input_name))}}<code>*</code></label>
                                <input type="text" value="{{ old($input_name) }}" id="{{$input_name}}" name="{{$input_name}}"  class="form-control  @error($input_name) is-invalid @enderror ">

                                <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                            </div>
                            <div class="input-group mb-3">
                                @php
                                    $input_name = 'status';
                                @endphp
                                <label for="guest_type_title" class="w-100">{{ucfirst(str_replace('_',' ',$input_name))}} <code>*</code></label>
                                <select name="{{$input_name}}"  class="form-control">
                                    <option {{(old($input_name) ==1 )?'selected':''}} value="1">Active</option>
                                    <option {{(old($input_name) =='0' )?'selected':''}} value="0">Inactive</option>
                                </select>

                            </div>




                        </div>
                        <!-- /.login-card-body -->
                        <div class="card-footer">
                            <div class="offset-md-3 col-sm-10">
                                @php
                                    $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                                @endphp
                                <button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary">Save</button>&nbsp;&nbsp;
                                <a href="{{url($bUrl)}}"  class="btn btn-warning">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-8">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body" id="">


                        <div class="col-md-12">

                            <form action="{{url($bUrl)}}" method="get"  class="form-inline">

                                <div class="form-row">
                                    <div class="col">
                                        <input type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Filter ..." class="form-control float-left search_input"/>
                                    </div>

                                    <div class="col">
                                        <input  type="submit" class="btn btn-primary" value="Filter"/>
                                        &nbsp;<a class="btn btn-default" href="{{ url($bUrl) }}"> Reset </a>
                                    </div>


                                </div>


                            </form>

                            <div class="col">

                                @if( !empty( Request::query() ) )

                                    @if( array_key_exists( 'filter', Request::query() ) || array_key_exists( 'selected', Request::query() ) )

                                        Showing results for

                                        @if(!empty($filter) )
                                            '{{ $filter }}'
                                        @endif

                                    @endif

                                @endif

                            </div>


                        </div>




                        <div class="col-md-12 mt-4">

                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px">SL</th>
                                            <th class="sort" data-row="name" id="name" >Name</th>
                                            <th class="sort" data-row="slug" id="slug" >Slug</th>
                                            <th class="text-center" >Status</th>
                                            <th style="width: 180px" class="text-center">Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if ($allData->count() > 0)

                                            @php
                                                $c = 1;
                                            @endphp

                                            @foreach ($allData as $data)
                                                @php

                                                    $status = '<i class="fa fa-times-circle" aria-hidden="true" style="color:red; font-size:19px"></i>';
                                                    if ($data->status ==1) {
                                                        $status = '<i class="fa fa-check-circle" aria-hidden="true" style="color:green;font-size:19px"></i>';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ $c+$serial }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->slug }}</td>
                                                    <td class="text-center">{!! $status !!}</td>

                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-info">
                                                            <a data-toggle="modal" data-target="#windowmodal" href="{{url($bUrl.'/'.$data->$tableID.'/edit')}}"><i class="fa fa-edit"></i> </a>
                                                        </button>

                                                        <button type="button" class="btn btn-outline-info">
                                                            <a ata-toggle="modal" data-target="#windowmodal" href="{{url($bUrl.'/delete/'.$data->$tableID)}}"><i class="fa fa-trash"></i> </a>
                                                        </button>
                                                        </div>

                                                    </td>
                                                </tr>

                                                @php
                                                    $c++;
                                                @endphp

                                            @endforeach

                                        @else

                                            <tr> <td colspan="4">There is nothing found.</td> </tr>


                                        @endif
                                        </tbody>
                                    </table>
                                </div>


                                @include('core::layouts.include.per_page')


                                <div class="col-md-9">
                                    <div class="pagination_table">
                                        {!! $allData->render() !!}
                                    </div>
                                </div>


                            </div><!-- /row -->


                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{$title}}
                    </div>
                    <!-- /.card-footer-->
                </div>

            </div>
        </div>
    </section>
@include('core::layouts.include.modal')
@endsection









