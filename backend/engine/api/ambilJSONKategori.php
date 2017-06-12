<?php

$conn = new PDO("mysql:host=localhost;dbname=laporan_revisi","root","sherlocked221b#$;");

$query = $conn->prepare("SELECT * FROM kategori_laporan ORDER BY idkategori_laporan DESC");

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
