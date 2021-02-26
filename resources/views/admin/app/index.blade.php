@extends('admin.layout.app')

@push('stylesheet')
<link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">
@endpush

@section('content')

<section class="section">
	<div class="section-header">
		<h1>Dashboard</h1>
	</div>

	<!-- kotak 3 -->
	<div class="row">
		<div class="col-lg-4 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-primary">
					<i class="far fa-user"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total UMKM</h4>
					</div>
					<div class="card-body">
						10
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-danger">
					<i class="far fa-newspaper"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Barang</h4>
					</div>
					<div class="card-body">
						42
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-warning">
					<i class="far fa-file"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Pengguna</h4>
					</div>
					<div class="card-body">
						1,201
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- statistik pengunjung per bulan -->
	<div class="row">
		<div class="col-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4>Statistik Transaksi</h4>
					<div class="card-header-action">
						<div class="btn-group">
							<div class="float-left mr-4">
								<select class="form-control selectric">
									<option>Bulan</option>
									<option>Januari</option>
									<option>Februari</option>
									<option>Maret</option>
									<option>April</option>
									<option>Mei</option>
									<option>Juni</option>
									<option>Juli</option>
									<option>Agustus</option>
									<option>September</option>
									<option>Oktober</option>
									<option>November</option>
									<option>Desember</option>
								</select>
							</div>
							<div class="float-left">
								<select class="form-control selectric">
									<option>Tahun</option>
									<option>Januari</option>
									<option>Februari</option>
									<option>Maret</option>
									<option>April</option>
									<option>Mei</option>
									<option>Juni</option>
									<option>Juli</option>
									<option>Agustus</option>
									<option>September</option>
									<option>Oktober</option>
									<option>November</option>
									<option>Desember</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<canvas id="myChart"></canvas>
				</div>
			</div>
		</div>
	</div>

	<!-- statistik transaksi per hari -->
	<div class="row">
		<div class="col-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4>Statistik UMKM</h4>
					<div class="card-header-action">
						<div class="float-left mr-4">
							<select class="form-control selectric">
								<option>Bulan</option>
								<option>Januari</option>
								<option>Februari</option>
								<option>Maret</option>
								<option>April</option>
								<option>Mei</option>
								<option>Juni</option>
								<option>Juli</option>
								<option>Agustus</option>
								<option>September</option>
								<option>Oktober</option>
								<option>November</option>
								<option>Desember</option>
							</select>
						</div>
						<div class="float-left">
							<select class="form-control selectric">
								<option>Tahun</option>
								<option>Januari</option>
								<option>Februari</option>
								<option>Maret</option>
								<option>April</option>
								<option>Mei</option>
								<option>Juni</option>
								<option>Juli</option>
								<option>Agustus</option>
								<option>September</option>
								<option>Oktober</option>
								<option>November</option>
								<option>Desember</option>
							</select>
						</div>
					</div>
				</div>
				<div class="card-body">
					<canvas id="myChart2"></canvas>
				</div>
			</div>
		</div>
	</div>

</section>

@endsection

@push('javascript')
<script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="assets/modules/chart.min.js"></script>
@endpush

@push('javascript-custom')

<script>
	// statistik lengkung
	var statistics_chart = document.getElementById("myChart").getContext('2d');

	var myChart = new Chart(statistics_chart, {
		type: 'line',
		data: {
			labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
			datasets: [{
				label: 'Statistics',
				data: [640, 387, 530, 302, 430, 270, 488],
				borderWidth: 5,
				borderColor: '#6777ef',
				backgroundColor: 'transparent',
				pointBackgroundColor: '#fff',
				pointBorderColor: '#6777ef',
				pointRadius: 4
			}]
		},
		options: {
			legend: {
				display: false
			},
			scales: {
				yAxes: [{
					gridLines: {
						display: false,
						drawBorder: false,
					},
					ticks: {
						stepSize: 150
					}
				}],
				xAxes: [{
					gridLines: {
						color: '#fbfbfb',
						lineWidth: 2
					}
				}]
			},
		}
	});

	// statistik bar
	var ctx = document.getElementById("myChart2").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
			datasets: [{
				label: 'Statistics',
				data: [460, 458, 330, 502, 430, 610, 488],
				borderWidth: 2,
				backgroundColor: '#6777ef',
				borderColor: '#6777ef',
				borderWidth: 2.5,
				pointBackgroundColor: '#ffffff',
				pointRadius: 4
			}]
		},
		options: {
			legend: {
				display: false
			},
			scales: {
				yAxes: [{
					gridLines: {
						drawBorder: false,
						color: '#f2f2f2',
					},
					ticks: {
						beginAtZero: true,
						stepSize: 150
					}
				}],
				xAxes: [{
					ticks: {
						display: false
					},
					gridLines: {
						display: false
					}
				}]
			},
		}
	});
</script>

@endpush