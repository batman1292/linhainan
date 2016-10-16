<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if (!isset($ses_user_id)) {
    header("Location: ../index.php?error=3");
}
$id = $_GET['id'];
include '../../helper/db_connect.php';
include '../../helper/helper.php';
connect_database();
$persons = get_person_detial($id);
$person = mysql_fetch_assoc($persons);
?>
<html>
    <head>
        <meta charset="utf-8">
        <link href="../../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href=../../"css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <script src="../../css/bootstrap-filestyle-1.2.1/src/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            function nextchild(input) {
                var name = input.name;
                var count = document.getElementById("count_child").value;
                var index = name.substring(9);
                var parent = "";
                var radios = document.getElementsByName('child1_relation');

                for (var i = 0, length = radios.length; i < length; i++) {
                    if (radios[i].checked) {
                        // do whatever you want with the checked radio
                        parent = radios[i].value;

                        // only one radio can be logically checked, don't check the rest
                        break;
                    }
                }
                if (index == (parseInt(count) + 1)) {
                    var newbrother = '<div class="row">';
                    newbrother += '<div class="col-xs-3">';
                    newbrother += '<h5>' + (parseInt(count) + 2) + '.ชื่อนามสกุล</h5>';
                    newbrother += '</div>';
                    newbrother += '<div class="col-xs-4">';
                    newbrother += '<input type="text" class="namechild' + (parseInt(count) + 2) + ' form-control" list="list_child' + (parseInt(count) + 2) + '" autofocus name="namechild' + (parseInt(count) + 2) + '" value="" onkeypress="nextchild(this);"  onkeyup="get_listData(this);" onchange="get_personData(this);">';
                    newbrother += '<datalist id="list_child' + (parseInt(count) + 2) + '" class="list_child' + (parseInt(count) + 2) + '">';
                    newbrother += '</datalist> ';
                    newbrother += '</div>';
                    newbrother += '<div class="col-xs-2">';
                    newbrother += '<h5>วันเกิด(ค.ศ.)</h5>';
                    newbrother += '</div>';
                    newbrother += '<div class="col-xs-3">';
                    newbrother += '<input type="date" class="form-control" autofocus name="child' + (parseInt(count) + 2) + '_bday" id="child' + (parseInt(count) + 2) + '_bday" value="" >';
                    newbrother += '</div>';
                    newbrother += '</div>';
                    newbrother += '<div class="row">';
                    newbrother += '<div class="col-xs-1 col-xs-offset-0">';
                    newbrother += '<h5>สถานะ</h5>';
                    newbrother += '</div>';
                    newbrother += '<div class="col-xs-3" style="margin-top: 7px;">';
                    newbrother += '<input type="radio" name="child' + (parseInt(count) + 2) + '_status" value="1" id="child' + (parseInt(count) + 2) + '_status1">ยังมีชีวิตอยู่';
                    newbrother += '<input type="radio" name="child' + (parseInt(count) + 2) + '_status" value="2" id="child' + (parseInt(count) + 2) + '_status2">เสียชีวิต';
                    newbrother += '</div>';
                    newbrother += '<div class="col-xs-2 col-xs-offset-0">';
                    newbrother += '<h5>ความสัมพันธ์</h5>';
                    newbrother += '</div>';
                    newbrother += '<div class="col-xs-2" style="margin-top: 7px;">';
                    newbrother += '<input type="radio" name="child' + (parseInt(count) + 2) + '_relation" value="1" id="child' + (parseInt(count) + 2) + '_relation1"';
                    if (parent == "1") {
                        newbrother += ' checked';
                    }
                    newbrother += '>บิดา';
                    newbrother += '<input type="radio" name="child' + (parseInt(count) + 2) + '_relation" value="2" id="child' + (parseInt(count) + 2) + '_relation2"';
                    if (parent == "2") {
                        newbrother += ' checked';
                    }
                    newbrother += '>มารดา';
                    newbrother += '</div>';
                    newbrother += '</div>';
                    document.getElementById("count_child").value = parseInt(count) + 1;
                    var mydiv = document.getElementById("children");
                    var newcontent = document.createElement('div');
                    newcontent.innerHTML = newbrother;
                    while (newcontent.firstChild) {
                        mydiv.appendChild(newcontent.firstChild);
                    }
                }
            }
            function nextbro(input) {
                var name = input.name;
                var count = document.getElementById("count_bro").value;
                var index = name.substring(7);
                if (index == (parseInt(count) + 1)) {
                    var newbrother = '<div class="row">';
                    newbrother += '<div class="col-xs-3">';
                    newbrother += '<h5>' + (parseInt(count) + 2) + '.ชื่อนามสกุล</h5>';
                    newbrother += '</div>';
                    newbrother += '<div class="col-xs-4">';
                    newbrother += ' <input type="text" class="namebro form-control" list="list_bro' + (parseInt(count) + 2) + '" autofocus name="namebro' + (parseInt(count) + 2) + '" value=""  onkeypress="nextbro(this);" onkeyup="get_listData(this);" onchange="get_personData(this);">';
                    newbrother += ' <datalist id="list_bro' + (parseInt(count) + 2) + '" class="list_bro">';
                    newbrother += '</datalist> ';
                    newbrother += ' </div>';
                    newbrother += '<div class="col-xs-2">';
                    newbrother += '<h5>วันเกิด(ค.ศ.)</h5>';
                    newbrother += '</div>';
                    newbrother += '<div class="col-xs-3">';
                    newbrother += '<input type="date" class="form-control" autofocus name="bro' + (parseInt(count) + 2) + '_bday" id="bro' + (parseInt(count) + 2) + '_bday" value="">';
                    newbrother += '</div>';
                    newbrother += ' </div>';
                    newbrother += '<div class="row">';
                    newbrother += '<div class="col-xs-1 col-xs-offset-0">';
                    newbrother += ' <h5>สถานะ</h5>';
                    newbrother += '</div>';
                    newbrother += '<div class="col-xs-3" style="margin-top: 7px;">';
                    newbrother += '<input type="radio" name="bro' + (parseInt(count) + 2) + '_status" value="1" id="bro' + (parseInt(count) + 2) + '_status1">ยังมีชีวิตอยู่';
                    newbrother += '<input type="radio" name="bro' + (parseInt(count) + 2) + '_status" value="2" id="bro' + (parseInt(count) + 2) + '_status2">เสียชีวิต';
                    newbrother += '</div>';
                    newbrother += ' </div>';
                    document.getElementById("count_bro").value = parseInt(count) + 1;
                    var mydiv = document.getElementById("brother");
                    var newcontent = document.createElement('div');
                    console.log(newbrother);
                    newcontent.innerHTML = newbrother;
                    while (newcontent.firstChild) {
                        mydiv.appendChild(newcontent.firstChild);
                    }
                }
            }
            function validate(evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
                var regex = /[0-9]|\./;
                if (!regex.test(key)) {
                    theEvent.returnValue = false;
                    if (theEvent.preventDefault)
                        theEvent.preventDefault();
                }
            }
            function handleClick(myRadio) {
                console.log(myRadio.value);
                var count = document.getElementById("count_child").value;
                if (myRadio.value === '1') {
                    document.getElementById("child1_relation1").checked = true;
                    document.getElementById("child2_relation1").checked = true;
                    document.getElementById("child3_relation1").checked = true;
                    document.getElementById("child4_relation1").checked = true;
                    document.getElementById("child5_relation1").checked = true;
                    document.getElementById("child6_relation1").checked = true;
                } else if (myRadio.value === '2') {
                    document.getElementById("child1_relation2").checked = true;
                    document.getElementById("child2_relation2").checked = true;
                    document.getElementById("child3_relation2").checked = true;
                    document.getElementById("child4_relation2").checked = true;
                    document.getElementById("child5_relation2").checked = true;
                    document.getElementById("child6_relation2").checked = true;
                }

            }

            var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
            function ValidateSingleInput(oInput) {
                if (oInput.type == "file") {
                    var sFileName = oInput.value;
                    if (sFileName.length > 0) {
                        var blnValid = false;
                        for (var j = 0; j < _validFileExtensions.length; j++) {
                            var sCurExtension = _validFileExtensions[j];
                            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                blnValid = true;
                                break;
                            }
                        }

                        if (!blnValid) {
                            alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                            oInput.value = "";
                            return false;
                        }
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                    }
                }
                return true;
            }
            //-------------------------------------------------------//
            function get_listData(input) {
                var str = input.value;
                var list = input.getAttribute("list");
                var dataString = 'parent_search=' + str;
                var http = new XMLHttpRequest();
                var url = "../../helper/ajax_update.php";
                http.open("POST", url, true);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.setRequestHeader("Content-length", dataString.length);
                http.setRequestHeader("Connection", "close");
                http.onreadystatechange = function() {//Call a function when the state changes.
                    if (http.readyState == 4 && http.status == 200) {
                        document.getElementById(list).innerHTML = http.responseText;
                    }
                }
                http.send(dataString);
            }
            function get_personData(input) {
                var name = input.name;
                var type = "";
                var index = "";
                if (name.indexOf("bro") != -1) {
                    type = "bro";
                    index = name.substring(7);
                } else if (name.indexOf("child") != -1) {
                    type = "child";
                    index = name.substring(9);
                }
                var bday = type + index + "_bday";
                var str = input.value;
                var dataString = 'persondata_search=' + str;
                var http = new XMLHttpRequest();
                var url = "../../helper/ajax_update.php";
                http.open("POST", url, true);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.setRequestHeader("Content-length", dataString.length);
                http.setRequestHeader("Connection", "close");
                http.onreadystatechange = function() {//Call a function when the state changes.
                    if (http.readyState == 4 && http.status == 200) {
                        var res = http.responseText.split(",");
 //                        
                        document.getElementById(bday).value = res[0];
                        var sta = type + index + "_status" + res[1];
                        document.getElementById(sta).checked = true;
                    }
                }
                http.send(dataString);
            }

            var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
            function ValidateSingleInput(oInput) {
                if (oInput.type == "file") {
                    var sFileName = oInput.value;
                    if (sFileName.length > 0) {
                        var blnValid = false;
                        for (var j = 0; j < _validFileExtensions.length; j++) {
                            var sCurExtension = _validFileExtensions[j];
                            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                blnValid = true;
                                break;
                            }
                        }

                        if (!blnValid) {
                            alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                            oInput.value = "";
                            return false;
                        }
                    }
                }
                return true;
            }
            $(document).ready(function() {

            });
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>
    </head>
    <body class="btn-material-red">
        <div class="bs-component">
            <form class="form-horizontal well" action="../action/add_child.php?id=<?php echo $id; ?>" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <h2>เพิ่มข้อมูลลูก</h2>
                    </div>
                </div>
                
                 <input type="text" name="count_child" id="count_child" value="0" hidden="">
                    <div class="children" id="children">
                        <div class="row">
                            <div class="col-xs-3">
                                <h5>1.ชื่อนามสกุล</h5>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" class="namechild form-control" list="list_child1" autofocus name="namechild1" value="" onkeypress="nextchild(this);" onkeyup="get_listData(this);" onchange="get_personData(this);">
                                <datalist id="list_child1" class="list_child1">

                                </datalist> 
                            </div>
                            <div class="col-xs-2">
                                <h5>วันเกิด(ค.ศ.)</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="date" class="form-control" autofocus name="child1_bday" id="child1_bday" value="" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-1 col-xs-offset-0">
                                <h5>สถานะ</h5>
                            </div>
                            <div class="col-xs-3" style="margin-top: 7px;">
                                <input type="radio" name="child1_status" value="1" id="child1_status1">ยังมีชีวิตอยู่
                                <input type="radio" name="child1_status" value="2" id="child1_status2">เสียชีวิต
                            </div>
                            <div class="col-xs-2 col-xs-offset-0">
                                <h5>ความสัมพันธ์</h5>
                            </div>
                            <div class="col-xs-2" style="margin-top: 7px;">
                        <input type="radio" name="child1_relation" value="1" <?php if ($person["GENDER_ID"] == 1) echo "checked"; ?>>บิดา
                        <input type="radio" name="child1_relation" value="2" <?php if ($person["GENDER_ID"] == 2) echo "checked"; ?>>มารดา
                            </div>
                        </div>
                    </div>
                <div class="row" style="margin-top: 0px">
                    <div class="col-xs-2 col-xs-offset-8">
                        <a class="btn btn-danger" role="button" onClick="javascript
                                :window.close()">ยกเลิก</a>
                    </div>
                    <div class="col-xs-2">
                        <button class="btn btn-success" type="submit" name="search">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>