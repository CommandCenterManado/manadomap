<?php

class Dashboard extends CI_Controller  {

    public function __construct() {
        parent::__construct();
        if(!$this->is_login())
            redirect(base_url("index.php/login"));
        $this->load->model("Pengguna_model","pengguna");
        $this->load->model("Laporan_model","laporan");
        $this->load->model("Kategori_model","kategori");
    }

    public function index() {
        $this->load->view("frontend/dashboard");
    }

    public function dashboard_card($par = "") {
        $records = $this->laporan->ambil_laporan([
            "approve" => 1
        ],$par);
        $kategori = $this->kategori->ambil_kategori();
        $this->load->model("Lokasi_model","lokasi");
        $kecamatan = $this->lokasi->ambil_kecamatan();

        $js = [
            "all" => "",
            "web" => "",
            "facebook" => "",
            "twitter" => "",
            "android" => "",
            "qlue" => "",
            "sms" => "",
            "telepon" => ""
        ];
        $st = [
            "all" => "",
            "dilapor" => "",
            "proses" => "",
            "selesai" => ""
        ];

        $ikc["id_all"] = "";
        foreach($kecamatan as $k){
            $ikc["id_".$k->idkecamatan] = "";
        }

        $ikt["id_all"] = "";
        foreach($kategori as $k){
            $ikt["id_".$k->idkategori_laporan] = "";
        }

        if($par != "") {
            $params = $this->input->get();
            $js[$params["jenis_laporan"]] = "selected";
            if(isset($params["idkelurahan"]) && $params["idkelurahan"] != "all") {
                $kelurahan = $this->lokasi->ambil_kelurahan($params["idkelurahan"]);
            }
            if(isset($params["idkecamatan"]))
                $ikc["id_".$params["idkecamatan"]] = "selected";
            $st[$params["status"]] = "selected";
            if(isset($params["idkategori_laporan"]))
                $ikt["id_".$params["idkategori_laporan"]] = "selected";
        }

        foreach($records as $key=>$l) {
            if($l->status == "dilapor") {
                $records[$key]->iconStatus = '<i class="fa fa-bullhorn fa-fw text-pumpkin"></i>';
            } elseif($l->status == "proses") {
                $records[$key]->iconStatus = '<i class="fa fa-clock-o fa-fw text-silver"></i>';
            } else {
                $records[$key]->iconStatus = '<i class="fa fa-check-circle fa-fw text-green"></i>';
            }
            if($l->jenis_laporan == "web") {
                $records[$key]->iconJenis = '<i class="fa fa-globe fa-lg fa-fw"></i>';
            } elseif($l->jenis_laporan == "android") {
                $records[$key]->iconJenis = '<i class="fa fa-android fa-lg fa-fw"></i>';
            } elseif($l->jenis_laporan == "facebook") {
                $records[$key]->iconJenis = '<i class="fa fa-facebook-square fa-lg fa-fw"></i>';
            } elseif($l->jenis_laporan == "twitter") {
                $records[$key]->iconJenis = '<i class="fa fa-twitter fa-lg fa-fw"></i>';
            } else {
                $records[$key]->iconJenis = '<i class="fa fa-file-text-o fa-lg fa-fw"></i>';
            }
        }


        $this->load->view("frontend/dashboard-card",compact("records","kecamatan","js","ikc","st","kategori","ikt"));
    }

