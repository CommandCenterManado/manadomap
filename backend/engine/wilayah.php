<?php

class wilayah extends core {

  public function ambilKecamatan() {
    $query = $this->db->prepare("SELECT * FROM kecamatan ORDER BY nama_kecamatan");
    if($query->execute()) {
      if($query->rowCount() > 0) {
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else return false;
    } else {
      var_dump($query->errorInfo());
      exit();
    }
  }

  public function ambilKelurahan($idkecamatan) {
    $query = $this->db->prepare("SELECT * FROM kelurahan WHERE idkecamatan = :id");
    $query->bindParam(":id",$idkecamatan);
    if($query->execute()) {
      if($query->rowCount() > 0) {
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        return false;
      }
    } else {
      var_dump($query->errorInfo());
      exit();
    }
  }

}
