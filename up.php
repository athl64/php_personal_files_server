<?php

//echo "received post<br>";
//echo var_dump($_FILES["fname"]);
//
//if( ($_FILES["fname"]) != null ) {
//    echo "not null<br>";
//    echo $_FILES["fname"]["name"] . "<br>";
//    //echo $_FILES["f_names"];
//}

//echo $fn = $_POST["fname"];
//echo $data = base64_encode($_POST["f_content"]);
//file_put_contents("uploads/f.doc", $data);

//echo $data=file_get_contents('php://input');

//$fname = "";
//$data=file_get_contents('php://input');
//
//foreach (getallheaders() as $name => $value) {
//    echo "$name: $value<br>";
//    if($name == "file_name") {
//        $fname = urldecode( iconv("cp1251","utf-8",$value) );
//    }
//}
//file_put_contents("uploads/" . $fname, $data);

//file_put_contents("uploads/file.doc", $data);
//$f = file_get_contents($_FILES["f_content"]["tmp_name"]);
//file_put_contents("uploads/" . $fn,$f);
//echo $_FILES["fname"]["name"];

//multiple file upload
//echo $fn = $_REQUEST["fname"];
echo $fn = $_POST["fname"];
echo "<br>";
if($_FILES["f_content"] != null) {
    move_uploaded_file($_FILES["f_content"]["tmp_name"],"uploads/" . $_FILES["f_content"]["name"]);
}


?>