    public function dashboard_list($par = "") {
        $records = $this->laporan->ambil_laporan([
            "approve" => 1
        ],$par);
        $kategori = $this->kategori->ambil_kategori();
        $this->load->model("Lokasi_model","lokasi");
        $kecamatan = $this->lokasi->ambil_kecamatan();

        $js = [
            "all" => "",
            "web" => "",
            "facebook" => "",
            "twitter" => "",
            "android" => "",
            "qlue" => "",
            "sms" => "",
            "telepon" => ""
        ];
        $st = [
            "all" => "",
            "dilapor" => "",
            "proses" => "",
            "selesai" => ""
        ];

        $ikc["id_all"] = "";
        foreach($kecamatan as $k){
            $ikc["id_".$k->idkecamatan] = "";
        }

        $ikt["id_all"] = "";
        foreach($kategori as $k){
            $ikt["id_".$k->idkategori_laporan] = "";
        }

        if($par != "") {
            $params = $this->input->get();
            $js[$params["jenis_laporan"]] = "selected";
            if(isset($params["idkelurahan"]) && $params["idkelurahan"] != "all") {
                $kelurahan = $this->lokasi->ambil_kelurahan($params["idkelurahan"]);
            }
            if(isset($params["idkecamatan"]))
                $ikc["id_".$params["idkecamatan"]] = "selected";
            $st[$params["status"]] = "selected";
            if(isset($params["idkategori_laporan"]))
                $ikt["id_".$params["idkategori_laporan"]] = "selected";
        }

        foreach($records as $key=>$l) {
            if($l->status == "dilapor") {
                $records[$key]->iconStatus = '<i class="fa fa-bullhorn fa-fw text-pumpkin"></i>';
            } elseif($l->status == "proses") {
                $records[$key]->iconStatus = '<i class="fa fa-clock-o fa-fw text-silver"></i>';
            } else {
                $records[$key]->iconStatus = '<i class="fa fa-check-circle fa-fw text-green"></i>';
            }
            if($l->jenis_laporan == "web") {
                $records[$key]->iconJenis = '<i class="fa fa-globe fa-lg fa-fw"></i>';
            } elseif($l->jenis_laporan == "android") {
                $records[$key]->iconJenis = '<i class="fa fa-android fa-lg fa-fw"></i>';
            } elseif($l->jenis_laporan == "facebook") {
                $records[$key]->iconJenis = '<i class="fa fa-facebook-square fa-lg fa-fw"></i>';
            } elseif($l->jenis_laporan == "twitter") {
                $records[$key]->iconJenis = '<i class="fa fa-twitter fa-lg fa-fw"></i>';
            } else {
                $records[$key]->iconJenis = '<i class="fa fa-file-text-o fa-lg fa-fw"></i>';
            }
        }

        $this->load->view("frontend/dashboard-list",compact("records","kecamatan","js","ikc","st","kategori","ikt"));
    }

    public function urus($id) {
        $record = $this->laporan->ambil_satu($id);
        $record->pengguna_approve = $this->laporan->ambil_pengguna_approve($record->idpengguna_approve);
        $record->pengguna_handle = $this->laporan->ambil_pengguna_handle($record->idpengguna_handle);
        if($record->approve == 1) {
            $this->load->view("dashboard/frames/header");
            $this->load->view("dashboard/urus",compact("record"));
            $this->load->view("dashboard/frames/footer");
        } else {
            redirect(base_url("index.php/dashboard/form"));
        }
    }


