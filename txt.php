<?php
header("Cache-Control: no-cache, must-revalidate");
date_default_timezone_set("Etc/GMT-3");
$now = date("r");

$msg_content = $_POST["str_name"];
$ip = $_SERVER["REMOTE_ADDR"];
//echo $msg_content . " received<br>";

if( $msg_content != "" ) {
    $msg_all = "\n#begin##########" . $now . "##[$ip]##\n" . $msg_content . "\n#end##########" . $now . "###########\n";
    if( (file_put_contents("txt.txt",$msg_all,FILE_APPEND)) != 0 ) {
        echo $now . "<br>writed";
        } else {
            echo "error while writing";
            }
            } else {
                echo $now . "<br>empty message";
            }

?>