<div class="col-md-12">

    <div class="publik">

        <form id="form" action="<?php echo base_url("index.php/publik/api_post_laporan/"); ?>" method="POST" enctype="multipart/form-data">
            <p><b>Nama Pelapor</b></p>
            <input type="text" name="nama_pelapor" required/><hr />
            <p><b>Alamat Pelapor</b></p>
            <input type="text" name="alamat_pelapor" required/><hr />
            <p><b>Nomor HP Pelapor</b></p>
            <input type="text" name="nomorhp_pelapor" required/><hr />
            <p><b>Email Pelapor</b></p>
            <input type="email" name="email_pelapor" required/><hr />
            <p><b>Kategori</b></p>
            <select name="idkategori_laporan">
                <option value="">Pilih Kategori</option>
                <?php
                foreach($kategori as $kat):
                    ?>
                    <option value="<?php echo $kat->idkategori_laporan; ?>"><?php echo $kat->nama_kategori; ?></option>
                <?php endforeach;?>
            </select><hr />
            <p><b>Kecamatan</b></p>
            <select id="kecamatan" name="idkecamatan">
                <option value="">Pilih Kecamatan</option>
                <?php
                foreach($records as $kec):
                    ?>
                    <option value="<?php echo $kec->idkecamatan; ?>"><?php echo $kec->nama_kecamatan; ?></option>
                <?php endforeach;?>
            </select><hr />
            <p><b>Kelurahan</b></p>
            <select id="kelurahan" name="idkelurahan">
                <option value="">Pilih Kelurahan</option>
            </select><hr />
            <p><b>Isi Laporan</b></p>
            <textarea name="isi_laporan" style="width: 100%" rows="5" required></textarea><hr />
            <p><b>Foto </b></p>
            <input type="file" name="file_attach" required/><hr />
            <button type="submit" class="btn">Kirim</button>
        </form>

    </div><hr />

</div>
<script>
    $("#kecamatan").on("change",function(){

        if($(this).val() !== "") {

            $.get(base_url("index.php/publik/api_ambil_kelurahan/" + $(this).val()),function(response){
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

    })
</script>