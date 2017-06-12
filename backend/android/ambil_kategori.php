<?php
require_once "core.php";

$query = $conn->prepare("SELECT * FROM kategori_laporan ORDER BY idkategori_laporan");

if($query->execute()) {
  $data = $query->fetchAll(PDO::FETCH_ASSOC);
  $jsonArray = array(
    "kategori" => $data
  );
  echo json_encode($jsonArray);
} else {
  var_dump($query->errorInfo());
  exit();
}
