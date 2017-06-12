

<article>
    <div class="container">
    <div class="col-md-12">
        <div class="filter">
            <h2 style="font-size: 18px;">Filter Laporan</h2><hr style="margin: 5px 0;" />
            <form action="<?php echo base_url("index.php/dashboard/index/filter/"); ?>" method="GET" id="form" class="filter">
                <b>Jenis Laporan</b>
                <select name="jenis_laporan">
                    <option value="all" <?php echo $js["all"]; ?>>Semua Jenis</option>
                    <option value="web" <?php echo $js["web"]; ?>>Web</option>
                    <option value="android" <?php echo $js["android"]; ?>>Android</option>
                    <option value="facebook" <?php echo $js["facebook"]; ?>>Facebook</option>
                    <option value="twitter" <?php echo $js["twitter"]; ?>>Twitter</option>
                    <option value="qlue" <?php echo $js["qlue"]; ?>>Qlue</option>
                </select>--
                <b>Status Laporan</b>
                <select name="status">
                    <option value="all" <?php echo $st["all"]; ?>>Semua Status</option>
                    <option value="dilapor" <?php echo $st["dilapor"]; ?>>Dilapor</option>
                    <option value="proses" <?php echo $st["proses"]; ?>>Dalam Proses</option>
                    <option value="selesai" <?php echo $st["selesai"]; ?>>Selesai</option>
                </select>--
                <b>Kategori/SKPD Laporan</b>
                <select name="idkategori_laporan">
                    <option value="all" <?php //echo $st["all"]; ?>>Semua Kategori</option>
                    <?php foreach($kategori as $k):?>
                        <option value="<?php echo $k->idkategori_laporan; ?>" <?php echo $ikt["id_".$k->idkategori_laporan]; ?>><?php echo $k->nama_kategori; ?></option>
                    <?php endforeach;?>
                </select><hr />
                <?php if($this->session->userdata("bagian") == "root"):?>
                    <b>Kecamatan</b>
                    <select name="idkecamatan" id="idkecamatan">
                        <option value="all" <?php echo $ikc["id_all"]; ?>>Semua Kecamatan</option>
                        <?php foreach($kecamatan as $l): ?>
                            <option value="<?php echo $l->idkecamatan; ?>" <?php echo $ikc["id_".$l->idkecamatan]; ?>><?php echo $l->nama_kecamatan; ?></option>
                        <?php endforeach; ?>
                    </select>--
                    <b>Kelurahan</b>
                    <select name="idkelurahan" id="idkelurahan">
                        <option value="all">Semua Kelurahan</option>
                    </select>--
                <?php endif; ?>
                <b>Waktu</b>
                <div class="input-daterange" id="filter_waktu" style="display: inline;">
                    <input value="<?php echo (isset($_GET["start"]))? $_GET["start"] : date("m/01/Y"); ?>" type="text" id="start" name="start" placeholder="Dari"><input value="<?php echo (isset($_GET["end"]))? $_GET["end"] : date("m/t/Y"); ?>" type="text" id="end" name="end" placeholder="Sampai">
                </div>--
                <button type="submit" class="btn"><i class="fa fa-filter fa-lg"></i>&nbsp;Filter</button><button type="reset" class="btn silver"><i class="fa fa-repeat fa-lg"></i>&nbsp;Reset</button><br /><br />
            </form>
        </div>
    </div>
    </div>

    <div class="col-md-12">
        <div class="">
            <?php foreach($records as $l): ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo base_url("assets/uploads/laporan/".$l->file_attach); ?>" style="width: 100%;height: 150px;object-fit: cover;"/>
                        <div class="caption">
                            <h3 data-toggle="tooltip" title="<?php echo strtoupper($l->status); ?>">
                                <?php echo $l->iconStatus; ?>&nbsp;<a href="<?php echo base_url("index.php/dashboard/urus/".$l->idlaporan_masyarakat); ?>">Nomor : <?php echo $l->nomor_laporan; ?></a>
                            </h3>
                            <ul class="list-group">
                                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="<?php echo $l->nama_kecamatan . " - " . $l->nama_kelurahan; ?>">
                                    <b><i class="fa fa-map-marker fa-lg fa-fw"></i>&nbsp;<?php echo character_limiter($l->nama_kecamatan . " - " . $l->nama_kelurahan,10); ?></b>
                                </li>
                                <li class="list-group-item">
                                    <b><i class="fa fa-clock-o fa-lg fa-fw"></i>&nbsp;<?php echo date("d-M-Y",strtotime($l->waktu_laporan)); ?></b>
                                </li>
                                <li class="list-group-item">
                                    <b data-toggle="tooltip" data-placement="bottom" title="<?php echo $l->nama_kategori; ?>"><i class="<?php echo $l->icon; ?> fa-fw"></i></b>
                                    <b data-toggle="tooltip" data-placement="bottom" title="Diposting dari <?php echo $l->jenis_laporan; ?>"><?php echo $l->iconJenis; ?></b>
                                </li>
                            </ul>
                            <p><a href="<?php echo base_url("index.php/dashboard/urus/".$l->idlaporan_masyarakat); ?>" class="btn"><i class="fa fa-edit fa-lg"></i>&nbsp;Urus</a></p>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>





</article>
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

        $(".input-daterange").datepicker({});

    });
</script>