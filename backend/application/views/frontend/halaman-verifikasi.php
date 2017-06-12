<!DOCTYPE html>
<html>
<head>
	<title>Halaman Verifikasi</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap/css/bootstrap.min.css");?>">
    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/css/bootstrap-datepicker.min.css");?>">
    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"/>
    <!-- main.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/css/main.css");?>">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

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
			<h4>Filter</h4>
			<div class="filter">
				<div class="filter-items">
					<h5>Jenis Laporan</h5>
                    <select class="btn btn-default btn-cookie" id="jenis_laporan">
                        <option value="web" <?php echo $menu["web"]; ?>>Web</option>
                        <option value="android" <?php echo $menu["android"]; ?>>Android</option>
                        <option value="facebook">Facebook</option>
                        <option value="twitter" <?php echo $menu["twitter"]; ?>>Twitter</option>
                        <option value="qlue" <?php echo $menu["qlue"]; ?>>Qlue</option>
                        <option value="sms" <?php echo $menu["sms"]; ?>>SMS</option>
                        <option value="telepon" <?php echo $menu["telepon"]; ?>>Telepon</option>
                    </select>
				</div>
                <div class="filter-items">
                    <button type="button" class="btn btn-primary btn-cookie" id="openForm">
                        <div class="btn-addon">
                            <i class="glyphicon glyphicon-plus"></i>
                        </div>
                        <div class="btn-label">
                            Input Form
                        </div>
                    </button>
                </div>
			</div>
		</div>
		<div class="card-view">
			<div class="container">
				<div class="row" id="laporan_verif_card">
                    <?php foreach($laporan as $l):?>
					<div class="col-lg-4">
						<div class="card">
							<div class="card-image-wrapper">
								<div class="card-image">
									<img src="<?php echo base_url("assets/uploads/laporan/".$l->file_attach);?>"/>
								</div>
							</div>
							<div class="card-info-wrapper">
								<div class="card-info">
									<h4><?php echo $l->nomor_laporan; ?></h4>
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
										</li>
									</ul>
								</div>
							</div>
							<div class="card-action-wrapper">
								<div class="card-action">
									<div class="btn-group btn-group-justified">
										<div class="btn-group">
											<button class="btn btn-default btn-lg approve" data-l='<?php echo htmlspecialchars(json_encode($l),ENT_QUOTES,"UTF-8"); ?>'>Approve</button>
										</div>
										<div class="btn-group">
											<button class="btn btn-default btn-lg hapus">Hapus</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <?php endforeach;?>
				</div>
			</div>
		</div>
	</content>
	<div class="popup-wrapper" id="approve_form">
        <div class="popup-container">
            <div class="popup">
                <div class="container-fliud">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="popup-form-container">
                                <form id="form" action="<?php echo base_url("index.php/dashboard/api_approve_laporan"); ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="jenis_laporan" value="web">
                                    <input type="hidden" name="idlaporan_masyarakat" id="idlaporan_masyarakat">
                                    <input type="hidden" id="lat" name="latitude" value="1.493416">
                                    <input type="hidden" id="lng" name="longitude" value="124.891966">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Pelapor</label>
                                                <input class="form-control" type="text" name="nama_pelapor" disabled/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email Pelapor</label>
                                                <input class="form-control" type="email" name="email_pelapor" disabled/>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Alamat Pelapor</label>
                                                <input class="form-control" type="text" name="alamat_pelapor" disabled/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <label>Nomor Hp Pelapor</label>
                                                <input class="form-control" type="text" name="nomorhp_pelapor" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select name="idkategori_laporan" class="form-control" disabled>
                                                    <option value="">Pilih Kategori</option>
                                                    <?php
                                                    foreach($kategori as $kat):
                                                        ?>
                                                        <option value="<?php echo $kat->idkategori_laporan; ?>"><?php echo $kat->nama_kategori; ?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <select name="idkecamatan" class="form-control idkecamatan" disabled>
                                                    <option value="">Pilih Kecamatan</option>
                                                    <?php
                                                    foreach($kecamatan as $kec):
                                                        ?>
                                                        <option value="<?php echo $kec->idkecamatan; ?>"><?php echo $kec->nama_kecamatan; ?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kelurahan</label>
                                                <input class="form-control" type="email" name="nama_kelurahan" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Isi Laporan</label>
                                                <textarea class="form-control" name="isi_laporan" style="resize: vertical; min-height: 100px" disabled></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-default tutup">Tutup</button>
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

    <?php $this->load->view("frontend/frames/input_form_popup"); ?>

    <?php $this->load->view("frontend/frames/alert"); ?>




</body>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/jquery/js/jquery-3.1.1.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap/js/bootstrap.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>

<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=true&libraries=places&key=AIzaSyBwTMhjPlZtwMX3mbZz1AjJrDJq-Uh-Wvw'></script>

<script src="<?php echo base_url("assets/newdesign/js/gmaps.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/fungsi.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/halVer.js");?>"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/socket.io.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/clientsocket.js"); ?>"></script>

<script>
    $(document).ready(function(){

        $("#laporan_verif_card").on("click",".approve",function(){


            $("body").addClass("popup-active");
            $("#approve_form").show();
            $("#input_form").hide();

            l = $(this).data().l;
            for(var prop in l){
                if(l.hasOwnProperty(prop)) {
                    $("#form input[type='text'][name='"+prop+"'],#form input[type='email'][name='"+prop+"'], #form input[type='hidden'][name='"+prop+"'], #form select[name='"+prop+"'], #form textarea[name='"+prop+"']").val(l[prop]);
                }
            }
            if(l.latitude != null && l.longitude != null) {
                init_map("#map",{lat: l.latitude,lng: l.longitude});
            } else {
                init_map("#map");
            }
        });

        $("#openForm").on("click",function(){
            $("body").addClass("popup-active");
            $("#approve_form").hide();
            $("#input_form").show();
            init_map("#map2");
        });

        $("#jenis_laporan").on("change",function(){
            hal = $(this).val();
            window.location.href = base_url("index.php/dashboard/halaman_verifikasi/" + hal);
        });

        $(".idkecamatan").on("change",function(){

            if($(this).val() !== "") {

                $.get(base_url("index.php/dashboard/api_ambil_kelurahan/" + $(this).val()),function(response){
                    if(response.status == "ok") {
                        kelurahan = $(".idkelurahan");
                        kelurahan.html("");
                        kelurahan.append("<option value='all'>Pilih Kelurahan</option>");
                        response.data.forEach(function(item){
                            kelurahan.append("<option value='"+item.idkelurahan+"'>"+item.nama_kelurahan+"</option>");
                        });
                    }
                });

            }

        });


    })
</script>


</html>