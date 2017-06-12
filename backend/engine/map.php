<?php


class map extends core {

  public function ambilKoordinat() {
    // $query = $this->db->prepare("SELECT * FROM `laporan_masyarakat` WHERE `web_post` = 0 AND `latitude` != 0");
    $query = $this->db->prepare("
      SELECT
      laporan_masyarakat.*,
      kategori_laporan.nama_kategori,
      kategori_laporan.eta_enabled,
      kecamatan.nama_kecamatan,
      kelurahan.nama_kelurahan
      FROM laporan_masyarakat LEFT JOIN
      kategori_laporan ON
      laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan
      LEFT JOIN kecamatan
      ON laporan_masyarakat.idkecamatan = kecamatan.idkecamatan
      LEFT JOIN kelurahan
      ON laporan_masyarakat.idkelurahan = kelurahan.idkelurahan
      WHERE laporan_masyarakat.web_post = 0 AND laporan_masyarakat.latitude != 0;
    ");
    if($query->execute()) {
      if($query->rowCount() > 0) {
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($data);
      }
    } else {
      var_dump($query->errorInfo());
      exit();
    }
  }

}
