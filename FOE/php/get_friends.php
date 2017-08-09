<?php

require_once 'config.php';
include 'get_person_gb.php';
$clan_request = '[{"requestMethod":"updateSettings","requestId":7,"__class__":"ServerRequest","requestData":[{"showPremiumConfirmDialog":false,"__class__":"Settings","preventMoveSetBuildingHint":true,"volume":0.666667,"showGuildExpeditionsInfoScreen":false,"gbInfoScreenHintTrigger":0,"hideSocialBar":false,"socialBarTab":1,"showGuildChampionshipsInfoScreen":false,"showIncidentsInfoScreen":true,"displayedGvgScreenContinent":true,"showFriendsTavernInfoScreen":false,"displayedFriendInviteScreen":true,"cup14AnimsEnabled":true,"showEventTutorialArrow":true,"showFppConfirmDialog":true,"enableAnimations":false,"preventTavernFriendsHint":false,"highlightUnattachedUnits":true,"packagesInterstitial":false,"displayedGvgScreenSectors":true,"displayedGvgScreenProvinces":true,"showTournamentNotParticipated":true,"displayedFirstDepositScreen":0,"zoomFactor":0.6,"animationSpeedup":2,"showSummerInfoScreen":false,"backgroundSound":false,"pushNotifications":null,"effectSound":false,"showEventInfoScreen":false,"tutorialSaveStep":"","chatHidden":true,"showEventHistoryFilters":false,"gbInfoScreenBlueprintTrigger":4,"showIncidentsCollectInfoScreen":true,"showGuildInfoScreen":true,"voClassName":"Settings"}],"requestClass":"SettingsService","voClassName":"ServerRequest"},{"requestMethod":"getClanMemberList","requestId":8,"__class__":"ServerRequest","requestData":[],"requestClass":"OtherPlayerService","voClassName":"ServerRequest"}]';
$frid_request = '[{"requestMethod":"updateSettings","requestId":9,"__class__":"ServerRequest","requestData":[{"showPremiumConfirmDialog":false,"__class__":"Settings","preventMoveSetBuildingHint":true,"volume":0.666667,"showGuildExpeditionsInfoScreen":false,"gbInfoScreenHintTrigger":0,"hideSocialBar":false,"socialBarTab":0,"showGuildChampionshipsInfoScreen":false,"showIncidentsInfoScreen":true,"displayedGvgScreenContinent":true,"showFriendsTavernInfoScreen":false,"displayedFriendInviteScreen":true,"cup14AnimsEnabled":true,"showEventTutorialArrow":true,"showFppConfirmDialog":true,"enableAnimations":false,"preventTavernFriendsHint":false,"highlightUnattachedUnits":true,"packagesInterstitial":false,"displayedGvgScreenSectors":true,"displayedGvgScreenProvinces":true,"showTournamentNotParticipated":true,"displayedFirstDepositScreen":0,"zoomFactor":0.6,"animationSpeedup":2,"showSummerInfoScreen":false,"backgroundSound":false,"pushNotifications":null,"effectSound":false,"showEventInfoScreen":false,"tutorialSaveStep":"","chatHidden":true,"showEventHistoryFilters":false,"gbInfoScreenBlueprintTrigger":4,"showIncidentsCollectInfoScreen":true,"showGuildInfoScreen":true,"voClassName":"Settings"}],"requestClass":"SettingsService","voClassName":"ServerRequest"},{"requestMethod":"getFriendsList","requestId":10,"__class__":"ServerRequest","requestData":[],"requestClass":"OtherPlayerService","voClassName":"ServerRequest"}]';
$hood_request = '[{"requestData":[{"preventMoveSetBuildingHint":true,"zoomFactor":0.6,"showGuildInfoScreen":true,"volume":0.666667,"showSummerInfoScreen":false,"socialBarTab":2,"showPremiumConfirmDialog":false,"showGuildExpeditionsInfoScreen":false,"__class__":"Settings","hideSocialBar":false,"displayedFriendInviteScreen":true,"showIncidentsInfoScreen":true,"gbInfoScreenHintTrigger":0,"showFriendsTavernInfoScreen":false,"enableAnimations":false,"cup14AnimsEnabled":true,"showEventTutorialArrow":true,"displayedGvgScreenContinent":true,"showFppConfirmDialog":true,"displayedGvgScreenProvinces":true,"highlightUnattachedUnits":true,"displayedGvgScreenSectors":true,"preventTavernFriendsHint":false,"showIncidentsCollectInfoScreen":true,"showGuildChampionshipsInfoScreen":false,"packagesInterstitial":false,"showTournamentNotParticipated":true,"displayedFirstDepositScreen":0,"animationSpeedup":2,"showEventInfoScreen":false,"tutorialSaveStep":"","pushNotifications":null,"gbInfoScreenBlueprintTrigger":4,"effectSound":false,"backgroundSound":false,"chatHidden":true,"showEventHistoryFilters":false,"voClassName":"Settings"}],"requestClass":"SettingsService","requestId":7,"__class__":"ServerRequest","requestMethod":"updateSettings","voClassName":"ServerRequest"},{"requestData":[],"requestClass":"OtherPlayerService","requestId":8,"__class__":"ServerRequest","requestMethod":"getNeighborList","voClassName":"ServerRequest"}]';



//$result = sendRequest($ses, $secret, json_decode($clan_request));
$result1 = sendRequest($ses, $secret, json_decode($frid_request));
//$result2 = sendRequest($ses, $secret, json_decode($frid_request));

$results = json_decode($result1);
$gb_results = array();
foreach($results as $i => $service) {
    if($service->requestClass === 'OtherPlayerService') {
        foreach($service->responseData as $k => $player) {
            if($player->has_great_building) {
                $gb_results = array_merge($gb_results, get_person_gbs($ses, $secret, $player->player_id, $player->name, $player->rank, 'clan'));
            }
        }
    }
}

echo json_encode($gb_results);

?>