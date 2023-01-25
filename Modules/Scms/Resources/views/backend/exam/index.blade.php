@extends('core::master')
@section('content')
    <section class="content data-body">
        <!-- Default box -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" >
                                <a href="{{url($bUrl.'/create')}}" class="btn bg-gradient-info custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-plus-circle"></i> Add New </a>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div id="tableData">
                        @include('scms::backend.exam.data')
                    </div>

                </div>

            </div>
        </div>
    </section>
@include('core::layouts.include.modal')
@endsection
@push('js')
    <script src="{{url('backend/js/index_page.js')}}"></script>
@endpush






