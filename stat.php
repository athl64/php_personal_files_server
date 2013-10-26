<?php
header("Cache-Control: no-cache, must-revalidate");

date_default_timezone_set("Etc/GMT-2");
$now = date("r");
$up = shell_exec("uptime");

echo $now . " || " . $up;

?>