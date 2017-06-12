<?php


class Pengguna_model extends CI_Model {

    public function ambil_data($username,$password) {
        $this->db->select("idpengguna,username,nama_lengkap,idkelurahan,idkecamatan,idkategori_laporan,super,bagian");
        $this->db->where("username",$username);
        $this->db->where("password",md5($password));
        $this->db->from("pengguna");

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->row_array();
        } else return false;
    }

    public function ambil_pengguna() {
        $this->db->select("pengguna.*");
        $this->db->select("kecamatan.nama_kecamatan");
        $this->db->select("kelurahan.nama_kelurahan");
        $this->db->select("kategori_laporan.nama_kategori");
        $this->db->select("kategori_laporan.icon");

        $this->db->join("kecamatan","pengguna.idkecamatan = kecamatan.idkecamatan","left");
        $this->db->join("kelurahan","pengguna.idkelurahan = kelurahan.idkelurahan","left");
        $this->db->join("kategori_laporan","pengguna.idkategori_laporan = kategori_laporan.idkategori_laporan","left");

        $this->db->from("pengguna");

        return $this->db->get()->result();
    }

    public function ambil_satu($id) {
        $this->db->select("pengguna.idpengguna");
        $this->db->select("pengguna.nama_lengkap");
        $this->db->select("pengguna.bagian");
        $this->db->select("kecamatan.nama_kecamatan");
        $this->db->select("kelurahan.nama_kelurahan");
        $this->db->select("kategori_laporan.nama_kategori");
        $this->db->select("kategori_laporan.icon");

        $this->db->join("kecamatan","pengguna.idkecamatan = kecamatan.idkecamatan","left");
        $this->db->join("kelurahan","pengguna.idkelurahan = kelurahan.idkelurahan","left");
        $this->db->join("kategori_laporan","pengguna.idkategori_laporan = kategori_laporan.idkategori_laporan","left");

        $this->db->where("pengguna.idpengguna",$id);

        $this->db->from("pengguna");

        return $this->db->get()->row();
    }

    public function tambah_pengguna($post) {
        if($post["bagian"] == "root" || $post["bagian"] == "walikota") {
            unset($post["idkelurahan"]);
            unset($post["idkecamatan"]);
            unset($post["idkategori_laporan"]);
        } elseif($post["bagian"] == "camat") {
            unset($post["idkelurahan"]);
            unset($post["idkategori_laporan"]);
        } elseif($post["bagian"] == "lurah") {
            unset($post["idkategori_laporan"]);
            unset($post["idkecamatan"]);
        } elseif($post["bagian"] == "department") {
            unset($post["idkecamatan"]);
            unset($post["idkelurahan"]);
        }
        $post["password"] = md5($post["password"]);

        return $this->db->insert("pengguna",$post);
    }

    public function hapus_pengguna($id) {
        return $this->db->where("idpengguna",$id)->delete("pengguna");
    }

    public function edit_pengguna($post) {
        $this->db->where("idpengguna",$post["idpengguna"]);

        if($post["bagian"] == "root" || $post["bagian"] == "walikota") {
            $post["idkelurahan"] = NULL;
            $post["idkecamatan"] = NULL;
            $post["idkategori_laporan"] = NULL;
        } elseif($post["bagian"] == "camat") {
            $post["idkelurahan"] = NULL;
            $post["idkategori_laporan"] = NULL;
        } elseif($post["bagian"] == "lurah") {
            $post["idkategori_laporan"] = NULL;
            $post["idkecamatan"] = NULL;
        } elseif($post["bagian"] == "department") {
            $post["idkecamatan"] = NULL;
            $post["idkelurahan"] = NULL;
        }

        if(isset($post["password"]))
            $post["password"] = md5($post["password"]);

        return $this->db->update("pengguna",$post);
    }

}