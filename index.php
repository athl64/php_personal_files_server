<?php
header('Content-type: text/html; charset=UTF-8');
/*setlocale("UTF-8");*/
date_default_timezone_set("Etc/GMT-3");
$today = date("r");
/* ------------------------------------------begin_file_upload----------------------------------------------------------------- */
$str_fnames = $_POST["f_names"];
$str_command = $_POST["command"];

        $fname = $_FILES["fname"]["name"];
        $tmp_fname = $_FILES["fname"]["tmp_name"];
        $uploaded_link = "";
        
    if($str_command == "upload" && $tmp_fname != "")
    {
        move_uploaded_file($tmp_fname,"uploads/" . iconv("utf-8","cp1251",$fname));/* fucking windows */
        /*move_uploaded_file($tmp_fname,"uploads/" . $fname);*/ /* unix */
        /*echo "<a href=\"uploads/" . $fname . "\">" . $fname . "</a>";*/ /* debug */
        $uploaded_link = "<p class=\"p_uploaded\">uploaded:<br><a href=\"uploads/$fname\" class=\"a_uploaded\">$fname</a></p>";
    }
/* ------------------------------------------end_file_upload----------------------------------------------------------------- */
/* ------------------------------------------begin_file_operation----------------------------------------------------------------- */
$str_fnames_p;

if($str_command =="delete" && $str_fnames != "") {
    $array_fnames = explode("\n",$str_fnames);
    if($str_command == "delete") {
        foreach($array_fnames as $each_fname) {
            $each_fname = iconv("utf-8","cp1251",$each_fname); /* for windows */
            $each_fname = str_replace("\r","",$each_fname);
            if( $each_fname != "" && file_exists("uploads/" . $each_fname) ) {
                //echo $each_fname . "<br>";
                unlink("uploads/" . $each_fname);
            }
        }
    }
}
if($str_command =="delete" && $str_fnames != "") {
    $str_fnames_p = "<p class=\"p_uploaded\">deleted:<br>" . str_replace("\n","<br>",$str_fnames) . "</p>";
}
/* ------------------------------------------end_file_operation----------------------------------------------------------------- */

echo "<!DOCTYPE html>
<html>
  <head>
    <meta charset=UTF-8>
    <title>home, sweet home (undone)</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
    <script src=\"script.js\"></script>
  </head>
  <body class=\"all\">
    <header class=\"header\">
        $today
    </header>
    <section>
        <div class=\"nav_container\">
        <!--<a href=\"index.php\"><div class=\"nav\">
            status
        </div></a>-->
        <a href=\"#\"><div class=\"nav\" id=\"j_button_files\">
            files
        </div></a>
        <a href=\"#\"><div class=\"nav\" id=\"j_button_text\">
            text
        </div></a>
        </div>
        <div class=\"body_content\">
        <div id=\"body_content_files\">
            <div class=\"div_1\">
                <div class=\"div_1_1\">
                <form name=\"form_name\" method=\"post\" action=\"index.php\" enctype=\"multipart/form-data\" id=\"main_form\">
                    <p>
                        <input type=\"file\" name=\"fname\" id=\"in_file_name\">
                        <input type=\"button\" value=\"send\" class=\"up_button\" onclick=\"command_send('upload')\">
                    </p>
                    <input type=\"hidden\" name=\"command\" id=\"command\"/>
                    <input type=\"hidden\" name=\"f_names\" id=\"f_names\"/>
                </form>
                $uploaded_link $str_fnames_p
                </div>
            </div>
            <div class=\"div_panel\">
                <div class=\"div_panel_button\" id=\"rename\">
                    rename
                </div>
                <div class=\"div_panel_button\" id=\"delete\" onclick=\"command_send('delete')\">
                    delete
                </div>
            </div>
                <table class=\"table_in\" id=\"tb_all\">
                    <thead class=\"thead_in\">
                        <tr>
                            <td class=\"td_in_num\">№</td>
                            <!--<td class=\"th_in_prewiev\"></td>-->
                            <td>name</td>
                            <td class=\"td_in_info\">info</td>
                            <td class=\"td_in_selected\">delete</td>
                        </tr>
                    </thead>
                    <!-- begin table content -->
                    ";

/* part of scandir & generate table body (begin)*/

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
        $current_link = iconv("cp1251","UTF-8",$current_pos);/* remove iconv for unix */
        $current_link = "<a href=\"uploads/$current_link\" class=\"a_file\" id=\"href_$n\">$current_link</a>";
        echo "<tr class=\"tr_in\" id=\"tr_$n\">
                    <td class=\"td_in_num\">
                        $n
                    </td>
                    <!--<td class=\"td_in_prewiev\">
                        <img class=\"img_icon\" src=\"exe_n.png\">
                    </td>-->
                    <td class=\"td_in\">
                        $current_link
                    </td>
                    <td class=\"td_in\">
                        $inf
                    </td>
                    <td class=\"td_in_selected\">
                        <input type=\"checkbox\" name=\"s_$n\" id=\"s_$n\">
                    </td>
                    </tr>";
    }
}

/* part of scandir & generate table body (end)*/

echo "
                    <!-- end table content -->
                </table>
        </div><!-- body_content_files -->
        </div>
    </section>
    <footer class=\"footer\">
      doesn't copyrighted
    </footer>
  </body>
</html>";

?>