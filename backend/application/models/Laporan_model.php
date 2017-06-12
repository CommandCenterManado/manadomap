<?php


class Laporan_model extends CI_Model {

    public function ambil_laporan($where = "",$depan = false,$limit = null,$order = false,$model = false) {


        foreach($where as $key=>$itemWhere){
            if($itemWhere === null || $itemWhere === "")
                unset($where[$key]);
        }



        if(isset($where["laporan_masyarakat.dari_tanggal"]) && isset($where["laporan_masyarakat.sampai_tanggal"])) {
            $this->db->where("DATE(laporan_masyarakat.waktu_laporan) >= ",date("Y-m-d",strtotime($where["laporan_masyarakat.dari_tanggal"])));
            $this->db->where("DATE(laporan_masyarakat.waktu_laporan) <= ",date("Y-m-d",strtotime($where["laporan_masyarakat.sampai_tanggal"])));

            unset($where["laporan_masyarakat.dari_tanggal"]);
            unset($where["laporan_masyarakat.sampai_tanggal"]);
        }

        // Filter where dari user
        $userdata = $this->session->userdata();

        if(isset($userdata["idpengguna"])) {
            if($userdata["bagian"] != "root" && $userdata["bagian"] != "walikota" && $userdata["bagian"] != "ccenter") {

                if($userdata["bagian"] == "camat")
                    $ftu["laporan_masyarakat.idkecamatan"] = $userdata["idkecamatan"];
                elseif($userdata["bagian"] == "lurah")
                    $ftu["laporan_masyarakat.idkelurahan"] = $userdata["idkelurahan"];
                elseif($userdata["bagian"] == "department")
                    $ftu["laporan_masyarakat.idkategori_laporan"] = $userdata["idkategori_laporan"];

                $this->db->where($ftu);
            }
        }

        if($model == false) {
            $this->db->select("laporan_masyarakat.*");
            $this->db->select("kategori_laporan.*");
            $this->db->select("kecamatan.nama_kecamatan");
            $this->db->select("kelurahan.nama_kelurahan");
            $this->db->select("pengguna.nama_lengkap AS nama_operator_approve");
        } elseif($model == "list") {
            $this->db->select("laporan_masyarakat.idlaporan_masyarakat,laporan_masyarakat.nomor_laporan,laporan_masyarakat.waktu_laporan,laporan_masyarakat.status,laporan_masyarakat.waktu_approve,laporan_masyarakat.jenis_laporan");
            $this->db->select("kategori_laporan.icon");
            $this->db->select("kecamatan.nama_kecamatan");
            $this->db->select("kelurahan.nama_kelurahan");
            $this->db->select("pengguna.nama_lengkap AS nama_operator_approve");
        } elseif($model == "card") {
            $this->db->select("laporan_masyarakat.idlaporan_masyarakat,laporan_masyarakat.nomor_laporan,laporan_masyarakat.waktu_laporan,laporan_masyarakat.status,laporan_masyarakat.file_attach,laporan_masyarakat.jenis_laporan,laporan_masyarakat.latitude,laporan_masyarakat.longitude");
            $this->db->select("kategori_laporan.icon");
        } elseif($model == "map") {
            $this->db->select("laporan_masyarakat.idlaporan_masyarakat,laporan_masyarakat.latitude,laporan_masyarakat.longitude,laporan_masyarakat.status");
        }

        $this->db->join("kategori_laporan","laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan","left");
        $this->db->join("kecamatan","laporan_masyarakat.idkecamatan = kecamatan.idkecamatan","left");
        $this->db->join("kelurahan","laporan_masyarakat.idkelurahan = kelurahan.idkelurahan","left");
        $this->db->join("pengguna","laporan_masyarakat.idpengguna_approve = pengguna.idpengguna","left");



        if($depan) {
            $this->db->where("laporan_masyarakat.status = 'proses' or laporan_masyarakat.status = 'selesai'");
            $this->db->order_by("laporan_masyarakat.waktu_submit_proses","desc");
            $this->db->order_by("laporan_masyarakat.waktu_submit_selesai","desc");
        }


        if($order != false) {
            $this->db->order_by("laporan_masyarakat.waktu_approve","desc");
        } else {
            $this->db->order_by("laporan_masyarakat.waktu_approve","asc");
        }


        if(isset($where["laporan_masyarakat.limit"])) {
            $jumLimit = $where["laporan_masyarakat.limit"];
            if(isset($where["laporan_masyarakat.offset"])) {
                $jumOffset = $where["laporan_masyarakat.offset"];
                unset($where["laporan_masyarakat.offset"]);
            }
            unset($where["laporan_masyarakat.limit"]);
        }


        if($where != "") {
            $this->db->where($where);
        }

        $dataCount = $this->db->count_all_results("laporan_masyarakat",false);

        if(isset($jumLimit)) {
            if(isset($jumOffset))
                $this->db->limit($jumLimit,$jumOffset);
            else
                $this->db->limit($jumLimit);
        }


        return array(
            "data"=>$this->db->get()->result(),
            "total"=>$dataCount
        );
    }

