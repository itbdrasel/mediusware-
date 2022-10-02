@extends("core::master")
@section("content")
    <section class="content">
        <!-- Default box -->
        <div class="row">

            <div class="col-6">
				<form action="{{url($bUrl.'/store')}}" method="post">
				<div class="card  card-outline card-primary">
					<div class="card-header">
						<h2 class="card-title"> {{$title}} </h2>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>

							<button type="button" class="btn btn-tool" >
								<a href="{{url($bUrl)}}" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> <i class="fa fa-arrow-left"></i> Back</a>
							</button>
						</div>
					</div>


					<div class="card-body login-card-body mt-4">
						<div class="pl-3 col-11">

                            @csrf
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
									<label class="col-sm-4 col-form-label">User Role<code>*</code></label>
									<div class="col-sm-8">
										<div class="input-group ">
											<select id="role" name="role" class="form-control" >
                                                <option value=""> Select User Role </option>
                                                @if (!empty($roles))
                                                    @foreach ($roles as $role)
												<option {{old('role')==$role->id?'selected':''}}  value="{{$role->id}}"> {{$role->name}} </option>
                                                    @endforeach
                                                @endif
											</select>
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fas fa-user-circle"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
						</div>


					</div>
					<!-- /.login-card-body -->
					<div class="card-footer">
						<div class="offset-md-4 col-sm-8">
                            @php
                                $spinner=  '<i class="fas fa-spinner fa-pulse"></i> Please Wait';
                            @endphp
							<button type="submit" onclick="this.disabled=true;this. innerHTML='{{$spinner}}';this.form.submit();" class="btn btn-primary"><i class="fas fa-save"></i> Register User</button>&nbsp;
							<a href="{{url($bUrl)}}" class="btn btn-warning">Cancel</a>
						</div>
					</div>
				</div><!-- /.card -->
				</form>
	</div>
 </div>
</section>

@endsection

