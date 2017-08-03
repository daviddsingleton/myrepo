<?php

$rid = 171 + rand(1, 100);
$ses = $_POST['session'];
$secret = "t7vCISxcfFgoUFZkLevyhNokShuc7rBIEkcUuvlEhWC79h1eTVL5GD6jS/oweSgTghqdBLdY5lEPDZlHXWyrGQ==";
$url = "https://us8.forgeofempires.com/game/json?h=" . $ses;

function getSig($ses, $secret, $request) {
    $data = $ses . $secret . $request;
    return substr(md5($data), 0, 10);
}

function sendRequest($ses, $secret, $req_body) {
    $url = "https://us8.forgeofempires.com/game/json?h=" . $ses;
    $req = curl_init($url);
    $new_bod = json_encode($req_body);
    $sig = getSig($ses, $secret, $new_bod);
    echo $sig . '<br />';
    echo $new_bod;
    curl_setopt($req, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($req, CURLOPT_POSTFIELDS, $new_bod);                                                                  
    curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($req, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Signature: ' . $sig)); 
    return curl_exec($req);
}

?>