    public function ambil_satu($id) {
        $this->db->select("laporan_masyarakat.*");
        $this->db->select("kategori_laporan.nama_kategori");
        $this->db->select("kategori_laporan.icon");
        $this->db->select("kecamatan.nama_kecamatan");
        $this->db->select("kelurahan.nama_kelurahan");
        $this->db->select("pengguna.nama_lengkap");
        $this->db->join("kategori_laporan","laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan","left");
        $this->db->join("kecamatan","laporan_masyarakat.idkecamatan = kecamatan.idkecamatan","left");
        $this->db->join("kelurahan","laporan_masyarakat.idkelurahan = kelurahan.idkelurahan","left");
        $this->db->join("pengguna","laporan_masyarakat.idpengguna_approve = pengguna.idpengguna","left");
        $this->db->where("laporan_masyarakat.idlaporan_masyarakat",$id);
        $this->db->from("laporan_masyarakat");
        return $this->db->get()->row();
    }
    public function ambil_satu_nomor($nomor) {
        $this->db->select("laporan_masyarakat.*");
        $this->db->select("kategori_laporan.nama_kategori");
        $this->db->select("kategori_laporan.icon");
        $this->db->select("kecamatan.nama_kecamatan");
        $this->db->select("kelurahan.nama_kelurahan");
        $this->db->select("pengguna.nama_lengkap");
        $this->db->join("kategori_laporan","laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan","left");
        $this->db->join("kecamatan","laporan_masyarakat.idkecamatan = kecamatan.idkecamatan","left");
        $this->db->join("kelurahan","laporan_masyarakat.idkelurahan = kelurahan.idkelurahan","left");
        $this->db->join("pengguna","laporan_masyarakat.idpengguna_approve = pengguna.idpengguna","left");
        $this->db->where("laporan_masyarakat.nomor_laporan",$nomor);
        $this->db->from("laporan_masyarakat");
        return $this->db->get()->row();
    }

    public function ambil_laporan_facebook() {
        return $this->db->order_by("waktu","desc")->get("laporan_facebook")->result();
    }

    public function simpan_laporan_temp($post) {
        $this->db->insert("lapor_temp",$post);
        return $this->db->insert_id();
    }

    public function ambil_laporan_temp($st,$kode,$nomor = null) {
        $this->db->where(($st) ? "kode_verifikasi" : "nomor_laporan",$kode);
        if($nomor != null)
            $this->db->where("nomor_laporan",$nomor);
        $data = $this->db->get("lapor_temp")->row_array();
        return $data;
    }

    public function hapus_laporan_temp($kode) {
        $this->db->where("kode_verifikasi",$kode);
        return $this->db->delete("lapor_temp");
    }

    public function approve_laporan($post) {
        $id = $post["idlaporan_masyarakat"];
        unset($post["idlaporan_masyarakat"]);
        $post["approve"] = 1;
        $post["idpengguna_approve"] = $this->session->userdata("idpengguna");



//        var_dump($post);die();
        $this->db->where("idlaporan_masyarakat",$id);
        $query = $this->db->update("laporan_masyarakat",$post);
        return $query;
    }

    public function ambil_pengguna_approve($id){
        return $this->db
            ->select("nama_lengkap")
            ->from("pengguna")
            ->where("idpengguna",$id)
            ->get()
            ->row();
    }

    public function ambil_pengguna_handle($id) {
        return $this->db
            ->select("nama_lengkap")
            ->from("pengguna")
            ->where("idpengguna",$id)
            ->get()
            ->row();
    }

    public function post_laporan($data) {

        if(isset($data["fromPariwisata"])) {
            $data["idkategori_laporan"] = 20;
            unset($data["fromPariwisata"]);
            $this->db->insert("laporan_masyarakat",$data);
            header("Location: http://dispar.manadokota.go.id/index.php/publik/pengaduan/success");
            exit();die();
        }

        if(isset($data["fromBack"])) {
            $data["approve"] = 1;
            unset($data["fromBack"]);
            unset($data["id_laporan_facebook"]);
        }

        if(isset($data["id_laporan_facebook"])) {
            $data["approve"] = 1;
            $this->db->where("id_laporan_facebook",$data["id_laporan_facebook"])->delete("laporan_facebook");
            unset($data["id_laporan_facebook"]);
        }


        $this->db->insert("laporan_masyarakat",$data);
        return $this->db->insert_id();
    }

    public function urus_laporan($data) {
        $this->db->where("idlaporan_masyarakat",$data["idlaporan_masyarakat"]);
        unset($data["idlaporan_masyarakat"]);
        return $this->db->update("laporan_masyarakat",$data);
    }

    public function hapus_laporan_facebook($id) {
        return $this->db->where("id_laporan_facebook",$id)->delete("laporan_facebook");
    }

