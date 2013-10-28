/* ajax get txt begin*/
var xmlhttp;

function send_request(url,cfunc) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
xmlhttp.onreadystatechange = cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.setRequestHeader("Cache-Control", "no-cache");
xmlhttp.send();
document.getElementById("body_content_container").innerHTML = "loading messages, wait...";
}

function txt_download() {
    send_request("txt.txt",response_repaired)
}

function response_repaired() {
    var str,str_out;
    str = "";
    str_out = "";
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        str = xmlhttp.responseText;
        };
    str_out = str.replace(/\n/g,"<br>");
    document.getElementById("body_content_container").innerHTML = str_out;
}
/* ajax get txt end*/

function shw_txt_w() {
    var txt_w = document.getElementById("txt_send");
    txt_w.style.display = "block";
    document.getElementById("txt_area").focus();
}

function hd_txt_w() {
    var txt_w = document.getElementById("txt_send");
    txt_w.style.display = "none";
}

function shw_file_w() {
    var txt_w = document.getElementById("file_send");
    txt_w.style.display = "block";
}

function hd_file_w() {
    var txt_w = document.getElementById("file_send");
    txt_w.style.display = "none";
}

function scroll_bottom() {
    window.scroll(0,document.getElementById("body_content_container").scrollHeight );
}

function scroll_top() {
    window.scroll(0,0 );
}
/* simplier ajax :) begin*/
function send_msg() {
    var txtarea = document.getElementById("txt_area");
    var body_content = document.getElementById("body_content_container");
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function () {
        body_content.innerHTML = xhttp.responseText;
        hd_txt_w();
        if (xhttp.status == 200 && xhttp.readyState == 4) {
            txtarea.value = "";
        }
    }
    xhttp.open("POST", "txt.php", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send("str_name=" + txtarea.value);/* important parameters in send() */
    
    document.getElementById("body_content_container").innerHTML = "sending message, wait...";
    
}
/* simplier ajax :) end*/

function selected_files() {
    var files = document.getElementById("file_name");
    var div_list = document.getElementById("file_send_selected");
    div_list.innerHTML = "";
    for (var i=0;i<files.files.length;i++) {
        div_list.innerHTML += files.files[i].name + "<br>";
    }
}

function files_list_request() {
    document.getElementById("body_content_container").innerHTML = "";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() { document.getElementById("body_content_container").innerHTML = xhr.responseText; };
    xhr.open("POST","ls.php");
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
    xhr.send("list=true");
    document.getElementById("body_content_container").innerHTML = "wait for listing...";
}

function status_request() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() { document.getElementById("top_status_bar").innerHTML = xhr.responseText; };
    xhr.open("POST","stat.php");
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
    xhr.send("status=true");
    document.getElementById("top_status_bar").innerHTML = "requesting uptime...";
}

function file_action(name,newname_id,action) {
    var xhr = new XMLHttpRequest();
    var response;
    var newfn_in = document.getElementById(newname_id);
    var newname = newfn_in.value;
    
    if (action == "rename") {
        xhr.onload = function() {
            response = xhr.responseText;
            if (response == "removed" || response == "renamed") {
                files_list_request();
            } else {
                alert("strange\n" + response + "\ntry reload page");
            }
        }
        xhr.open("POST","f_act.php");
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
        xhr.send("fname=" + name + "&fname_new=" + newname + "&act=" + action);
    }
    
    if (action == "remove") {
        newname = "";
        xhr.onload = function() {
            response = xhr.responseText;
            if (response == "removed" || response == "renamed") {
                files_list_request();
            } else {
                alert("strange\n" + response + "\ntry reload page");
            }
        }
        xhr.open("POST","f_act.php");
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
        xhr.send("fname=" + name + "&fname_new=" + newname + "&act=" + action);
    }
}

function shw_f_ren(f_in_id) {
    var div = document.getElementById(f_in_id);
    if (div.style.height != "50px") {
        div.style.height = "50px";
        div.style.width = "550px";
        div.style.backgroundColor = "#ff9598";
    } else {
        div.style.height = "15px";
        div.style.width = "50px";
        div.style.backgroundColor = "#e2e2e2";
    }
}

/* prevent hidding of child input when it clicked but allow to hide span when it clicked  */
function dont_show_up(in_f_id) {
        var div = document.getElementById(in_f_id);
        div.onclick = function(e) {
        e.stopPropagation();
        }
}

//function files_upload() {
//    document.getElementById("body_content_container").innerHTML = "";
//    var f_names = document.getElementById("file_name");
//    var fr = FileReader();
//    
//    fr.onload = function(event) {
//        for(var i=0;i<f_names.files[0].length;i+=1024) {
//        var str_file = event.target.result;
//        var xhttp_f = new XMLHttpRequest();
//        xhttp_f.onreadystatechange = function() { document.getElementById("body_content_container").innerHTML += xhttp_f.responseText; hd_file_w(); };
//        xhttp_f.open("POST", "up.php", true);
//        xhttp_f.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
//        xhttp_f.setRequestHeader('file_name',encodeURIComponent(f_names.files[0].name));
//        xhttp_f.setRequestHeader('file_part_n',i);
//        xhttp_f.send(str_file.slice(i,i+1024));
//        }
//    };
//    fr.readAsArrayBuffer(f_names.files[0]);
//}

//working multiple upload below
function files_upload() {
    document.getElementById("body_content_container").innerHTML = "";
    var f_names = document.getElementById("file_name");
    
    for (var i=0;i<f_names.files.length;i++) {
        
    var fd = new FormData();
    var xhttp_f = new XMLHttpRequest();
    
        fd.append("fname",f_names.files[i].name);
        fd.append("f_content",f_names.files[i]);
        xhttp_f.onreadystatechange = function() { /*document.getElementById("body_content_container").innerHTML = xhttp_f.responseText;*/files_list_request(); hd_file_w(); };
        xhttp_f.open("POST", "up.php", true);
        //xhttp_f.setRequestHeader('Content-Type', 'multipart/form-data');
        //xhttp_f.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
        //xhttp_f.setRequestHeader('file_name',encodeURIComponent(f_names.files[0].name));
        //xhttp_f.setRequestHeader('file_part_n',i);
        xhttp_f.send(fd);
    }
}