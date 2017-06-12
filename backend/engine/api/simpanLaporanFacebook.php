<?php
require_once "../init.php";
header("Content-Type: application/json;charset=utf-8");
// exit();
$post = json_decode(file_get_contents("php://input"));
if(!empty($post)) {
	if($laporan->simpanLaporanFacebook()) {
		echo json_encode(array("status"=>"ok"));
	} else {
		echo json_encode(array("status"=>"gagal"));
	}
} else {
		echo json_encode(array("status"=>"post null"));
}