    public function halaman_verifikasi($page = "") {
        if($this->session->userdata("bagian") !== "root" && $this->session->userdata("bagian") !== "ccenter" && $this->session->userdata("bagian") !== "walikota")
            redirect(base_url("index.php/dashboard/"));
        $this->load->model("Lokasi_model","lokasi");
        $this->load->model("Kategori_model","kategori");
        $kecamatan = $this->lokasi->ambil_kecamatan();
        $kategori = $this->kategori->ambil_kategori();


        //

        switch($page) {
            case "" :
            case "web" :
                $laporan = $this->laporan->ambil_laporan([
                    "approve" => 0,
                    "jenis_laporan" => "web"
                ]);
                $menu = array(
                    "web" => "selected",
                    "android" => "",
                    "twitter" => "",
                    "qlue" => "",
                    "sms" => "",
                    "telepon" => ""
                );
                $this->load->view("frontend/halaman-verifikasi",compact("kecamatan","kategori","laporan","menu"));
                break;
            case "facebook" :
                $laporan = $this->laporan->ambil_laporan_facebook();
                $this->load->view("frontend/halaman-verifikasi-facebook",compact("kecamatan","kategori","laporan","menu"));
                break;
            case "twitter" :
                $laporan = $this->laporan->ambil_laporan([
                    "approve" => 0,
                    "jenis_laporan" => "twitter"
                ]);
                $menu = array(
                    "web" => "",
                    "android" => "",
                    "twitter" => "selected",
                    "qlue" => "",
                    "sms" => "",
                    "telepon" => ""
                );
                $this->load->view("frontend/halaman-verifikasi",compact("kecamatan","kategori","laporan","menu"));
                break;
            case "qlue" :
                $laporan = $this->laporan->ambil_laporan([
                    "approve" => 0,
                    "jenis_laporan" => "qlue"
                ]);
                $menu = array(
                    "web" => "",
                    "android" => "",
                    "twitter" => "",
                    "qlue" => "selected",
                    "sms" => "",
                    "telepon" => ""
                );
                $this->load->view("frontend/halaman-verifikasi",compact("kecamatan","kategori","laporan","menu"));
                break;
            case "sms" :
                $laporan = $this->laporan->ambil_laporan([
                    "approve" => 0,
                    "jenis_laporan" => "sms"
                ]);
                $menu = array(
                    "web" => "",
                    "android" => "",
                    "twitter" => "",
                    "qlue" => "",
                    "sms" => "selected",
                    "telepon" => ""
                );
                $this->load->view("frontend/halaman-verifikasi",compact("kecamatan","kategori","laporan","menu"));
                break;
            case "telepon" :
                $laporan = $this->laporan->ambil_laporan([
                    "approve" => 0,
                    "jenis_laporan" => "telepon"
                ]);
                $menu = array(
                    "web" => "",
                    "android" => "",
                    "twitter" => "",
                    "qlue" => "",
                    "sms" => "",
                    "telepon" => "selected"
                );
                $this->load->view("frontend/halaman-verifikasi",compact("kecamatan","kategori","laporan","menu"));
                break;
            case "android" :
                $laporan = $this->laporan->ambil_laporan([
                    "approve" => 0,
                    "jenis_laporan" => "android"
                ]);
                $menu = array(
                    "web" => "",
                    "android" => "selected",
                    "twitter" => "",
                    "qlue" => "",
                    "sms" => "",
                    "telepon" => ""
                );
                $this->load->view("frontend/halaman-verifikasi",compact("kecamatan","kategori","laporan","menu"));
                break;
            default:
                redirect(base_url("index.php/dashboard/halaman_verifikasi"));
                break;
        }

        //


    }

    public function hapus_laporan_temp($id) {
        $namaGambar = $this->laporan->ambil_gambar_laporan($id);
        unlink("assets/uploads/laporan/".$namaGambar);
        $this->laporan->hapus_laporan_temp($id);
        redirect(base_url("index.php/dashboard/form/"));
    }
    public function hapus_laporan_facebook($id) {
        $this->laporan->hapus_laporan_facebook($id);
        redirect(base_url("index.php/dashboard/form/facebook"));
    }

    public function pengaturan_kategori() {
        $this->proteksi_hal_root();

        $this->load->model("Kategori_model","kategori");
        $kategori = $this->kategori->ambil_kategori();
        $this->load->view("frontend/pengaturan-kategori",compact("kategori"));
    }

    public function pengaturan_pengguna() {
        $this->proteksi_hal_root();

        $this->load->model("Lokasi_model","lokasi");
        $this->load->model("Kategori_model","kategori");
        $pengguna = $this->pengguna->ambil_pengguna();
        $kecamatan = $this->lokasi->ambil_kecamatan();
        $kategori = $this->kategori->ambil_kategori();

        $this->load->view("frontend/pengaturan-pengguna",compact("kecamatan","kategori","pengguna"));
    }

