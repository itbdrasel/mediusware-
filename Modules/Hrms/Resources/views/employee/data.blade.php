<div class="card-body" id="">
    <div class="col-md-12">
        <form id="filter_form"   action="{{url($bUrl)}}" method="get"  class="form-inline">
            <div class="row">
                <div class="col-md-3 form-group">
                    <input type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Filter Name ..." class="form-control search_input w-100"/>
                </div>
                <div class="col-md-4 form-group">
                    <input  type="submit" class="btn btn-primary filter_submit" value="Filter"/>
                    &nbsp;<a class="btn btn-default filter_reset" href="{{ url($bUrl) }}"> Reset </a>
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
                        <th class="sort text-center" data-row="id_number" id="id_number" >ID No</th>
                        <th>Mobile</th>
                        <th>E-mail</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th class="text-center">Photo</th>
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
                                <td class="text-center">{{ $data->id_number }}</td>
                                <td>{{ $data->mobile }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->department->name??'' }}</td>
                                <td>{{ $data->designation->name??'' }}</td>
                                <td></td>
                                <td class="text-center">
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-outline-primary link_btn">
                                            <a  href="{{url($bUrl.'/'.$data->id)}}"><i class="fa fa-table"></i> </a>
                                        </button>
                                        <button class="btn btn-primary dropdown-toggle dropdown_toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item"  href="{{url($bUrl.'/'.$data->id.'/edit')}}"><i class="fa fa-edit"></i> Edit</a></li>
                                            <li> <div class="dropdown-divider"></div></li>
                                            <li>
                                                <a class="dropdown-item"  onclick="deleteItem('{{$data->$tableID}}','{{url($bUrl.'/delete')}}')" style="cursor: pointer"><i class="fa fa-trash"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>

                            @php
                                $c++;
                            @endphp

                        @endforeach

                    @else

                        <tr> <td colspan="9">There is nothing found.</td> </tr>


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
