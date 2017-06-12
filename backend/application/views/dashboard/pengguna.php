<article>

    <div class="col-md-12">

        <div class="col-md-6">
            <h2>&raquo;&nbsp;Tambah Pengguna</h2><br />
            <form action="<?php echo base_url("index.php/dashboard/api_post_pengguna"); ?>" method="POST" id="form">


                <div class="col-md-6">
                    <p><b>Nama Lengkap</b></p>
                    <input type="text" name="nama_lengkap" required><hr />
                    <p><b>Username</b></p>
                    <input type="text" name="username" required><hr />
                    <p><b>Password</b></p>
                    <input type="password" name="password" required><hr />
                    <p><b>Bagian</b></p>
                    <select name="bagian" id="bagian" required>
                        <option value="">Pilih Bagian</option>
                        <option value="walikota">Walikota</option>
                        <option value="department">SKPD</option>
                        <option value="camat">Camat</option>
                        <option value="lurah">Lurah</option>
                        <option value="root">Root (Super User/Operator)</option>
                    </select><hr />
                </div>

                <div class="col-md-6">
                    <!-- Pilihan dinamis -->
                    <div id="idkecamatan">
                        <p><b>Kecamatan</b></p>
                        <select name="idkecamatan" disabled>
                            <option value="">Pilih Kecamatan</option>
                            <?php foreach($kecamatan as $k):?>
                                <option value="<?php echo $k->idkecamatan ?>"><?php echo $k->nama_kecamatan; ?></option>
                            <?php endforeach; ?>
                        </select><hr />
                    </div>
                    <div id="idkelurahan">
                        <p><b>Kelurahan</b></p>
                        <select name="idkelurahan" disabled>
                            <option value="">Pilih Kelurahan</option>
                        </select><hr />
                    </div>
                    <div id="idkategori_laporan">
                        <p><b>Kategori yang dihandle</b></p>
                        <select name="idkategori_laporan" disabled>
                            <option value="">Pilih Kategori</option>
                            <?php foreach($kategori as $k):?>
                            <option value="<?php echo $k->idkategori_laporan; ?>"><?php echo $k->nama_kategori;?></option>
                            <?php endforeach;?>
                        </select><hr />
                    </div>
                    <button type="submit" class="btn">Simpan</button>
                </div>

            </form>
        </div>

        <div class="col-md-6">
            <h2>&raquo;&nbsp;Daftar pengguna aktif</h2><br />
            <div class="conlap">
                <ul id="daftardata">
                    <?php foreach($pengguna as $p): ?>
                        <li>
                            <b><i class="fa fa-angle-right"></i>&nbsp;<?php echo $p->nama_lengkap; ?></b><br />
                            Posisi :
                            <?php
                            $bagian = $p->bagian;
                            if($bagian == "root")
                                echo "Administrator";
                            elseif($bagian == "camat")
                                echo "Camat kecamatan ".$p->nama_kecamatan;
                            elseif($bagian == "lurah")
                                echo "Lurah kelurahan ".$p->nama_kelurahan;
                            elseif($bagian == "department")
                                echo "SKPD pengurusan ".$p->nama_kategori;
                            else
                                echo $bagian;
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    </div>

</article>

<script>


    $(document).ready(function(){

        $("#bagian").on("change",function(){
            bagian = $(this).val();
            if(bagian != "root"){
                if(bagian != "walikota") {
                    if(bagian == "camat") {
                        $("#idkecamatan select").prop("disabled",false);
                        $("#idkelurahan select").prop("disabled",true);
                        $("#idkategori_laporan select").prop("disabled",true);
                    } else if(bagian == "lurah") {
                        $("#idkecamatan select").prop("disabled",false);
                        $("#idkelurahan select").prop("disabled",false);
                        $("#idkategori_laporan select").prop("disabled",true);
                    } else if(bagian == "department") {
                        $("#idkecamatan select").prop("disabled",true);
                        $("#idkelurahan select").prop("disabled",true);
                        $("#idkategori_laporan select").prop("disabled",false);
                    } else {
                        $("#idkecamatan select").prop("disabled",true);
                        $("#idkelurahan select").prop("disabled",true);
                        $("#idkategori_laporan select").prop("disabled",true);
                    }
                } else {
                    $("#idkecamatan select").prop("disabled",true);
                    $("#idkelurahan select").prop("disabled",true);
                    $("#idkategori_laporan select").prop("disabled",true);
                }
            } else {
                $("#idkecamatan select").prop("disabled",true);
                $("#idkelurahan select").prop("disabled",true);
                $("#idkategori_laporan select").prop("disabled",true);
            }

        });

        $("#idkecamatan select").on("change",function(){
            idkelurahan = $(this).val();
            if($("#bagian").val() == "lurah") {
                $.get(base_url("index.php/dashboard/api_ambil_kelurahan/"+idkelurahan),function(response){
                    $("#idkelurahan select").html("").append("<option value=''>Pilih Kelurahan</option>");
                    $.each(response.data,function(index,item){
                        $("#idkelurahan select").append("<option value='"+item.idkelurahan+"'>"+item.nama_kelurahan+"</option>");
                    });
                });
            }
        });

    });


</script>