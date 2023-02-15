<div class="card-body" id="">


    <div class="col-md-12">
        <form id="filter_form"  action="{{url($bUrl)}}" method="get"  class="form-inline">
            <div class="row">
                <div class="col-sm-3 form-group ">
                    <input type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Filter Role Name ..." class="form-control search_input w-100"/>
                </div>
                <div class="col-sm-4 form-group ">
                    <input type="submit" class="btn btn-primary filter_submit" value="Filter"/>
                    <button class="btn btn-default filter_reset" type="reset">Reset</button>
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
                        <th class="sort" data-row="name" id="name" >Role Name</th>
                        <th class="sort" data-row="slug" id="slug" >Role Slug</th>
                        <th>Redirect</th>
                        <th class="text-center">Order By</th>
                        <th class="text-center">Directory</th>
                        <th class="text-center">Branch</th>
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
                            @php
                                $directory  = $data->active_directory==1?'<span class="badge bg-info">Yes</span>':'<span class="badge bg-warning">No</span>';
                                $branch     = $data->active_branch==1?'<span class="badge bg-primary">Yes</span>':'<span class="badge bg-warning">No</span>';
                            @endphp
                            <tr>
                                <td class="text-center">{{ $c+$serial }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->slug }}</td>
                                <td>{{$data->redirect_url}}</td>
                                <td class="text-center">{{$data->order_by}}</td>
                                <td class="text-center">{!! $directory !!}</td>
                                <td class="text-center">{!! $branch !!}</td>



                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-primary link_btn">
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





        </div><!-- /row -->


    </div>

</div>

<div class="card-footer">
    {{getDataTablesInfo($allData, $serial??'', $c??'')}}
</div>
