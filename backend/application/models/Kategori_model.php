<?php

class Kategori_model extends CI_Model {

    public function ambil_kategori() {
        return $this->db->get("kategori_laporan")->result();
    }

    public function tambah_kategori($post) {
        return $this->db->insert("kategori_laporan",$post);
    }

    public function hapus_kategori($id) {
        return $this->db->where("idkategori_laporan",$id)->delete("kategori_laporan");
    }

    public function edit_kategori($data) {
        $this->db->where("idkategori_laporan",$data["idkategori_laporan"]);
        return $this->db->update("kategori_laporan",$data);
    }

}