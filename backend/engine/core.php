<?php

class core {

  protected $db;

  public function __construct() {
    try {
      $this->db = new PDO("mysql:host=localhost;dbname=laporan_revisi","root","sherlocked221b#$;");
    } catch (Exception $e) {
      echo $e->getMessage();
      exit();
    }
  }

}
