<?php
session_start();
header("Content-Type: application/json;charset=utf-8");
if(isset($_SESSION["idpengguna"])) {
  echo json_encode(array("user" => $_SESSION));
} else {
  echo json_encode(array("user" => "none"));
}
