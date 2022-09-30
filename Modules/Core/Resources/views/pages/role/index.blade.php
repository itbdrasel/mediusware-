@extends('core::master')
@section('content')
<!-- Main content -->
<section class="content ">
<div class="row frontoffice-body">

    <div class="col-10">

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">  <i class="fa fa-book"></i> {{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool">
                        <a href="{{url($bUrl.'/create')}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-plus-circle"></i> Add New Role</a>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">SL</th>
                        <th>Role Name</th>
                        <th>Role Slug</th>
                        <th>Redirect</th>
                        <th>Session Key</th>
                        <th>Session Value</th>
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
                                <td>{{$data->name}}</td>
                                <td>{{$data->slug}}</td>
                                <td>{{$data->redirect}}</td>
                                @php
                                    $session_key = '';
                                    $session_value = '';
                                    if (!empty($data->session_data)) {
                                        $session_data = json_decode($data->session_data);
                                        if (!empty($session_data)) {
                                            $session_key = $session_data->session_key;
                                            $session_value = $session_data->session_value;
                                        }
                                    }
                                @endphp
                                <td>{{$session_key}}</td>
                                <td>{{$session_value}}</td>

                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <!-- /.card-body -->
                <br>

                <!-- /.card-footer-->

            </div>
            <div class="card-footer">
                {{$title}}
            </div>
        </div><!--/card-->

    </div>
</div>
</section>

    @endsection
