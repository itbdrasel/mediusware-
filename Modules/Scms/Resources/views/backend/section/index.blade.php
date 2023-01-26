@extends('core::master')
@section('content')
    <section class="content data-body school_body">
        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" >
                                <a href="{{url($bUrl.'/create')}}" data-bs-toggle="modal" data-bs-target="#windowmodal" class="btn bg-gradient-info custom_btn"><i class="mdi mdi-plus"></i> <i class="fa fa-plus-circle"></i> Add New </a>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-sm-3 col-md-2">
                                @if (count($allClass) >0)
                                <ul class="card w-100 nav tabs-vertical">
                                    @foreach($allClass as $class)
                                    <li class="{{$id ==$class->id?'active':''}}">
                                        <a href="{{url($bUrl.'/'.$class->id)}}"><i class="fas fa-circle"></i>{{$class->name}}</a>
                                    </li>
                                    @endforeach

                                </ul>
                                @endif
                            </div>
                            <div class="col-xl-10 col-sm-9 col-md-10">
                                <div class="card">
                                    <input type="hidden" value="" data-row="" id="sortBy">
                                    <div id="tableData">
                                        @include($view_path.'data')
                                    </div>
                                </div>

                            </div>
                        </div>

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







