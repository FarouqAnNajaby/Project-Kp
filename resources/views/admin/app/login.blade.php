<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Admin Lamongan Mart</title>

	@include('admin.partials.stylesheet')
</head>


<body background="{{ asset('assets/img/bg1.jpeg') }}">
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="login-brand">
							<img src="{{ asset('assets/img/logoDinas.jpg') }}" alt="logo" width="100">
						</div>

						<div class="card card-primary">
							<div class="card-header">
								<h4>Login</h4>
							</div>

							<div class="card-body">
								<form method="POST" action="#" class="needs-validation" novalidate="">
									<div class="form-group">
										<label for="email">Email</label>
										<input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
										<div class="invalid-feedback">
											Silahkan masukkan email
										</div>
									</div>

									<div class="form-group">
										<div class="d-block">
											<label for="password" class="control-label">Sandi</label>
											<div class="float-right">
												<a href="forgot_password.php" class="text-small">
													Lupa Sandi?
												</a>
											</div>
										</div>
										<input id="password" type="password" class="form-control" name="password" tabindex="2" required>
										<div class="invalid-feedback">
											Silahkan masukkan kata sandi
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
											Login
										</button>
									</div>
								</form>
							</div>
						</div>
						<div class="simple-footer">
							Copyright &copy; Stisla 2018
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	@include('admin.partials.js')

</body>

</html>