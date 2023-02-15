@extends('core::master')
@section('content')
    <section class="content data-body ">
        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h2 class="card-title"> {!! $page_icon !!} &nbsp; {{ $title }} </h2>
                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" >
                                <a href="{{url($bUrl.'/create?class='.$class_id)}}{{!empty($section_id)?'&section='.$section_id:''}}" class="btn bg-gradient-info custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-plus-circle"></i> Add New </a>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" value="" data-row="" id="sortBy">
                    <div class="card-body" id="tableData">
                        @include($view_path.'data')
                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('core::layouts.include.modal_delete')
@endsection
@push('js')
    <script src="{{url('backend/js/index_page.js')}}"></script>
@endpush
