<?php
require_once "../init.php";
$data = $pengguna->ambilLaporan();
$tanggal = array();

$daftarLaporan = array();

foreach($data as $value) {
$tanggal[] = explode(" ",$value["waktu_laporan"])[0];
}

foreach($tanggal as $hari) {
$daftarLaporan[$hari] = search($data,"waktu_laporan",$hari);
}
function search($array,$key,$value) {
  $results = array();
  if(is_array($array)) {
    if(isset($array[$key]) && explode(" ",$array[$key])[0] == $value) {
      $results[] = $array;
    }
    foreach($array as $subarray) {
      $results = array_merge($results,search($subarray,$key,$value));
    }
  }
  return $results;
}
$hasilakhir = array("list" => $data,"group" => $daftarLaporan);

echo json_encode($hasilakhir);