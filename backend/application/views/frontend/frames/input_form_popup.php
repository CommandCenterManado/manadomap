
<div class="popup-wrapper" id="input_form">
    <div class="popup-container">
        <div class="popup">
            <div class="container-fliud">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="popup-form-container">
                            <form action="<?php echo base_url("index.php/dashboard/api_post_laporan/web"); ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="fromBack">
                                <input type="hidden" class="lat" name="latitude" value="1.493416">
                                <input type="hidden" class="lng" name="longitude" value="124.891966">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Pelapor</label>
                                            <input class="form-control" type="text" name="nama_pelapor" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Email Pelapor</label>
                                            <input class="form-control" type="email" name="email_pelapor" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Alamat Pelapor</label>
                                            <input class="form-control" type="text" name="alamat_pelapor" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <label>Nomor Hp Pelapor</label>
                                            <input class="form-control" type="text" name="nomorhp_pelapor" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <label>File Attach</label>
                                            <input type="file" name="file_attach" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="idkategori_laporan" class="form-control" required>
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
                                            <select name="idkecamatan" class="form-control idkecamatan" required>
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
                                            <select name="idkelurahan" class="form-control idkelurahan" required>
                                                <option value="">Pilih Kelurahan</option>
                                                <?php
                                                foreach($kelurahan as $kel):
                                                    ?>
                                                    <option value="<?php echo $kel->idkelurahan; ?>"><?php echo $kel->nama_kelurahan; ?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Jenis Laporan</label>
                                            <select name="jenis_laporan" class="form-control" required>
                                                <option value="">Pilih Jenis Laporan</option>
                                                <option value="web">Web</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="twitter">Twitter</option>
                                                <option value="android">QuickManado (Android)</option>
                                                <option value="qlue">Qlue</option>
                                                <option value="sms">SMS</option>
                                                <option value="telepon">Telepon</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Isi Laporan</label>
                                            <textarea class="form-control" name="isi_laporan" style="resize: vertical; min-height: 100px" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-default tutup">Tutup</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div id="map2" style="height: 100vh; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>