<?php

$fname = $_POST["fname"];
$fname_new = $_POST["fname_new"];
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
//-----------------------------------------------
if($fname != "" && $fname_new != "" && $act != "") {
    if($act == "rename") {
        if( file_exists("uploads/" . $fname) ) {
            $fname_new .= substr($fname,strrpos($fname,"."));
            rename("uploads/" . $fname,"uploads/" . $fname_new);
            echo "renamed";
        } else {
            echo "can't rename file";
        }
    }
}

?>