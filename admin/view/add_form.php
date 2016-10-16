<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if (!isset($ses_user_id)) {
    header("Location: ../index.php?error=3");
}
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
        <script src="../../css/bootstrap-filestyle-1.2.1/src/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            function nextchild(input) {
                var name = input.name;
                var count = document.getElementById("count_child").value;
                var index = name.substring(9);
                var parent = "";
                var radios = document.getElementsByName('gender');

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
            $(document).ready(function() {
                $("#list_gen").change(function() {
                    var gen_id = $(this).val();
                    var dataString = 'generation=' + gen_id;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {
                                    var res = html.split("/");
                                    $("#gen_pinyin").html(res[0]);
                                    $("#gen_th").html(res[1]);
                                }
                            });
                });
                $("#chinaname").change(function() {
                    var china_str = $(this).val();
                    var dataString = 'china_str=' + china_str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {
                                    document.getElementById('chinaname_pinyin').value = html;
                                }
                            });
                });
                $(".province").change(function()
                {
                    var id = $(this).val();
                    var dataString = 'province_id=' + id;
                    console.log("dslfk");
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {
                                    $(".amphur").html(html);
                                }
                            });
                    $(".district").html('<option selected="selected">เลือกอำเภอก่อน</option>');
                });
                $(".amphur").change(function()
                {
                    var id = $(this).val();
                    var dataString = 'AMPHUR_ID=' + id;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {
                                    $(".district").html(html);
                                }
                            });
                });
                $(".organization_province").change(function()
                {
                    var id = $(this).val();
                    var dataString = 'province_id=' + id;
                    console.log("dslfk");
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {
                                    $(".organization_amphur").html(html);
                                }
                            });
                    $(".organization_district").html('<option selected="selected">เลือกอำเภอก่อน</option>');
                });
                $(".organization_amphur").change(function()
                {
                    var id = $(this).val();
                    var dataString = 'AMPHUR_ID=' + id;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {
                                    $(".organization_district").html(html);
                                }
                            });
                });
                $(".parent_list").keyup(function()
                {
                    var str = $(this).val();
                    var dataString = 'parent_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {
                                    $(".list_parent").html(html);
                                }
                            });
                });
                $(".parent_list").change(function()
                {
                    var str = $(this).val();
                    var dataString = 'status_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {
                                    if (html == 1) {
                                        $("#father_status1").prop("checked", true);
                                    } else if (html == 2) {
                                        $("#father_status2").prop("checked", true);
                                    }
                                }
                            });
                });
                $(".mother_list").keyup(function()
                {
                    var str = $(this).val();
                    var dataString = 'parent_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {
                                    $(".list_mother").html(html);
                                }
                            });
                });
                $(".mother_list").change(function()
                {
                    var str = $(this).val();
                    var dataString = 'status_search=' + str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function(html)
                                {
                                    if (html == 1) {
                                        $("#mother_status1").prop("checked", true);
                                    } else if (html == 2) {
                                        $("#mother_status2").prop("checked", true);
                                    }
                                }
                            });
                });
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
    <?php
    include '../../helper/db_connect.php';
    connect_database();
    ?>
    <!--<body class="btn-danger">-->
    <body class="btn-material-red">
        <div class="bs-component">
            <form class="form-horizontal well" action="../action/add.php" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                <div id="print">
                    <div class="row">
                        <div class="col-xs-3">
                            <h4>1.ข้อมูลส่วนตัว </h4>
                        </div>
                        <div class="col-xs-1" style="margin-top:10px">
                            ปีลงทะเบียน
                        </div>
                        <div class="col-xs-2" style="margin-top:10px">
                            <select class="form-control" name="reg_year" autofocus>
                                <?php
