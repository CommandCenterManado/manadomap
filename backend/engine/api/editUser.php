<?php
require_once "../init.php";
$helper->logged_out_protect();
$input = file_get_contents("php://input");
$post = json_decode($input);
if(isset($post->nama_lengkap) && isset($post->username) && isset($post->super) && isset($post->bagian)) {

	$cond = $pengguna->editUser($post->nama_lengkap,$post->username,$post->idkategori_laporan,$post->idkecamatan,$post->idkelurahan,$post->bagian,$post->super,$post->idpengguna);

	header("Content-Type: application/json;charset=utf-8");
	echo json_encode($cond);
	
} else {
	
	echo json_encode(array("msg" => "failed"));
	
}