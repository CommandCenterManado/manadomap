<?php
session_start();
ob_start();
function autoloader($class) {
  include_once $class.".php";
}

spl_autoload_register("autoloader");

try {
  $core = new core();
  $laporan = new laporan();
  $helper = new helper();
  $pengguna = new pengguna();
  $map = new map();
  $wilayah = new wilayah();
} catch (Exception $e) {
  echo $e->getMessage();
  exit();
}
