<?php
require_once "../init.php";
//$helper->logged_out_protect();
if(isset($_GET["idkecamatan"])) {
  $kelurahan = $wilayah->ambilKelurahan($_GET["idkecamatan"]);
  if($kelurahan != false) {
    echo json_encode(array("kelurahan"=>$kelurahan));
  } else {
    echo "gagal";
  }
}
