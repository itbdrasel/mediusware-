@extends('core::master')
@section('content')
    <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header">
            </div>
            <div class="card-body" >
                <p><a href="{{url('core/dashboard')}}">Core Module</a></p>
                <p><a href="{{url('hrms/dashboard')}}">HRMS Module</a></p>
                <p><a href="{{url('scms/dashboard')}}">SCMS Module</a></p>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
@endsection
