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
                    <input type="hidden"  data-row="" id="sortBy">
                    <div id="tableData">
                        @include($view_path.'data')
                    </div>

                </div>

            </div>
        </div>
    </section>
    @include('core::layouts.include.modal_delete')
    @include('core::layouts.include.blank_modal')
@endsection
@push('js')
    <script src="{{url('backend/js/index_page.js')}}"></script>
@endpush
