<?php
$ses = $_POST['session'];
$rid = 171;// + rand(1, 100);
$page = $_POST['page'];
$secret = "t7vCISxcfFgoUFZkLevyhNokShuc7rBIEkcUuvlEhWC79h1eTVL5GD6jS/oweSgTghqdBLdY5lEPDZlHXWyrGQ==";

$body = array(
    array(
        'requestData' => array('great_building', null, $page),
        'requestClass' => 'RankingService',
        'requestId' => $rid,
        '__class__' => 'ServerRequest',
        'requestMethod' => 'getRanking',
        'voClassName' => 'ServerRequest'
    )
);
$new_bod = json_encode($body);
$data = $ses . $secret . $new_bod;
$sig = substr(md5($data), 0, 10);
$url = "https://us8.forgeofempires.com/game/json?h=" . $ses;

$req = curl_init($url);
curl_setopt($req, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($req, CURLOPT_POSTFIELDS, $new_bod);                                                                  
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
curl_setopt($req, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Referer:  https://foeus.innogamescdn.com/swf/Preloader.swf?1501063289/[[DYNAMIC]]/1',
    'Signature: ' . $sig,
    'Cookie: portal_tid=1444999355211-36800; metricsUvId=9e871a8f-99a6-4527-9a9d-c459b7f4559f; _ga=GA1.2.118901741.1444999357; sid=GIIIBiyMyomFzVVnDholAJs2DMsI34fLtniYrQwT; req_page_info=game_v1; start_page_type=game; start_page_version=v1; ig_conv_last_site=https://us8.forgeofempires.com/game/index',
    // 'Cookie: metricsUvId=adfe66a2-721f-4088-bf64-9e7c451cb2d0; sid=OCvC3A_fLBeLcUlOasuuaziZmmR350iCb-flQiDm; req_page_info=game_v1; start_page_type=game; start_page_version=v1; ig_conv_last_site=https://us8.forgeofempires.com/game/index; _ga=GA1.2.643914890.1482254298; _gid=GA1.2.1743891981.1501453401; _gat=1',
    'Host: us8.forgeofempires.com',
    'Origin: https://foeus.innogamescdn.com',
    'Client-Identification: version=1.106; requiredVersion=1.106; platform=bro; platformVersion=web')); 
$result = curl_exec($req);

print_r($result);