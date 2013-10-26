<?php

$fname = $_POST["fname"];
$act = $_POST["act"];

if($fname != "" && $act != "") {
    if($act == "remove") {
        if( file_exists("uploads/" . $fname) ) {
            unlink("uploads/" . $fname);
            echo "removed";
        } else {
            echo "file not found";
        }
    }
}

?>