//                                $data = date("Y");
                                for ($i = date("Y"); $i >= 2015; $i--) {
                                    echo "<option value='$i'>$i </option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-2" style="margin-top:10px">
                            running number
                        </div>
                        <div class="col-xs-1" style="margin-left:0px;">
                            <input type="text" class="form-control" autofocus name="runnum" placeholder="auto">
                        </div>
                        <div class="col-xs-2 " style="margin-top:0" id="notPrint">
                            <a class="btn btn-material-teal" role="button" style="margin-top: 0px" onclick="javascript:window.open('../../print/add.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')"><i class="mdi-action-print"></i>พิมพ์</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <img id="output" src="../../picture/non.jpg" class="img-rounded" alt="Responsive image" width=100px height=100px > 
                        </div>
                        <div class="col-xs-5" style="margin-top:0">
                            <input type="file" name="picture" id="picture" data-input="false"  class="filestyle" data-buttonText="เปลี่ยนรูปประจำตัว" accept="image/*" value="fasfs" onchange="ValidateSingleInput(this);">
                        </div>
                        <div class="col-xs-2" style="margin-top:10">
                            <h5>ผู้ติดตามจำนวน</h5>
                        </div>
                        <div class="col-xs-2" style="margin-top:10">
                            <select name="follower" class="form-control" autofocus>
                                <?php
                                for ($i = 0; $i < 11; $i++) {
                                    echo "<option value='$i'>$i </option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-1" style="margin-top:10">คน</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <h5>คำนำหน้า</h5>
                        </div>
                        <div class="col-xs-2"  style="margin-top: 5px">
                            <select class="form-control" autofocus name="title" >
                                <?php
                                $sql = mysql_query("SELECT * FROM `title` WHERE 1");
                                while ($rs = mysql_fetch_array($sql)) {
                                    echo "<option value='" . $rs["ID"] . "'>" . $rs["TITLE_NAME"] . " </option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-1">
                            <h5>ชื่อ</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="name" required>
                        </div>
                        <div class="col-xs-1">
                            <h5>นามสกุล</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="surname" required>
                        </div>
                        <!--                        <div class="col-xs-1">
                                                    <h4>เพศ</h4>
                                                </div>
                                                <div class="col-xs-2" style="margin-top:8">
                                                    <input type="radio" name="gender" value="1" >ชาย
                                                    <input type="radio" name="gender" value="2" >หญิง
                                                </div>-->
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <h5>ชื่อจีน </h5>
                        </div>
                        <div class="col-xs-1">
                            <h5>林</h5> 
                        </div>
                        <div class="col-xs-1">
                            <h5>- รุ่น</h5>
                        </div>
                        <div class="col-xs-3" style="margin: 5 0px">
                            <select class="form-control" autofocus name="generation" id="list_gen"  onchange="change_gen()">
                                <?php
                                echo "<option disabled> รายการรุ่นสาย 1 </option>";
                                $sql = get_gen_by_type(1);
                                while ($rs = mysql_fetch_array($sql)) {
                                    echo "<option value='" . $rs["ID"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                }
                                echo "<option disabled> รายการรุ่นสาย 2 </option>";
                                $sql = get_gen_by_type(2);
                                while ($rs = mysql_fetch_array($sql)) {
                                    echo "<option value='" . $rs["ID"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                }
                                echo "<option disabled> รายการอื่นๆ </option>";
                                $sql = get_gen_by_type(3);
                                while ($rs = mysql_fetch_array($sql)) {
                                    echo "<option value='" . $rs["ID"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-1">
                            <h5>- ชื่อ</h5> 
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control"autofocus id="chinaname" name="chinaname" value="" placeholder="ชื่อตัวอักษรจีน">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <h5>ออกเสียง pinyin</h5>
                        </div>
                        <div class="col-xs-1">
                            <h5>lin </h5> 
                        </div>
                        <div class="col-xs-1">
                            <h5>- รุ่น</h5>
                        </div>
                        <div class="col-xs-3" >
                            <h5 id="gen_pinyin"></h5>
                        </div>
                        <div class="col-xs-1">
                            <h5>- ชื่อ</h5> 
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control"autofocus id="chinaname_pinyin" name="chinaname_pinyin" value="" placeholder="ชื่อตัวเสียง pinyin">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <h5>ชื่อตัวสำเนียงไทย </h5>
                        </div>
                        <div class="col-xs-1" >
                            <h5>หลิน </h5> 
                        </div>
                        <div class="col-xs-1">
                            <h5>- รุ่น</h5>
                        </div>
                        <div class="col-xs-3" >
                            <h5 id="gen_th">   </h5>
                        </div>
                        <div class="col-xs-1">
                            <h5>- ชื่อ</h5> 
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control"autofocus name="chinaname_thai" value="" placeholder="ชื่อตัวสำเนียงไทย">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-4">
                            <h5>รหัสบัตรประจำตัวประชาชน </h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="personalID" maxlength="13" >
                        </div>
                        <div class="col-xs-1">
                            <h5>สถานะ</h5>
                        </div>
                        <div class="col-xs-4" style="margin-top:7px">
                            <input type="radio" name="status" value="1" >ยังมีชีวิต
                            <input type="radio" name="status" value="2" >เสียชีวิตแล้ว
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-1">
                            <h5>เพศ</h5>
                        </div>
                        <div class="col-xs-2" style="margin-top:7px">
                            <input type="radio" name="gender" id="gender" value="1" required onclick="handleClick(this);">ชาย
                            <input type="radio" name="gender" id="gender" value="2" onclick="handleClick(this);" >หญิง
                        </div>
                        <div class="col-xs-2">
                            <h5>วันเกิด(ค.ศ.)</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="date" class="form-control" autofocus name="birthday" >
                        </div>
                        <div class="col-xs-2">
                            <h5>สถานะภาพ</h5>
                        </div>
                        <div class="col-xs-2">
                            <select class="form-control" id="select" style="margin-top: 5px" name="maritalstatus">
                                <option value="1">โสด</option>
                                <option value="2">สมรส</option>
                                <option value="3">หย่าร้าง</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <h5>ที่อยู่บ้าน</h5>
                        </div>
                        <div class="col-xs-2">
                            <h5>บ้านเลขที่</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="addr_num" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>หมู่</h5>
                        </div>
                        <div class="col-xs-1">
                            <input type="text" class="form-control" autofocus name="addr_moo" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>หมู่บ้าน</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="addr_village" value="">
                        </div>
                    </div>
                    <div class="row">
                        <!--                        <div class="col-xs-2">
                                                    <h4>หมู่บ้าน</h4>
                                                </div>
                                                <div class="col-xs-2">
                                                    <input type="text" class="form-control" autofocus name="addr_village" value="">
                                                </div>-->
                        <div class="col-xs-1">
                            <h5>ซอย</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="addr_alley" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>ถนน</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="addr_road" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>ตำบล</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px">

                            <select name="addr_district" class="district form-control" placeholder="Your favorite pastry">>
                                <option selected="selected">เลือกจังหวัดก่อน</option>

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <!--                        <div class="col-xs-2">
                                                    <h4>ตำบล</h4>
                                                </div>
                                                <div class="col-xs-4" style="margin-top: 5px">
                        
                                                    <select name="addr_district" class="district form-control" placeholder="Your favorite pastry">>
                                                        <option selected="selected">เลือกอำเภอก่อน</option>
                        
                                                    </select>
                                                </div>-->
                        <div class="col-xs-1">
                            <h5>อำเภอ</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px">
                            <select name="addr_amphur" class="amphur form-control" placeholder="Your favorite pastry">>
                                <option selected="selected">เลือกจังหวัดก่อน</option>
                            </select> 
                        </div>
                        <div class="col-xs-1">
                            <h5>จังหวัด</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px">
                            <select name="addr_province" class="province form-control" placeholder="Your favorite pastry">
                                <option >โปรดเลือกจังหวัด</option>
                                <?php
                                $sql = mysql_query("select PROVINCE_ID,PROVINCE_NAME from province where 1");
                                while ($row = mysql_fetch_array($sql)) {
                                    $id = $row['PROVINCE_ID'];
                                    $data = $row['PROVINCE_NAME'];
                                    $data = str_replace(' ', '', $data);
                                    echo '<option value="' . $id . '">' . $data . '</option>';
                                }
                                ?>
                            </select> 

                        </div>
                        <div class="col-xs-2">
                            <h5>รหัสไปรษณีย์</h5>
                        </div>
                        <div class="col-xs-2" style="margin-top: -5">
                            <input type="text" class="form-control" autofocus name="addr_zipcode" value="" maxlength="5">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <h5>โทรศัทพ์บ้าน</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="tel" value="" maxlength="10" onkeypress='validate(event)'>
                        </div>
                        <div class="col-xs-1" style="margin-top: 5">
                            ต่อ
                        </div>
                        <div class="col-xs-1">
                            <input type="text" class="form-control" autofocus name="tel_comment" value="">
                        </div>
                        <div class="col-xs-2">
                            <h5>เบอร์มือถือ</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="moblie" value="" maxlength="10" onkeypress='validate(event)' >
                        </div>
                    </div>
                    <div class ="row">
                        <!--                        <div class="col-xs-2">
                                                    <h4>เบอร์มือถือ</h4>
                                                </div>
                                                <div class="col-xs-2">
                                                    <input type="text" class="form-control" autofocus name="moblie" value="" onkeyup="autoTab2(this, 2)" >
                                                </div>-->
                        <div class="col-xs-2">
                            <h5>e-mail</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="email" class="form-control" autofocus name="email" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>facebook</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="facebook" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>lineID</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="line" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>2.อาชีพ/ธุรกิจหลัก</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                            <h5>ธุรกิจ</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5">
                            <select class="form-control" autofocus name="organizationtype" >
                                <?php
                                $sql = mysql_query("SELECT * FROM `organizationtype` WHERE 1");
                                while ($rs = mysql_fetch_array($sql)) {
                                    echo "<option value='" . $rs["ID"] . "'>" . $rs["ORGANIZATIONTYPE_NAME"] . " </option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <h5>ประเภทธุรกิจหลัก</h5>
                        </div>
                        <div class="col-xs-5">
                            <input type="text" class="form-control"  name="organization_comment">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <h5>ชื่อสถานที่ทำงาน</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control"  name="organization_name">
                        </div>
                        <div class="col-xs-2">
                            <h5>ตำแหน่งงาน</h5>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" autofocus name="organization_role" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <h5>ที่อยู่ทำงาน</h5>
                        </div>
                        <div class="col-xs-2">
                            <h5>เลขที่</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control"  name="organization_num">
                        </div>
                        <div class="col-xs-1">
                            <h5>หมู่</h5>
                        </div>
                        <div class="col-xs-1">
                            <input type="text" class="form-control" autofocus name="organization_moo" value="">
                        </div>
                        <div class="col-xs-2">
                            <h5>หมู่บ้าน</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="organization_village" value="">
                        </div>
                    </div>
                    <div class="row">
                        <!--                        <div class="col-xs-2">
                                                    <h4>หมู่บ้าน</h4>
                                                </div>
                                                <div class="col-xs-2">
                                                    <input type="text" class="form-control" autofocus name="organization_village" value="">
                                                </div>-->
                        <div class="col-xs-1">
                            <h5>ซอย</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="organization_alley" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>ถนน</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="organization_road" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>ตำบล</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px">

                            <select name="organization_district" class="organization_district form-control" placeholder="Your favorite pastry">>
                                <option selected="selected">เลือกจังหวัดก่อน</option>

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <!--                        <div class="col-xs-1">
                                                    <h4>ตำบล</h4>
                                                </div>
                                                <div class="col-xs-3" style="margin-top: 5px">
                        
                                                    <select name="organization_district" class="organization_district form-control" placeholder="Your favorite pastry">>
                                                        <option selected="selected">เลือกอำเภอก่อน</option>
                        
                                                    </select>
                                                </div>-->
                        <div class="col-xs-1">
                            <h5>อำเภอ</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px">
                            <select name="organization_amphur" class="organization_amphur form-control" placeholder="Your favorite pastry">>
                                <option selected="selected">เลือกจังหวัดก่อน</option>
                            </select> 
                        </div>
                        <div class="col-xs-1">
                            <h5>จังหวัด</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px">
                            <select name="organization_province" class="organization_province form-control" placeholder="Your favorite pastry">>
                                <option >โปรดเลือกจังหวัด</option>
                                <?php
                                $sql = mysql_query("select PROVINCE_ID,PROVINCE_NAME from province where 1");
                                while ($row = mysql_fetch_array($sql)) {
                                    $id = $row['PROVINCE_ID'];
                                    $data = $row['PROVINCE_NAME'];
                                    $data = str_replace(' ', '', $data);
                                    echo '<option value="' . $id . '">' . $data . '</option>';
                                }
                                ?>
                            </select> 

                        </div>
                        <div class="col-xs-2">
                            <h5>รหัสไปรษณีย์</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="organization_zipcode" value="" maxlength="5">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                            <h5>โทรศัพท์</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="organization_tel" value="" maxlength="10" onkeypress='validate(event)'>
                        </div>
                        <div class="col-xs-1">
                            <h5>ต่อ</h5>
                        </div>
                        <div class="col-xs-1">
                            <input type="text" class="form-control" autofocus name="organization_tel_comment" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>Fax</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="organization_fax" value="" maxlength="10" onkeypress='validate(event)'>
                        </div>
                        <div class="col-xs-1">
                            <h5>ต่อ</h5>
                        </div>
                        <div class="col-xs-1">
                            <input type="text" class="form-control" autofocus name="organization_fax_comment" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                            <h5>website</h5>
                        </div>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" autofocus name="organization_web" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>Email</h5>
                        </div>
                        <div class="col-xs-5">
                            <input type="email" class="form-control" autofocus name="organization_mail" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>3.ครอบครัว</h4> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-3">
                            <h5>ชื่อ-นามสกุลมารดา</h5>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" list="list_mother" class="mother_list form-control" name="mother" id="mother" />
                            <datalist id="list_mother" class="list_mother">

                            </datalist> 
                        </div>
                        <div class="col-xs-1 col-xs-offset-1">
                            <h5>สถานะ</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px;">
                            <input type="radio" name="mother_status" value="1" id="mother_status1">ยังมีชีวิตอยู่
                            <input type="radio" name="mother_status" value="2" id="mother_status2">เสียชีวิต
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <h5>ชื่อ-นามสกุลบิดา</h5>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" list="list_parent" class="parent_list form-control" name="parent" />
                            <datalist id="list_parent" class="list_parent">

                            </datalist> 
                        </div>
                        <div class="col-xs-1 col-xs-offset-1">
                            <h5>สถานะ</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px;">
                            <input type="radio" name="parent_status" value="1" id="father_status1">ยังมีชีวิตอยู่
                            <input type="radio" name="parent_status" value="2" id="father_status2">เสียชีวิต


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>4.ที่อยู่บรรพบุรุษประเทศจีน</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <h5>ชื่อนามสกุล</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_NAME" value="">
                        </div>
                        <div class="col-xs-2">
                            <h5>ความสัมพันธ์</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type='text' class="form-control" autofocus name='CHINAHOUSE_LINK' value="">
                        </div>
                        <div class="col-xs-2">
                            <h5>เบอร์ติดต่อ</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_TEL" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5"><h5><strong>อักษรจีน</h5></strong></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_VILLAGE" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>村</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_DISTRICT" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>區</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_AMPHUR" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>镇</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_PROVINCE" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>省</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5"><h5><strong>อักษรไทย</strong></h5></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                            <h5>หมู่บ้าน</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_VILLAGE_TH" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>ตำบล</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_DISTRICT_TH" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>อำเภอ</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_AMPHUR_TH" value="">
                        </div>
                        <div class="col-xs-1">
                            <h5>จังหวัด</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_PROVINCE_TH" value="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12" ><h4>5. ชื่อนามสกุล ของพี่-น้องร่วมบิดา-มารดาเดียวกัน</h4></div>
                    </div>
                    <input type="text" name="count_bro" id="count_bro" value="0" hidden="">
                    <div class="brother" id="brother"> 
                        <div class="row">
                            <div class="col-xs-3">
                                <h5>1.ชื่อนามสกุล</h5>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" class="namebro form-control" list="list_bro1" autofocus name="namebro1" value="" onkeypress="nextbro(this);" onkeyup="get_listData(this);" onchange="get_personData(this);">
                                <datalist id="list_bro1" class="list_bro" >

                                </datalist> 
                            </div>
                            <div class="col-xs-2">
                                <h5>วันเกิด(ค.ศ.)</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="date" class="form-control" autofocus name="bro1_bday" id="bro1_bday" value="" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-1 col-xs-offset-0">
                                <h5>สถานะ</h5>
                            </div>
                            <div class="col-xs-3" style="margin-top: 7px;">
                                <input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                                <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12" ><h4>6. ชื่อนามสกุล ของบุตร-ธิดา</h4></div>
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
                                <input type="radio" name="child1_relation" value="1" id="child1_relation1">บิดา
                                <input type="radio" name="child1_relation" value="2" id="child1_relation2">มารดา
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 0px">
                    <div class="row" style="margin-top: 0px">
                        <div class="col-xs-2" style="margin-top:2">
                            <h5>หมายเหตุ :</h5>
                        </div>

                        <div class="col-xs-10" style="margin-top:10">
                            <input type="text" class="form-control" autofocus name="REMARK" list="remark_list" value="<?php echo get_remark($id) ?>">
                            <datalist id="remark_list" class="remark_list">
                                <?php echo get_remark_list(); ?>
                            </datalist> 
                        </div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-2">
                        <a class="btn btn-danger" role="button" onClick="javascript
                                :window.close()">ยกเลิก</a>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-success" type="submit" name="search">บันทึก และ ลงทะเบียน</button>
                    </div>
                </div>

            </form>
        </div>
    </body>
</html>