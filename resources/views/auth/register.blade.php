<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/default/full/login_tabbed.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Jan 2020 11:00:11 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Register</title>
	<link rel="Shortcut Icon" type="image/x-icon" href="{{asset('favicon.png')}}" />

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset ('global_assets/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset ('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset ('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset ('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset ('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset ('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset ('global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{asset ('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset ('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset ('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

	<script src="{{asset ('assets/js/app.js')}}"></script>
	<script src="{{asset ('global_assets/js/demo_pages/login.js')}}"></script>
	<!-- /theme JS files -->
	<style>
		.card{
			background-color: #fff0;
			border: 2px solid rgb(255 255 255 / 0.7);
			color:#fff;
		}
	</style>

</head>

<body>

	<!-- Page content -->
	<div class="page-content login-cover">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
				<form class="login-form wmin-sm-400" action="{{ route('register') }}" method="POST">
                @csrf
                @method('POST')
					<div class="card mb-0">
						<!-- <ul class="nav nav-tabs nav-justified alpha-grey mb-0">
							<li class="nav-item"><a href="#login-tab1" class="nav-link border-y-0 border-left-0 active" data-toggle="tab"><h6 class="my-1">Sign in</h6></a></li>
						</ul> -->

						<div class="tab-content card-body">
							<div class="tab-pane fade show active" id="login-tab1">
								<div class="text-center mb-3">
									<img src="{{asset('img/logo1.png')}}" style="width:25%;" alt="logo">
									<h5 class="mb-0">Register your account</h5>
									<!-- <span class="d-block text-muted">Your credentials</span> -->
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Username" autocomplete="name" autofocus>

									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
									@error('name')
										<span class="invalid-feedback text-white" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input id="class" type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class') }}" required placeholder="StudentID" autocomplete="StudentID" autofocus>
									<div class="form-control-feedback">
										<i class="icon-address-book2 text-muted"></i>
									</div>
									@error('class')
										<span class="invalid-feedback text-white" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email" autocomplete="email">
									<div class="form-control-feedback">
										<i class="icon-envelop3 text-muted"></i>
									</div>
									@error('email')
										<span class="invalid-feedback text-white" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="new-password">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
									@error('password')
										<span class="invalid-feedback text-white" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Check password" autocomplete="new-password">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
								</div>

								<div class="form-group d-flex align-items-center">
									<!-- <div class="form-check mb-0"> -->
									<a href="{{route('login')}}" class="text-white">登入</a>
									<!-- </div> -->

									<!-- <a href="#" class="ml-auto text-white">忘記密碼?</a> -->
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Register</button>
								</div>

								<!-- <div class="form-group text-center text-muted content-divider">
									<span class="px-2">or sign in with</span>
								</div>

								<div class="form-group text-center">
									<button type="button" class="btn btn-outline bg-indigo border-indigo text-indigo btn-icon rounded-round border-2"><i class="icon-facebook"></i></button>
									<button type="button" class="btn btn-outline bg-pink-300 border-pink-300 text-pink-300 btn-icon rounded-round border-2 ml-2"><i class="icon-dribbble3"></i></button>
									<button type="button" class="btn btn-outline bg-slate-600 border-slate-600 text-slate-600 btn-icon rounded-round border-2 ml-2"><i class="icon-github"></i></button>
									<button type="button" class="btn btn-outline bg-info border-info text-info btn-icon rounded-round border-2 ml-2"><i class="icon-twitter"></i></button>
								</div>

								<div class="form-group text-center text-muted content-divider">
									<span class="px-2">Don't have an account?</span>
								</div>

								<div class="form-group">
									<a href="#" class="btn btn-light btn-block">Sign up</a>
								</div> -->

								<!-- <span class="form-text text-center text-muted">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span> -->
							</div>
						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>

<!-- Mirrored from demo.interface.club/limitless/demo/Template/layout_1/LTR/default/full/login_tabbed.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Jan 2020 11:00:11 GMT -->
</html>
