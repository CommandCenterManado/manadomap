<?php
require_once "../init.php";
$helper->logged_out_protect();
$input = file_get_contents("php://input");
$post = json_decode($input);
if(isset($post->idkategori_laporan)) {
	$cond = $laporan->hapusKategori($post->idkategori_laporan);
	echo json_encode($cond);
}