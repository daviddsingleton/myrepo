<?php

require_once 'config.php';
function get_person_gbs($ses, $secret, $personid, $name, $rank, $type) {
    $request_body = '[{"requestData":[' . $personid . '],"requestClass":"GreatBuildingsService","requestId":13,"__class__":"ServerRequest","requestMethod":"getOtherPlayerOverview","voClassName":"ServerRequest"}]';
    // echo 'REquest body:::' . $request_body . '<br />';
    $result = sendRequest($ses, $secret, json_decode($request_body));
    // print_r($result);
    $gb_array = array();
    $gbs = json_decode($result);
    // print_r($gbs);
    foreach($gbs as $k => $v) {
        if($v->requestClass === 'GreatBuildingsService')  {
            //this is the one we want
            foreach($v->responseData as $i => $gb) {
                $gb->player_id = $personid;
                $gb->player_name = $name;
                $gb->player_rank = $rank;
                $gb->player_type = $type;
                $gb_array[] = $gb;
            }
        }
    }
    return $gb_array;
}

?>