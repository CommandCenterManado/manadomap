<?php

class Android extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Laporan_model","laporan");
    }

    public function ambil_kategori() {
        header("Content-Type: application/json;charset=utf-8");
        $kategori = $this->db->get("kategori_laporan")->result_array();
        echo json_encode(array("kategori"=>$kategori));
    }

    public function ambil_kecamatan() {
        header("Content-Type: application/json;charset=utf-8");
        $kecamatan = $this->db->get("kecamatan")->result_array();
        echo json_encode(array("kecamatan"=>$kecamatan));
    }

    public function ambil_kelurahan($idkecamatan) {
        header("Content-Type: application/json;charset=utf-8");
        $kelurahan = $this->db->where("idkecamatan",$idkecamatan)->get("kelurahan")->result_array();
        echo json_encode(array("kelurahan"=>$kelurahan));
    }
    public function api_ambil_satu_laporan($nomor) {
        header("Content-Type: application.json;charset=utf8");
        $record = $this->laporan->ambil_satu_nomor($nomor);
        echo json_encode($record);
    }

    public function post_laporan() {
        $this->load->model("Laporan_model","laporan");
        $post = $this->input->post();

        $path = APPPATH . "../assets/uploads/laporan/".$post["file_attach"];

        $decode = base64_decode($post["string_gambar"]);
        unset($post["string_gambar"]);
        $file = fopen($path,"wb");
        $write = fwrite($file,$decode);
        fclose($file);

        $post["status"] = "dilapor";
        $post["nomor_laporan"] = rand(0000,9999);
        $post["jenis_laporan"] = "android";
        $post["approve"] = 0;
        $id = $this->laporan->post_laporan($post);

        if($id) {
            $post["idlaporan_masyarakat"] = $id;
            $post["dari_publik"] = 1;
            $this->kirimTrigger($post);
            echo json_encode(array("status"=>"ok","nomor"=>$post["nomor_laporan"]));
        } else {
            echo "gagal";
        }

    }

    private function kirimTrigger($data) {
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,"http://localhost/trigger_laporan_baru");
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

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