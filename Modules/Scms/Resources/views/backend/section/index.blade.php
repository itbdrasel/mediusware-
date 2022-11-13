@extends('core::master')
@section('content')
    <section class="content data-body school_body">
        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" >
                                <a href="{{url($bUrl.'/create')}}" data-bs-toggle="modal" data-bs-target="#windowmodal" class="btn bg-gradient-info custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-plus-circle"></i> Add New </a>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-sm-3 col-md-2">
                                @if (count($allClass) >0)
                                <ul class="card w-100 nav tabs-vertical">
                                    @foreach($allClass as $class)
                                    <li class="{{$id ==$class->id?'active':''}}">
                                        <a href="{{url($bUrl.'/'.$class->id)}}"><i class="fas fa-circle"></i>{{$class->name}}</a>
                                    </li>
                                    @endforeach

                                </ul>
                                @endif
                            </div>
                            <div class="col-xl-10 col-sm-9 col-md-10">
                                <div class="card">
                                    <div class="card-body">
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
                                                            <th class="sort" data-row="nick_name" id="nick_name" >Nick Name</th>
                                                            <th>Teacher</th>
                                                            <th>Shift</th>
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
                                                                    <td>{{ $data->nick_name }}</td>
                                                                    <td>{{ $data->teacher->name??'' }}</td>
                                                                    <td>{{ $data->shift->name??'' }}</td>
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

                                                            <tr> <td colspan="5">There is nothing found.</td> </tr>


                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @include('core::layouts.include.per_page')
                                            </div><!-- /row -->


                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        {{$title}}
                    </div>
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






