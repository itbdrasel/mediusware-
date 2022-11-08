<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">{{$appTitle}}</a></li>
                        <li class="breadcrumb-item active text-capitalize"><i class="fa fa-angle-double-right"></i> {{$moduleName}}</li>
                        @if(!empty($title))
                        <li class="breadcrumb-item active"><i class="fa fa-angle-double-right"></i> {{$title}}</li>
                        @endif
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
