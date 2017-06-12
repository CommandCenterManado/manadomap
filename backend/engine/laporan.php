<?php

class laporan extends core {

  private $nama_pelapor;
  private $alamat_pelapor;
  private $nohp_pelapor;
  private $kategori;
  private $isi;
  private $attach;

  public function get_nama_pelapor() {
    return $this->nama_pelapor;
  }
  public function get_alamat_pelapor() {
    return $this->alamat_pelapor;
  }
  public function get_nohp_pelapor() {
    return $this->nohp_pelapor;
  }
  public function get_kategori() {
    return $this->kategori;
  }
  public function get_isi() {
    return $this->isi;
  }
  public function get_attach() {
    return $this->attach;
  }

  public function ambilDaftarKategori() {
    $query = $this->db->prepare("SELECT * FROM kategori_laporan ORDER BY nama_kategori");
    if($query->execute()) {
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    } else {
      var_dump($query->errorInfo());
      exit();
    }
  }

  public function ambilDataLaporanBerdasarkanNomor($nomor) {
    $query = $this->db->prepare("
      SELECT
      laporan_masyarakat.*,
      kategori_laporan.nama_kategori,
      kategori_laporan.icon,
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
      WHERE laporan_masyarakat.nomor_laporan = :nl
    ");
    $query->bindParam(":nl",$nomor);
    if($query->execute()) {
      if($query->rowCount() > 0) {
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
      } else {
        return false;
      }
    } else {
      var_dump($query->errorInfo());
      exit();
    }
  }

  public function ambilJSONLaporanBerdasarkanId($id) {
    $query = $this->db->prepare("
      SELECT
      laporan_masyarakat.*,
      kategori_laporan.nama_kategori,
      kategori_laporan.icon,
      kategori_laporan.eta_enabled,
      kecamatan.nama_kecamatan,
      kelurahan.nama_kelurahan
      FROM laporan_masyarakat LEFT JOIN
      kategori_laporan
      ON laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan
      LEFT JOIN kecamatan
      ON laporan_masyarakat.idkecamatan = kecamatan.idkecamatan
      LEFT JOIN kelurahan
      ON laporan_masyarakat.idkelurahan = kelurahan.idkelurahan
      WHERE laporan_masyarakat.idlaporan_masyarakat = :id
    ");
    $query->bindParam(":id",$id);
    if($query->execute()) {
      if($query->rowCount() > 0) {
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return json_encode($data);
      } else {
        return json_encode(array("msg"=>"error"));
      }
    } else {
      var_dump($query->errorInfo());
      exit();
    }
  }

  public function kirimLaporan($nama,$email,$alamat,$tkp,$nohp,$kategori,$isi,$attach) {
    if($nama != "" && $alamat != "" && $tkp != "" && $nohp != "" && $kategori != "" && $isi != "" && $attach != null) {

      $namaBaru = $this->uploadAttach($attach,"laporan");
      if($namaBaru != false):
        $query = $this->db->prepare("
          INSERT INTO laporan_masyarakat (nama_pelapor,email_pelapor,alamat_pelapor,alamat_kejadian,nomorhp_pelapor,idkategori_laporan,isi_laporan,file_attach) VALUES (:np,:em,:ap,:ak,:nhp,:kt,:is,:fa);
        ");
        $query->bindParam(":np",$nama);
        $query->bindParam(":em",$email);
        $query->bindParam(":ap",$alamat);
        $query->bindParam(":ak",$tkp);
        $query->bindParam(":nhp",$nohp);
        $query->bindParam(":kt",$kategori);
        $query->bindParam(":is",$isi);
        $query->bindParam(":fa",$namaBaru);

        if($query->execute()) {
          if($query->rowCount() > 0):
            $lastID = $this->db->lastInsertId();
            $id = ($lastID > 9) ? $lastID : "0".$lastID;
            $kategori = ($kategori > 9) ? $kategori : "0".$kategori;
            $year = date("y");
            $nomor = $year."/".$id."-".$kategori."-".rand(10,99)."-";
            $query = $this->db->prepare("
              UPDATE laporan_masyarakat
              SET nomor_laporan = :nl
              WHERE idlaporan_masyarakat = :id;
            ");
            $query->bindParam(":nl",$nomor);
            $query->bindParam(":id",$lastID);
            if($query->execute()) {
              return ($query->rowCount() > 0) ? true : false;
            } else {
              var_dump($query->errorInfo());
              exit();
            }
          endif;
        } else {
          var_dump($query->errorInfo());
          exit();
        }
      endif;

    } else {
      return false;
    }
  }

  private function uploadAttach($file,$tipe) {
    $tipeDiizinkan = array("png","jpg","jpeg","bmp","gif");
    $tipeFile = end(explode(".",$file["name"]));
    if(in_array($tipeFile,$tipeDiizinkan)) {
      $namaBaru = sha1(time().$file["name"]).".".$tipeFile;
      $folderUpload = "files/".$tipe."/";
      $cond = copy($file["tmp_name"],$folderUpload.$namaBaru);
      return ($cond === true) ? $namaBaru : false;
    } else {
      return false;
    }
  }

  public function ambilLaporanBerdasarkanKategori($idkategori) {
    $query = $this->db->prepare("SELECT * FROM laporan_masyarakat WHERE kategori_laporan = :kat");
    $query->bindParam(":kat",$idkategori);
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

  public function ambilLaporanBerdasarkanPlatform($platform) {
    $query = $this->db->prepare("SELECT * FROM laporan_masyarakat WHERE web_post = :plat");
    $query->bindParam(":plat",$platform);

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

  public function ambilLaporan($limit = 0,$offset = 0) {
    if($limit == 0) {
      $query = $this->db->prepare("
        SELECT
        laporan_masyarakat.*,
        kategori_laporan.nama_kategori,
        kategori_laporan.icon,
        kategori_laporan.eta_enabled
        FROM laporan_masyarakat LEFT JOIN kategori_laporan ON laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan ORDER BY waktu_laporan DESC
      ");
      if($query->execute()) {
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        var_dump($query->errorInfo());
        exit();
      }
    } else {
      $query = $this->db->prepare("
        SELECT
        laporan_masyarakat.*,
        kategori_laporan.nama_kategori,
        kategori_laporan.icon,
        kategori_laporan.eta_enabled
        FROM laporan_masyarakat LEFT JOIN kategori_laporan ON laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan ORDER BY waktu_laporan DESC LIMIT $limit
      ");
      if($query->execute()) {
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else {
        var_dump($query->errorInfo());
        exit();
      }
    }
  }

  public function updateLaporan($id,$status,$etahari,$etajam,$isi,$file) {
    if($id != "" && $status != "" && $isi != "" && $file != null) {
      $namaBaru = $this->uploadAttach($file,"respon");
      $etahari = ($status == "proses") ? $etahari : null;
      $etajam = ($status == "proses") ? $etajam : null;
      $fileField = ($status == "proses") ? "file_respon_proses" : "file_respon_selesai";
      $responField = ($status == "proses") ? "tindakan_proses" : "tindakan_selesai";
      $query = $this->db->prepare("
        UPDATE laporan_masyarakat
        SET status = :st,
        pengerjaan_hari = :eth,
        pengerjaan_jam = :ejm,
        $responField = :td,
        $fileField = :fl
        WHERE idlaporan_masyarakat = :id
      ");
      $query->bindParam(":st",$status);
      $query->bindParam(":eth",$etahari);
      $query->bindParam(":ejm",$etajam);
      $query->bindParam(":td",$isi);
      $query->bindParam(":fl",$namaBaru);
      $query->bindParam(":id",$id);

      if($query->execute()) {
        return ($query->rowCount() > 0) ? true : false;
      } else {
        var_dump($query->errorInfo());
        exit();
      }

    } else {
      return false;
    }
  }

  public function sudahBaca($id) {
    $query = $this->db->prepare("UPDATE laporan_masyarakat SET dibaca = 1 WHERE idlaporan_masyarakat = :id");
    $query->bindParam(":id",$id);
    if($query->execute()) {
      return true;
    } else {
      var_dump($query->errorInfo());
      exit();
    }
  }
  
  public function hapusLaporan($id) {
	  $query = $this->db->prepare("DELETE FROM laporan_masyarakat WHERE idlaporan_masyarakat = :id");
	  $query->bindParam(":id",$id);
	  
	  if($query->execute()) {
		  return ($query->rowCount());
	  } else {
		  var_dump($query->errorInfo());
		  exit();
	  }
  }

  public function simpanKategori($nama_kategori,$icon,$eta_enabled) {
	  $query = $this->db->prepare("
		INSERT INTO kategori_laporan(nama_kategori,icon,eta_enabled)
		VALUES (:nm,:ic,:et);
	  ");
	  $query->bindParam(":nm",$nama_kategori);
	  $query->bindParam(":ic",$icon);
	  $query->bindParam(":et",$eta_enabled);
	  
	  if($query->execute()) {
		  if($query->rowCount() > 0) {
			  return array("status" => "ok","msg"=>$this->db->lastInsertId());
		  } else {
			  return array("status" => "failed","msg"=>0);
		  }
	  } else {
		  var_dump($query->errorInfo());
		  exit();
	  }
  }
  
  public function hapusKategori($id) {
	  $query = $this->db->prepare("DELETE FROM kategori_laporan WHERE idkategori_laporan = :id");
	  $query->bindParam(":id",$id);
	  
	  if($query->execute()) {
		  if($query->rowCount() > 0) {
			  return array("status" => "ok");
		  } else {
			  return array("status" => "failed");
		  }
	  } else {
		  var_dump($query->errorInfo());
		  exit();
	  }
  }

  public function editKategori($id,$nama,$icon,$eta) {
    $query = $this->db->prepare("UPDATE kategori_laporan SET nama_kategori = :nm, icon = :ic, eta_enabled = :eta WHERE idkategori_laporan = :id");
    $query->bindParam(":nm",$nama);
    $query->bindParam(":ic",$icon);
    $query->bindParam(":eta",$eta);
    $query->bindParam(":id",$id);

    if($query->execute()) {
      if($query->rowCount() > 0) {
        return array("status" => "ok");
      } else {
        return array("status" => "failed");
      }
    } else {
      var_dump($query->errorInfo());
      exit();
    }
  }


  // Facebook
  public function ambilLaporanFacebook($limit,$cond) {
    $query = $this->db->prepare("SELECT * FROM `laporan_facebook` WHERE `approve` = :cond ORDER BY `waktu` DESC LIMIT :lm");
    $query->bindParam(":cond",$cond,PDO::PARAM_BOOL);
    $query->bindParam(":lm",$limit,PDO::PARAM_INT);

    if($query->execute()) {
      if($query->rowCount() > 0) {
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
      } else return false;
    } else {
      return false;
    }
  }

  public function approveLaporanFacebook($id) {
    $query = $this->db->prepare("UPDATE `laporan_facebook` SET `approve` = 1 WHERE `id_laporan_facebook` = :id");
    $query->bindParam(":id",$id);

    if($query->execute()) {
      return ($query->rowCount() > 0);
    } else return false;
  }

  public function simpanLaporanFacebook() {
    $post = json_decode(file_get_contents("php://input"));
    $file_attach = $this->parseGambar($post->gambar,$post->tipe_gambar);
    $web_post = 1;


    $this->approveLaporanFacebook($post->id_laporan_facebook);

    $query = $this->db->prepare("INSERT INTO `laporan_masyarakat`(`idkelurahan`,`idkecamatan`,`idkategori_laporan`,`nama_pelapor`,`alamat_pelapor`,`nomorhp_pelapor`,`email_pelapor`,`isi_laporan`,`file_attach`,`web_post`) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $bindParameter = array(
      $post->idkelurahan,
      $post->idkecamatan,
      $post->idkategori_laporan,
      $post->nama_pelapor,
      $post->alamat_pelapor,
      $post->nomorhp_pelapor,
      $post->email_pelapor,
      $post->isi_laporan,
      $file_attach,
      $web_post
    );
    if($query->execute($bindParameter)) {
      if($query->rowCount() > 0) {

        $lastID = $this->db->lastInsertId();
            $id = ($lastID > 9) ? $lastID : "0".$lastID;
            $kategori = ($post->idkategori_laporan > 9) ? $post->idkategori_laporan : "0".$post->idkategori_laporan;
            $year = date("y");
            $nomor = $year."/".$id."-".$kategori."-".rand(10,99)."-";
            $query = $this->db->prepare("
              UPDATE laporan_masyarakat
              SET nomor_laporan = :nl
              WHERE idlaporan_masyarakat = :id;
            ");
            $query->bindParam(":nl",$nomor);
            $query->bindParam(":id",$lastID);
            if($query->execute()) {
              return ($query->rowCount() > 0) ? true : false;
            } else {
              var_dump($query->errorInfo());
              exit();
            }

      } else return false;
    } else {
      var_dump($query->errorInfo());
      exit();
    }

  }

  private function parseGambar($gambar,$type) {
    $namaFile = md5(uniqid() . rand(0000,9999) . time());
    $ekstensi = ($type == "image/png") ? ".png" : ".jpg";
    $gambar = str_replace("data:" . $type . ";base64,","",$gambar);
    // echo __DIR__;exit();
    $file = __DIR__ . "/../files/laporan/" . $namaFile . $ekstensi;
    $real = base64_decode($gambar);
    $testUpload = file_put_contents($file, $real);
    return $namaFile . $ekstensi;
  }
  
}
