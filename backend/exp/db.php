<?php

class database {

	private $db;

	public function __construct() {

		try{
			$this->db = new PDO("mysql:host=localhost;dbname=laporan_revisi","root","sherlocked221b#$;");
		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}

	public function update(Array $batch) {

		foreach($batch as $data) {
			$query = $this->db->prepare("INSERT INTO `laporan_facebook`(`id_post`,`id_user`,`nama_user`,`message`,`waktu`) VALUES (:ip,:iu,:nu,:msg,:wk)");
			$query->bindParam(":ip",$data["id_post"]);
			$query->bindParam(":iu",$data["id_user"]);
			$query->bindParam(":nu",$data["nama_user"]);
			$query->bindParam(":msg",$data["message"]);
			$query->bindParam(":wk",$data["waktu"]);

			$query->execute();
		}
	}

	public function ambil() {
		$query = $this->db->prepare("SELECT * FROM `laporan_facebook` ORDER BY `waktu` DESC");
		if($query->execute()) {
			if($query->rowCount() > 0) {
				$data = $query->fetchAll(PDO::FETCH_ASSOC);
				return $data;
			} else return false;
		}
	}

}