    public function dashboard_map($par = "") {
        $records = $this->laporan->ambil_laporan([
            "approve" => 1
        ],$par);
        $kategori = $this->kategori->ambil_kategori();
        $this->load->model("Lokasi_model","lokasi");
        $kecamatan = $this->lokasi->ambil_kecamatan();

        $js = [
            "all" => "",
            "web" => "",
            "facebook" => "",
            "twitter" => "",
            "android" => "",
            "qlue" => "",
            "sms" => "",
            "telepon" => ""
        ];
        $st = [
            "all" => "",
            "dilapor" => "",
            "proses" => "",
            "selesai" => ""
        ];

        $ikc["id_all"] = "";
        foreach($kecamatan as $k){
            $ikc["id_".$k->idkecamatan] = "";
        }

        $ikt["id_all"] = "";
        foreach($kategori as $k){
            $ikt["id_".$k->idkategori_laporan] = "";
        }

        if($par != "") {
            $params = $this->input->get();
            $js[$params["jenis_laporan"]] = "selected";
            if(isset($params["idkelurahan"]) && $params["idkelurahan"] != "all") {
                $kelurahan = $this->lokasi->ambil_kelurahan($params["idkelurahan"]);
            }
            if(isset($params["idkecamatan"]))
                $ikc["id_".$params["idkecamatan"]] = "selected";
            $st[$params["status"]] = "selected";
            if(isset($params["idkategori_laporan"]))
                $ikt["id_".$params["idkategori_laporan"]] = "selected";
        }

        foreach($records as $key=>$l) {
            if($l->status == "dilapor") {
                $records[$key]->iconStatus = '<i class="fa fa-bullhorn fa-fw text-pumpkin"></i>';
            } elseif($l->status == "proses") {
                $records[$key]->iconStatus = '<i class="fa fa-clock-o fa-fw text-silver"></i>';
            } else {
                $records[$key]->iconStatus = '<i class="fa fa-check-circle fa-fw text-green"></i>';
            }
            if($l->jenis_laporan == "web") {
                $records[$key]->iconJenis = '<i class="fa fa-globe fa-lg fa-fw"></i>';
            } elseif($l->jenis_laporan == "android") {
                $records[$key]->iconJenis = '<i class="fa fa-android fa-lg fa-fw"></i>';
            } elseif($l->jenis_laporan == "facebook") {
                $records[$key]->iconJenis = '<i class="fa fa-facebook-square fa-lg fa-fw"></i>';
            } elseif($l->jenis_laporan == "twitter") {
                $records[$key]->iconJenis = '<i class="fa fa-twitter fa-lg fa-fw"></i>';
            } else {
                $records[$key]->iconJenis = '<i class="fa fa-file-text-o fa-lg fa-fw"></i>';
            }
        }

        $this->load->view("frontend/dashboard-map",compact("records","kecamatan","js","ikc","st","kategori","ikt"));
    }

    public function srv() {
        echo "<pre>";
        shell_exec("cd c");
        $out = shell_exec("ls -l");
        chdir("c:\\xampp\\htdocs\\laporan_revisi\\nodeserver\\e");
        echo($out);
        echo "<br />";
        $out = shell_exec("ls -l");
        $out = shell_exec("node server.js");
        //echo($out);
    }

    public function api_ambil_laporan($par = false) {
        header("Content-Type: application/json");
        if($par == false) {
            $records = $this->laporan->ambil_laporan([
                "approve" => 1
            ]);
        } else {
            $records = $this->laporan->ambil_laporan([
                "approve" => 1
            ],$par);
        }
        echo json_encode($records);
    }

    public function api_ambil_satu_laporan($id) {
        header("Content-Type: application.json;charset=utf8");
        $record = $this->laporan->ambil_satu($id);
        echo json_encode($record);
    }

    public function api_post_laporan($ref = "") {
        $post = $this->input->post();
        $post["status"] = "dilapor";
        $post["nomor_laporan"] = rand(0000,9999);
        $post["file_attach"] = $this->upload_gambar("laporan");
        $post["idpengguna_approve"] = $this->session->userdata("idpengguna");
        $id = $this->laporan->post_laporan($post);
        if($id){
            $post["idlaporan_masyarakat"] = $id;
            $this->kirimTrigger($post);
            redirect(base_url("index.php/dashboard/halaman_verifikasi/".$ref."/success"));
        } else {
            redirect(base_url("index.php/dashboard/halaman_verifikasi/".$ref."/error"));
        }
    }

    public function api_ambil_kecamatan() {
        $this->load->model("Lokasi_model","lokasi");
        $records = $this->lokasi->ambil_kecamatan();
        header("Content-Type: application/json");
        echo json_encode(array("status"=>"ok","data"=>$records));
    }

    public function api_ambil_kelurahan($idkecamatan) {
        $this->load->model("Lokasi_model","lokasi");
        $records = $this->lokasi->ambil_kelurahan($idkecamatan);
        header("Content-Type: application/json");
        echo json_encode(array("status"=>"ok","data"=>$records));
    }

