<?php
session_start();
require_once __DIR__ . "/src/Facebook/autoload.php";
$fb = new Facebook\Facebook([
    "app_id" => "1801394613445272",
    "app_secret" => "dbe6640af8cd7787730e5322e00f6aea",
    "default_graph_version" => "v2.8"
]);

$helper = $fb->getRedirectLoginHelper();
$loginUrl = $helper->getLoginUrl("http://laporan.manadokota.go.id/exp/facebook.php");

header("Location: " . $loginUrl);
exit();