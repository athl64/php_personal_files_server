var arr_sel = new Array();
var arr_sel = [];
var str = "";

function selected_files() {
    str = "";
    var tb = document.getElementById("tb_all").rows.length;
    for(var i=0;i<=tb;i++) {
        try {
            var current_ckeck = document.getElementById("s_" + i);
            if (current_ckeck.checked == true) {
                var current_fname = document.getElementById("href_" + i).innerHTML;
                arr_sel.push(current_fname);
                str += current_fname + "\n";
                }
        } catch (e) {
            /*alert(e);*/
        }
    }
    if (str == "") {
        str = "files doesn't selected";
    }
    /*var r = confirm("You want to delete this files:\n\n" + str + "\nAre you sure?");*/
    return str;
}
function command_send(act_from_button) {
    var mainform = document.getElementById("main_form");
    var command = document.getElementById("command");
    var f_names = document.getElementById("f_names");
    /* --------------------------------------------------- */
    if (selected_files() != "files doesn't selected") {
        var r = confirm("You want to delete this files:\n\n" + str + "\nAre you sure?");
        if (r) {
            command.value = act_from_button;
            f_names.value = selected_files();
            mainform.submit();
        }
    } else {
        alert("you must select files");
    }
}