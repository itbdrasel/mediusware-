@extends('core::master')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="card data-body">
            <div class="card-header">
                <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool">
                        <a href="{{url($bUrl.'/'.$objData->id.'/edit')}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i>
                            <i class="fa fa-edit"></i> Edit</a>
                        <a href="{{url($bUrl)}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i
                                class="fa fa-arrow-left"></i> Back</a>
                    </button>

                </div>
            </div>
            <style>
                .guest-profile-box, .guest_info{
                    border: none !important;
                }
                .general_info label{
                    margin-bottom: 15px !important;
                }
                .other_label{
                    background-color: transparent !important;
                    color: #000080 !important;
                    font-weight: bold;
                }
                .other_label span{
                    border-bottom: 1px solid #000080;
                    font-size: 21px;
                }
                .language i{
                    font-size: 20px;
                }
                .language i.fa-check-circle{
                    color: green;
                }
                .language i.fa-times-circle{
                    color: red;
                }
                .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
                    background-color: #000080;
                }
            </style>
            <div class="card-body frontoffice-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="guest-profile-box">
                                    <div class="guest-profile-pic">
                                        @if(\Storage::exists($objData->picture))
                                            <img src="{{url('/').'/'.$objData->picture}}" alt="">
                                        @else
                                            <img src="{{url('/backend/images')}}/default-avatar.png">
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <h4>{{$objData->name}}</h4>
                                        <span>Employee ID : {{ $objData->id_number}}</span>
                                        <p>Designation : {{ $objData->designation->name??''}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="margin-top: -13px">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="pills-general-information-tab" data-toggle="pill" href="#v-general-information" role="tab" aria-controls="v-general-information" aria-selected="true">General Information</a>
                                    {{--                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">User Information</a>--}}
                                </div>
                            </div>

                        </div>
                        <div class="col-md-9 tab-content" id="v-pills-tabContent">
                            <div class="card tab-pane fade show active"  id="v-general-information" role="tabpanel" aria-labelledby="pills-general-information-tab">
                                <div class="guest_info pb-4">
                                    <h2 class="pl-4">General Information</h2>
                                    <div class="row pt-2 pl-4 general_info">
                                        <label class="col-sm-2 label font-weight-bold h6">Employee Name</label>
                                        <div class="col-sm-4">
                                            : {{$objData->name}}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Designation</label>
                                        <div class="col-sm-4">
                                            : {{$objData->designation->name??''}}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Employee ID</label>
                                        <div class="col-sm-4">
                                            : {{$objData->id_number}}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Department</label>
                                        <div class="col-sm-4">
                                            : {{$objData->department->name??''}}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Date Of Birth</label>
                                        <div class="col-sm-4">
                                            : {{userDateFormat($objData->birth_date)}}
                                        </div>
{{--                                        <label class="col-sm-2 label font-weight-bold h6">Employee Type</label>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            : {{$objData->employee_type}}--}}
{{--                                        </div>--}}
                                        <label class="col-sm-2 label font-weight-bold h6">Joining Date</label>
                                        <div class="col-sm-4">
                                            : {{userDateFormat($objData->joining_date)}}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Mobile No</label>
                                        <div class="col-sm-4">
                                            : {{$objData->mobile }}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">E-mail</label>
                                        <div class="col-sm-4">
                                            : {{$objData->email }}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">NID No</label>
                                        <div class="col-sm-4">
                                            : {{$objData->nid }}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Tin Number</label>
                                        <div class="col-sm-4">
                                            : {{$objData->in }}
                                        </div>

                                        <label class="col-sm-2 label font-weight-bold h6">Gender</label>
                                        <div class="col-sm-4">
                                            : {{$objData->employee_sex }}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Religion</label>
                                        <div class="col-sm-4">
                                            : {{ $objData->religion->name??'' }}
                                        </div>


                                        <label class="col-sm-2 label font-weight-bold h6">Basic Salary</label>
                                        <div class="col-sm-4">
                                            : {{$objData->basic_salary }}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Gross Salary</label>
                                        <div class="col-sm-4">
                                            : {{$objData->basic_salary }}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Blood Group</label>
                                        <div class="col-sm-4">
                                            : {{$objData->blood_group }}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Father's Name</label>
                                        <div class="col-sm-4">
                                            : {{$objData->father_name }}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Mother's Name</label>
                                        <div class="col-sm-4">
                                            : {{$objData->mother_name }}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Present Address</label>
                                        <div class="col-sm-4">
                                            : {{$objData->present_address }}
                                        </div>
                                        <label class="col-sm-2 label font-weight-bold h6">Permanent Address</label>
                                        <div class="col-sm-4">
                                            : {{$objData->permanent_address }}
                                        </div>
                                        <div class="col-sm-6"></div>

                                    </div>
                                    <h2 class="pl-4 other_label"><span>Educational Information</span></h2>
                                    <div class="pl-4 pr-4" >
                                        <table class="table table-bordered text-center" id="eduTable">
                                            <thead>
                                            <tr>
                                                <th scope="col" >Institute</th>
                                                <th scope="col" >Subject</th>
                                                <th scope="col" >Degree</th>
                                                <th scope="col" >Passing Year</th>
                                                <th scope="col" >Result</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $education_array =[];
                                                  if (!empty($objData->employee_education)) {
                                                      $education_array= json_decode($objData->employee_education, true);
                                                  }
                                            @endphp
                                            @if(count($education_array) >0)
                                                @foreach($education_array as $key=>$value)
                                                    <tr>
                                                        <td>{{$value['ins_name']}}</td>
                                                        <td>{{$value['subject']}}</td>
                                                        <td>{{$value['degree']}}</td>
                                                        <td>{{$value['passing_year']}}</td>
                                                        <td>{{$value['result']}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <h2 class="pl-4 other_label"><span>Language Information</span></h2>
                                    <div class="pl-4 pr-4" >
                                        <table class="table table-bordered text-center language" >
                                            <thead>
                                            <tr>
                                                <th scope="col" >Language</th>
                                                <th scope="col" >Read</th>
                                                <th scope="col" >Write</th>
                                                <th scope="col" >Speak</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $language_array =[];
                                                if (!empty($objData->employee_language)) {
                                                     $language_array= json_decode($objData->employee_language, true);
                                                    }
                                            @endphp
                                            @if(count($language_array) >0)
                                                @foreach($language_array as $sl=>$language_a)
                                                    <tr>
                                                        <td>{{$language_a['lang_name']}}</td>
                                                        <td>{!!  ($language_a['readLang']  == "Y") ? '<i class="fa fa-check-circle" aria-hidden="true"></i>': '<i class="fa fa-times-circle" aria-hidden="true"></i>'  !!}</td>
                                                        <td>{!!  ($language_a['writeLang']  == "Y") ? '<i class="fa fa-check-circle" aria-hidden="true"></i>': '<i class="fa fa-times-circle" aria-hidden="true"></i>'  !!}</td>
                                                        <td>{!!  ($language_a['speakLang']  == "Y") ? '<i class="fa fa-check-circle" aria-hidden="true"></i>': '<i class="fa fa-times-circle" aria-hidden="true"></i>'  !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                        @if(\Storage::exists($objData->employee_document))
                                            <label class="col-sm-2 label font-weight-bold h6">Document</label>
                                            <div class="col-sm-12">
                                                <embed src="{{url('/').'/'.$objData->employee_document}}" alt="" height="500px" width="100%"></embed><br>
                                                <a class="btn btn-sm btn-primary" target="_blank" href="{{url('/').'/'.$objData->employee_document}}">View</a>
                                            </div>
                                        @endif
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
    </section>






@include('core::layouts.include.modal')
@endsection





