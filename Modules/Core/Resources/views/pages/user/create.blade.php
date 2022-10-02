@extends("master_home")
@section("content")

@push('js')
	<style>
		#hotel_list, #module_name{ display:none}
	</style>
@endpush
    <section class="content">
        <!-- Default box -->
        <div class="row">

            <div class="col-6">
				<form action="{{url($bUrl.'/store')}}" method="post">
				<div class="card">
					<div class="card-header">
						<h2 class="card-title"> {{$title}} </h2>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>

							<button type="button" class="btn btn-tool" >
								<a href="{{url('system/core/users')}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-arrow-left"></i> Back</a>
							</button>
						</div>
					</div>


					<div class="card-body login-card-body mt-4">
						<div class="pl-3 col-11">

								{{csrf_field()}}

								{{ validation_errors($errors) }}

								<div class="form-group row">
									<label class="col-sm-4 col-form-label">User Name<code>*</code></label>

									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" name="full_name" id="full_name" value="{{ old('full_name')}} " class="form-control" placeholder="Your Name">
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fas fa-user"></span>
												</div>
											</div>
										</div>

									</div>
								</div>


								<div class="form-group row">
									<label class="col-sm-4 col-form-label">E-mail<code>*</code></label>

									<div class="col-sm-8">
										<div class="input-group ">
											<input type="email" id="email" name="email" value="{{ old('email')}} " class="form-control" placeholder="Email">
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fas fa-envelope"></span>
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="form-group row">
									<label class="col-sm-4 col-form-label">Password<code>*</code></label>

									<div class="col-sm-8">
										<div class="input-group ">
											<input type="password" name="password" id="password" class="form-control" placeholder="Password">
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fas fa-lock"></span>
												</div>
											</div>
										</div>
									</div>

								</div>


								<div class="form-group row">
									<label class="col-sm-4 col-form-label">User Group<code>*</code></label>

									<div class="col-sm-8">
										<div class="input-group ">
											<select id="role" name="role" class="form-control" >
												<option value=""> Select User Group </option>
												@foreach(\App\Roles::get() as $role)
													<option data-role="{{ $role->slug }}" value="{{$role->id}}" {{ ( old("role") == $role->id ? "selected" : "") }} > {{ ucfirst($role->name) }}</option>
												@endforeach

											</select>
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fas fa-user-circle"></span>
												</div>
											</div>
										</div>
									</div>
								</div>


								<div id="module_name" {{ (old('role') == 1) ? 'style=display:block' : ''  }}>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Module Name<code>*</code></label>

										<div class="col-sm-8">
											<div class="input-group ">
												<select id="module" name="module" {{ (old('role') != 1) ? 'disabled' : ''  }} class="form-control" >
													@php
														$modules = ['hotels'=>'Hotel Management', 'hrms'=>'Human Resourse',]
													@endphp
													@foreach($modules as $key=>$value)
														<option value=" {{ $key }}"> {{ $value }}</option>
													@endforeach

												</select>
												<div class="input-group-append">
													<div class="input-group-text">
														<span class="fas fa-tasks"></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div><!--/module_name-->
								<div id="hotel_list" {{ (old('role') == 2 || old('role') == 3) ? 'style=display:block' : ''  }}>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label"> Hotel Name<code>*</code></label>

										<div class="col-sm-8">
											<div class="input-group ">
												<select id="hotel_id" name="hotel_id" {{ (old('role') == 2 || old('role') == 3 ) ? '' : 'disabled'  }} class="form-control" >
													@if(session()->get('_hotel_id') == 0)
														@foreach(\App\Models\HotelList::orderBy('isHeadOffice', 'DESC')->get() as $hotel)
															<option value=" {{ $hotel->h_id }}"> {{ $hotel->h_name }}</option>
														@endforeach
													@else
														@foreach(\App\Models\HotelList::where('h_id',session()->orderBy('isHeadOffice', 'DESC')->get('_hotel_id'))->get() as $hotel)
															<option value=" {{ $hotel->h_id }}"> {{ $hotel->h_name }}</option>
														@endforeach
													@endif


												</select>
												<div class="input-group-append">
													<div class="input-group-text">
														<span class="fas fa-hotel"></span>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
								<!-- /hotel_list-->






						</div>


					</div>
					<!-- /.login-card-body -->
					<div class="card-footer">
						<div class="offset-md-4 col-sm-8">
							<button type="submit" class="btn btn-primary">Register User</button>&nbsp;
							<a href="{{url('/system/core/users')}}" class="btn btn-warning">Cancel</a>
						</div>
					</div>
				</div><!-- /.card -->
				</form>
	</div>
 </div>
</section>

@endsection
    @push('js')

	<script>
	$('#role').change(function(){

		switch( $(this).find(':selected').data('role') ) {
		  case "admin":
			$('#module_name').slideDown(200);
			$('#module_name #module').removeAttr('disabled');
			$('#hotel_list').slideUp(200);
			$('#hotel_list #hotel_id').attr('disabled', 'disabled');
			break;
		  case "hoteladmin":
		  case "hotelmanager":
		  case "frontdesk":
		  case "roomservice":
		  case "hrmanager":
		  case "payrollmanager":
			$('#hotel_list').slideDown(200);
			$('#hotel_list #hotel_id').removeAttr('disabled');
			$('#module_name').slideUp(200);
			$('#module_name #module').attr('disabled', 'disabled');
			break;
		  default:
			$('#hotel_list, #module_name').slideUp(200);
		}
	});

	</script>


    @endpush
