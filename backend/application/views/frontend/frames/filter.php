<form action="<?php echo base_url("index.php/dashboard/".$this->uri->segment(2)."/filter/"); ?>" method="GET" id="filter_form">
    <div class="filter">
        <?php if($this->uri->segment(2) != "dashboard_map"):?>
        <h3>Filter</h3>
        <?php endif;?>
        <div class="filter-items">
            <h5>Jenis Laporan</h5>
            <select class="btn btn-default btn-cookie" name="jenis_laporan">
                <option value="all" <?php echo $js["all"]; ?>>Semua Jenis</option>
                <option value="web" <?php echo $js["web"]; ?>>Web</option>
                <option value="android" <?php echo $js["android"]; ?>>Android</option>
                <option value="facebook" <?php echo $js["facebook"]; ?>>Facebook</option>
                <option value="twitter" <?php echo $js["twitter"]; ?>>Twitter</option>
                <option value="qlue" <?php echo $js["qlue"]; ?>>Qlue</option>
                <option value="sms" <?php echo $js["sms"]; ?>>SMS</option>
                <option value="telepon" <?php echo $js["telepon"]; ?>>Telepon</option>
            </select>
        </div>
        <div class="filter-items">
            <h5>Status Laporan</h5>
            <select class="btn btn-default btn-cookie" name="status">
                <option value="all" <?php echo $st["all"]; ?>>Semua Status</option>
                <option value="dilapor" <?php echo $st["dilapor"]; ?>>Dilapor</option>
                <option value="proses" <?php echo $st["proses"]; ?>>Dalam Proses</option>
                <option value="selesai" <?php echo $st["selesai"]; ?>>Selesai</option>
            </select>
        </div>
        <div class="filter-items">
            <h5>Kategori/SKPD Laporan</h5>
            <select class="btn btn-default btn-cookie" name="idkategori_laporan">
                <option value="all" <?php //echo $st["all"]; ?>>Semua Kategori</option>
                <?php foreach($kategori as $k):?>
                    <option value="<?php echo $k->idkategori_laporan; ?>" <?php echo $ikt["id_".$k->idkategori_laporan]; ?>><?php echo $k->nama_kategori; ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="filter-items">
            <h5>Kecamatan</h5>
            <select class="btn btn-default btn-cookie" name="idkecamatan" id="idkecamatan">
                <option value="all" <?php echo $ikc["id_all"]; ?>>Semua Kecamatan</option>
                <?php foreach($kecamatan as $l): ?>
                    <option value="<?php echo $l->idkecamatan; ?>" <?php echo $ikc["id_".$l->idkecamatan]; ?>><?php echo $l->nama_kecamatan; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filter-items">
            <h5>Kelurahan</h5>
            <select class="btn btn-default btn-cookie" id="idkelurahan" name="idkelurahan">
                <option value="all">Semua Kelurahan</option>
            </select>
        </div>
        <div class="filter-items">
            <h5>Waktu</h5>
            <div class="row input-daterange">
                <div class="col-lg-6">
                    <input value="<?php echo (isset($_GET["start"]))? $_GET["start"] : date("m/01/Y"); ?>" class="form-control form-cookie" type="text" name="start" id="start" placeholder="Dari tanggal"/>
                </div>
                <div class="col-lg-6">
                    <input value="<?php echo (isset($_GET["end"]))? $_GET["end"] : date("m/t/Y"); ?>" class="form-control form-cookie" type="text" name="end" id="end" placeholder="Sampai tanggal"/>
                </div>
            </div>
        </div>
        <div class="filter-items">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary btn-cookie">
                        <div class="btn-addon">
                            <i class="glyphicon glyphicon-filter"></i>
                        </div>
                        <div class="btn-label">
                            Filter
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>