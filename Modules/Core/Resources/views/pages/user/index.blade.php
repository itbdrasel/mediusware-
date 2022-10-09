@push('css')
    <style>
        input.form-control.float-left.search_input{
            width: 250px;
        }
        ul.pagination{
            float: right;
        }
    </style>
@endpush
@extends("core::master")
@section("content")
    <section class="content">
        <!-- Default box -->
        <div class="row">

            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                            <button type="button" class="btn btn-tool" >
                                <a href="{{url($bUrl.'/create')}}" class="btn bg-gradient-info custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-plus-circle"></i> Add New User </a>
                            </button>

                        </div>
                    </div>
                    <div class="card-body frontoffice-body">
                        <div class="col-md-10">

                            <form action="{{url($bUrl)}}" method="get"  class="form-inline">

                                <div class="row ">
                                    <div class="col-sm-3 form-group ">
                                        <input type="text" name="filter" value="{{ $filter ?? '' }}" placeholder="Filter by name & email..." class="form-control search_input w-100"/>
                                    </div>


                                    <div class="col-sm-3 form-group ">
                                        <select class="form-select" name="selected" id="by_loc" >

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
                                        <input type="submit" class="btn btn-primary" value="Filter"/>
                                        &nbsp;<a class="btn btn-default" href="{{ url($bUrl) }}"> Reset </a>
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
                                <tbody>
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
                                                    <button type="button" class="btn btn-outline-info link_btn">
                                                        <a  href="{{url($bUrl.'/profile/'.$user->id)}}"><i class="fa fa-table"></i> </a>
                                                    </button>

                                                    <button type="button" class="btn btn-outline-info dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                    </button>

                                                    <div class="dropdown-menu dropLeft" >
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#windowmodal" href="{{url($bUrl.'/'.$user->id.'/edit')}}"><i class="fa fa-edit"></i> Edit</a>
                                                        <a class="dropdown-item" href="{{url($bUrl.'/profile/'.$user->id)}}?permission=permission"><i class="fa fa-eye"></i> view Permission</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" id="action" data-toggle="modal" data-target="#windowmodal" href="{{url($bUrl.'/delete/'.$user->id)}}"><i class="fa fa-trash"></i> Delete</a>
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
                            <div class="col-md-9">
                                <div class="pagination_table">
                                    {!! $allData->render() !!}
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
            $('form').submit(function() {
                $(this).find(":input").filter(function(){return !this.value;}).attr("disabled", "disabled");
            });
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
