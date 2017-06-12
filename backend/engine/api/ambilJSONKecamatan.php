<?php
require_once "../init.php";

echo json_encode(array("kecamatan" => $wilayah->ambilKecamatan()));