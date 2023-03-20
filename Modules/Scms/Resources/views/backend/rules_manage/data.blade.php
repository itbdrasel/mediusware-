<div class="card-body" id="">


    <div class="col-md-12">

        <form id="filter_form" action="{{url($bUrl)}}" method="get"  class="form-inline">

{{--            <div class="row">--}}
{{--                <div class="col-md-3 form-group">--}}
{{--                    <input type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Filter Name ..." class="form-control search_input w-100"/>--}}
{{--                </div>--}}

{{--                <div class="col-md-4 form-group">--}}
{{--                    <input type="submit" class="btn btn-primary filter_submit" value="Filter"/>--}}
{{--                    <button class="btn btn-default filter_reset" type="reset">Reset</button>--}}
{{--                </div>--}}


{{--            </div>--}}


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
                    <div  class="dataTables_ajax text-center d-none">
                        <i class="spinner-border text-center text-primary"></i>
                    </div>
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px">SL</th>
                        <th>Class</th>
                        <th>Exam</th>
                        <th class="text-center" width="18%">Start - End Year</th>
                        <th>All Roles</th>
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
                                <td>{{ $data->className->name??'' }}</td>
                                <td>{{ $data->exam->name??'' }}</td>
                                <td class="text-center">{{ !empty($data->start_year)?$data->start_year:'' }}{{ !empty($data->start_year) && !empty($data->end_year)?'-'.$data->end_year:' Continue' }}</td>
                                <td>
                                    @if(!empty($data->ruleManages))
                                        @foreach($data->ruleManages as $value)
                                            <span class="badge bg-primary">{{$value->ruleName->code}}</span>
                                        @endforeach
                                    @endif
                                </td>
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
