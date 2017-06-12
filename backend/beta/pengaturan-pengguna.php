<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="dist/bootstrap/css/bootstrap.min.css">
	<!-- Bootstrap Datepicker -->
	<link rel="stylesheet" type="text/css" href="dist/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
	<!-- FontAwesome -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"/>
	<!-- Sweet Allert -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
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
							<i class="glyphicon glyphicon-dashboard"></i>
						</div>
						<div class="btn-label">
							Dashboard List
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
			<h4>Pengaturan Pengguna</h4>
			<div class="filter">
				<div class="filter-items">
					<div class="row">
						<div class="col-lg-6">
							<button type="submit" class="btn btn-primary btn-cookie" data-toggle="modal" data-target="#myModal">
								<div class="btn-addon">
									<i class="glyphicon glyphicon-plus"></i>
								</div>
								<div class="btn-label">
									Tambah
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
					<div class="col-lg-8 col-lg-offset-2">
						<div class="card">
							<table class="table table-striped">
								<thead>
									<th>Nama Pengguna</th>
									<th>Posisi</th>
									<th>Jumlah Laporan</th>
									<th>Hapus</th>
								</thead>
								<tbody>
									<tr>
										<td>Lorem Ipsum</td>
										<td>Dolor Sit</td>
										<td>10</td>
										<td>
											<button href="#" class="btn btn-danger btn-cookie">
												<div class="btn-addon" style="padding: 5px 10px">
													<i class="glyphicon glyphicon-trash"></i>
												</div>
												<div class="btn-label" style="padding: 5px 10px">
													Hapus
												</div>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
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
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input class="form-control" type="text" name=""/>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Username</label>
							<input class="form-control" type="text" name=""/>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Password</label>
							<input class="form-control" type="password" name=""/>
						</div>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>Bagian</label>
							<select class="form-control">
								<option>Lorem</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Kecamatan</label>
							<select class="form-control">
								<option>Lorem</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Kelurahan</label>
							<select class="form-control">
								<option>Lorem</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Kategori yang dihandle</label>
							<select class="form-control">
								<option>Lorem</option>
							</select>
						</div>
					</div>
				</div>
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

<!-- jQuery -->
<script type="text/javascript" src="dist/jquery/js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="dist/bootstrap/js/bootstrap.min.js"></script>
<!-- Bootstrap Datepicker -->
<script type="text/javascript" src="dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- Sweet Allert -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- Main js -->
<script type="text/javascript" src="js/main.js"></script>

</html>