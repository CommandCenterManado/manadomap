<?php
session_start();
require_once "./db.php";
require_once __DIR__ . "/src/Facebook/autoload.php";

$db = new database();

$fb = new Facebook\Facebook([
    "app_id" => "1801394613445272",
    "app_secret" => "dbe6640af8cd7787730e5322e00f6aea",
    "default_graph_version" => "v2.8"
]);

$helper = $fb->getRedirectLoginHelper();

try {

    $accessToken = $helper->getAccessToken();
    $oAuth2Client = $fb->getOAuth2Client();
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

} catch(\Facebook\Exceptions\FacebookResponseException $e) {
    header("Location: ./getAccessToken.php");
    exit();
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
    header("Location: ./getAccessToken.php");
    echo "FacebookSDKException : " . $e->getMessage();
    exit();
}

$fb->setDefaultAccessToken($accessToken);

$request = $fb->request("GET","/1281072315296712/feed?fields=from,message,updated_time&include_hidden=true&show_expired=true");

try{
    $response = $fb->getClient()->sendRequest($request);
}catch (\Facebook\Exceptions\FacebookResponseException $e) {
    echo "FacebokResponseException : " . $e->getMessage();
    exit();
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
    echo "FacebookSDKException : " . $e->getMessage();
    exit();
}

$responsePost = $response->getDecodedBody();
//var_dump($responsePost);exit();
$posts = array();

foreach($responsePost["data"] as $key=>$body) {
    if($body["nama_user"] != "Laporan Kota Manado") {
        if(isset($body["message"])) {
            $posts[$key]["message"] = $body["message"];
            $posts[$key]["id_post"] = $body["id"];
            $posts[$key]["id_user"] = $body["from"]["id"];
            $posts[$key]["nama_user"] = $body["from"]["name"];
            $posts[$key]["waktu"] = $body["updated_time"];
        }
    }
}

$db->update($posts);

header("Location: http://laporan.manadokota.go.id/index.php/dashboard/form/facebook");

//$data = $db->ambil();
//
//if($data != false) {
//	echo json_encode($data);
//}
