<?php
require_once "core.php";
if(!isset($_POST["nama_lengkap"])) {
	exit("Anda tidak punya akses ke halaman ini!");
	die();
} else {

  $nama_lengkap = $_POST["nama_lengkap"];
  $alamat_lengkap = $_POST["alamat_lengkap"];
  $no_telp = $_POST["no_telp"];
  $email_pelapor = $_POST["email_pelapor"];
  $kategori = $_POST["kategori"];
  $isi_laporan = $_POST["isi_laporan"];
	$lat = $_POST["latitude"];
	$lng = $_POST["longitude"];

	$encoded_string = $_POST["string_gambar"];
	$image_name = $_POST["nama_gambar"];

	$decoded_string = base64_decode($encoded_string);
	$path = "../files/laporan/".$image_name;

	$file = fopen($path,"wb");
	$is_written = fwrite($file,$decoded_string);
	fclose($file);

	$query = $conn->prepare("
    INSERT INTO laporan_masyarakat(nama_pelapor,alamat_pelapor,nomorhp_pelapor,email_pelapor,idkategori_laporan,isi_laporan,web_post,file_attach,latitude,longitude) VALUES (:np,:ap,:nhp,:em,:kat,:is,:wb,:fl,:lat,:lng);
  ");

  $web_post = 0;
  $query->bindParam(":np",$nama_lengkap);
  $query->bindParam(":ap",$alamat_lengkap);
  $query->bindParam(":nhp",$no_telp);
  $query->bindParam(":em",$email_pelapor);
  $query->bindParam(":kat",$kategori);
  $query->bindParam(":is",$isi_laporan);
  $query->bindParam(":wb",$web_post);
  $query->bindParam(":fl",$image_name);
	$query->bindParam(":lat",$lat);
	$query->bindParam(":lng",$lng);

	if($query->execute()) {
		if($query->rowCount() > 0) {
			$lastID = $conn->lastInsertId();
			$id = ($lastID > 9) ? $lastID : "0".$lastID;
			$kategori = ($kategori > 9) ? $kategori : "0".$kategori;
			$year = date("y");
			$nomor = $year."/".$id."-".$kategori."-".rand(10,99);
			$query = $conn->prepare("
				UPDATE laporan_masyarakat
				SET nomor_laporan = :nl
				WHERE idlaporan_masyarakat = :id
			");
			$query->bindParam(":nl",$nomor);
			$query->bindParam(":id",$id);
			if($query->execute()) {
				if($query->rowCount() > 0) {
					$data = array(
						"status" => "ok",
						"nomor" => $nomor
					);
				} else {
					$data = array(
						"status" => "error",
						"nomor" => "0"
					);
				}
				echo json_encode($data);
			} else {
				var_dump($query->errorInfo());
				exit();
			}
    } else {
			echo "gagal";
    }
	} else {
		var_dump($query->errorInfo());
		exit();
	}
}
