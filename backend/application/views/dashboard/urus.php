
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="window.history.back()" class="btn">Kembali</a>
<article>
    <nav></nav>

    <div class="tilt col-md-12">
        <div class="handle-form">
            <h1><a href="<?php echo base_url("index.php/dashboard/urus/".$record->idlaporan_masyarakat); ?>">Nomor Laporan : <?php echo $record->nomor_laporan; ?></a></h1>
            <h3><i>Dikonfirmasi oleh <?php echo $record->pengguna_approve->nama_lengkap; ?> pada <?php echo date("d-M-Y h:i",strtotime($record->waktu_laporan)); ?></i></h3><hr />
            <h3>Nama Pelapor : <?php echo $record->nama_pelapor; ?></h3>
            <h3>Alamat Pelapor : <?php echo $record->alamat_pelapor; ?></h3>
            <h3>Nomor HP Pelapor : <?php echo $record->nomorhp_pelapor; ?></h3>
            <h3>Email Pelapor : <?php echo $record->email_pelapor; ?></h3>
            <h3>Status Laporan : <?php echo $record->status; ?></h3>
            <h3>Isi Laporan </h3><hr />
            <p><?php echo $record->isi_laporan; ?></p><hr />


            <?php if($record->status == "proses" || $record->status == "selesai"): ?>
            <div class="proses">
                <h3>Ditangani oleh <?php echo $record->pengguna_handle->nama_lengkap; ?></h3>
                <h3>Proses kerja</h3>
                <div class="col-md-6" style="padding-left: 0">
                    <img src="<?php echo base_url("assets/uploads/respon/".$record->file_respon_proses); ?>"/><br /><br />
                    <a target="_blank" href="<?php echo base_url("assets/uploads/respon/".$record->file_respon_proses); ?>" class="btn">Lihat Tampilan Penuh</a>
                </div>
                <div class="col-md-6">
                    <p><?php echo $record->tindakan_proses; ?></p>
                </div>
            </div><hr />
            <?php endif;?>

            <?php if($record->status == "selesai"): ?>
                <div class="proses">
                    <h3>Ditangani oleh <?php echo $record->pengguna_handle->nama_lengkap; ?></h3>
                    <h3>Penyelesaian</h3>
                    <div class="col-md-6" style="padding-left: 0">
                        <img src="<?php echo base_url("assets/uploads/respon/".$record->file_respon_selesai); ?>"/><br /><br />
                        <a target="_blank" href="<?php echo base_url("assets/uploads/respon/".$record->file_respon_selesai); ?>" class="btn">Lihat Tampilan Penuh</a>
                    </div>
                    <div class="col-md-6">
                        <p><?php echo $record->tindakan_selesai; ?></p>
                    </div>
                </div><hr />
            <?php endif;?>



            <?php if($record->status !== "selesai"):?>
            <form action="<?php echo base_url("index.php/dashboard/api_urus_laporan"); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idlaporan_masyarakat" value="<?php echo $record->idlaporan_masyarakat; ?>"/>
                <p><b>Status Laporan</b></p>
                <select name="status" value="<?php echo $record->status; ?>" required>
                    <option value="">Pilih Status</option>
                    <?php if($record->status != "proses"): ?>
                    <option value="proses">Proses</option>
                    <?php endif;?>
                    <option value="selesai">Selesai</option>
                </select><br /><br />
                <p><b>File Attach</b></p>
                <input type="file" name="file_attach"/><br /><br />
                <p><b>Detail</b></p>
                <textarea name="tindakan" cols="100" rows="6" required></textarea>
                <button type="submit" class="btn">Update</button>
            </form>
            <?php else:?>
            <a href="#" onclick="window.print();" class="btn green"><i class="fa fa-print fa-lg"></i>&nbsp;Cetak Laporan</a>
            <?php endif;?>


        </div>
        <div class="preview">
            <img src="<?php echo base_url("assets/uploads/laporan/".$record->file_attach); ?>" alt=""/><br /><br />
            <a target="_blank" href="<?php echo base_url("assets/uploads/laporan/".$record->file_attach); ?>" class="btn">Lihat Tampilan Penuh</a><hr />
        </div>
    </div>

</article>