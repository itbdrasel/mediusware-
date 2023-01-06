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

                    <div class="card-body" id="">


                        <div class="col-md-12">

                            <form action="{{url($bUrl)}}" method="get"  class="form-inline">

                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <input type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Filter Name ..." class="form-control search_input w-100"/>
                                    </div>

                                    <div class="col-md-4 form-group">
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
                                <div class="col-md-12 table-responsive">

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px">SL</th>
                                            <th class="sort" data-row="name" id="name" >Name</th>
                                            <th class="sort text-center" width="10%" data-row="year" id="year" >Year</th>
                                            <th style="width: 180px" class="text-center">Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if ($allData->count() > 0)

                                            @php
                                                $c = 1;
                                            @endphp

                                            @foreach ($allData as $data)
                                                <tr>
                                                    <td class="text-center">{{ $c+$serial }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td class="text-center">{{ getFormatYear($data->year) }}</td>

                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-primary link_btn">
                                                            <a data-bs-toggle="modal" data-bs-target="#windowmodal" href="{{url($bUrl.'/'.$data->$tableID.'/edit')}}"><i class="fa fa-edit"></i> </a>
                                                        </button>

                                                        <button type="button" class="btn btn-outline-primary link_btn">
                                                            <a data-bs-toggle="modal" data-bs-target="#windowmodal" href="{{url($bUrl.'/delete/'.$data->$tableID)}}"><i class="fa fa-trash"></i> </a>
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
                            </div><!-- /row -->


                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{getDataTablesInfo($allData, $serial??'', $c??'')}}
                    </div>
                    <!-- /.card-footer-->
                </div>

            </div>
        </div>
    </section>
@include('core::layouts.include.modal')
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#per_page').on('change', function() {
                $.ajax({
                    type:'POST',
                    url:'{{ url($bUrl) }}',
                    data: $( this ).serialize(),
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data){
                        window.location.href = '{{ url($bUrl) }}';
                    }
                });


            });

        });
    </script>

@endpush






