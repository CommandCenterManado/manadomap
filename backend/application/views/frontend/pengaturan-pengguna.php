<!DOCTYPE html>
<html>
<head>
	<title>Pengaturan Pengguna</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap/css/bootstrap.min.css");?>">
    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/css/bootstrap-datepicker.min.css");?>">
	<!-- FontAwesome -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"/>
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
                                <?php foreach($pengguna as $p):?>
									<tr>
										<td><?php echo $p->nama_lengkap; ?></td>
										<td><?php
                                            $bagian = $p->bagian;
                                            if($bagian == "root")
                                                echo "Administrator";
                                            elseif($bagian == "camat")
                                                echo "Camat kecamatan ".$p->nama_kecamatan;
                                            elseif($bagian == "lurah")
                                                echo "Lurah kelurahan ".$p->nama_kelurahan;
                                            elseif($bagian == "department")
                                                echo "SKPD pengurusan ".$p->nama_kategori;
                                            elseif($bagian == "ccenter")
                                                echo "Command Center Operator";
                                            elseif($bagian == "walikota")
                                                echo "Walikota";
                                            else
                                                echo $bagian;
                                            ?>
                                        </td>
										<td></td>
										<td>
											<button href="#" class="btn btn-danger btn-cookie hapus" data-id="<?php echo $p->idpengguna; ?>" data-nama="<?php echo $p->nama_lengkap; ?>">
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
		<form action="<?php echo base_url("index.php/dashboard/api_post_pengguna"); ?>" method="POST">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Pengguna</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input class="form-control" type="text" name="nama_lengkap" required/>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Username</label>
							<input class="form-control" type="text" name="username" required/>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Password</label>
							<input class="form-control" type="password" name="password" required/>
						</div>
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>Bagian</label>
							<select class="form-control" id="bagian" name="bagian" required>
                                <option value="">Pilih Bagian</option>
                                <option value="walikota">Walikota</option>
                                <option value="department">SKPD</option>
                                <option value="camat">Camat</option>
                                <option value="lurah">Lurah</option>
                                <option value="ccenter">Command Center (Operator)</option>
                                <option value="root">Root (Super User)</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Kecamatan</label>
							<select class="form-control" name="idkecamatan" id="idkecamatan" disabled>
                                <option value="">Pilih Kecamatan</option>
                                <?php foreach($kecamatan as $k):?>
                                    <option value="<?php echo $k->idkecamatan ?>"><?php echo $k->nama_kecamatan; ?></option>
                                <?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Kelurahan</label>
							<select class="form-control" name="idkelurahan" id="idkelurahan" disabled>
                                <option value="">Pilih Kelurahan</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Kategori yang dihandle</label>
							<select class="form-control" name="idkategori_laporan" id="idkategori_laporan" disabled>
                                <option value="">Pilih Kategori</option>
                                <?php foreach($kategori as $k):?>
                                    <option value="<?php echo $k->idkategori_laporan; ?>"><?php echo $k->nama_kategori;?></option>
                                <?php endforeach;?>
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

    <?php $this->load->view("frontend/frames/alert"); ?>

</body>

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/jquery/js/jquery-3.1.1.min.js");?>"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap/js/bootstrap.min.js");?>"></script>
<!-- Bootstrap Datepicker -->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>
<!-- Sweet Allert -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/fungsi.js");?>"></script>
<!-- Main js -->
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/main.js");?>"></script>

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
                text: "Apakah anda yakin ingin menghapus pengguna dengan nama " + nama + " dari sistem?",
                showCancelButton: true
            },function(){
                window.location.href = base_url("index.php/dashboard/api_hapus_pengguna/"+id);
            });

        });

        $("#bagian").on("change",function(){
            bagian = $(this).val();
            if(bagian != "root"){
                if(bagian != "walikota") {
                    if(bagian == "camat") {
                        $("#idkecamatan").prop("disabled",false);
                        $("#idkelurahan").prop("disabled",true);
                        $("#idkategori_laporan").prop("disabled",true).val("");
                    } else if(bagian == "lurah") {
                        $("#idkecamatan").prop("disabled",false);
                        $("#idkelurahan").prop("disabled",false);
                        $("#idkategori_laporan").prop("disabled",true).val("");
                    } else if(bagian == "department") {
                        $("#idkecamatan").prop("disabled",true).val("");
                        $("#idkelurahan").prop("disabled",true).val("");
                        $("#idkategori_laporan").prop("disabled",false);
                    } else {
                        $("#idkecamatan").prop("disabled",true).val("");
                        $("#idkelurahan").prop("disabled",true).val("");
                        $("#idkategori_laporan").prop("disabled",true).val("");
                    }
                } else {
                    $("#idkecamatan").prop("disabled",true).val("");
                    $("#idkelurahan").prop("disabled",true).val("");
                    $("#idkategori_laporan").prop("disabled",true).val("");
                }
            } else {
                $("#idkecamatan").prop("disabled",true).val("");
                $("#idkelurahan").prop("disabled",true).val("");
                $("#idkategori_laporan").prop("disabled",true).val("");
            }

        });

        $("#idkecamatan").on("change",function(){
            idkelurahan = $(this).val();
            if($("#bagian").val() == "lurah") {
                $.get(base_url("index.php/dashboard/api_ambil_kelurahan/"+idkelurahan),function(response){
                    $("#idkelurahan").html("").append("<option value=''>Pilih Kelurahan</option>");
                    $.each(response.data,function(index,item){
                        $("#idkelurahan").append("<option value='"+item.idkelurahan+"'>"+item.nama_kelurahan+"</option>");
                    });
                });
            }
        });
    })
</script>

</html>