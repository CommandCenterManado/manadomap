<?php
require_once "../init.php";
$helper->logged_out_protect();
$input = file_get_contents("php://input");
$post = json_decode($input);
if(isset($post->idkategori_laporan) && isset($post->nama_kategori) && isset($post->icon) && isset($post->eta_enabled)) {
	$cond = $laporan->editKategori($post->idkategori_laporan,$post->nama_kategori,$post->icon,$post->eta_enabled);
	echo json_encode($cond);
} else {
	var_dump($post);
}