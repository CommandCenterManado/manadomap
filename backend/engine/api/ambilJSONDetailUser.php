<?php
require_once "../init.php";
$helper->logged_out_protect();
echo json_encode($_SESSION);
