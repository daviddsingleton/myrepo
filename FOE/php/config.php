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
    $cookie = $_POST['cookie'];
    #echo $sig . '<br />';
    #echo $new_bod;
    curl_setopt($req, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($req, CURLOPT_POSTFIELDS, $new_bod);                                                                  
    curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($req, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Referer:  https://foeus.innogamescdn.com/swf/Preloader.swf?1501063289/[[DYNAMIC]]/1',
        'Signature: ' . $sig,
        'Cookie: ' . $cookie,
        // 'Cookie: metricsUvId=adfe66a2-721f-4088-bf64-9e7c451cb2d0; sid=OCvC3A_fLBeLcUlOasuuaziZmmR350iCb-flQiDm; req_page_info=game_v1; start_page_type=game; start_page_version=v1; ig_conv_last_site=https://us8.forgeofempires.com/game/index; _ga=GA1.2.643914890.1482254298; _gid=GA1.2.1743891981.1501453401; _gat=1',
        'Host: us8.forgeofempires.com',
        'Origin: https://foeus.innogamescdn.com',
        'Client-Identification: version=1.106; requiredVersion=1.106; platform=bro; platformVersion=web')); 
    return curl_exec($req);
}

?>