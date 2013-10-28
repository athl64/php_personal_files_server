<?php
header("Cache-Control: no-cache, must-revalidate");

if($_POST["list"] == "true") {
$array_ls = scandir("uploads");
$n = 0;
$inf = "";
$current_link = "";
//$ico = "";
$base_name = "";
foreach($array_ls as $current_pos) {
    if($current_pos[0] == ".") {continue;} else {
        ++$n;
        $mtime_inf = stat("uploads/" . $current_pos);
        $inf = round( filesize("uploads/" . $current_pos)/1024 ) . " kb<br>" . /*mime_content_type("uploads/" . $current_pos) . "<br>" .*/ date("F D Y H:i:s", $mtime_inf['mtime']);
        $current_link = $current_pos;
        $base_name = basename($current_link,"");
        $base_name = substr($current_link,0,strrpos($current_link,"."));
        echo "<span class=\"file_list_span\" id=\"file_list_span_$n\">
                    <a href=\"uploads/$current_link\">$current_link</a>
                    <br>
                    <span class=\"file_list_span_inner\">
                        $inf
                    </span>
                    <span class=\"file_list_span_button_del\" onclick=\"file_action('$current_link','f_new_name_$n','remove')\">
                        delete
                    </span>
                    <span class=\"file_list_span_button_ren\" id=\"file_list_span_button_ren_$n\" onclick=\"shw_f_ren('file_list_span_button_ren_$n');dont_show_up('f_new_name_$n');\">
                        rename
                        <br>
                        <input type=\"text\" id=\"f_new_name_$n\" value=\"$base_name\">
                        <input type=\"button\" value=\"rename\" onclick=\"file_action('$current_link','f_new_name_$n','rename')\">
                    </span>
                </span>";
    }
}

}//if post

?>