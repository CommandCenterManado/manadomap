<article>

    <div class="col-md-12">
        <div class="col-md-6">
            <h2>&raquo;&nbsp;Tambah Kategori Laporan</h2><br />
            <form action="<?php echo base_url("index.php/dashboard/api_post_kategori"); ?>" id="form" method="POST">
                <p><b>Nama Kategori</b></p>
                <input type="text" name="nama_kategori" required/><hr />
                <b>Apakah waktu pengerjaan bisa diestimasi?</b>
                <input type="checkbox" name="eta_enabled" style="width: inherit"/><hr />
                <button type="submit" class="btn">Simpan</button>
            </form>
        </div>

        <div class="col-md-6">
            <h2>&raquo;&nbsp;Daftar Kategori Aktif</h2>
            <div class="conlap">
                <ul id="daftardata">
                    <?php foreach ($kategori as $k): ?>
                        <li><i class="<?php echo $k->icon; ?> fa-fw"></i>&nbsp;<?php echo $k->nama_kategori; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>



</article>