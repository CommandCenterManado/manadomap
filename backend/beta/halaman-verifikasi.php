<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="dist/bootstrap/css/bootstrap.min.css">
	<!-- Bootstrap Datepicker -->
	<link rel="stylesheet" type="text/css" href="dist/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
	<!-- main.css -->
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

</head>
<body>
	<header id="header">
		<div class="site-info-container">
			<div class="container">
				<div class="site-info">
					<h1>Pemerintah<img src="img/logo_manado.png">Kota Manado</h1>
				</div>
			</div>
		</div>
		<div class="nav-main-container">
			<div class="container">
				<div class="nav-main">
					<a href="#" class="btn btn-success btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-dashboard"></i>
						</div>
						<div class="btn-label">
							Dashboard Card
						</div>
					</a>
					<a href="#" class="btn btn-success btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-map-marker"></i>
						</div>
						<div class="btn-label">
							Dashboard Map
						</div>
					</a>
					<a href="#" class="btn btn-success btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-check"></i>
						</div>
						<div class="btn-label">
							Halaman Verifikasi
						</div>
					</a>
					<a href="#" class="btn btn-info btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-tasks"></i>
						</div>
						<div class="btn-label">
							Pengaturan Ketegori
						</div>
					</a>
					<a href="#" class="btn btn-info btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-tasks"></i>
						</div>
						<div class="btn-label">
							Pengaturan Pengguna 
						</div>
					</a>
					<a href="#" class="btn btn-danger btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-log-out"></i>
						</div>
						<div class="btn-label">
							Logout
						</div>
					</a>
					</div>
			</div>
		</div>
	</header>
	<content id="content content-halaman-verifikasi">
		<div class="container">
			<h4>Filter</h4>
			<div class="filter">
				<div class="filter-items">
					<h5>Jenis Laporan</h5>
					<select class="btn btn-default btn-cookie">
						<option>Web</option>
						<option>Facebook</option>
						<option>Twitter</option>
						<option>Android</option>
						<option>SMS</option>
						<option>Telephone</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card-view">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="card">
							<div class="card-image-wrapper">
								<div class="card-image">
									<img src="img/panel_image_landscape.jpg"/>
								</div>
							</div>
							<div class="card-info-wrapper">
								<div class="card-info">
									<h4>2869</h4>
									<ul class="list-group">
										<li class="list-group-item">
											<i class="glyphicon glyphicon-map-marker"></i>
											Bunaken
										</li>
										<li class="list-group-item">
											<i class="glyphicon glyphicon-time"></i>
											25-Dec-2016
										</li>
										<li class="list-group-item">
											<i class="glyphicon glyphicon-time"></i>
											<i class="glyphicon glyphicon-time"></i>
										</li>
									</ul>
								</div>
							</div>
							<div class="card-action-wrapper">
								<div class="card-action">
									<div class="btn-group btn-group-justified">
										<div class="btn-group">
											<button class="btn btn-default btn-lg approve">Approve</button>
										</div>
										<div class="btn-group">
											<button class="btn btn-default btn-lg hapus">Hapus</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</content>
	<div class="popup-wrapper">
		<div class="popup-container">
			<div class="popup">
				<div class="container-fliud">
					<div class="row">
						<div class="col-lg-5">
							<div class="popup-form-container">
								<form>
									<input type="hidden" name="idlaporan_masyarakat" id="idlaporan_masyarakat">
									<input type="hidden" id="lat" name="latitude">
									<input type="hidden" id="lng" name="longitude">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Nama Pelapor</label>
												<input class="form-control" type="text" name="nama-pelapor"/>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Email Pelapor</label>
												<input class="form-control" type="email" name="email-pelapor"/>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Alamat Pelapor</label>
												<input class="form-control" type="text" name="email-pelapor"/>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-group">
												<label>Nomor Hp Pelapor</label>
												<input class="form-control" type="number" name="email-pelapor"/>
											</div>
										</div>
									</div>
									<hr/>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Kategori</label>
												<input class="form-control" type="text" name="nama-pelapor"/>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Kecamatan</label>
												<input class="form-control" type="email" name="email-pelapor"/>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Kelurahan</label>
												<input class="form-control" type="email" name="email-pelapor"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label>Isi Laporan</label>
												<textarea class="form-control" style="resize: vertical; min-height: 100px"></textarea>
											</div>
											<button type="submit" class="btn btn-primary">Simpan</button>
											<button type="button" class="btn btn-default" id="tutup">Tutup</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-7">
							<div id="map" style="height: 100vh; width: 100%;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script type="text/javascript" src="dist/jquery/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="dist/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>


<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=true&libraries=places&key=AIzaSyBwTMhjPlZtwMX3mbZz1AjJrDJq-Uh-Wvw'></script>

<script src="http://laporan.manadokota.go.id/assets/js/gmaps.js"></script>
<script type="text/javascript" src="js/fungsi.js"></script>
<script type="text/javascript" src="js/halVer.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


</html>