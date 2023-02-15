@extends('core::master')
@section('content')
<!-- Main content -->
<section class="content ">
<div class="row data-body">

    <div class="col-md-11 col-sm-12">

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
            <input type="hidden"  data-row="" id="sortBy">
            <div id="tableData">
                @include($view_path.'data')
            </div>

        </div><!--/card-->

    </div>
</div>
</section>
    @endsection
@push('js')
    <script src="{{url('backend/js/index_page.js')}}"></script>
@endpush

