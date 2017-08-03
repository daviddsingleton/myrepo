<?php
require_once 'config.php';
$eid = $_POST['eid'];
$pid = $_POST['pid'];

/**
**Example Request
**[{"requestMethod":"getConstruction","requestId":13,"__class__":"ServerRequest","requestData":[107,2399329],"requestClass":"GreatBuildingsService","voClassName":"ServerRequest"}]
** 107 is the gb entity id, the other number is the player_id
*/

$req_data = array(
    array(
        'requestMethod' => 'getConstruction',
        'requestId' => $rid,
        '__class__' => 'ServerRequest',
        'requestData' => array($eid+0, $pid+0),
        'requestClass' => 'GreatBuildingsService',
        'voClassName' => 'ServerRequest'
    )
);

$result = sendRequest($ses, $secret, $req_data);

print_r($result);

#[{"requestMethod":"getConstruction","requestId":13,"__class__":"ServerRequest","requestData":[107,2399329],"requestClass":"GreatBuildingsService","voClassName":"ServerRequest"}]
#[{"requestMethod":"getConstruction","requestId":268,"__class__":"ServerRequest","requestData":["136","1438777"],"requestClass":"GreatBuildingsService","voClassName":"ServerRequest"}]