<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Card</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap/css/bootstrap.min.css");?>">
	<!-- Bootstrap Datepicker -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/css/bootstrap-datepicker.min.css");?>">
    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"/>
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
            <?php $this->load->view("frontend/frames/navigasi");?>
		</div>
	</header>
	<content id="content content-dashboard">
		<div class="container">
<!--			Filter -->
            <?php $this->load->view("frontend/frames/filter"); ?>
		</div>
		<div class="card-view">
			<div class="container">
				<div class="row" id="laporan_card_wrap">
                    <?php foreach($records as $l):?>
					<div class="col-lg-4">
						<div class="card">
							<div class="card-image-wrapper">
								<div class="card-image">
									<img src="<?php echo base_url("assets/uploads/laporan/").$l->file_attach;?>"/>
								</div>
							</div>
							<div class="card-info-wrapper">
								<div class="card-info">
									<h4><a href="#"><?php echo $l->iconStatus . "&nbsp;" . $l->nomor_laporan; ?></a></h4>
									<ul class="list-group">
										<li class="list-group-item">
											<i class="glyphicon glyphicon-map-marker"></i>
											<?php echo $l->nama_kecamatan . " - " . $l->nama_kelurahan; ?>
										</li>
										<li class="list-group-item">
											<i class="glyphicon glyphicon-time"></i>
											<?php echo date("d/M-Y",strtotime($l->waktu_laporan)); ?>
										</li>
										<li class="list-group-item">
                                            <i class="<?php echo $l->icon; ?>"></i>
                                            <?php echo $l->iconJenis;?>
										</li>
									</ul>
								</div>
							</div>
							<div class="card-action-wrapper">
								<div class="card-action">
                                    <button class="btn btn-default card-action-button tangani" data-l='<?php echo htmlspecialchars(json_encode($l),ENT_QUOTES,"UTF-8"); ?>'>Tangani</button>
								</div>
							</div>
						</div>
					</div>
                    <?php endforeach;?>
				</div>
			</div>
		</div>
	</content>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form action="<?php echo base_url("index.php/dashboard/api_urus_laporan/dashboard_card"); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Penanganan Laporan</h4>
                    </div>
                    <div class="modal-body" id="table-info">
                        <input type="hidden" name="idlaporan_masyarakat" id="idlaporan_masyarakat">
                        <table class="table table-default table-default-information">
                            <tbody>
                            <tr>
                                <td>Nama Pelapor:</td>
                                <td id="nama_pelapor"></td>
                            </tr>
                            <tr>
                                <td>No. Telp. Pelapor:</td>
                                <td id="nomorhp_pelapor"></td>
                            </tr>
                            <tr>
                                <td>Email Pelapor:</td>
                                <td id="email_pelapor"></td>
                            </tr>
                            <tr>
                                <td>Alamat Pelapor:</td>
                                <td id="alamat_pelapor"></td>
                            </tr>
                            <tr>
                                <td>Status Laporan</td>
                                <td id="statusText"></td>
                            </tr>
                            <tr>
                                <td>Isi Laporan:</td>
                                <td id="isi_laporan"></td>
                            </tbody>
                        </table>
                        <div id="detil-proses" class="well">
                            <table class="table table-default table-default-information">
                                <tr>
                                    <td>Ditindak oleh</td>
                                    <td class="pengguna_handle"></td>
                                </tr>
                                <tr>
                                    <td>Foto</td>
                                    <td id="file_respon_proses_wr"><img src="" width="100%"/></td>
                                </tr>
                                <tr>
                                    <td>Detail Proses</td>
                                    <td id="tindakan_proses"></td>
                                </tr>
                            </table>
                        </div>
                        <div id="detil-selesai" class="well">
                            <table class="table table-default table-default-information">
                                <tr>
                                    <td>Ditindak oleh</td>
                                    <td class="pengguna_handle"></td>
                                </tr>
                                <tr>
                                    <td>Foto</td>
                                    <td id="file_respon_selesai_wr"><img src="" width="100%"/></td>
                                </tr>
                                <tr>
                                    <td>Detail Selesai</td>
                                    <td id="tindakan_selesai"></td>
                                </tr>
                            </table>
                        </div>
                        <hr/>
                        <div id="tindakan_wr">
                            <h4>Isi tindakan</h4>
                            <table class="table table-default table-default-information">
                                <tbody>
                                <tr>
                                    <td>Status Laporan</td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="proses">Dalam Proses</option>
                                                <option value="selesai">Selesai</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Isi Laporan:</td>
                                    <td>
                                        <div class="form-group">
                                            <textarea class="form-control" name="tindakan" required></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gambar :</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="file" name="file_attach" required>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="buat">Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <?php $this->load->view("frontend/frames/alert"); ?>

</body>
<script src="<?php echo base_url("assets/newdesign/js/fungsi.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/jquery/js/jquery-3.1.1.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap/js/bootstrap.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/main.js");?>"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/socket.io.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/clientsocket.js"); ?>"></script>

<script>
    $(document).ready(function(){

        $("#idkecamatan").on("change",function(){

            if($(this).val() !== "") {

                $.get(base_url("index.php/dashboard/api_ambil_kelurahan/" + $(this).val()),function(response){
                    if(response.status == "ok") {
                        kelurahan = $("#idkelurahan");
                        kelurahan.html("");
                        kelurahan.append("<option value='all'>Semua Kelurahan</option>");
                        response.data.forEach(function(item){
                            kelurahan.append("<option value='"+item.idkelurahan+"'>"+item.nama_kelurahan+"</option>");
                        });
                    }
                })

            }

        });

        $("#laporan_card_wrap").on("click",".tangani",function(){
            l = $(this).data().l;
            config_popup(l);
        });

    })
</script>

</html>