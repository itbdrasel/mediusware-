<div class="card-body">
    <div class="row">
        <div class="col-xl-2 col-sm-3 col-md-2 school_body">
            @if (count($allClass) >0)
                <ul class="card w-100 nav tabs-vertical">
                    @foreach($allClass as $class)
                        <li class="{{$class_id ==$class->id?'active':''}}">
                            <a href="{{url($bUrl.'/'.$class->id)}}"><i class="fas fa-circle"></i>{{$class->name}}</a>
                        </li>
                    @endforeach

                </ul>
            @endif
        </div>
        <div class="col-xl-10 col-sm-9 col-md-10">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{empty($section_id)?'active':''}}" href="{{url($pageUrl)}}" >All Students</a>
                        </li>
                        @if (count($sections) >0)
                            @foreach($sections as $section)
                                <li class="nav-item">
                                    <a class="nav-link {{(!empty($section_id) && $section->id == $section_id)?'active':''}}" href="{{url($pageUrl.'/'.$section->id)}}" >{{$section->name}}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="card-body table-responsive">
                    <div class="col-md-12 ">
                        <form id="filter_form"  action="{{url($bUrl.'/'.$class_id)}}" method="get"  class="form-inline">

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
                            <div class="col-md-12">

                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="50">SL</th>
                                        <th width="120" class="sort text-center" data-row="id_no" id="id_no" >Id No</th>
                                        <th width="120" class="text-center">Photo</th>
                                        <th class="sort" data-row="name" id="name" >Name</th>
                                        <th class="text-center" width="100">Roll</th>
                                        <th class="text-center" width="150">Phone</th>
                                        <th width="150" class="text-center">Manage</th>
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
                                                <td class="text-center">{{ $data->id_number }}</td>
                                                <td>{{ $data->teacher->name??'' }}</td>
                                                <td>{{ $data->name??'' }}</td>
                                                <td class="text-center">{{ $data->roll }}</td>
                                                <td class="text-center">{{ $data->phone }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group dropleft">
                                                        <button type="button" class="btn btn-outline-primary link_btn">
                                                            <a  href="{{paramUrl($bUrl.'/show/'.$data->id)}}"><i class="fa fa-table"></i> </a>
                                                        </button>
                                                        <button class="btn btn-primary dropdown-toggle dropdown_toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item"  href="{{paramUrl($bUrl.'/'.$data->id.'/edit')}}"><i class="fa fa-edit"></i> Edit</a></li>
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

                                        <tr> <td colspan="7">There is nothing found.</td> </tr>


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
                <!-- /.card -->
            </div>


        </div>
    </div>

</div>
<!-- /.card-body -->

<!-- /.card-footer-->
