<?php

class Lokasi_model extends CI_Model {

    public function ambil_kecamatan() {
        $query = $this->db->get("kecamatan");
        return $query->result();
    }

    public function ambil_kelurahan($idkecamatan) {
        $this->db->where("idkecamatan",$idkecamatan);
        $query = $this->db->get("kelurahan");
        return $query->result();
    }

    public function ambil_satu_kelurahan($idkelurahan) {
        return $this->db->where("idkelurahan",$idkelurahan)->get("kelurahan")->row();
    }

    public function ambil_satu_kecamatan($idkecamatan) {
        return $this->db->where("idkecamatan",$idkecamatan)->get("kecamatan")->row();
    }

}