    public function api_urus_laporan($ref) {
        $id = $this->input->post("idlaporan_masyarakat");
        $namaFile = $this->upload_gambar("respon");
        if(!$namaFile){
            var_dump($this->upload->display_errors());exit();
        }


        $query = $this->laporan->urus_laporan($id,$namaFile);
        if($query)
            redirect(base_url("index.php/dashboard/$ref/"));
        else
            redirect(base_url("index.php/dashboard/$ref/"));
    }

    public function api_approve_laporan() {
        $post = $this->input->post();
        $update = $this->laporan->approve_laporan();
        if($update){
            $this->kirimTrigger($post);
            redirect(base_url("index.php/dashboard/halaman_verifikasi/web/success"));
        } else {
            redirect(base_url("index.php/dashboard/halaman_verifikasi/web/error"));
        }
    }

    public function api_post_kategori() {
        $this->proteksi_hal_root();

        $this->load->model("Kategori_model","kategori");
        $tambah = $this->kategori->tambah_kategori();
        if($tambah)
            redirect(base_url("index.php/dashboard/pengaturan_kategori/success"));
        else
            redirect(base_url("index.php/dashboard/pengaturan_kategori/error"));
    }
    public function api_hapus_kategori($id) {
        $this->proteksi_hal_root();

        $this->load->model("Kategori_model","kategori");
        $hapus = $this->kategori->hapus_kategori($id);
        if($hapus)
            redirect(base_url("index.php/dashboard/pengaturan_kategori/success"));
        else
            redirect(base_url("index.php/dashboard/pengaturan_kategori/error"));
    }

    public function api_post_pengguna() {
        $this->proteksi_hal_root();

        $tambah = $this->pengguna->tambah_pengguna();
        if($tambah)
            redirect(base_url("index.php/dashboard/pengaturan_pengguna/success"));
        else
            redirect(base_url("index.php/dashboard/pengaturan_pengguna/error"));
    }
    public function api_hapus_pengguna($id) {
        $this->proteksi_hal_root();

        $hapus = $this->pengguna->hapus_pengguna($id);
        if($hapus)
            redirect(base_url("index.php/dashboard/pengaturan_pengguna/success"));
        else
            redirect(base_url("index.php/dashboard/pengaturan_pengguna/error"));
    }
    public function api_ambil_pengguna() {
        header("Content-Type: application/json;charset=utf-8");
        echo json_encode($this->session->userdata());
    }

    public function api_logout() {
        $this->session->sess_destroy();
    }


    private function upload_gambar($folder) {
        $realName = $_FILES["file_attach"]["name"];
        $type = explode(".",$realName);
        $type = end($type);
        $config["upload_path"] = "assets/uploads/".$folder;
        $config["allowed_types"] = "jpg|png|bmp|jpeg";
        $config["max_size"] = "10000";
        $config["file_name"] = md5(microtime().$_FILES["file_attach"]["name"]);
        $this->load->library("upload",$config);
        if($this->upload->do_upload("file_attach")) {
            return $config["file_name"].".".$type;
        } else {
            return $this->upload->display_errors();
        }
    }

    private function is_login() {
        $login = $this->session->userdata("idpengguna");
        return (isset($login));
    }

    public function ambil_satu_laporan($id) {
        $laporan = $this->laporan->ambil_satu($id);
        $user = $this->session->userdata();
        $data = array("laporan"=>$laporan,"user"=>$user);
        header("Content-Type: application/json;charset=utf-8");
        echo json_encode($data);
    }

    private function proteksi_hal_root() {
        if($this->session->userdata("bagian") != "root" && $this->session->userdata("bagian") != "walikota")
            redirect(base_url("index.php/dashboard/"));
    }

    private function kirimTrigger($data) {
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,"http://localhost/trigger_laporan_baru");

        curl_setopt($curl,CURLOPT_HEADER,0);
        curl_setopt($curl,CURLOPT_HTTPHEADER,array("Expect:"));
        curl_setopt($curl,CURLOPT_PORT,7001);
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,20);

        curl_setopt($curl,CURLOPT_POST,true);
        curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($data));

        curl_exec($curl);
        curl_close($curl);
    }
}