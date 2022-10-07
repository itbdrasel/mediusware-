@extends("core::master")
@section("content")
    <section class="content">
        <!-- Default box -->
        <div class="row">

            <div class="col-md-6">
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


					<div class="card-body mt-4">
						<div class="pl-3 col-11">

                            @csrf
								{{ validation_errors($errors) }}

								<div class="form-group row">
                                    @php
                                        $input_name = 'full_name';
                                    @endphp
									<label for="{{$input_name}}" class="col-sm-4 col-form-label">{{ucfirst(str_replace('_',' ',$input_name))}}<code>*</code></label>

									<div class="col-sm-8">
										<div class="input-group">
											<input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ old($input_name)}} " class="form-control @error($input_name) is-invalid @enderror" placeholder="Your Name">
											<div class="input-group-text ">
                                                <span class="fas fa-user"></span>
											</div>
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
										</div>

									</div>
								</div>


								<div class="form-group row">
                                    @php
                                        $input_name = 'email';
                                    @endphp
									<label for="{{$input_name}}" class="col-sm-4 col-form-label">{{ucfirst(str_replace('_',' ',$input_name))}}<code>*</code></label>

									<div class="col-sm-8">
										<div class="input-group ">
											<input type="email" id="{{$input_name}}" name="{{$input_name}}" value="{{ old($input_name)}} " class="form-control @error($input_name) is-invalid @enderror" placeholder="Email">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
										</div>
									</div>
								</div>

                            <div class="form-group row">
                                @php
                                    $input_name = 'user_name';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-4 col-form-label">User Name</label>

                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" id="{{$input_name}}" name="{{$input_name}}" value="{{old($input_name)}}" class="form-control @error($input_name) is-invalid @enderror" >
                                        <div class="input-group-text">
                                            <span class="fas fa-user-clock"></span>
                                        </div>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                @php
                                    $input_name = 'phone';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-4 col-form-label">Phone Number</label>

                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="{{$input_name}}" id="{{$input_name}}" value="{{ old($input_name)}} " class="form-control @error($input_name) is-invalid @enderror" >
                                        <div class="input-group-text">
                                            <span class="fas fa-phone"></span>
                                        </div>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>

                                </div>
                            </div>


								<div class="form-group row">
                                    @php
                                        $input_name = 'password';
                                    @endphp
									<label for="{{$input_name}}" class="col-sm-4 col-form-label">{{ucfirst(str_replace('_',' ',$input_name))}}<code>*</code></label>

									<div class="col-sm-8">
										<div class="input-group ">
											<input type="password" name="{{$input_name}}" id="{{$input_name}}" class="form-control @error($input_name) is-invalid @enderror" placeholder="{{ucfirst(str_replace('_',' ',$input_name))}}">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
										</div>
									</div>

								</div>

                            <div class="form-group row">
                                @php
                                    $input_name = 'password_confirmation';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-4 col-form-label">Confirm Password<code>*</code></label>

                                <div class="col-sm-8">
                                    <div class="input-group ">
                                        <input type="password" id="{{$input_name}}" class="form-control @error($input_name) is-invalid @enderror" name="{{$input_name}}" autocomplete="current-password">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
                                    </div>
                                </div>

                            </div>



								<div class="form-group row">
                                    @php
                                        $input_name = 'role';
                                    @endphp
									<label for="{{$input_name}}" class="col-sm-4 col-form-label">User Role<code>*</code></label>
									<div class="col-sm-8">
										<div class="input-group ">
											<select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                                <option value=""> Select User Role </option>
                                                @if (!empty($roles))
                                                    @foreach ($roles as $role)
												<option {{old('role')==$role->id?'selected':''}} data-branch="{{$role->active_branch}}"  value="{{$role->id}}"> {{$role->name}} </option>
                                                    @endforeach
                                                @endif
											</select>
                                            <div class="input-group-text">
                                                <span class="fas fa-user-circle"></span>
                                            </div>
                                            <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
										</div>
									</div>
								</div>
                            <div class="form-group row d-none" id="branch_aria">
                                @php
                                    $input_name = 'branch_id';
                                @endphp
                                <label for="{{$input_name}}" class="col-sm-4 col-form-label">Branch<code>*</code></label>
                                <div class="col-sm-8">
                                    <div class="input-group ">
                                        <select id="{{$input_name}}" name="{{$input_name}}" class="form-select @error($input_name) is-invalid @enderror" >
                                            <option value=""> Select User Branch </option>
                                            @if (!empty($allBranch))
                                                @foreach ($allBranch as $branch)
                                                    <option {{old($input_name)==$branch->id?'selected':''}}  value="{{$branch->id}}"> {{$branch->name}} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-text">
                                            <span class="fas fa-user-circle"></span>
                                        </div>
                                        <span id="{{$input_name}}-error" class="error invalid-feedback">{{$errors->first($input_name)}}</span>
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
@push('js')
    <script>
        $(document).ready(function () {
            activeBranch();
        })
        $('#role').on('change', function () {
            activeBranch();
        });
        function activeBranch() {
           let role = $('#role').val();
           if (role !=''){
               let activeBranch = $('#role').find(':selected').data('branch');
               if (activeBranch ==1){
                $('#branch_aria').removeClass('d-none');
               }else{
                   $('#branch_aria').addClass('d-none');
               }

           }else{
               $('#branch_aria').addClass('d-none');
           }
        }
    </script>
@endpush
