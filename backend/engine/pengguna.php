<?php

class pengguna extends core
{
    private $nama_lengkap;
    private $username;
    private $password;

    public function set_password($p)
    {
        $this->password = $p;
    }

    public function get_nama_lengkap()
    {
        return $this->nama_lengkap;
    }

    public function set_nama_lengkap($n)
    {
        $this->nama_lengkap = $n;
    }

    public function get_username()
    {
        return $this->username;
    }

    public function set_username($u)
    {
        $this->username = $u;
    }

    public function login()
    {
        $query = $this->db->prepare("
      SELECT `pengguna`.*,`kategori_laporan`.`nama_kategori`,`kecamatan`.`nama_kecamatan`,`kelurahan`.`nama_kelurahan` FROM `pengguna` LEFT JOIN `kategori_laporan` ON `pengguna`.`idkategori_laporan` = `kategori_laporan`.`idkategori_laporan` LEFT JOIN `kecamatan` ON `pengguna`.`idkecamatan` = `kecamatan`.`idkecamatan` LEFT JOIN `kelurahan` ON `pengguna`.`idkelurahan` = `kelurahan`.`idkelurahan` WHERE `pengguna`.`username` = :username AND `pengguna`.`password` = :password
    ");
        $query->bindParam(":username", $this->username);
        $query->bindParam(":password", md5($this->password));

        if ($query->execute()) {
            if ($query->rowCount() > 0) {
                $data = $query->fetch(PDO::FETCH_ASSOC);
                $_SESSION["idpengguna"] = $data["idpengguna"];
                $_SESSION["nama_lengkap"] = $data["nama_lengkap"];
                $_SESSION["username"] = $data["username"];
                $_SESSION["idkelurahan"] = $data["idkelurahan"];
                $_SESSION["idkecamatan"] = $data["idkecamatan"];
                $_SESSION["idkategori_laporan"] = $data["idkategori_laporan"];
                $_SESSION["super"] = $data["super"];
                $_SESSION["bagian"] = $data["bagian"];
                $_SESSION["nama_kategori"] = $data["nama_kategori"];
                $_SESSION["nama_kecamatan"] = $data["nama_kecamatan"];
                $_SESSION["nama_kelurahan"] = $data["nama_kelurahan"];
                $this->set_nama_lengkap($data["nama_lengkap"]);
                return true;
            } else {
                return false;
            }
        } else {
            var_dump($query->errorInfo());
            exit();
        }
    }

    public function ambilLaporan()
    {
        if ($_SESSION["bagian"] == "camat") {
            $query = $this->db->prepare("SELECT laporan_masyarakat.*,kategori_laporan.nama_kategori,kategori_laporan.icon,kategori_laporan.eta_enabled,kecamatan.nama_kecamatan,kelurahan.nama_kelurahan FROM laporan_masyarakat LEFT JOIN kategori_laporan ON laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan WHERE laporan_masyarakat.idkecamatan = :kec ORDER BY laporan_masyarakat.waktu_laporan DESC");
            $query->bindParam(":kec", $_SESSION["idkecamatan"]);
        } elseif ($_SESSION["bagian"] == "lurah") {
            $query = $this->db->prepare("SELECT laporan_masyarakat.*,kategori_laporan.nama_kategori,kategori_laporan.icon,kategori_laporan.eta_enabled,kecamatan.nama_kecamatan,kelurahan.nama_kelurahan FROM laporan_masyarakat LEFT JOIN kategori_laporan ON laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan LEFT JOIN kecamatan ON laporan_masyarakat.idkecamatan = kecamatan.idkecamatan LEFT JOIN kelurahan ON laporan_masyarakat.idkelurahan = kelurahan.idkelurahan WHERE laporan_masyarakat.idkelurahan = :kel ORDER BY laporan_masyarakat.waktu_laporan DESC");
            $query->bindParam(":kel", $_SESSION["idkelurahan"]);
        } elseif ($_SESSION["bagian"] == "walikota" && $_SESSION["super"] == 1) {
            $query = $this->db->prepare("SELECT laporan_masyarakat.*,kategori_laporan.nama_kategori,kategori_laporan.icon,kategori_laporan.eta_enabled,kecamatan.nama_kecamatan,kelurahan.nama_kelurahan FROM laporan_masyarakat LEFT JOIN kategori_laporan ON laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan LEFT JOIN kecamatan ON laporan_masyarakat.idkecamatan = kecamatan.idkecamatan LEFT JOIN kelurahan ON laporan_masyarakat.idkelurahan = kelurahan.idkelurahan ORDER BY laporan_masyarakat.waktu_laporan DESC");
        } elseif ($_SESSION["bagian"] == "department") {
            $query = $this->db->prepare("SELECT laporan_masyarakat.*,kategori_laporan.nama_kategori,kategori_laporan.icon,kategori_laporan.eta_enabled,kecamatan.nama_kecamatan,kelurahan.nama_kelurahan FROM laporan_masyarakat LEFT JOIN kategori_laporan ON laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan LEFT JOIN kecamatan ON laporan_masyarakat.idkecamatan = kecamatan.idkecamatan LEFT JOIN kelurahan ON laporan_masyarakat.idkelurahan = kelurahan.idkelurahan WHERE laporan_masyarakat.idkategori_laporan = :kat ORDER BY laporan_masyarakat.waktu_laporan DESC");
            $query->bindParam(":kat", $_SESSION["idkategori_laporan"]);
        } else {
            $query = $this->db->prepare("SELECT laporan_masyarakat.*,kategori_laporan.nama_kategori,kategori_laporan.icon,kategori_laporan.eta_enabled,kecamatan.nama_kecamatan,kelurahan.nama_kelurahan FROM laporan_masyarakat LEFT JOIN kategori_laporan ON laporan_masyarakat.idkategori_laporan = kategori_laporan.idkategori_laporan LEFT JOIN kecamatan ON laporan_masyarakat.idkecamatan = kecamatan.idkecamatan LEFT JOIN kelurahan ON laporan_masyarakat.idkelurahan = kelurahan.idkelurahan ORDER BY laporan_masyarakat.waktu_laporan DESC");
        }
        if ($query->execute()) {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } else {
            var_dump($query->errorInfo());
            exit();
        }
    }

    public function ambilDaftarUser()
    {
        $query = $this->db->prepare("
		SELECT pengguna.*,
		kategori_laporan.nama_kategori,
		kecamatan.nama_kecamatan,
		kelurahan.nama_kelurahan
		FROM pengguna
		LEFT JOIN kategori_laporan ON pengguna.idkategori_laporan = kategori_laporan.idkategori_laporan
		LEFT JOIN kecamatan ON pengguna.idkecamatan = kecamatan.idkecamatan 
		LEFT JOIN kelurahan ON pengguna.idkelurahan = kelurahan.idkelurahan
	  ");

        if ($query->execute()) {
            if ($query->rowCount()) {
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

    public function simpanUser($nama_lengkap, $username, $password, $idkategori_laporan, $idkecamatan, $idkelurahan, $bagian, $super)
    {

        $query = $this->db->prepare("INSERT INTO pengguna (nama_lengkap,username,password,idkategori_laporan,idkecamatan,idkelurahan,bagian,super) VALUES (:nl,:us,:ps,:kat,:kec,:kel,:bag,:lelel)");

        $query->bindParam(":nl", $nama_lengkap);
        $query->bindParam(":us", $username);
        $query->bindParam(":ps", md5($password));
        $query->bindParam(":kat", $idkategori_laporan);
        $query->bindParam(":kec", $idkecamatan);
        $query->bindParam(":kel", $idkelurahan);
        $query->bindParam(":bag", $bagian);
        $query->bindParam(":lelel", $super);

        if ($query->execute()) {
            return ($query->rowCount() > 0) ? array("msg" => $this->db->lastInsertId()) : array("msg" => "failed");
        } else {
            var_dump($query->errorInfo());
            exit();
        }

    }


    public function editUser($nama_lengkap, $username, $idkategori_laporan, $idkecamatan, $idkelurahan, $bagian, $super, $idpengguna)
    {

        $query = $this->db->prepare("UPDATE pengguna SET nama_lengkap = :nl,username = :us,idkategori_laporan = :kat,idkecamatan = :kec,idkelurahan = :kel,bagian = :bag,super = :lelel WHERE idpengguna = :id");

        $query->bindParam(":nl", $nama_lengkap);
        $query->bindParam(":us", $username);
        $query->bindParam(":kat", $idkategori_laporan);
        $query->bindParam(":kec", $idkecamatan);
        $query->bindParam(":kel", $idkelurahan);
        $query->bindParam(":bag", $bagian);
        $query->bindParam(":lelel", $super);
        $query->bindParam(":id", $idpengguna);

        if ($query->execute()) {
            return ($query->rowCount() > 0) ? array("msg" => "success") : array("msg" => "failed");
        } else {
            var_dump($query->errorInfo());
            exit();
        }

    }

    public function hapusUser($id)
    {
        $query = $this->db->prepare("DELETE FROM pengguna WHERE idpengguna = :id");
        $query->bindParam(":id", $id);

        if ($query->execute()) {
            return ($query->rowCount() > 0) ? array("msg" => "success") : array("msg" => "failed");
        } else {
            var_dump($query->errorInfo());
            exit();
        }
    }


}
