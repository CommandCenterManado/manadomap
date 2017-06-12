<div class="container-fluid">
    <div class="nav-main">
        <a href="<?php echo base_url("index.php/dashboard/"); ?>" class="btn btn-success btn-cookie">
            <div class="btn-addon">
                <i class="glyphicon glyphicon-home"></i>
            </div>
            <div class="btn-label">
                Home
            </div>
        </a>
        <a href="<?php echo base_url("index.php/dashboard/dashboard_card"); ?>" class="btn btn-success btn-cookie">
            <div class="btn-addon">
                <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <div class="btn-label">
                Dashboard Card
            </div>
        </a>
        <a href="<?php echo base_url("index.php/dashboard/dashboard_list"); ?>" class="btn btn-success btn-cookie">
            <div class="btn-addon">
                <i class="glyphicon glyphicon-dashboard"></i>
            </div>
            <div class="btn-label">
                Dashboard List
            </div>
        </a>
        <a href="<?php echo base_url("index.php/dashboard/dashboard_map"); ?>" class="btn btn-success btn-cookie">
            <div class="btn-addon">
                <i class="glyphicon glyphicon-map-marker"></i>
            </div>
            <div class="btn-label">
                Dashboard Map
            </div>
        </a>
        <?php if($this->session->userdata("bagian") == "ccenter" || $this->session->userdata("bagian") == "root" || $this->session->userdata("bagian") == "walikota"):?>
            <a href="<?php echo base_url("index.php/dashboard/halaman_verifikasi"); ?>" class="btn btn-success btn-cookie">
                <div class="btn-addon">
                    <i class="glyphicon glyphicon-check"></i>
                </div>
                <div class="btn-label">
                    Halaman Verifikasi
                </div>
            </a>
        <?php endif;?>
        <?php if($this->session->userdata("bagian") == "root" || $this->session->userdata("bagian") == "walikota"):?>
            <a href="<?php echo base_url("index.php/dashboard/pengaturan_kategori"); ?>" class="btn btn-info btn-cookie">
                <div class="btn-addon">
                    <i class="glyphicon glyphicon-tasks"></i>
                </div>
                <div class="btn-label">
                    Pengaturan Kategori
                </div>
            </a>
            <a href="<?php echo base_url("index.php/dashboard/pengaturan_pengguna"); ?>" class="btn btn-info btn-cookie">
                <div class="btn-addon">
                    <i class="glyphicon glyphicon-tasks"></i>
                </div>
                <div class="btn-label">
                    Pengaturan Pengguna
                </div>
            </a>
        <?php endif;?>
        <a href="javascript:logout()" class="btn btn-danger btn-cookie">
            <div class="btn-addon">
                <i class="glyphicon glyphicon-log-out"></i>
            </div>
            <div class="btn-label">

            </div>
        </a>
    </div>
</div>