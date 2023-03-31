



<div class="card-body" id="">


    <div class="col-md-12">

        <form id="filter_form" action="{{url($bUrl)}}" method="get"  class="form-inline">

            <div class="row">
                <div class="col-md-3 form-group">
                    <input type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Filter Name ..." class="form-control search_input w-100"/>
                </div>

                <div class="col-md-4 form-group">
                    <input type="submit" class="btn btn-primary filter_submit" value="Filter"/>
                    &nbsp;
                    <button class="btn btn-default filter_reset" type="reset">Reset</button>
{{--                    <a class="btn btn-default" href="{{ url($bUrl) }}"> Reset </a>--}}
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

                <table class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px">SL</th>
                        <th lass="sort" data-row="name" id="name" >Name</th>
                        <th lass="sort" data-row="grade_point" id="grade_point" >Grade Point</th>
                        <th lass="sort" data-row="full_mark" id="full_mark" >Full Mark</th>
                        <th lass="sort" data-row="mark_from" id="mark_from" >Mark From</th>
                        <th lass="sort" data-row="mark_upto" id="mark_upto" >Mark Upto</th>
                        <th lass="sort" data-row="out_of_id" id="out_of_id" >Out of</th>
                        <th class="text-start">Comment</th>
                        <th lass="sort" data-row="status" id="status">Status</th>
                        <th style="width: 180px" class="text-center">Manage</th>
                    </tr>
                    </thead>
                    <tbody class="data_table">

                    <div  class="dataTables_ajax text-center d-none">
                        <i class="spinner-border text-center text-primary"></i>
                    </div>
                    @if ($allData->count() > 0)

                        @php
                            $c = 1;
                        @endphp

                        @foreach ($allData as $data)
                            <tr>
                                <td class="text-center">{{ $c+$serial }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->grade_point }}</td>
                                <td>{{ $data->full_mark }}</td>
                                <td>{{ $data->mark_from }}</td>
                                <td>{{ $data->mark_upto }}</td>
                                <td>Out of ({{ $data->out_of_id==1?5:4 }})</td>
                                <td class="text-start">{{ $data->comment }}</td>
                                <td>{!! getStatusBadge($data->status) !!}</td>

                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-primary link_btn">
                                            <a  href="{{url($bUrl.'/'.$data->$tableID.'/edit')}}"><i class="fa fa-edit"></i> </a>
                                        </button>

                                        <button type="button" class="btn btn-outline-primary link_btn">
                                            <a onclick="deleteItem('{{$data->$tableID}}','{{url($bUrl.'/delete')}}')" style="cursor: pointer"><i class="fa fa-trash"></i> </a>
                                        </button>
                                    </div>

                                </td>
                            </tr>

                            @php
                                $c++;
                            @endphp

                        @endforeach

                    @else
                        <tr> <td colspan="10">There is nothing found.</td> </tr>
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


