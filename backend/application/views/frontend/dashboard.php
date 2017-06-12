<!DOCTYPE html>
<html>
<head>
	<title>Home Dashboard</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap/css/bootstrap.min.css");?>">
	<!-- Bootstrap Datepicker -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/css/bootstrap-datepicker.min.css");?>">
	<!-- main.css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/css/main.css");?>">

</head>
<body>
	<header id="header" style="padding-bottom: 15px">
		<div class="site-info-container">
			<div class="container">
				<div class="site-info">
					<h1>Pemerintah<img src="<?php echo base_url("assets/newdesign/img/logo_manado.png");?>">Kota Manado</h1>
				</div>
			</div>
		</div>
		<div class="nav-main-container">
			<div class="container-fluid">
<!--				<div class="nav-main">-->
<!--					<a href="dashboard.php" class="btn btn-success btn-cookie">-->
<!--						<div class="btn-addon">-->
<!--							<i class="glyphicon glyphicon-dashboard"></i>-->
<!--						</div>-->
<!--						<div class="btn-label">-->
<!--							Dashboard-->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="dashboard-card.php" class="btn btn-success btn-cookie">-->
<!--						<div class="btn-addon">-->
<!--							<i class="glyphicon glyphicon-dashboard"></i>-->
<!--						</div>-->
<!--						<div class="btn-label">-->
<!--							Dashboard Card-->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="dashboard-list.php" class="btn btn-success btn-cookie">-->
<!--						<div class="btn-addon">-->
<!--							<i class="glyphicon glyphicon-dashboard"></i>-->
<!--						</div>-->
<!--						<div class="btn-label">-->
<!--							Dashboard List-->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="dashboard-map.php" class="btn btn-success btn-cookie">-->
<!--						<div class="btn-addon">-->
<!--							<i class="glyphicon glyphicon-map-marker"></i>-->
<!--						</div>-->
<!--						<div class="btn-label">-->
<!--							Dashboard Map-->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="halaman-verifikasi.php" class="btn btn-success btn-cookie">-->
<!--						<div class="btn-addon">-->
<!--							<i class="glyphicon glyphicon-check"></i>-->
<!--						</div>-->
<!--						<div class="btn-label">-->
<!--							Halaman Verifikasi-->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="pengaturan-kategori.php" class="btn btn-info btn-cookie">-->
<!--						<div class="btn-addon">-->
<!--							<i class="glyphicon glyphicon-tasks"></i>-->
<!--						</div>-->
<!--						<div class="btn-label">-->
<!--							Pengaturan Ketegori-->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="pengaturan-pengguna.php" class="btn btn-info btn-cookie">-->
<!--						<div class="btn-addon">-->
<!--							<i class="glyphicon glyphicon-tasks"></i>-->
<!--						</div>-->
<!--						<div class="btn-label">-->
<!--							Pengaturan Pengguna -->
<!--						</div>-->
<!--					</a>-->
<!--					<a href="#" class="btn btn-danger btn-cookie">-->
<!--						<div class="btn-addon">-->
<!--							<i class="glyphicon glyphicon-log-out"></i>-->
<!--						</div>-->
<!--						<div class="btn-label">-->
<!--							Logout-->
<!--						</div>-->
<!--					</a>-->
<!--<!--				</div>-->
<!--			</div>-->
		</div>
	</header>
	<content id="content content-dashboard">
		<div class="container">
			<div class="row">
				<div class="col-lg-2">
					<div class="panel panel-primary">
						<div class="panel-heading text-right">
							<h1 style="margin: 0;"><?php echo $this->db->get("laporan_masyarakat")->num_rows(); ?></h1>
							<small><i class="glyphicon glyphicon-file"></i> Total Laporan</small>
						</div>
						<a href="<?php echo base_url("index.php/dashboard/dashboard_card"); ?>">
							<div class="panel-footer">
								<span>Lihat lebih detail</span>
								<div class="clear-fix">
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="panel panel-info">
						<div class="panel-heading text-right">
							<h1 style="margin: 0;"><?php echo $this->db->get("pengguna")->num_rows(); ?></h1>
							<small><i class="glyphicon glyphicon-file"></i> Pengguna terdaftar</small>
						</div>
						<a href="<?php echo base_url("index.php/dashboard/pengaturan_pengguna"); ?>">
							<div class="panel-footer">
								<span>Lihat lebih detail</span>
								<div class="clear-fix">
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="panel panel-info">
						<div class="panel-heading text-right">
							<h1 style="margin: 0;"><?php echo $this->db->get("kategori_laporan")->num_rows(); ?></h1>
							<small><i class="glyphicon glyphicon-file"></i> SKPD</small>
						</div>
						<a href="<?php echo base_url("index.php/dashboard/pengaturan_kategori"); ?>">
							<div class="panel-footer">
								<span>Lihat lebih detail</span>
								<div class="clear-fix">
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="panel panel-info">
						<div class="panel-heading text-right">
							<h1 style="margin: 0;"><?php echo $this->db->where("status","dilapor")->get("laporan_masyarakat")->num_rows(); ?></h1>
							<small><i class="glyphicon glyphicon-file"></i> Laporan belum direspon</small>
						</div>
						<a href="<?php echo base_url("index.php/dashboard/dashboard_card"); ?>">
							<div class="panel-footer">
								<span>Lihat lebih detail</span>
								<div class="clear-fix">
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="panel panel-info">
						<div class="panel-heading text-right">
							<h1 style="margin: 0;"><?php echo $this->db->where("status","proses")->get("laporan_masyarakat")->num_rows(); ?></h1>
							<small><i class="glyphicon glyphicon-file"></i> Laporan sedang diproses</small>
						</div>
						<a href="<?php echo base_url("index.php/dashboard/dashboard_card"); ?>">
							<div class="panel-footer">
								<span>Lihat lebih detail</span>
								<div class="clear-fix">
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="panel panel-info">
						<div class="panel-heading text-right">
							<h1 style="margin: 0;"><?php echo $this->db->where("status","selesai")->get("laporan_masyarakat")->num_rows(); ?></h1>
							<small><i class="glyphicon glyphicon-file"></i> Laporan selesai ditangani</small>
						</div>
						<a href="<?php echo base_url("index.php/dashboard/dashboard_card"); ?>">
							<div class="panel-footer">
								<span>Lihat lebih detail</span>
								<div class="clear-fix">
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8">
					<div id="placeholder" style="width: 100%; height: 300px;">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<span><i class="glyphicon glyphicon-bell"></i> Update Terbaru</span>
						</div>
						<ul class="list-group">
							<li class="list-group-item">Jalan rusak di perairan Lorem</li>
							<li class="list-group-item">Jalan rusak di perairan Lorem</li>
							<li class="list-group-item">Jalan rusak di perairan Lorem</li>
						</ul>
					</div>
                    <a href="<?php echo base_url("index.php/dashboard/dashboard_card"); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-log-in"></i>&nbsp;Tampilan penuh</a>
				</div>
			</div>
		</div>
	</content>
</body>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/jquery/js/jquery-3.1.1.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/flot/excanvas.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/flot/jquery.flot.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap/js/bootstrap.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/main.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/socket.io.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/clientsocket.js"); ?>"></script>

<script type="text/javascript">
$(document).ready(function(){
	$.plot($("#placeholder"), 
		[ 
			[[0, 0],[0.5, 0.5], [1, 1.5], [2, 1]], 
			[[0, 0],[0.5, 1], [1, 1], [2, 3]] 
		], {
		});
});
</script>

</html>