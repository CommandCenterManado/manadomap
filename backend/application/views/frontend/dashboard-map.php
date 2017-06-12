<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

	<title>Dashboard Map</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap/css/bootstrap.min.css");?>">
	<!-- Bootstrap Datepicker -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/css/bootstrap-datepicker.min.css");?>">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- main.css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/css/main.css");?>">

</head>
<body id="dashboard-map">
	<header id="header">
		<div class="site-info-container">
			<div class="container">
				<div class="site-info">
					<h1>Pemerintah<img src="<?php echo base_url("assets/newdesign/img/logo_manado.png");?>">Kota Manado</h1>
				</div>
			</div>
		</div>
		<div class="nav-main-container" id="nav-main-wrap">
            <?php $this->load->view("frontend/frames/navigasi"); ?>
			<div class="container">
				<div class="nav-main-button-wrapper">
					<button id="nav-main-button" class="nav-main-button"><i class="glyphicon glyphicon-chevron-down"></i> Menu</button>
				</div>
			</div>
		</div>
		<div class="filter-container" id="filter-wrap">
			<div class="container">
                <?php $this->load->view("frontend/frames/filter");?>
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



    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form action="<?php echo base_url("index.php/dashboard/api_urus_laporan/dashboard_map"); ?>" method="POST" enctype="multipart/form-data">
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

<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/jquery/js/jquery-3.1.1.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap/js/bootstrap.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/map.js");?>"></script>

<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/main.js");?>"></script>

<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=true&libraries=places&key=AIzaSyBwTMhjPlZtwMX3mbZz1AjJrDJq-Uh-Wvw'></script>

<script src="<?php echo base_url("assets/newdesign/js/gmaps.js");?>"></script>
<script src="<?php echo base_url("assets/newdesign/js/fungsi.js");?>"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/socket.io.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/clientsocket.js"); ?>"></script>

<script type="text/javascript">
</script>

</body>
</html>