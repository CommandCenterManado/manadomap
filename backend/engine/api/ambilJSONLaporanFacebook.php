<?php
require_once "../init.php";
header("Content-type: application/json;charset=utf-8");


// Post yg diambil cuma post yg blum di approve
// ?approve=0 kalo mo ambe yg blum diapprove, ?approve=1 kalo mo ambe yg so approve

$posts = $laporan->ambilLaporanFacebook(500,$_GET["approve"]); // <-- Ator limit post disini deng approve status

if($posts != false) {
	echo json_encode(array("data"=>$posts));
} else {
	echo json_encode(array("data"=>"post null"));
}