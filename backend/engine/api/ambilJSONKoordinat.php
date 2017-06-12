<?php
require_once "../init.php";
//$helper->logged_out_protect();
  $koord = $map->ambilKoordinat();
  if($koord != false) {
    echo json_encode($koord);
  } else {
    echo "gagal";
  }
