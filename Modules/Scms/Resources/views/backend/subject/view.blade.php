@extends('core::master')
@section('content')
    <!-- Main content -->
    <section class="content frontoffice-body">
        <div class="card data-body">
            <div class="card-header">
                <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool">
                        <a href="{{url($bUrl.'/'.$objData->id.'/edit')}}" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i>
                            <i class="fa fa-edit"></i> Edit</a>
                    </button>
                    <button type="button" class="btn btn-tool">
                        <a href="{{url($bUrl)}}" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i> <i
                                class="fa fa-arrow-left"></i> Back</a>
                    </button>

                </div>
            </div>

            <div class="card-body">
                <div class="col-8 m-auto">
                    <table class="table table-bordered customer_ifo">
                        <tbody>
                            <tr>
                                <th width="20%">Subject Name</th>
                                <td><strong>{{$objData->name}}</strong></td>
                            </tr>
                            <tr>
                                <th>Subject Code</th>
                                <td>{{$objData->subject_code}}</td>
                            </tr>
                            <tr>
                                <th>Class</th>
                                <td>{{ $objData->getClass->name??'' }}</td>
                            </tr>
                            <tr>
                                <th>Subject Type</th>
                                <td>{{ $objData->subjectType->name??'' }}</td>
                            </tr>
                            <tr>
                                <th>Teacher</th>
                                <td>{{ $objData->teacher->name??'' }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{$title}}
            </div>
        </div>
    </section>

@include('core::layouts.include.modal')
@endsection





