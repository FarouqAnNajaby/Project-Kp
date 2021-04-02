@extends('ecommerce.layout.app')

@section('content')
<section class="shop login section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 col-12">
				<div class="login-form">
					<h2>Daftar Akun</h2>
					<p>Lengkapi Biodata Diri Anda untuk Memulai Bertransaksi dengan Akun Anda</p>
					<!-- Form -->
					<form class="form" method="post" action="#">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Nama Lengkap<span>*</span></label>
									<input type="text" name="nama" required="required">
								</div>
							</div>
							<div class="col-12 mb-4">
								<div class="form-group">
									<label for="">Jenis Kelamin</label>
									<select name="" id="" class="select-jk">
										<option value="">------Pilih------</option>
										<option value="">Laki-laki</option>
										<option value="">Perempuan</option>
									</select>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Tanggal Lahir</label>
									<input type="date" name="tanggal_lahir">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Email <span>*</span></label>
									<input type="email" name="email" required>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Kata Sandi<span>*</span></label>
									<input type="password" name="password" placeholder="" required="required">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Konfirmasi Kata Sandi<span>*</span></label>
									<input type="password" name="password_confirm" placeholder="" required="required">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group login-btn">
									<button class="btn" type="submit">Daftar Sekarang</button>
									<a href="/login.php" class="btn">Login</a>
								</div>
							</div>
						</div>
					</form>
					<!-- <form class="form" method="post" action="login.php">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Nama Lengkap<span>*</span></label>
									<input type="text" name="NamaLengkap" placeholder="" required="required">
								</div>                               
								<div class="form-group">
									<label>Tanggal Lahir<span>*</span></label>
									<input type="Date" name="tanggalLahir" placeholder="" required="required">
								</div>
                                <div class="form-group-check">
                                    <div class="single-widget daftar">
                                        <label>jenis kelamin<span>*</span></label>
                                        <ul class="check-box-list">
                                            <li>
                                                <label class="checkbox-inline" for="Laki-laki">
                                                    <input name="jk" id="Laki-laki" type="radio">Laki-laki
                                                </label>
                                            </li>
                                            <li>
                                                <label class="checkbox-inline" for="Laki-laki">
                                                    <input name="jk" id="Perempuan" type="radio">Perempuan 
                                                </label>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
								<div class="form-group">
									<label>Email<span>*</span></label>
									<input type="email" name="email" placeholder="" required="required">
								</div>
                                <div class="form-group">
									<label>Password<span>*</span></label>
									<input type="password" name="Password" placeholder="" required="required">
								</div>
								<div class="form-group">
									<label>Confirm Password<span>*</span></label>
									<input type="password" name="Confirm-Password" placeholder="" required="required">
								</div>
							</div>
							
							<div class="col-12">
								<div class="form-group daftar-btn">									
									<button class="btn" type="submit">Daftar Sekarang</button>	
																
								</div>
								<div class="confirm-login">
								<div class="right-login">																		
										<span>Sudah Punya Akun ?</span> <br>
									<a href="login.php" class="linked">Login Disini!</a>
								</div>

								</div>
																	
							</div>
						</div>
					</form> -->
					<!--/ End Form -->
				</div>
			</div>
		</div>
	</div>
</section>
@endsection