<?php

class helper extends core {
  public function formatTime($time) {
    $tanggalSekarang = date("d-M-Y");
		$tanggal = date("d-M-Y",strtotime($time));
		if($tanggalSekarang == $tanggal) {
			return "Hari ini - ".date("H:i",strtotime($time));
		} else {
			return date("d-M-Y H:i",strtotime($time));
		}
  }
  public function logged_out_protect() {
    if(!$this->is_login()) {
      header("location: login.php");
      exit();
    }
  }
  public function logged_in_protect() {
    if($this->is_login()) {
      header("location: list.php");
      exit();
    }
  }

  public function is_login() {
    return (isset($_SESSION["idpengguna"])) ? true : false;
  }
}
