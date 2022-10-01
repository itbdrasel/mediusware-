@extends('core::master')
@section('content')
<!-- Main content -->
<section class="content ">
<div class="row frontoffice-body">

    <div class="col-11">

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">  <i class="fa fa-book"></i> {{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool">
                        <a href="{{url($bUrl.'/create')}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-plus-circle"></i> Add New Role</a>
                    </button>
                </div>
            </div>
            <div class="card-body" id="">


                <div class="col-md-12">

                    <form action="{{url($bUrl)}}" method="get"  class="form-inline">

                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Filter Role Name ..." class="form-control float-left search_input"/>
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
                                    <th class="sort" data-row="name" id="name" >Role Name</th>
                                    <th class="sort" data-row="slug" id="slug" >Role Slug</th>
                                    <th>Redirect</th>
                                    <th>Session Key</th>
                                    <th>Session Value</th>
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
                                            <td>{{ $data->slug }}</td>
                                            <td>{{$data->redirect}}</td>
                                            @php
                                                $session_key = '';
                                                $session_value = '';
                                                if (!empty($data->session_data)) {
                                                    $session_data = json_decode($data->session_data);
                                                    if (!empty($session_data)) {
                                                        $session_key = $session_data->session_key;
                                                        $session_value = $session_data->session_value;
                                                    }
                                                }
                                            @endphp
                                            <td>{{$session_key}}</td>
                                            <td>{{$session_value}}</td>


                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-info">
                                                        <a href="{{url($bUrl.'/'.$data->$tableID.'/edit')}}"><i class="fa fa-edit"></i> </a>
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

            <div class="card-footer">
                {{$title}}
            </div>
        </div><!--/card-->

    </div>
</div>
</section>

    @endsection
