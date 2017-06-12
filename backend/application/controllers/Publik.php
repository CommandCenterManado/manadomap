<?php


class Publik extends CI_Controller {


    public function index() {
        $this->load->model("Lokasi_model","lokasi");
        $this->load->model("Kategori_model","kategori");
        $records = $this->lokasi->ambil_kecamatan();
        $kategori = $this->kategori->ambil_kategori();

        $this->load->view("dashboard/frames/header");
        $this->load->view("publik/form",compact("records","kategori"));
        $this->load->view("dashboard/frames/footer");
    }



    public function api_post_laporan($ref = "") {
        $this->load->model("Laporan_model","laporan");
        $post = $this->input->post();
        $post["jenis_laporan"] = "web";
        $post["status"] = "dilapor";
        $post["nomor_laporan"] = rand(0000,9999);
        $post["file_attach"] = $this->upload_gambar();
        $query = $this->laporan->post_laporan($post);

        if($query){
            $post["idlaporan_masyarakat"] = $query;
            $post["dari_publik"] = true;
            $this->kirimTrigger($post);
            redirect(base_url("index.php/publik/index/success"));
        } else {
            redirect(base_url("index.php/publik/index/error"));
        }
    }

    public function api_ambil_kelurahan($idkecamatan) {
        $this->load->model("Lokasi_model","lokasi");
        $records = $this->lokasi->ambil_kelurahan($idkecamatan);
	header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        echo json_encode(array("status"=>"ok","data"=>$records));
    }


    private function upload_gambar() {
        $realName = $_FILES["file_attach"]["name"];
        $type = explode(".",$realName);
        $type = end($type);
        $config["upload_path"] = "assets/uploads/laporan";
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
