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
<body id="dashboard-map">
	<header id="header">
		<div class="site-info-container">
			<div class="container">
				<div class="site-info">
					<h1>Pemerintah<img src="img/logo_manado.png">Kota Manado</h1>
				</div>
			</div>
		</div>
		<div class="nav-main-container" id="nav-main-wrap">
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
			<div class="container">
				<div class="nav-main-button-wrapper">
					<button id="nav-main-button" class="nav-main-button"><i class="glyphicon glyphicon-chevron-down"></i> Menu</button>
				</div>
			</div>
		</div>
		<div class="filter-container" id="filter-wrap">
			<div class="container">
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
						<div class="row">
							<div class="col-lg-6">
								<input class="form-control form-cookie" type="text" name="start"/>
							</div>
							<div class="col-lg-6">
								<input class="form-control form-cookie" type="text" name="end"/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="nav-main-button-wrapper">
					<button id="filter-button" class="nav-main-button"><i class="glyphicon glyphicon-chevron-down"></i>  Filter</button>
				</div>
			</div>
		</div>
	</header>
	<content id="content content-maps" style="position: fixed; top: 70px; bottom: 0; left: 0; right:0; ">
		<div id="map" style="width: 100%; height: 100%; position: absolute; top: 0; bottom: 0; left: 0; right:0;"></div>
	</content>

<script type="text/javascript" src="dist/jquery/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="dist/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/map.js"></script>

<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=true&libraries=places&key=AIzaSyBwTMhjPlZtwMX3mbZz1AjJrDJq-Uh-Wvw'></script>

<script src="http://laporan.manadokota.go.id/assets/js/gmaps.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        map = new GMaps({
            el: "#map",
            lat: 1.5002396,
            lng: 124.8720195,
            zoom: 13,
            mapTypeControl: false,
            zoomControl: false
        });

    });
</script>

</body>
</html>