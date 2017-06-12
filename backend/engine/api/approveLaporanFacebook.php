<?php
require_once "../init.php";
header("Content-Type: application/json;charset=utf-8");

if(!empty($_POST)) {
	if($laporan->approveLaporanFacebook()) {
		echo json_encode(array("status"=>"ok"));
	} else {
		echo json_encode(array("status"=>"gagal"));
	}	
} else {
	echo json_encode(array("status"=>"post null"));
}