    public function ambil_gambar_laporan($id) {
        $gambar = $this->db->select("file_attach")->from("laporan_masyarakat")->where("idlaporan_masyarakat",$id)->get()->row()->file_attach;
        return $gambar;
    }

    public function hitung_laporan($where) {
        $this->db->where($where);
        return $this->db->get("laporan_masyarakat")->num_rows();
    }

    public function ambil_jumlah_data($type = "all") {

        $userdata = $this->session->userdata();

        if(isset($userdata["idpengguna"])) {
            if($userdata["bagian"] != "root" && $userdata["bagian"] != "walikota" && $userdata["bagian"] != "ccenter") {

                if($userdata["bagian"] == "camat")
                    $ftu["laporan_masyarakat.idkecamatan"] = $userdata["idkecamatan"];
                elseif($userdata["bagian"] == "lurah")
                    $ftu["laporan_masyarakat.idkelurahan"] = $userdata["idkelurahan"];
                elseif($userdata["bagian"] == "department")
                    $ftu["laporan_masyarakat.idkategori_laporan"] = $userdata["idkategori_laporan"];

                $this->db->where($ftu);
            }
        }

        if($type != "all") {
            if($type == "proses") {
                $this->db->select("COUNT(*) AS jumlah, DATE(waktu_submit_proses) AS waktu_laporan");
                $whereStatus = "(laporan_masyarakat.status = '".$type."' OR laporan_masyarakat.tindakan_proses IS NOT NULL)";
                $this->db->where($whereStatus);
                $this->db->group_by("DATE(waktu_submit_proses)");
            } else {
                $this->db->select("COUNT(*) AS jumlah, DATE(waktu_submit_selesai) AS waktu_laporan");
                $whereStatus = "(laporan_masyarakat.status = '".$type."' OR laporan_masyarakat.tindakan_selesai IS NOT NULL)";
                $this->db->where($whereStatus);
                $this->db->where("laporan_masyarakat.status",$type);

                $this->db->group_by("DATE(waktu_submit_selesai)");
            }
        } else {
            $this->db->select("COUNT(*) AS jumlah, DATE(waktu_approve) AS waktu_laporan");
            $this->db->group_by("DATE(waktu_approve)");
        }
        $this->db->from("laporan_masyarakat");
        $this->db->where("approve",1);
        $data = $this->db->get()->result();
        return $data;
    }

    public function hitung_per_kecamatan($status) {

        $userdata = $this->session->userdata();

        if(isset($userdata["idpengguna"])) {
            if($userdata["bagian"] != "root" && $userdata["bagian"] != "walikota" && $userdata["bagian"] != "ccenter") {

                if($userdata["bagian"] == "camat")
                    $ftu["laporan_masyarakat.idkecamatan"] = $userdata["idkecamatan"];
                elseif($userdata["bagian"] == "lurah")
                    $ftu["laporan_masyarakat.idkelurahan"] = $userdata["idkelurahan"];
                elseif($userdata["bagian"] == "department")
                    $ftu["laporan_masyarakat.idkategori_laporan"] = $userdata["idkategori_laporan"];

                $this->db->where($ftu);
            }
        }

        if($status != "all")
            $this->db->where("laporan_masyarakat.status",$status);

        $this->db->select("COUNT(laporan_masyarakat.idlaporan_masyarakat) AS jumlah, kecamatan.nama_kecamatan");
        $this->db->from("laporan_masyarakat");
        $this->db->join("kecamatan","laporan_masyarakat.idkecamatan = kecamatan.idkecamatan","left");
        $this->db->group_by("kecamatan.nama_kecamatan");
        return $this->db->get()->result();
    }

    public function hitung_per_kelurahan($idkecamatan,$status) {

        $userdata = $this->session->userdata();

        if(isset($userdata["idpengguna"])) {
            if($userdata["bagian"] != "root" && $userdata["bagian"] != "walikota" && $userdata["bagian"] != "ccenter") {

                if($userdata["bagian"] == "camat")
                    $ftu["laporan_masyarakat.idkecamatan"] = $userdata["idkecamatan"];
                elseif($userdata["bagian"] == "lurah")
                    $ftu["laporan_masyarakat.idkelurahan"] = $userdata["idkelurahan"];
                elseif($userdata["bagian"] == "department")
                    $ftu["laporan_masyarakat.idkategori_laporan"] = $userdata["idkategori_laporan"];

                $this->db->where($ftu);
            }
        }

        if($status != "all")
            $this->db->where("laporan_masyarakat.status",$status);

        $this->db->where("kelurahan.idkecamatan",$idkecamatan);

        $this->db->select("COUNT(laporan_masyarakat.idlaporan_masyarakat) AS jumlah, kelurahan.nama_kelurahan");
        $this->db->from("laporan_masyarakat");
        $this->db->join("kelurahan","laporan_masyarakat.idkelurahan = kelurahan.idkelurahan","left");
        $this->db->group_by("kelurahan.nama_kelurahan");
        return $this->db->get()->result();
    }


}