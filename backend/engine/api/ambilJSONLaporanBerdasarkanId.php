<?php
require_once "../init.php";
$helper->logged_out_protect();
if(isset($_GET["id"])) {
  $laporan->sudahBaca($_GET["id"]);
  echo $laporan->ambilJSONLaporanBerdasarkanId($_GET["id"]);
}
