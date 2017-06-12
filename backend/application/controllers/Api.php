<?php

class Api extends CI_Controller
{

    const ERROR_CODE = 0;
    const SUCCESS_CODE = 1;
    const GAMBAR_LAPORAN_DIR = "assets/uploads/laporan/";
    const GAMBAR_RESPON_DIR = "assets/uploads/respon/";

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/Kuala_Lumpur");

        $this->load->model("Kategori_model", "kategori");
        $this->load->model("Laporan_model", "laporan");
        $this->load->model("Lokasi_model", "lokasi");
        $this->load->model("Pengguna_model", "pengguna");
        $this->load->library("Pip");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Content-Type: application/json;charset=utf-8");
        header("Access-Control-Allow-Origin: *");
        $method = $_SERVER["REQUEST_METHOD"];

        if(!isset($_SESSION["sess_publik"])) {
            $_SESSION["sess_publik"] = [];
        }

        if($this->session->userdata("idpengguna") == NULL && $this->uri->segment(2) != "cek_user_login" && $this->uri->segment(2) != "login") {
//            echo json_encode(array("status"=>"Akses tidak diizinkan! Session tidak ditemukan pada sistem"));
//            exit();
        }

        if ($method == "OPTIONS") {
            die();
        }
    }

    // User
    public function login() {
        $post = json_decode(file_get_contents("php://input"));

        $user = $this->pengguna->ambil_data($post->username,$post->password);

        if($user) {
            $this->session->set_userdata($user);
            $userdata = $this->session->userdata();
            echo json_encode(array("status"=>"ok","msg"=>"Login berhasil!","userdata"=>$userdata));
        } else {
            echo json_encode(array("status"=>"gagal","msg"=>"Login gagal!"));
        }
    }

    public function cek_user_login() {
        $st = ($this->session->userdata("idpengguna") == NULL) ? 0 : 1;
        $return = array(
            "status" => $st,
            "userdata" => $this->session->userdata()
        );
        echo json_encode($return);
    }

    public function logout() {
        $userdata = $this->session->userdata();
        $this->session->sess_destroy();
        echo json_encode(array("status"=>"ok","msg"=>"Berhasil logout!","userdata"=>$userdata));
    }

    // Laporan
    public function ambil_laporan($model = false)
    {
        $where = $this->input->get();

        if(!isset($where["limit"]))
            $where["limit"] = 30;

        foreach($where as $key=>$value) {
            $where["laporan_masyarakat.".$key] = $where[$key];
            unset($where[$key]);
        }


        $where["approve"] = 1;
        $data = $this->laporan->ambil_laporan($where,false,null,false,$model);
        echo json_encode($data);
    }

    public function ambil_laporan_dengan_filter($limit = 30) {
        $filter = (array)json_decode(file_get_contents("php://input"));
    }

    public function ambil_satu_laporan($id) {
        $data = $this->laporan->ambil_satu($id);
        echo json_encode($data);
    }

    public function ambil_berdasarkan_nomor($nomor) {
        $data = $this->laporan->ambil_satu_nomor($nomor);

        if($data == null) {


            $data = $this->laporan->ambil_laporan_temp(0,$nomor);


            if($data != null) {
                echo json_encode(array("status"=>true,"verif"=>0,"data"=>$data));
            } else {
                echo json_encode(array("status"=>false,"msg"=>"Tidak dapat menemukan laporan!"));
            }

        } else {

            foreach($_SESSION["sess_publik"] as $key => $value) {
                if($value["nomor_laporan"] == $nomor) {
                    unset($_SESSION["sess_publik"][$key]);
                    break;
                }
            }

            $data->interval_waktu_proses = $this->ambil_interval_waktu($data->waktu_submit_proses);
            $data->interval_waktu_selesai = $this->ambil_interval_waktu($data->waktu_submit_selesai);
            echo json_encode(array("status"=>true,"verif"=>1,"data"=>$data));



        }

    }

    public function lihat_sesi() {
        echo json_encode($this->session->userdata());
    }

    public function simpan_laporan($data = null)
    {
        $post = ($data == null) ? (array)json_decode(file_get_contents("php://input")) : $data;


        if(
            isset($post["idkelurahan"]) &&
            isset($post["idkecamatan"]) &&
            isset($post["idkategori_laporan"]) &&
            isset($post["nama_pelapor"]) &&
            isset($post["alamat_pelapor"]) &&
            isset($post["nomorhp_pelapor"]) &&
            isset($post["email_pelapor"]) &&
            isset($post["isi_laporan"]) &&
            isset($post["file_attach"])
        ) {


            $post["status"] = "dilapor";

            $sess = $this->session->userdata();

            if(isset($sess["idpengguna"])) {
                if(!isset($post["publik"])) {
                    $post["approve"] = 1;
                    $post["idpengguna_approve"] = $sess["idpengguna"];
                }
            } else {
                $post["approve"] = 0;
            }

            if(isset($post["publik"])) {
                unset($post["publik"]);
            }

            $post["nomor_laporan"] = ($data == null) ? rand(111111,999999) : $data["nomor_laporan"];

            $data_gambar = $this->generate_data_gambar($post["file_attach"]);

            $write_file = $this->upload_gambar($data_gambar["base64"],$data_gambar["nama"]);

            if($write_file) {
                $post["file_attach"] = $data_gambar["nama"];

                $this->buat_thumbnail(self::GAMBAR_LAPORAN_DIR . $post["file_attach"]);

                $lastId = $this->laporan->post_laporan($post);

                if($lastId) {
                    curl_post("http://localhost:7001/trigger_laporan",$post);
                    echo json_encode(array("status"=>"ok","last_insert_id"=>$lastId,"nomor_laporan"=>$post["nomor_laporan"]));
                } else {
                    echo json_encode(array("status"=>"gagal","msg"=>"Database error!"));
                }
            } else {
                echo json_encode(array("status"=>"gagal","msg"=>"Gagal upload file!"));
            }

        } else {

            echo json_encode(array("status"=>"gagal","msg"=>"Data tidak lengkap"));

        }


    }

    public function simpan_laporan_temp() {

        $post = (array)json_decode(file_get_contents("php://input"));

        if(
            isset($post["idkelurahan"]) &&
            isset($post["idkecamatan"]) &&
            isset($post["idkategori_laporan"]) &&
            isset($post["nama_pelapor"]) &&
            isset($post["alamat_pelapor"]) &&
            isset($post["nomorhp_pelapor"]) &&
            isset($post["email_pelapor"]) &&
            isset($post["isi_laporan"]) &&
            isset($post["file_attach"])
        ) {

            if($this->generate_data_gambar($post["file_attach"]) == false) {
                echo json_encode(array("status"=>"gagal","msg"=>"Tipe data tidak diizinkan!"));
                exit();
            }

            $post["status"] = "dilapor";

            $post["approve"] = 0;
            $post["nomor_laporan"] = rand(111111,999999);

            $kode_verifikasi = uniqid();
            $post["kode_verifikasi"] = $kode_verifikasi;
            $post["file_attach"] = json_encode($post["file_attach"]);

            $nnl = $this->generate_kode_gambar(255, 60, $post["nomor_laporan"], "nomor_laporan");
            $nkv = $this->generate_kode_gambar(550, 60, $kode_verifikasi, "kode_verifikasi");

            $paket = [
                "ng_nomor_laporan" => $nnl,
                "ng_kode_verifikasi" => $nkv
            ];

            $_SESSION["sess_publik"][$kode_verifikasi] = array("nomor_laporan"=>$post["nomor_laporan"],"paket"=>$paket);

            $id = $this->laporan->simpan_laporan_temp($post);

            if ($id) {
                $items = [];
                foreach ($_SESSION["sess_publik"] as $item) {
                    array_push($items, $item);
                }
                echo json_encode(array("status"=>true,"baru" => $paket, "wadah" => $items));
            } else {
                echo json_encode(array('status' => false));
            }

        } else {

            echo json_encode(array("status"=>false,"msg"=>"Data tidak lengkap"));

        }

    }

    public function ambil_daftar_nama_gambar_kode() {
        $items = [];
        foreach($_SESSION["sess_publik"] as $item) {
            array_push($items,$item);
        }
        echo json_encode($items);
    }


    public function reset_sess_publik() {
        unset($_SESSION["sess_publik"]);
    }

    public function verifikasi_laporan_publik() {
        $post = (array)json_decode(file_get_contents("php://input"));


        if(isset($post["kode_verifikasi"])) {

            $data = $this->laporan->ambil_laporan_temp(1,$post["kode_verifikasi"],$post["nomor_laporan"]);

            if($data == null) {
                echo json_encode(array("status"=>false,"msg"=>"Nomor verifikasi tidak valid!"));
                exit();
            }


            $data["file_attach"] = json_decode($data["file_attach"]);


            foreach($_SESSION["sess_publik"] as $key => $value) {
                if($key == $post["kode_verifikasi"]) {

                    $ng_nomor_laporan = "assets/gambar_kode/nomor_laporan/".$value["paket"]["ng_nomor_laporan"];
                    $ng_kode_verifikasi = "assets/gambar_kode/kode_verifikasi/".$value["paket"]["ng_kode_verifikasi"];

                    unlink($ng_nomor_laporan);
                    unlink($ng_kode_verifikasi);

                    unset($_SESSION["sess_publik"][$key]);
                    break;
                }
            }

            unset($data["idlapor_temp"]);
            unset($data["kode_verifikasi"]);

            $data["publik"] = true;

            $s = $this->simpan_laporan($data);

            $this->laporan->hapus_laporan_temp($post["kode_verifikasi"]);


        } else {

            echo json_encode(array("status"=>false,"msg"=>"Data tidak lengkap"));
        }
    }

    public function test() {
        curl_post("http://localhost:7001/trigger_laporan",array("test"=>1));
    }

    public function approve_laporan()
    {
        $post = (array)json_decode(file_get_contents("php://input"));
        if(isset($post["latitude"]) && isset($post["longitude"])) {
            $post["waktu_approve"] = date("Y-m-d H:i:s");
            $post["idpengguna_approve"] = $this->session->userdata("idpengguna");
            $update = $this->laporan->approve_laporan($post);
            if($update) {
                echo json_encode(array("status"=>true));
            } else {
                echo json_encode(array("status"=>false,"msg"=>"Server error"));
            }
        } else {
            echo json_encode(array("status"=>false,"msg"=>"Data tidak lengkap!"));
        }
    }
    public function ambil_laporan_publik($type)
    {
        if($type != "facebook") {
            $data = $this->laporan->ambil_laporan([
                "approve" => 0,
                "jenis_laporan" => $type
            ]);
            echo json_encode($data);
        } else {
            $data = $this->laporan->ambil_laporan_facebook();
            echo json_encode($data);
        }
    }

    public function ambil_laporan_depan($limit = 10) {
        $data = $this->laporan->ambil_laporan("",true,$limit);
        echo json_encode($data);
    }

    public function ambil_laporan_facebook()
    {
        $data = $this->laporan->ambil_laporan_facebook();
        echo json_encode($data);
    }

    // Model json entitas
    public function ambil_model_laporan()
    {
        $data = $this->db->list_fields("laporan_masyarakat");
        echo json_encode($data);
    }

    public function ambil_model_kategori() {
        $data = $this->db->list_fields("kategori_laporan");
        echo json_encode($data);
    }

    public function ambil_model_pengguna() {
        $data = $this->db->list_fields("pengguna");
        echo json_encode($data);
    }

    // Kategori
    public function ambil_kategori()
    {
        $data = $this->kategori->ambil_kategori();
        foreach($data as $key=>$kat) {
            $data[$key]->jumlah_laporan = $this->laporan->hitung_laporan(["idkategori_laporan"=>$kat->idkategori_laporan]);
        }
        echo json_encode($data);
    }

    public function simpan_kategori()
    {
        $post = (array)json_decode(file_get_contents("php://input"));
        if(isset($post["nama_kategori"]) && isset($post["icon"]) && isset($post["eta_enabled"])) {
            if($this->kategori->tambah_kategori($post)) {
                echo json_encode(array("status"=>"ok"));
            } else {
                echo json_encode(array("status"=>"gagal"));
            }
        } else {
            echo json_encode(array("status" => "tidak lengkap"));
        }
    }

    public function edit_kategori() {
        $post = (array)json_decode(file_get_contents("php://input"));
        if(isset($post["idkategori_laporan"]) && isset($post["nama_kategori"]) && isset($post["icon"]) && isset($post["eta_enabled"])) {
            if($this->kategori->edit_kategori($post)) {
                echo json_encode(array("status"=>"ok"));
            } else {
                echo json_encode(array("status"=>"gagal"));
            }
        } else {
            echo json_encode(array("status"=>"tidak lengkap"));
        }
    }

    public function hapus_kategori()
    {
        $post = (array)json_decode(file_get_contents("php://input"));
        if(isset($post["idkategori_laporan"])) {
            if($this->kategori->hapus_kategori($post["idkategori_laporan"])) {
                echo json_encode(array("status"=>"ok"));
            } else {
                echo json_encode(array("status"=>"gagal"));
            }
        } else {
            echo json_encode(array("status"=>"tidak lengkap"));
        }
    }

    // Pengguna
    public function ambil_pengguna() {
        $data = $this->pengguna->ambil_pengguna();
        echo json_encode($data);
    }

    public function simpan_pengguna() {
        $post = (array)json_decode(file_get_contents("php://input"));
//        $this->debug($post);
        if(isset($post["bagian"]) && isset($post["super"]) && isset($post["username"]) && isset($post["nama_lengkap"]) && isset($post["password"])) {
            if($this->pengguna->tambah_pengguna($post)) {
                echo json_encode(array("status"=>"ok"));
            } else {
                echo json_encode(array("status"=>"gagal"));
            }
        } else {
            echo json_encode(array("status"=>"tidak lengkap"));
        }
    }

    public function edit_pengguna() {
        $post = (array)json_decode(file_get_contents("php://input"));
//        $this->debug($post);
        if(isset($post["bagian"]) && isset($post["super"]) && isset($post["username"]) && isset($post["nama_lengkap"])) {
            if($this->pengguna->edit_pengguna($post)) {
                echo json_encode(array("status"=>"ok"));
            } else {
                echo json_encode(array("status"=>"gagal"));
            }
        } else {
            echo json_encode(array("status"=>"tidak lengkap"));
        }
    }

    public function hapus_pengguna() {
        $post = (array)json_decode(file_get_contents("php://input"));
//        $this->debug($post);
        if(isset($post["idpengguna"])) {
            if ($this->pengguna->hapus_pengguna($post["idpengguna"])) {
                echo json_encode(array("status"=>"ok"));
            } else {
                echo json_encode(array("status"=>"gagal"));
            }
        } else {
            echo json_encode(array("status"=>"tidak lengkap"));
        }
    }

    // Lokasi
    public function ambil_kecamatan()
    {
        $data = $this->lokasi->ambil_kecamatan();
        echo json_encode($data);
    }

    public function ambil_kelurahan($idkecamatan = "")
    {
        if ($idkecamatan == "") {
            echo json_encode(array("status" => "Id kecamatan tidak didefinisikan!"));
        } else {
            $data = $this->lokasi->ambil_kelurahan($idkecamatan);
            echo json_encode($data);
        }
    }

    public function ambil_kelurahan_by_id($idkelurahan) {
        if ($idkelurahan == "") {
            echo json_encode(array("status" => "Id kelurahan tidak didefinisikan!"));
        } else {
            $data = $this->lokasi->ambil_satu_kelurahan($idkelurahan);
            echo json_encode($data);
        }
    }

    public function ambil_kecamatan_by_id($idkecamatan) {
        if ($idkecamatan == "") {
            echo json_encode(array("status"=>"Id kecamatan tidak didefinisikan!"));
        } else {
            $data = $this->lokasi->ambil_satu_kecamatan($idkecamatan);
            echo json_encode($data);
        }
    }

    public function urus_laporan() {
        $post = (array)json_decode(file_get_contents("php://input"));

        if(isset($post["proses"]->tindakan_proses) && isset($post["proses"]->pengerjaan_hari) && isset($post["proses"]->pengerjaan_jam) && isset($post["proses"]->file_respon_proses->nama)) {
            if($post["proses"]->tindakan_proses != "" && $post["proses"]->pengerjaan_hari != NULL && $post["proses"]->pengerjaan_jam != NULL) {
                $prs_st = 1;
            } else {
                $prs_st = 0;
            }
        } else {
            $prs_st = 0;
        }

        if(isset($post["selesai"]->tindakan_selesai) && isset($post["selesai"]->file_respon_selesai->nama)) {
            if($post["selesai"]->tindakan_selesai != "") {
                $sls_st = 1;
            } else {
                $sls_st = 0;
            }
        } else {
            $sls_st = 0;
        }

        if($prs_st || $sls_st) {

            if($prs_st) {
                $id = $post["idlaporan_masyarakat"];
                $proses = $post["proses"];
                $data_gambar = $this->generate_data_gambar($proses->file_respon_proses);


                $write = $this->upload_gambar($data_gambar["base64"],$data_gambar["nama"],"respon");

                if($write) {
                    $data["idlaporan_masyarakat"] = $id;
                    $data["tindakan_proses"] = ($proses->tindakan_proses == "") ? null : $proses->tindakan_proses;
                    $data["waktu_submit_proses"] = date("Y-m-d H:i:s");
                    $data["pengerjaan_hari"] = $proses->pengerjaan_hari;
                    $data["pengerjaan_jam"] = $proses->pengerjaan_jam;
                    $data["file_respon_proses"] = $data_gambar["nama"];
                    $data["status"] = "proses";
                    $this->buat_thumbnail(self::GAMBAR_RESPON_DIR . $data["file_respon_proses"]);
                    $this->laporan->urus_laporan($data);
                    echo json_encode(array("status"=>"ok"));
                    if(!$sls_st) exit();
                } else {
                    echo json_encode(array("status"=>"gagal","msg"=>"File tidak terupload!"));
                }
            }

            if($sls_st) {
                $id = $post["idlaporan_masyarakat"];
                $selesai = $post["selesai"];
                $data_gambar = $this->generate_data_gambar($selesai->file_respon_selesai);

                $write = $this->upload_gambar($data_gambar["base64"],$data_gambar["nama"],"respon");

                if($write) {
                    $data["idlaporan_masyarakat"] = $id;
                    $data["tindakan_selesai"] = ($selesai->tindakan_selesai == "") ? null : $selesai->tindakan_selesai;
                    $data["waktu_submit_selesai"] = date("Y-m-d H:i:s");
                    $data["file_respon_selesai"] = $data_gambar["nama"];
                    $data["status"] = "selesai";
                    $this->buat_thumbnail(self::GAMBAR_RESPON_DIR . $data["file_respon_selesai"]);
                    $this->laporan->urus_laporan($data);
                    echo json_encode(array("status"=>"ok"));
                } else {
                    echo json_encode(array("status"=>"gagal","msg"=>"File tidak terupload!"));
                }
            }

        } else {
            echo json_encode(array("status"=>"gagal","msg"=>"Post data tidak lengkap!"));
        }

    }


    public function ambil_gambar() {
        $this->generate_kode_gambar(255,60,rand(111111,999999));
        $this->generate_kode_gambar(545,60,uniqid());
    }


    private function generate_data_gambar($objekGambar) {
        $e = explode(".", $objekGambar->nama);
        $ekstensi = strtolower(end($e));
        $tipe_diizinkan = array("png","jpg","jpeg","bmp","JPEG","JPG","PNG","BMP");


        if(!in_array($ekstensi,$tipe_diizinkan)) {
            return false;
            exit();
        }

        $data = array(
            "nama" => md5($objekGambar->nama) . "_" . md5(microtime()) . "." . $ekstensi,
            "base64" => $objekGambar->file
        );

        return $data;
    }

    private function upload_gambar($base64,$nama,$folder = "laporan") {


        $decode = base64_decode(preg_replace('#^data:image/[^;]+;base64,#', '',$base64));

        $path = APPPATH . "../assets/uploads/".$folder."/".$nama;


        $file = fopen($path,"wb");
        $write = fwrite($file,$decode);
        fclose($file);

        return ($write) ? true : false;
    }

    private function debug($var) {
        var_dump($var);
        exit();
    }

    private function ambil_interval_waktu($t1) {
        $waktunotif = new DateTime($t1);
        $waktusekarang = new DateTime("now");
        $diff = $waktusekarang->diff($waktunotif);
        if($diff->days > 0) {
            return $diff->format("%d hari %h jam lalu");
        } else {
            return $diff->format("%h jam %i menit lalu");
        }
    }

    public function ambil_chart_json($type = "all") {
        $dari = strtotime(date("2017/01/01 00:00:00")) - 86400;
        $ke = strtotime(date("Y/m/d 00:00:00"));
        $dataAda = $this->laporan->ambil_jumlah_data($type);
        echo json_encode($this->list_tanggal($dari,$ke,$dataAda));
    }

    private function list_tanggal($dari,$ke,$dataAda) {
        $format = "Y/m/d 00:00:00";
        $arr_days = array();
        $day_passed = ($ke - $dari);
        $day_passed = ($day_passed/86400);

        $counter = 0;
        $day_to_display = $dari;
        while($counter < $day_passed){
            $day_to_display += 86400;
            $arr_days[date($format,$day_to_display)] = 0;
            $counter++;
        }
        foreach($dataAda as $d) {
            $arr_days[date($format,strtotime($d->waktu_laporan))] = (int)$d->jumlah;
        }
        $ret = [];
        foreach($arr_days as $tanggal=>$jumlah) {
            $ret[] = [$tanggal,$jumlah];
        }

        return $ret;
    }

    public function ambil_chart_daerah($type = "kecamatan",$status = "all") {
        switch ($type) {
            case "kecamatan":
                $kelurahan = $this->lokasi->ambil_kecamatan();
                $data_kecamatan = $this->laporan->hitung_per_kecamatan($status);
                $jumlahs = [];
                foreach($kelurahan as $k) {
                    $jumlahs[$k->nama_kecamatan] = 0;
                }
                foreach($data_kecamatan as $d) {
                    $jumlahs[$d->nama_kecamatan] = (int)$d->jumlah;
                }
                $ret = [];

                foreach($jumlahs as $key=>$jumlah) {
                    $data = new stdClass();
                    $data->y = $jumlah;
                    $data->name = $key;
                    $ret[] = $data;
                }

                echo json_encode($ret);
                break;
            case "kelurahan":
                $ret = [];

                $kecamatan = $this->lokasi->ambil_kecamatan();

                if($this->session->userdata("bagian") == "camat") {

                    $idkecamatan = $this->session->userdata("idkecamatan");
                    $kelurahan = $this->lokasi->ambil_kelurahan($idkecamatan);
                    $data_kelurahan = $this->laporan->hitung_per_kelurahan($idkecamatan,$status);$jumlahs = [];
                    foreach($kelurahan as $k) {
                        $jumlahs[$k->nama_kelurahan] = 0;
                    }
                    foreach($data_kelurahan as $d) {
                        $jumlahs[$d->nama_kelurahan] = (int)$d->jumlah;
                    }
                    foreach($jumlahs as $key=>$jumlah) {
                        $ret[] = array($key,$jumlah);
                    }
                    echo json_encode($ret);
                    
                } else {

                    foreach($kecamatan as $kec) {
                        $kelurahan = $this->lokasi->ambil_kelurahan($kec->idkecamatan);
                        $data_kelurahan = $this->laporan->hitung_per_kelurahan($kec->idkecamatan,$status);
                        $jumlahs = [];
                        foreach($kelurahan as $k) {
                            $jumlahs[$k->nama_kelurahan] = 0;
                        }
                        foreach($data_kelurahan as $d) {
                            $jumlahs[$d->nama_kelurahan] = (int)$d->jumlah;
                        }
                        foreach($jumlahs as $key=>$jumlah) {
                            $ret[] = array($key,$jumlah);
                        }
                    }
                    echo json_encode($ret);

                }



                break;
        }
    }

    private function generate_kode_gambar($w,$h,$text,$folder) {
        $png_image = imagecreatetruecolor($w,$h);

        $font_path = 'assets/fonts/OpenSans-Semibold.ttf';

        imageantialias($png_image,true);
        imagecolortransparent($png_image,imagecolorallocate($png_image,0,0,0));


        $text_color = imagecolorallocate($png_image, 38, 10, 20);

        imagettftext($png_image,55,0,0,55,$text_color,$font_path,$text);


        $nama_file = md5(uniqid());

        $lokasi_gambar = 'assets/gambar_kode/' . $folder . "/" . $nama_file . '.png';

        imagepng($png_image,$lokasi_gambar);
        imagedestroy($png_image);

        return $nama_file.".png";
    }



    public function buat_thumbnail($img_path) {
        $p = 300;
        $h = 225;

        $tipe = pathinfo($img_path,PATHINFO_EXTENSION);

        switch($tipe) {
            case "png":
            case "PNG":
                $image = imagecreatefrompng($img_path);
                break;
            case "jpg":
            case "jpeg":
            case "JPG":
                $image = imagecreatefromjpeg($img_path);break;
            default:
                $image = imagecreatefromwbmp($img_path);break;
        }

        $info_gambar = getimagesize($img_path);

        $pg = $info_gambar[0];
        $hg = $info_gambar[1];



        if($hg > $pg) {
            $panjang_baru = $p;
            $tinggi_baru = $this->hitung_ukuran_scale($p,$pg) * $hg;
            // Scale
            $hasil = imagescale($image,$panjang_baru,$tinggi_baru, IMG_BILINEAR_FIXED);
            // Crop
            $hasil = imagecrop($hasil,array(
                        "x" => 0,
                        "y" => ($tinggi_baru/2) - ($h/2),
                        "width" => $p,
                        "height" => $h
                    ));
        } else {
            $panjang_baru = $this->hitung_ukuran_scale($h,$hg) * $pg;
            $tinggi_baru = $h;
            // Scale
            $hasil = imagescale($image,$panjang_baru,$h,IMG_BILINEAR_FIXED);
            // Crop
            $hasil = imagecrop($hasil,array(
                "x" => ($panjang_baru/2) - ($p/2),
                "y" => 0,
                "width" => $p,
                "height" => $h
            ));
        }


        switch($tipe) {
            case "png":
                imagepng($hasil,pathinfo($img_path,PATHINFO_DIRNAME) . "/thumb/" . pathinfo($img_path,PATHINFO_FILENAME) . "." . pathinfo($img_path,PATHINFO_EXTENSION));
                break;
            case "jpg":
            case "jpeg":
                imagejpeg($hasil,pathinfo($img_path,PATHINFO_DIRNAME) . "/thumb/" . pathinfo($img_path,PATHINFO_FILENAME) . "." . pathinfo($img_path,PATHINFO_EXTENSION));
                break;
            default:
                imagewbmp($hasil,pathinfo($img_path,PATHINFO_DIRNAME) . "/thumb/" . pathinfo($img_path,PATHINFO_FILENAME) . "." . pathinfo($img_path,PATHINFO_EXTENSION));
        }
    }


    public function latihan() {

        $png_image = imagecreatetruecolor(255,60);

        $font_path = 'assets/fonts/OpenSans-Semibold.ttf';

        imageantialias($png_image,true);
        imagecolortransparent($png_image,imagecolorallocate($png_image,0,0,0));


        $text_color = imagecolorallocate($png_image, 38, 10, 20);

        imagettftext($png_image,55,0,0,55,$text_color,$font_path,123456);


        $nama_file = md5(uniqid());

        $lokasi_gambar = 'assets/gambar_kode/' . "nomor_laporan" . "/" . $nama_file . '.png';

        imagepng($png_image,$lokasi_gambar);
        imagedestroy($png_image);

        echo "<img src='".base_url($lokasi_gambar)."'/>";

//        return $nama_file.".png";
//
//        echo APPPATH;
    }

    private function hitung_ukuran_scale($n,$p) {
        return ((($n*100)/$p) / 100);
    }


    public function ambil_id_lokasi() {
        $lat = $this->input->get("latitude");
        $lng = $this->input->get("longitude");

        $daftar_kecamatan = $this->lokasi->ambil_kecamatan();

        foreach($daftar_kecamatan as $kecamatan) {
            $koordinat = $this->ekstrakKoordinat(json_decode(file_get_contents("http://localhost/laporan/assets/geojson/".explode(".",$kecamatan->kml)[0].".geojson")));
            if($this->pip->pointInPolygon([$lng,$lat],$koordinat)) {
                $idkecamatan = $kecamatan->idkecamatan;
                $namaKec = $kecamatan->nama_kecamatan;
            }
        }

        if(isset($idkecamatan)) {

            $daftar_kelurahan = $this->lokasi->ambil_kelurahan($idkecamatan);

            foreach($daftar_kelurahan as $kelurahan) {
                $koordinat = $this->ekstrakKoordinat(json_decode(file_get_contents("http://localhost/laporan/assets/geojson/".explode(".",$kelurahan->kml)[0].".geojson")));
                if($this->pip->pointInPolygon([$lng,$lat],$koordinat)) {
                    $idkelurahan = $kelurahan->idkelurahan;
                    $namaKel = $kelurahan->nama_kelurahan;
                }
            }

        }

        echo json_encode(array(
            "idkecamatan" => $idkecamatan,
            "idkelurahan" => $idkelurahan
        ));


    }

    private function ekstrakKoordinat($geoJson) {
        $coordinates = $geoJson->features[0]->geometry->coordinates;
        $new = $coordinates;
        for($i=1;$i<$this->countDim($coordinates)-1;$i++) {
            $new = $new[0];
        }
        return $new;
    }

    public function countDim($array) {
        if(is_array(reset($array))) {
            $return = $this->countDim(reset($array)) + 1;
        } else {
            $return = 1;
        }
        return $return;
    }



}