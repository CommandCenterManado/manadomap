
<article>

    <div class="col-md-8" id="page_container">
        <div class="conlap">
            <?php foreach($laporan as $l): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="preview top">
                            <img src="<?php echo base_url("assets/uploads/laporan/".$l->file_attach); ?>" />
                        </div>
                        <div class="details bottom">
                            <h2><a href="<?php echo base_url("index.php/dashboard/urus/".$l->idlaporan_masyarakat); ?>"><?php echo $l->nomor_laporan; ?></a></h2><hr style="margin: 3px;"/>
                            <h5><?php echo $l->nama_kecamatan . "-" . $l->nama_kelurahan; ?></h5>
                            <h5><?php echo date("d-M-Y",strtotime($l->waktu_laporan)); ?></h5>
                            <p><b><i class="<?php echo $l->icon; ?>"></i>&nbsp;<?php echo $l->nama_kategori; ?></b></p><br />
                        </div>
                        <div class="opts">
                            <a data-l='<?php echo htmlspecialchars(json_encode($l),ENT_QUOTES,"UTF-8"); ?>' href="javascript:void(0);" class="btn green approve"><i class="fa fa-arrow-circle-o-right fa-lg"></i>&nbsp;Setuju</a><a href="javascript:void(0);" class="btn red hapus" data-id="<?php echo $l->idlaporan_masyarakat; ?>"><i class="fa fa-trash fa-lg"></i>&nbsp;Hapus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="col-md-4">

        <div class="conlap">

            <form id="form" action="<?php echo base_url("index.php/dashboard/api_approve_laporan"); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idlaporan_masyarakat"/>
                <p><b>Jenis Laporan</b></p>
                <select id="jenis_laporan" name="jenis_laporan" required>
                    <option value="web" selected>Web</option>
                    <option value="facebook">Facebook</option>
                    <option value="twitter">Twitter</option>
                    <option value="qlue">Qlue</option>
                    <option value="android">Android</option>
                </select><hr />
                <p><b>Nama Pelapor</b></p>
                <input type="text" name="nama_pelapor" disabled required/><hr />
                <p><b>Alamat Pelapor</b></p>
                <input type="text" name="alamat_pelapor" disabled required/><hr />
                <p><b>Nomor HP Pelapor</b></p>
                <input type="text" name="nomorhp_pelapor" disabled required/><hr />
                <p><b>Email Pelapor</b></p>
                <input type="email" name="email_pelapor" disabled required/><hr />
                <p><b>Kategori</b></p>
                <select name="idkategori_laporan" disabled>
                    <option value="">Pilih Kategori</option>
                    <?php
                    foreach($kategori as $kat):
                        ?>
                        <option value="<?php echo $kat->idkategori_laporan; ?>"><?php echo $kat->nama_kategori; ?></option>
                    <?php endforeach;?>
                </select><hr />
                <p><b>Kecamatan</b></p>
                <select id="kecamatan" name="idkecamatan" disabled>
                    <option value="">Pilih Kecamatan</option>
                    <?php
                    foreach($records as $kec):
                        ?>
                        <option value="<?php echo $kec->idkecamatan; ?>"><?php echo $kec->nama_kecamatan; ?></option>
                    <?php endforeach;?>
                </select><hr />
                <p><b>Kelurahan</b></p>
                <input type="text" name="nama_kelurahan" disabled/><hr />
                <p><b>Koordinat</b></p>
                <div id="latlngpicker" class="normal"></div><br />
                <input name="latitude" type="hidden" id="latitude"/><input name="longitude" type="hidden" id="longitude"/>
                <button type="button" class="btn" id="go_normal">Kembali ke form</button>
                <button id="go_fullscreen" type="button">Tampilan Penuh</button>
                <hr />
                <p><b>Isi Laporan</b></p>
                <textarea name="isi_laporan" style="width: 100%" rows="5" disabled required></textarea><hr />
                <button type="submit" class="btn">Simpan</button>
            </form>

        </div>

    </div>

</article>
<script>
    $(document).ready(function(){

        update_map(1.493416,124.891966);

        $(".approve").on("click",function(){
            l = $(this).data().l;
            for(var prop in l){
                if(l.hasOwnProperty(prop)) {
                    $("#form input[type='text'][name='"+prop+"'],#form input[type='email'][name='"+prop+"'], #form input[type='hidden'][name='"+prop+"'], #form select[name='"+prop+"'], #form textarea[name='"+prop+"']").val(l[prop]);
                }
            }
            update_map(l.latitude,l.longitude);
        });


        $("#go_fullscreen").on("click",function(){
            $("#latlngpicker").removeClass("normal").addClass("fullscreen").prop("style","");
            $("#go_normal").show();
        });
        $("#go_normal").on("click",function(){
            $("#latlngpicker").removeClass("fullscreen").addClass("normal").prop("style","width: 100%;height: 300px;overflow: hidden");
            $("#go_normal").hide();
        });

        $("#kecamatan").on("change",function(){

            if($(this).val() !== "") {

                $.get(base_url("index.php/dashboard/api_ambil_kelurahan/" + $(this).val()),function(response){
                    if(response.status == "ok") {
                        kelurahan = $("#kelurahan");
                        kelurahan.html("");
                        kelurahan.append("<option value=''>Pilih Kelurahan</option>");
                        response.data.forEach(function(item){
                            kelurahan.append("<option value='"+item.idkelurahan+"'>"+item.nama_kelurahan+"</option>");
                        });
                    }
                })

            }

        });

        $(".hapus").on("click",function(){
            id = $(this).data().id;
            swal({
                title: "Konfirmasi",
                text: "Apakah anda yakin akan menghapus item laporan ini?",
                type: "warning",
                showCancelButton: true
            },function(){
                window.location.href = base_url("index.php/dashboard/hapus_laporan_temp/"+id);
            });
        });

    });
</script>