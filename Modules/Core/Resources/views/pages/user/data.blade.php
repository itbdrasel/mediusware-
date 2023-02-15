<div class="card-body data-body">
    <div class="col-md-10">

        <form id="filter_form" action="{{url($bUrl)}}" method="get"  class="form-inline">

            <div class="row ">
                <div class="col-sm-3 form-group ">
                    <input type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Filter by name & email..." class="form-control search_input w-100"/>
                </div>


                <div class="col-sm-3 form-group ">
                    <select class="form-select" name="selected" >

                        <option value=""> Select User Role </option>
                        @php $locationList = [] @endphp
                        @if (!empty($roles))
                            @foreach ($roles as $key => $role)
                                @php $locationList += [$role->id => $role->name] @endphp

                                <option value="{{ $role->id }}"  {{ $selected == $role->id ? 'selected' : '' }} >{{ $role->name }}</option>
                            @endforeach;
                        @endif
                    </select>

                </div>

                <div class="col-sm-4 form-group ">
                    <input  type="submit" class="btn btn-primary filter_submit" value="Filter"/>
                    &nbsp;<a class="btn btn-default filter_reset" href="{{ url($bUrl) }}"> Reset </a>
                </div>



            </div>


        </form>
        <br>

        <div class="col">

            @if( !empty( Request::query() ) )

                Showing results for

                @if(!empty($filter) )
                    '{{ $filter }}'
                @endif

                @if(!empty($selected) && isset($locationList[$selected]) )
                    @if(!empty($filter) )
                        &amp;
                    @endif
                    User Role '{{ $locationList[$selected] }}'
                @endif


            @endif

        </div>


    </div>
    <div class="table-responsive-sm">
        <table class="table table-bordered  table-hover">
            <thead>
            <tr>
                <th style="width:50px; text-align: center">#</th>
                <th class="sort" data-row="name" id="name"  >Name</th>
                <th class="sort" data-row="email" id="email" >Email</th>
                <th data-row="role" id="role"  class="text-center sort">Users Role</th>
                <th class="text-center sort" data-row="login" id="login" >Last Login</th>
                <th class="text-center"  >Status</th>
                <th class="text-center" style="width: 150px">Action</th>
            </tr>
            </thead>
            <tbody class="data_table">

            <div  class="dataTables_ajax text-center d-none">
                <i class="spinner-border text-center text-primary"></i>
            </div>
            @if (!empty($allData))
                @php
                    $c = 1;
                @endphp
                @foreach($allData as $key=>$user)
                    @php
                        $status = '<span class="badge bg-danger">Inactive</span>';
                        if (!empty($user->activation) && $user->activation->completed){
                             $status = '<span class="badge bg-success">Active</span>';
                        }
                    @endphp
                    <tr>
                        <td class="text-center">{{$c}}</td>
                        <td>{{$user->full_name}}</td>
                        <td>{{$user->email}}</td>
                        <td class="text-center">{{ucfirst($user->name) }}</td>
                        <td class="text-center">{{ $user->last_login ? \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login))->diffForHumans() : 'Not yet login' }}</td>
                        <td class="text-center">{!! $status !!}</td>

                        <td class="text-center">


                            <div class="btn-group dropleft">
                                <button type="button" class="btn btn-outline-primary link_btn">
                                    <a  href="{{url($bUrl.'/profile/'.$user->id)}}"><i class="fa fa-table"></i> </a>
                                </button>
                                {{--                                                    <button type="button" class="btn btn-outline-info dropdown-toggle dropdown-hover dropdown-icon" data-bs-toggle="dropdown">--}}
                                {{--                                                    </button>--}}
                                <button class="btn btn-primary dropdown-toggle dropdown_toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" onclick="blankModal('{{url($bUrl.'/'.$user->$tableID.'/edit')}}')" style="cursor: pointer" ><i class="fa fa-edit"></i> Edit</a></li>
                                    <li><a class="dropdown-item" href="{{url($bUrl.'/permission/'.$user->id)}}"><i class="fa fa-eye"></i> view Permission</a></li>
                                    <li> <div class="dropdown-divider"></div></li>
                                    <li>
                                        <a class="dropdown-item"  onclick="deleteItem('{{$user->$tableID}}','{{url($bUrl.'/delete')}}')" style="cursor: pointer"><i class="fa fa-trash"></i> Delete</a>
                                    </li>
                                </ul>

                                <div class="dropdown-menu dropLeft" >




                                </div>
                            </div>
                        </td>
                    </tr>
                    @php
                        $c++;
                    @endphp
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

    <div class="row mt-4">
        @include('core::layouts.include.per_page')
    </div>
</div>
<div class="card-footer">
    {{getDataTablesInfo($allData, $serial??'', $c??'')}}
</div>
