@extends("master_auth")
@section("content")
	<style>
		.login-box, .register-box {
			width: 370px !important;
		}
	</style>
	<body>
	<section class="login-section">
		<div class="container-fluid pl-0">
			<div class="row d-flex justify-content-center align-items-center">
				<div class="col-lg-7 col-md-6">

					<div class="login-section-img">
						<h3>{{$appTitle}}</h3>
					</div>
				</div>
				<div class="col-lg-5 col-md-6 d-flex justify-content-center">
					<div class="login-box">
						<div class="login-box-title">
							<img src="{{url($logo)}}">
							<h3>{{$appTitle}}</h3>
							<h5>Reset your password</h5>
							<p>Enter your email address and we will send you a password reset link.</p>
						</div>

						<div class="d-flex align-items-center login-box-title2">
{{--							<h3>Admin Dashboard</h3>--}}
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
								<form action="{{url('system/core/forgot-password')}}" method="post" class="m-0">
									@csrf
									<div class="row">
										<div class="col-12">
											<div class="form-group mb-3">
												<input type="email"  id="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email">
												<span class="fas fa-envelope"></span>
											</div>
										</div>


										<div class="col-12">
											<button type="submit" class="btn btn-block">Send Password Reset E-mail</button>
										</div>
										<div class="col-12 login-link">
											<a href="{{url('system/core/login')}}">login</a>
										</div>
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

