<?php
require_once "../init.php";
$helper->logged_out_protect();
if(isset($_GET["id"])) {
	echo $_GET["id"];
	$laporan->hapusLaporan($_GET["id"]);
}