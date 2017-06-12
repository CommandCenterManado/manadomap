
<article>

    <div class="col-md-8" id="page_container">
        <div class="conlap">

        </div>
    </div>
    <div class="col-md-4">

        <div class="conlap">

            <form id="form" action="<?php echo base_url("index.php/dashboard/api_approve_laporan"); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="fromBack"/>
                <p><b>Jenis Laporan</b></p>
                <select id="jenis_laporan" name="jenis_laporan" required>
                    <option value="web">Web</option>
                    <option value="facebook">Facebook</option>
                    <option value="twitter">Twitter</option>
                    <option value="qlue" selected>Qlue</option>
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

    });
</script>