<?php
require_once('system/json.php');
$json = new Json();
unlink($json->josnOfflineFileAddress['PastHour']);
unlink($json->josnOfflineFileAddress['PastDay']);
unlink($json->josnOfflineFileAddress['Past7Days']);
unlink($json->josnOfflineFileAddress['Past30Days']);
$json->getPastHour();
$json->getPastDay();
$json->getPast7Days();
$json->getPast30Days();
header("location:index.php?page=PastHour");
?>