<?php
require_once "../init.php";
$helper->logged_out_protect();
$input = file_get_contents("php://input");
$post = json_decode($input);
if(isset($post->nama_kategori) && isset($post->icon) && isset($post->eta_enabled)) {
	echo json_encode($laporan->simpanKategori($post->nama_kategori,$post->icon,$post->eta_enabled));
}