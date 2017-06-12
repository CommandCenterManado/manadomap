<?php
require_once "../init.php";
$helper->logged_out_protect();
$input = file_get_contents("php://input");
$id = json_decode($input);
if(isset($id)) {

	$cond = $pengguna->hapusUser($id);

	header("Content-Type: application/json;charset=utf-8");
	echo json_encode($cond);
	
} else {
	
	echo json_encode(array("msg" => "failed"));
	
}