@extends('core::master')

@section('content')

<!-- Main content -->
<section class="container">

	<div class="row">

	  <div class="col-8">

		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">  <i class="fa fa-book"></i> {{$title}}</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool">
						<a href="{{url($bUrl)}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-arrow-left"></i> Back</a>
					</button>
				</div>
			</div>

            <div class="card-body">


			 <form method="post" action="{{url($bUrl.'/store')}}" >
                    @csrf

					{!! validation_errors($errors) !!}

                 <input type="hidden"  value="{{ getValue($tableID, $objData) }}" id="id" name="{{$tableID}}">

						<div class="form-group row">
							<label for="h_name" class="col-sm-2 col-form-label"> Role Name <code>*</code></label>

							<div class="col-sm-5">
								<input type="text" value="{{getValue('name', $tableID)}}" name="name"    class="form-control">
							</div>


						</div>
					 <div class="form-group row">
						 <label for="h_name" class="col-sm-2 col-form-label"> Role Slug <code>*</code></label>
						 <div class="col-sm-5">
							 <input type="text" value="{{getValue('slug', $objData)}}" name="slug" class="form-control">
						 </div>
					 </div>

                     <div class="form-group row">
                         <label class="col-sm-2 col-form-label"> Redirect <code>*</code></label>
                         <div class="col-sm-5">
                             <input type="text" value="{{getValue('redirect_url', $objData)}}" name="redirect_url"  class="form-control">
                         </div>
                     </div>

                 <div class="form-group row">
                     <label class="col-sm-2 col-form-label"> Session Key </label>
                     <div class="col-sm-5">
                         <input type="text" value="{{getValue('redirect', $objData)}}" name="session_key"  class="form-control">
                     </div>
                 </div>
                 <div class="form-group row">
                     <label  class="col-sm-2 col-form-label"> Session Value </label>
                     <div class="col-sm-5">
                         <input type="text" value="{{getValue('redirect', $objData)}}" name="session_value"  class="form-control">
                     </div>
                 </div>



				 <!-- /.card-body -->
					<div class="card-footer">
						<div class="offset-md-2 col-sm-9">
							<button type="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;
							<a href="{{url($pageUrl)}}"  class="btn btn-warning">Cancel</a>
						</div>
					</div>
					<!-- /.card-footer-->

	  			</form>


			</div>
		</div><!--/card-->

	</div>
 </div>
</section>

    @endsection
