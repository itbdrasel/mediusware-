@extends('core::master')
@section('content')
<!-- Main content -->
<section class="content ">
<div class="row frontoffice-body">

    <div class="col-12">

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">  <i class="fa fa-book"></i> {{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool">
                        <a href="{{url($bUrl.'/create')}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-plus-circle"></i> Add New</a>
                    </button>
                </div>
            </div>
            <div class="card-body" id="">


                <div class="col-md-12">

                    <form action="{{url($bUrl)}}" method="get"  class="form-inline">

                        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                            <div class="col">
                                <input type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Filter Name or Phone..." class="form-control search_input w-100"/>
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
                                    <th width="200" class="sort" data-row="slug" id="slug" >Phone</th>
                                    <th>E-mail</th>
                                    <th>Address</th>
                                    <th width="100" class="text-center">Order by</th>
                                    <th width="100" class="text-center">Status</th>
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
                                            <td>{{ $data->phone }}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->address}}</td>
                                            <td class="text-center">{{$data->order_by}}</td>
                                            <td class="text-center">{!! $status !!}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-info link_btn">
                                                        <a href="{{url($bUrl.'/'.$data->$tableID.'/edit')}}"><i class="fa fa-edit"></i> </a>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-info link_btn">
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

                                    <tr> <td colspan="7">There is nothing found.</td> </tr>


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

            <div class="card-footer">
                {{$title}}
            </div>
        </div><!--/card-->

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
