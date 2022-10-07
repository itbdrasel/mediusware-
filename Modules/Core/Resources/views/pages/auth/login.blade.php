@extends("core::master_auth")
@section("content")

	<body>
	<section class="login-section">
		<div class="container-fluid pl-0">
			<div class="row d-flex justify-content-center align-items-center">
				<div class="col-lg-8 col-md-6">

					<div class="login-section-img">
						<h3>{{$appTitle}}</h3>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 d-flex justify-content-center">
					<div class="login-box">
						<div class="login-box-title">
							<img src="{{url($logo)}}">
							<h3>{{$appTitle}}</h3>
							<h5>Sign in to Continue</h5>

						</div>

						<div class="d-flex align-items-center login-box-title2">
							@if($errors->any())
							<div class="alert alert-danger w-100 alert-dismissible fade show" role="alert" style="background-color: #f8d7da !important; border-color: #f5c2c7; color: #842029;">
								{{$errors->all()[0]??''}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							@endif
						</div>
						<div>
							<div class="login-card-body">
								<form action="{{url($pageUrl)}}" method="post" class="m-0">
									@csrf
									<div class="row">
										<div class="col-12">
											<div class="input-group mb-3">
												<input type="email"  id="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email">
                                                <div class="input-group-text ">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
											</div>
										</div>
										<div class="col-12">
											<div class="input-group mb-3">
												<input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                                <div class="input-group-text ">
                                                    <span class="fas fa-lock"></span>
                                                </div>
											</div>
										</div>
{{--										<div class="col-12 text-left">--}}
{{--											<div class="icheck-primary">--}}
{{--												<input type="checkbox" id="remember">--}}
{{--												<label for="remember">--}}
{{--													Remember Me--}}
{{--												</label>--}}
{{--											</div>--}}
{{--										</div>--}}
										<div class="col-md-12 ">
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-block">Sign In</button>
                                            </div>
										</div>
										<div class="col-12 login-link">
											<a href="{{url($bUrl.'/forgot-password')}}">Forget Password?</a>
										</div>
									</div>
								</form>
							</div>
							<!-- /.login-card-body -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</body>
@endsection

