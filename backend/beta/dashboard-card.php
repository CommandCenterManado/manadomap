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
			<div class="container-fluid">
				<div class="nav-main">
					<a href="dashboard-card.php" class="btn btn-success btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-dashboard"></i>
						</div>
						<div class="btn-label">
							Dashboard Card
						</div>
					</a>
					<a href="dashboard-list.php" class="btn btn-success btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-dashboard"></i>
						</div>
						<div class="btn-label">
							Dashboard List
						</div>
					</a>
					<a href="dashboard-map.php" class="btn btn-success btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-map-marker"></i>
						</div>
						<div class="btn-label">
							Dashboard Map
						</div>
					</a>
					<a href="halaman-verifikasi.php" class="btn btn-success btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-check"></i>
						</div>
						<div class="btn-label">
							Halaman Verifikasi
						</div>
					</a>
					<a href="pengaturan-kategori.php" class="btn btn-info btn-cookie">
						<div class="btn-addon">
							<i class="glyphicon glyphicon-tasks"></i>
						</div>
						<div class="btn-label">
							Pengaturan Ketegori
						</div>
					</a>
					<a href="pengaturan-pengguna.php" class="btn btn-info btn-cookie">
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
	<content id="content content-dashboard">
		<div class="container">
			<h4>Filter</h4>
			<div class="filter">
				<div class="filter-items">
					<h5>Jenis Laporan</h5>
					<select class="btn btn-default btn-cookie">
						<option>Semua Jenis</option>
					</select>
				</div>
				<div class="filter-items">
					<h5>Jenis Laporan</h5>
					<select class="btn btn-default btn-cookie">
						<option>Semua Status</option>
					</select>
				</div>
				<div class="filter-items">
					<h5>Jenis Laporan</h5>
					<select class="btn btn-default btn-cookie">
						<option>Semua Kategori</option>
					</select>
				</div>
				<div class="filter-items">
					<h5>Jenis Laporan</h5>
					<select class="btn btn-default btn-cookie">
						<option>Semua Kecamatan</option>
					</select>
				</div>
				<div class="filter-items">
					<h5>Jenis Laporan</h5>
					<select class="btn btn-default btn-cookie">
						<option>Semua Kelurahan</option>
					</select>
				</div>
				<div class="filter-items">
					<h5>Jenis Laporan</h5>
					<select class="btn btn-default btn-cookie">
						<option>Semua Kelurahan</option>
					</select>
				</div>
				<div class="filter-items">
					<h5>Jenis Laporan</h5>
					<div class="row input-daterange">
						<div class="col-lg-6">
							<input class="form-control form-cookie" type="text" name="start" id="start"/>
						</div>
						<div class="col-lg-6">
							<input class="form-control form-cookie" type="text" name="end" id="end"/>
						</div>
					</div>
				</div>
				<div class="filter-items">
					<div class="row">
						<div class="col-lg-6">
							<button type="submit" class="btn btn-primary btn-cookie">
								<div class="btn-addon">
									<i class="glyphicon glyphicon-filter"></i>
								</div>
								<div class="btn-label">
									Filter
								</div>
							</button>
						</div>
					</div>
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
									<button class="btn btn-default card-action-button" data-toggle="modal" data-target="#myModal">Tangani</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</content>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		<form>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Kategori</h4>
			</div>
			<div class="modal-body">
				<table class="table table-default table-default-information">
					<tbody>
						<tr>
							<td>Nama Pelapor:</td>
							<td>Bobby Najoan</td>
						</tr>
						<tr>
							<td>No. Telp. Pelapor:</td>
							<td>0823487583</td>
						</tr>
						<tr>
							<td>Email Pelapor:</td>
							<td>bobby@tagconn.com</td>
						</tr>
						<tr>
							<td>Alamat Pelapor:</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua.</td>
						</tr>
						<tr>
							<td>Status Laporan</td>
							<td>Dilapor</td>
						</tr>
						<tr>
							<td>Isi Laporan:</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
						</tr>
					</tbody>
				</table>
				<hr/>
				<table class="table table-default table-default-information">
					<tbody>
						<tr>
							<td>Status Laporan</td>
							<td>
								<div class="form-group">
									<select class="form-control">
										<option>Dilapor</option>
										<option>Dalam Proses</option>
										<option>Selesai</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td>Isi Laporan:</td>
							<td>
								<div class="form-group">
									<textarea class="form-control">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
								</div>
							</td>
						</tr>
						<tr>
							<td>Gambar :</td>
							<td>
								<div class="form-group">
									<input type="file" name="">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Buat</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</form>
		</div>

	  </div>
	</div>
</body>

<script type="text/javascript" src="dist/jquery/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="dist/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</html>