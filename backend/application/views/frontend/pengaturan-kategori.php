<!DOCTYPE html>
<html>
<head>
	<title>Pengaturan Kategori</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap/css/bootstrap.min.css");?>">
    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/css/bootstrap-datepicker.min.css");?>">
	<!-- FontAwesome -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"/>
	<!-- Bootstrap-Iconpicker -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css");?>"/>
	<!-- Sweet Allert -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- main.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/css/main.css");?>">

</head>
<body>
	<header id="header">
		<div class="site-info-container">
			<div class="container">
				<div class="site-info">
                    <h1>Pemerintah<img src="<?php echo base_url("assets/newdesign/img/logo_manado.png");?>">Kota Manado</h1>
				</div>
			</div>
		</div>
		<div class="nav-main-container">
            <?php $this->load->view("frontend/frames/navigasi"); ?>
		</div>
	</header>
	<content id="content content-halaman-verifikasi">
		<div class="container">
			<h4>Pengaturan Kategori</h4>
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
									<th>Icon</th>
									<th>Nama Kategori</th>
                                    <th>Waktu Estimasi</th>
									<th>User Terkait</th>
									<th>Jumlah Laporan</th>
									<th>Hapus</th>
								</thead>
								<tbody>
                                <?php foreach($kategori as $k):?>
									<tr>
										<td><i class="fa <?php echo $k->icon;?> fa-lg"></i></td>
										<td><?php echo $k->nama_kategori; ?></td>
                                        <td align="center"><?php echo ($k->eta_enabled == 1) ? "<b>Y</b>" : "<b>N</b>";?></td>
                                        <td></td>
										<td></td>
										<td>
											<button href="#" class="btn btn-danger btn-cookie hapus" data-id="<?php echo $k->idkategori_laporan; ?>" data-nama="<?php echo $k->nama_kategori; ?>">
												<div class="btn-addon" style="padding: 5px 10px">
													<i class="glyphicon glyphicon-trash"></i>
												</div>
												<div class="btn-label" style="padding: 5px 10px">
													Hapus
												</div>
											</button>
										</td>
									</tr>
                                <?php endforeach;?>
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
		<form action="<?php echo base_url("index.php/dashboard/api_post_kategori"); ?>" method="POST">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Kategori</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<label>Nama Kategori</label>
					<input class="form-control" type="text" name="nama_kategori" required/>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="eta_enabled"/> Centang bila waktu pengerjaan kategori dapat di estimasi.
					</label>
				</div>
				<!-- Example 3 -->
				<button class="btn btn-default" data-iconset="fontawesome" data-icon="fa-adjust" role="iconpicker"></button>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Buat</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</form>
		</div>

	  </div>
	</div>

    <?php $this->load->view("frontend/frames/alert"); ?>

</body>

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/jquery/js/jquery-3.1.1.min.js");?>"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap/js/bootstrap.min.js");?>"></script>
<!-- Bootstrap Datepicker -->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>
<!-- Bootstrap-Iconpicker Iconset for FontAwesome -->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.3.0.min.js");?>"></script>
<!-- Bootstrap-Iconpicker -->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js");?>"></script>
<!-- Sweet Allert -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- Main js -->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/main.js");?>"></script>
<!--Fungsi js-->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/fungsi.js");?>"></script>


<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/socket.io.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/clientsocket.js"); ?>"></script>
<script>
    $(document).ready(function(){
        $(".hapus").on("click",function(){
            id = $(this).data().id;
            nama = $(this).data().nama;
            swal({
                title: "Konfirmasi",
                type: "warning",
                text: "Apakah anda yakin ingin menghapus kategori " + nama + "?",
                showCancelButton: true
            },function(){
                window.location.href = base_url("index.php/dashboard/api_hapus_kategori/" + id);
            });
        })
    })
</script>

</html>