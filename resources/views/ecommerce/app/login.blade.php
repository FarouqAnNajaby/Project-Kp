@extends('ecommerce.layout.app')

@section('content')
<section class="shop login section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 col-12">
				<div class="login-form">
					<h2>Masuk</h2>
					<p>Masuk menggunakan akun anda untuk memulai transaksi</p>
					<!-- Form -->
					<form class="form" method="post" action="#">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Email<span>*</span></label>
									<input type="email" name="email" placeholder="" required="required">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Kata Sandi<span>*</span></label>
									<input type="password" name="password" placeholder="" required="required">

									<div class="checkbox">
										<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">Ingat saya</label>
									</div>
									<a href="javascript:;" class="lost-pass">Lupa password?</a>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group login-btn">
									<button class="btn" type="submit">Login</button>
									<a href="{{ route('ecommerce.registration') }}" class="btn">Register</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection