<?php
require_once "../init.php";
$helper->logged_out_protect();
header("Content-Type: application/json;charset=utf8");
echo json_encode($pengguna->ambilDaftarUser());