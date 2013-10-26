<?php
header("Cache-Control: no-cache, must-revalidate");

if($_POST["list"] == "true") {
$array_ls = scandir("uploads");
$n = 0;
$inf = "";
$current_link = "";
$ico = "";
foreach($array_ls as $current_pos) {
    if($current_pos[0] == ".") {continue;} else {
        ++$n;
        $mtime_inf = stat("uploads/" . $current_pos);
        $inf = round( filesize("uploads/" . $current_pos)/1024 ) . " kb<br>" . /*mime_content_type("uploads/" . $current_pos) . "<br>" .*/ date("F D Y H:i:s", $mtime_inf['mtime']);
        $current_link = $current_pos;
        echo "<span class=\"file_list_span\" id=\"file_list_span_$n\">
                    <a href=\"uploads/$current_link\">$current_link</a>
                    <br>
                    <span class=\"file_list_span_inner\">
                        $inf
                    </span>
                    <span class=\"file_list_span_button_del\" onclick=\"file_action('$current_link','remove')\">
                        delete
                    </span>
                    <span class=\"file_list_span_button_ren\">
                        rename
                    </span>
                </span>";
    }
}

}//if post

?>