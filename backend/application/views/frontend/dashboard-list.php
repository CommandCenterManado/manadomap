<!DOCTYPE html>
<html>
<head>
    
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

	<title>Dashboard List</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap/css/bootstrap.min.css");?>">
    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/css/bootstrap-datepicker.min.css");?>">

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
	<content id="content content-dashboard">
		<div class="container">
<!--            Filter-->
            <?php $this->load->view("frontend/frames/filter");?>
		</div>
		<div class="card-view">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 col-lg-offset-1">
						<div class="card">
							<table class="table table-bordered" style="text-align: center;">
								<thead>
									<tr>
										<th rowspan="2">Nomor Laporan</th>
										<th rowspan="2">Waktu</th>
										<th rowspan="2">Ringkasan</th>
										<th colspan="3">Status</th>
									</tr>
									<tr>
										<th>Dilapor</th>
										<th>Proses</th>
										<th>Selesai</th>
									</tr>
								</thead>
								<tbody>
                                <?php foreach($records as $l): ?>
									<tr>
										<td><?php echo $l->nomor_laporan; ?></td>
										<td><?php echo date("d/M-Y",strtotime($l->waktu_laporan)); ?></td>
                                        <td><?php echo character_limiter($l->isi_laporan,20); ?></td>
										<td><?php echo ($l->status == "dilapor") ? "<i class='glyphicon glyphicon-ok'></i>" : "";?></td>
										<td><?php echo ($l->status == "proses") ? "<i class='glyphicon glyphicon-ok'></i>" : "";?></td>
										<td><?php echo ($l->status == "selesai") ? "<i class='glyphicon glyphicon-ok'></i>" : "";?></td>
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

    <?php $this->load->view("frontend/frames/alert"); ?>

</body>

<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/jquery/js/jquery-3.1.1.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap/js/bootstrap.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/main.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/newdesign/js/fungsi.js");?>"></script>

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
    })
</script>

</html>