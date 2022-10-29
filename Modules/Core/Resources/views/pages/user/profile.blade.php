
@extends("core::master")
@section("content")
    <section class="content guest-profile-area">
        <!-- Default box -->
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body data-body">
                        <div class="col-md-10 col-sm-12">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="guest-profile-box">
                                        <div class="guest-profile-pic">
                                            <img src="{{url('/backend/images')}}/default-avatar.png">
                                        </div>
                                        <div class="text-center">
                                            <h4>{{$objData->full_name}}</h4>
                                            <span>User Role : {{ $objData->name}}</span>
                                        </div>
                                    </div>

                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">User Information</a>
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active " id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                            <div class="guest_info mb-4">
                                                <h2>User Information</h2>
                                                <div class="card-body">
                                                    <table class="table table-striped border">
                                                        <tbody><tr>
                                                            <th width="30%">Name </th>
                                                            <td> {{$objData->full_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>User Role </th>
                                                            <td> {{$objData->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>E-mail </th>
                                                            <td> {{$objData->email}}</td>
                                                        </tr>
                                                        @if(!empty($objData->phone))
                                                            <tr>
                                                                <th>Phone </th>
                                                                <td>{{$objData->phone}}</td>
                                                            </tr>
                                                        @endif
                                                        @if(!empty($objData->user_name))
                                                            <tr>
                                                                <th>User Name </th>
                                                                <td>{{$objData->user_name}}</td>
                                                            </tr>
                                                        @endif
                                                        @if(!empty($objData->branch_id) && !empty($objData->branch))
                                                            <tr>
                                                                <th>Branch </th>
                                                                <td>{{$objData->branch->name??''}}</td>
                                                            </tr>
                                                        @endif
                                                        @if(!empty($objData->activation))
                                                            <tr>
                                                                <th>Status </th>
                                                                <td>
                                                                    {!! $objData->activation->completed==1?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">Inactive</span>' !!}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
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
        </div>
        </div>
    </section>

@endsection
