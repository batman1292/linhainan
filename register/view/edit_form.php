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
        <link href="../../css/fieldset.css" rel="stylesheet" type="text/css"/>
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
                if (myRadio.value === '1') {
//                    console.log("kdid");
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
                setInterval(function() {
                    var id = document.getElementById('data_id').value;
                    var time = document.getElementById('time_old').value;
                    var dataString = "id=" + id + "&time=" + time;
                    $.ajax
                            ({
                                url: "../../helper/dbupdate_ajax.php",
                                type: "POST",
                                data: dataString,
                                cache: false,
                                success: function(html) {
                                    var str = html.toString();
                                    var check = str.search("reload");
                                    if (check != -1) {
                                        window.location.reload();
                                    }
                                }
                            });
                }, 1000);
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

                $(".parent_list").keyup(function() {
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
                $(".mother_list").keyup(function() {
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

            });
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();

                document.body.innerHTML = originalContents;
            }
            function del(data, id) {
                var string = "คุณต้องการลบ " + data;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
//                    add data to db
//                window.location = 'adding.php?code=' + code + '&department=' + department;
//                    window.location = 'action/del.php?id=' + id + '&data=' + search_data + '&option=' + search_option;
                    window.location = '../action/del.php?id=' + id + '&data=eiei&option=form';
                }
            }
        </script>
    </head>
    <?php
    $id = $_GET['id'];
    include '../../helper/db_connect.php';
    include '../../helper/helper.php';
    connect_database();
    $persons = get_person_detial($id);
    $person = mysql_fetch_assoc($persons);
//    print_r($person);
    ?>
    <!--<body class="btn-danger">-->
    <body class="btn-material-red">
        <div class="bs-component">
            <form class="form-horizontal well" action="../edit.php?id=<?php echo $id; ?>" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                <div id="print">
                    <div class="row">
                        <div class="col-xs-3">
                            <h4>1.ข้อมูลส่วนตัว </h4>
                        </div>
                        <div class="col-xs-1" style="margin-top:10px">
                            ปีลงทะเบียน
                        </div>
                        <div class="col-xs-2" style="margin-top:10px">
                            <select class="form-control" name="reg_year">
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
                            <input type="text" class="form-control" autofocus name="runnum" value="<?php echo get_running_number($id); ?>" >
                        </div>
                        <div class="col-xs-2 " style="margin-top:0" id="notPrint">
                            <a class="btn btn-material-teal" role="button" style="margin-top: 0px" onclick="javascript:window.open('../../print/edit.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')"><i class="mdi-action-print"></i>พิมพ์</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-2">
                            <img id="output"
                            <?php
                            $picture_name = get_picture($id);
                            if ($picture_name) {
                                echo 'src="../../picture/' . $picture_name . '"';
                            } else {
                                echo 'src="../../picture/non.jpg"';
                            }
                            ?>
                                 class="img-rounded" alt="Responsive image" width=100px height=100px >
                        </div>
                        <div class="col-xs-6" style="margin-top:0">
                            <input type="file" name="picture" id="picture" data-input="false"  class="filestyle" data-buttonText="เปลี่ยนรูปประจำตัว" accept="image/*" value="fasfs" onchange="ValidateSingleInput(this);">
                        </div>
                        <div class="col-xs-2" style="margin-top:10">
                            ผู้ติดตามจำนวน
                        </div>
                        <div class="col-xs-1" style="margin-top:10">
                            <select name="follower" class="form-control" autofocus>
                                <?php
                                $follwers = get_follower($person['ID']);
                                for ($i = 0; $i < 11; $i++) {
                                    if ($i == $follwers)
                                        echo "<option value='$i' selected>$i </option>";
                                    else
                                        echo "<option value='$i'>$i </option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-1" style="margin-top:10">คน</div>

                    </div>
                    <fieldset class="scheduler-border" id="personal_fieldset">
                        <legend class="scheduler-border"><h4>ข้อมูลส่วนตัว</h4></legend>
                        <div class="row">
                            <input type="text" name="data_id" id="data_id" style="visibility:hidden"  value="<?php echo $id; ?>">
                            <input type="text" name="time_old" id="time_old" style="visibility:hidden"  value="<?php echo get_last_update($id); ?>">
                            <div class="col-xs-2">
                                <h5>คำนำหน้า</h5>
                            </div>
                            <div class="col-xs-2"  style="margin-top: 5px">
                                <select class="form-control" autofocus name="title" disabled="">
                                    <?php
                                    $sql = mysql_query("SELECT * FROM `title` WHERE 1");
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs['ID'] == $person['TITLE_ID'])
                                            echo "<option value='" . $rs["ID"] . "' selected='selected'>" . $rs["TITLE_NAME"] . " </option>";
                                        else
                                            echo "<option value='" . $rs["ID"] . "'>" . $rs["TITLE_NAME"] . " </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-1">
                                <h5>ชื่อ</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" autofocus name="name" required readOnly="true" value="<?php echo get_person_name_string($id); ?>">
                            </div>
                            <div class="col-xs-1">
                                <h5>นามสกุล</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" autofocus name="surname" readOnly="true" required value="<?php echo get_person_surname_string($id); ?>">
                            </div>
                        </div>

                        <?php
                        $chinanames = get_person_china_name($id);
                        $chinaname = mysql_fetch_assoc($chinanames);
//
                        ?>
                        <div class="row">
                            <div class="col-xs-3">
                                <h5>ชื่อจีน </h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>林 </h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>- รุ่น</h5>
                            </div>
                            <div class="col-xs-3" style="margin: 5 0px">
                                <select class="form-control" autofocus name="generation" id="list_gen" disabled="">
                                    <?php
                                    echo "<option disabled> รายการรุ่นสาย 1 </option>";
                                    $sql = get_gen_by_type(1);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs["ID"] == $person["GENERATION_ID"]) {
                                            echo "<option value='" . $rs["ID"] . "' selected='selected'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
//                                        echo "<option value='" . $rs["id"] . "' selected='selected'>" . $rs["type"] . " : " . $rs["name"] . " : " . $rs["pinyin"] . " : " . $rs["th"] . " </option>";
                                        } else {
                                            echo "<option value='" . $rs["ID"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                        }
                                    }
                                    echo "<option disabled> รายการรุ่นสาย 2 </option>";
                                    $sql = get_gen_by_type(2);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs["ID"] == $person["GENERATION_ID"]) {
                                            echo "<option value='" . $rs["ID"] . "' selected='selected'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
//                                        echo "<option value='" . $rs["id"] . "' selected='selected'>" . $rs["type"] . " : " . $rs["name"] . " : " . $rs["pinyin"] . " : " . $rs["th"] . " </option>";
                                        } else {
                                            echo "<option value='" . $rs["ID"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                        }
                                    }
                                    echo "<option disabled> รายการอื่นๆ </option>";
                                    $sql = get_gen_by_type(3);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs["ID"] == $person["GENERATION_ID"]) {
                                            echo "<option value='" . $rs["ID"] . "' selected='selected'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
//                                        echo "<option value='" . $rs["id"] . "' selected='selected'>" . $rs["type"] . " : " . $rs["name"] . " : " . $rs["pinyin"] . " : " . $rs["th"] . " </option>";
                                        } else {
                                            echo "<option value='" . $rs["ID"] . "'>" . $rs["GENERATION_INDEX"] . " : " . $rs["GENERATION_NAME"] . " : " . $rs["GENERATION_PINYIN"] . " : " . $rs["GENERATION_TH"] . " </option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-1">
                                <h5>- ชื่อ</h5>
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control"autofocus id="chinaname" name="chinaname" value="<?php echo $chinaname['CHINANAME_NAME']; ?>" placeholder="ชื่อตัวอักษรจีน" readOnly="true">
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
                                <h5 id="gen_pinyin">
                                    <?php
                                    $sql = get_gen_by_type(1);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs["ID"] == $person["GENERATION_ID"]) {
                                            echo $rs["GENERATION_PINYIN"];
                                        }
                                    }
                                    $sql = get_gen_by_type(2);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs["ID"] == $person["GENERATION_ID"]) {
                                            echo $rs["GENERATION_PINYIN"];
                                        }
                                    }
                                    $sql = get_gen_by_type(3);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs["ID"] == $person["GENERATION_ID"]) {
                                            echo $rs["GENERATION_PINYIN"];
                                        }
                                    }
                                    ?>
                                </h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>- ชื่อ</h5>
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control"autofocus id="chinaname_pinyin" name="chinaname_pinyin" value="<?php echo $chinaname['CHINANAME_PINYIN']; ?>" placeholder="ชื่อตัวเสียง pinyin" readOnly="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <h5>ชื่อตัวสำเนียงไทย </h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>หลิน </h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>- รุ่น</h5>
                            </div>
                            <div class="col-xs-3" >
                                <h5 id="gen_th">
                                    <?php
                                    $sql = get_gen_by_type(1);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs["ID"] == $person["GENERATION_ID"]) {
                                            echo $rs["GENERATION_TH"];
                                        }
                                    }
                                    $sql = get_gen_by_type(2);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs["ID"] == $person["GENERATION_ID"]) {
                                            echo $rs["GENERATION_TH"];
                                        }
                                    }
                                    $sql = get_gen_by_type(3);
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs["ID"] == $person["GENERATION_ID"]) {
                                            echo $rs["GENERATION_TH"];
                                        }
                                    }
                                    ?>
                                </h5>
                            </div>
                            <div class="col-xs-1">
                                <h5>- ชื่อ</h5>
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control"autofocus name="chinaname_thai" value="<?php echo $chinaname['CHINANAME_TH']; ?>" placeholder="ชื่อตัวสำเนียงไทย" readOnly="true">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-3">
                                <h5>รหัสบัตรประจำตัวประชาชน </h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" autofocus name="personalID" maxlength="13" value="<?php echo get_personalID($id) ?>" readOnly="true">
                            </div>
                            <div class="col-xs-2">
                                <h5> สถานนะ </h5>
                            </div>
                            <div class="col-xs-4">
                                <?php
                                if ($person['STATUS'] == 1) {
                                    ?>
                                    <input type="radio" name="status" value="1" checked="" >ยังมีชีวิตอยู่
                                    <input type="radio" name="status" value="2" >เสียชีวิต
                                    <?php
                                } else if ($person['STATUS'] == 2) {
                                    ?>
                                    <input type="radio" name="status" value="1" >ยังมีชีวิตอยู่
                                    <input type="radio" name="status" value="2" checked="" >เสียชีวิต
                                    <?php
                                } else {
                                    ?>
                                    <input type="radio" name="status" value="1" >ยังมีชีวิตอยู่
                                    <input type="radio" name="status" value="2"  >เสียชีวิต
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-1">
                                <h5>เพศ</h5>
                            </div>
                            <div class="col-xs-2" style="margin-top:8px">
                                <input type="radio" name="gender" value="1" <?php if ($person["GENDER_ID"] == 1) echo "checked"; ?> onclick="handleClick(this);" disabled="">ชาย
                                <input type="radio" name="gender" value="2" <?php if ($person["GENDER_ID"] == 2) echo "checked"; ?> onclick="handleClick(this);" disabled="">หญิง
                            </div>
                            <div class="col-xs-2">
                                <h5>วันเกิด(ค.ศ.)</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="date" class="form-control" autofocus name="birthday" value="<?php echo $person['BIRTHDAY']; ?>" readOnly="true">
                            </div>
                            <div class="col-xs-2">
                                <h5>สถานะภาพ</h5>
                            </div>
                            <div class="col-xs-2">
                                <select class="form-control" id="select" style="margin-top: 5px" name="maritalstatus" disabled="">
                                    <?php
                                    $sql = mysql_query("SELECT * FROM `maritalstatus` WHERE 1");
                                    while ($rs = mysql_fetch_array($sql)) {
                                        if ($rs["ID"] == $person["MARITALSTATUS_ID"]) {
                                            echo "<option value='" . $rs["ID"] . "' selected='selected'>" . $rs["MARITALSTATUS_NAME"] . " </option>";
//                                        echo "<option value='" . $rs["id"] . "' selected='selected'>" . $rs["type"] . " : " . $rs["name"] . " : " . $rs["pinyin"] . " : " . $rs["th"] . " </option>";
                                        } else {
                                            echo "<option value='" . $rs["ID"] . "'>" . $rs["MARITALSTATUS_NAME"] . " </option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3 col-xs-offset-8">
                                <a class="btn btn-material-deeporange" role="button" style="margin-top: 0px" onClick="javascript:window.open('../../admin/view/edit_person_detail.php?id=<?php echo $id ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=400,top=0,left=150 ')">แก้ไขข้อมูลส่วนตัว</a>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><h4>ข้อมูลการติดต่อเดิม</h4></legend>
                        <?php
                        $homeAddrs = get_person_all_address($id, 1);
                        $count = 1;
                        while ($homeAddr = mysql_fetch_assoc($homeAddrs)) {
//                    print_r($homeAddr);
                            ?>
                            <div class="row">
                                <div class="col-xs-2">
                                    <h5>ที่อยู่บ้าน<?php echo $count; ?></h5>
                                </div>
                                <div class="col-xs-8" style="margin-top: 1px">
                                    <h6>
                                        <?php
                                        echo get_addr_string($homeAddr);
// echo $homeAddr['ADDRESS_NUM'] . ' ' . $homeAddr['ADDRESS_VILLAGE'] . ' ' . $homeAddr['ADDRESS_ALLEY'] . ' หมู่ ' . $homeAddr['ADDRESS_MOO'] . ' ' . $homeAddr['ADDRESS_ROAD'] . ' ' . get_district_string($homeAddr['ADDRESS_DISTRICT_ID']) . ' ' . get_amphur_string($homeAddr['ADDRESS_AMPHUR_ID']) . ' ' . get_province_string($homeAddr['ADDRESS_PROVINCE_ID']) . ' ' . $homeAddr['ADDRESS_ZIPCODE'];
                                        ?>
                                    </h6>
                                </div>
                                <!--                        <div class="col-sm-2">
                                                            <a class="btn btn-danger" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">ลบที่อยู่บ้าน</a>
                                                        </div>-->
                            </div>
                            <?php
                            $count++;
                        }
                        ?>
                        <!--                <div class="row">
                                            <div class="col-sm-2 col-sm-offset-9">
                                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('add_form.php', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=500,height=650,top=0,left=150 ')">แก้ไขที่อยู่บ้าน</a>
                                            </div>
                                        </div>-->
                        <div class="row">
                            <div class="col-xs-6">
                                <?php
                                $homeTels = get_person_contact($id, 1);
                                $count = 1;
                                while ($homeTel = mysql_fetch_assoc($homeTels)) {
//                            print_r($homeTel);
                                    ?>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h5>เบอร์โทรศัพท์บ้าน<?php echo $count; ?></h5>
                                        </div>
                                        <div class="col-xs-6" style="margin-top: 1px">
                                            <h6>
                                                <?php echo $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING']; ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            <div class="col-xs-6">
                                <?php
                                $mobileTels = get_person_contact($id, 2);
                                $count = 1;
                                while ($mobileTel = mysql_fetch_assoc($mobileTels)) {
//                            print_r($homeTel);
                                    ?>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h5>มือถือ<?php echo $count; ?></h5>
                                        </div>
                                        <div class="col-xs-6" style="margin-top: 1px">
                                            <h6>
                                                <?php echo $mobileTel['CONTACT_ARER_CODE'] . '-' . $mobileTel['CONTACT_STRING']; ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $emails = get_person_contact($id, 3);
                            $email = mysql_fetch_assoc($emails);

                            if ($email) {
                                ?> <div class="col-xs-1">
                                    <h5>E mail</h5>
                                </div>
                                <div class="col-xs-2" style="margin-top: 1px">
                                    <h6>
                                        <?php echo $email['CONTACT_STRING']; ?>
                                    </h6>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            $emails = get_person_contact($id, 5);
                            $email = mysql_fetch_assoc($emails);

                            if ($email) {
                                ?> <div class="col-xs-1">
                                    <h5>Facebook</h5>
                                </div>
                                <div class="col-xs-2" style="margin-top: 1px">
                                    <h6>
                                        <?php echo $email['CONTACT_STRING']; ?>
                                    </h6>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            $emails = get_person_contact($id, 4);
                            $email = mysql_fetch_assoc($emails);

                            if ($email) {
                                ?> <div class="col-xs-1">
                                    <h5>Line</h5>
                                </div>
                                <div class="col-xs-2" style="margin-top: 1px">
                                    <h6>
                                        <?php echo $email['CONTACT_STRING']; ?>
                                    </h6>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <a class="btn btn-material-deeporange" role="button" style="margin-top: 0px" onClick="javascript:window.open('../../admin/view/detail_address.php?id=<?php echo $id ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=0,left=150 ')">ดูข้อมูลการติดต่อทั้งหมด</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <h4>ข้อมูลการติดต่อใหม่(ถ้ามีการเปลี่ยนแปลง)</h4>
                            </div>
                        </div>
                        <div class = "row">
                            <div class = "col-xs-2">
                                <h5>ที่อยู่บ้านใหม่</h5>
                            </div>
                            <div class = "col-xs-2">
                                <h5>บ้านเลขที่</h5>
                            </div>
                            <div class = "col-xs-2">
                                <input type = "text" class = "form-control" autofocus name = "addr_num" value = "">
                            </div>
                            <div class = "col-xs-1">
                                <h5>หมู่</h5>
                            </div>
                            <div class = "col-xs-1">
                                <input type = "text" class = "form-control" autofocus name = "addr_moo" value = "">
                            </div>
                            <div class = "col-xs-1">
                                <h5>หมู่บ้าน</h5>
                            </div>
                            <div class = "col-xs-3">
                                <input type = "text" class = "form-control" autofocus name = "addr_village" value = "">
                            </div>
                        </div>
                        <div class = "row">
                            <!--<div class = "col-xs-2">
                            <h4>หมู่บ้าน</h4>
                            </div>
                            <div class = "col-xs-2">
                            <input type = "text" class = "form-control" autofocus name = "addr_village" value = "">
                            </div> -->
                            <div class = "col-xs-1">
                                <h5>ซอย</h5>
                            </div>
                            <div class = "col-xs-3">
                                <input type = "text" class = "form-control" autofocus name = "addr_alley" value = "">
                            </div>
                            <div class = "col-xs-1">
                                <h5>ถนน</h5>
                            </div>
                            <div class = "col-xs-3">
                                <input type = "text" class = "form-control" autofocus name = "addr_road" value = "">
                            </div>
                            <div class = "col-xs-1">
                                <h5>ตำบล</h5>
                            </div>
                            <div class = "col-xs-3" style = "margin-top: 5px">
                                <select name = "addr_district" class = "district form-control" placeholder = "Your favorite pastry">>
                                    <option selected = "selected">เลือกจังหวัดก่อน</option>
                                </select>
                            </div>
                        </div>
                        <div class = "row">
                            <div class = "col-xs-1">
                                <h5>อำเภอ</h5>
                            </div>
                            <div class = "col-xs-3" style = "margin-top: 5px">
                                <select name = "addr_amphur" class = "amphur form-control" placeholder = "Your favorite pastry">>
                                    <option selected = "selected">เลือกจังหวัดก่อน</option>
                                </select>
                            </div>
                            <div class = "col-xs-1">
                                <h5>จังหวัด</h5>
                            </div>
                            <div class = "col-xs-3" style = "margin-top: 5px">
                                <select name = "addr_province" class = "province form-control" placeholder = "Your favorite pastry">
                                    <option >โปรดเลือกจังหวัด</option>
                                    <?php
                                    $sql = mysql_query("select PROVINCE_ID,PROVINCE_NAME from province where 1");
                                    while ($row = mysql_fetch_array($sql)) {
                                        $id_province = $row['PROVINCE_ID'];
                                        $data = $row['PROVINCE_NAME'];
                                        $data = str_replace(' ', '', $data);
                                        echo '<option value="' . $id_province . '">' . $data . '</option>';
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-xs-2">
                                <h5>รหัสไปรษณีย์</h5>
                            </div>
                            <div class="col-xs-2" style="margin-top: -5">
                                <input type="text" class="form-control" autofocus name="addr_zipcode" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <h6>โทรศัทพ์บ้านใหม่</h6>
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
                                <h5>เบอร์มือถือใหม่</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" autofocus name="moblie" value="" maxlength="10" onkeypress='validate(event)'>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="col-xs-2">
                                <h5>e-mail</h5>
                            </div>
                            <div class="col-xs-3">
                                <?php
//                            $emails = get_person_contact($id, 3);
//                            $email = mysql_fetch_assoc($emails);
//                            if ($email) {
////                                echo $email['CONTACT_STRING'];
//
                                ?>
                                    <!--<input type="email" class="form-control" autofocus name="email" value="//<?php // echo $email['CONTACT_STRING'];                                                                          ?>">-->
                                <?php
//                            } else {
//
                                ?>
                                <!--<input type="email" class="form-control" autofocus name="email" value="">-->
                                <?php
//                            }
//
                                ?>
                                <input type="email" class="form-control" autofocus name="email" value="">
                            </div>
                            <div class="col-xs-1">
                                <h5>facebook</h5>
                            </div>
                            <div class="col-xs-3">
                                <?php
//                            $fbs = get_person_contact($id, 3);
//                            $fb = mysql_fetch_assoc($fbs);
//                            if ($fb) {
////                                echo $fb['CONTACT_STRING'];
//
                                ?>
                                    <!--<input type="text" class="form-control" autofocus name="facebook" value="//<?php // echo $fb['CONTACT_STRING'];                                                                          ?>">-->
                                <?php
//                            } else {
//
                                ?>
                                <!--<input type="text" class="form-control" autofocus name="facebook" value="">-->
                                <?php
//                            }
                                ?>
                                <input type="text" class="form-control" autofocus name="facebook" value="">
                            </div>
                            <div class="col-xs-1">
                                <h5>lineID</h5>
                            </div>
                            <div class="col-xs-2">
                                <?php
//                            $lines = get_person_contact($id, 3);
//                            $line = mysql_fetch_assoc($lines);
//                            if ($line) {
////                                echo $fb['CONTACT_STRING'];
//
                                ?>
                                    <!--<input type="text" class="form-control" autofocus name="line" value="//<?php // echo $line['CONTACT_STRING'];                                                                         ?>">-->
                                <?php
//                            } else {
//
                                ?>
                                <!--<input type="text" class="form-control" autofocus name="line" value="">-->
                                <?php
//                            }
                                ?>
                                <input type="text" class="form-control" autofocus name="line" value="">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><h4>อาชีพ/ธุรกิจหลัก</h4></legend>
                        <?php
                        $checkOrganizations = get_person_organization($id);
                        $checkOrganization = mysql_fetch_assoc($checkOrganizations);
                        if (!$checkOrganization) {
                            ?>
                            <div class="row">
                                <div class="col-xs-6 col-xs-offset-2">
                                    <h4 class="text-danger">ไม่พบข้อมูลอาชีพ กรุณากดปุ่มเพิ่มข้อมูลอาชีพ</h4>
                                </div>
                            </div>
                            <?php
                        } else {
                            $organizationroles = get_person_organization($id);
                            $count = 1;
                            while ($organizationrole = mysql_fetch_assoc($organizationroles)) {
//                        print_r($organizationrole);
                                $organization_id = $organizationrole['ORGANIZATION_ID'];

                                $organizations = get_organization_data($organization_id);
                                $organization = mysql_fetch_assoc($organizations);
                                ?>
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border"><h5>อาชีพ/ธุรกิจ<?php echo $count; ?></h5></legend>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h5>ธุรกิจ</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <h6><?php echo get_organization_type_string($organization['ORGANIZATION_TYPE_ID']); ?></h6>
                                        </div>
                                        <div class="col-sm-2">
                                            <h5>ประเภทธุรกิจ</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <h6><?php echo $organization['ORGANIZATION_COMMENT']; ?></h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <h5>ชื่อ</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <h6><?php echo $organization['ORGANIZATION_NAME']; ?></h6>
                                        </div>
                                        <div class="col-sm-2">
                                            <h5>ตำแหน่งงาน</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <h6> <?php echo $organizationrole['ORGANIZATION_ROLE']; ?></h6>
                                        </div>
                                    </div>
                                    <?php
                                    $organizationAddrs = get_person_all_address($organization_id, 2);
                                    $count_addr = 1;
                                    while ($organizationAddr = mysql_fetch_assoc($organizationAddrs)) {
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <h5>ที่อยู่</h5>
                                            </div>
                                            <div class="col-sm-10">
                                                <h6> <?php echo $organizationAddr['ADDRESS_NUM'] . ' ' . $organizationAddr['ADDRESS_VILLAGE'] . ' ' . $organizationAddr['ADDRESS_ALLEY'] . ' ' . $organizationAddr['ADDRESS_MOO'] . ' ' . $organizationAddr['ADDRESS_ROAD'] . ' ' . get_district_string($organizationAddr['ADDRESS_DISTRICT_ID']) . ' ' . get_amphur_string($organizationAddr['ADDRESS_AMPHUR_ID']) . ' ' . get_province_string($organizationAddr['ADDRESS_PROVINCE_ID']) . ' ' . $organizationAddr['ADDRESS_ZIPCODE']; ?> </h6>
                                            </div>
                                        </div>
                                        <?php
                                        $count_addr++;
                                    }
                                    if ($count_addr == 1) {
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h5>ไม่พบข้อมูลที่อยู่</h5>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php
                                            $homeTels = get_person_contact($organization_id, 6);
                                            $count_temp = 1;
                                            while ($homeTel = mysql_fetch_assoc($homeTels)) {
//                            print_r($homeTel);
                                                ?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h5>เบอร์โทรศัพท์ที่ทำงาน<?php echo $count_temp; ?></h5>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h6>
                                                            <?php
                                                            echo $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING'];
                                                            if ($homeTel['CONTACT_COMMENT'] != '')
                                                                echo " ต่อ " . $homeTel['CONTACT_COMMENT']
                                                                ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                                <?php
                                                $count_temp++;
                                            }
                                            if ($count_temp == 1) {
                                                ?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h5>เบอร์โทรศัพท์ที่ทำงาน</h5>
                                                    </div>
                                                    <div class="col-sm-6" style="margin-top: 10px">
                                                        <?php echo '-'; ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?php
                                            $homeTels = get_person_contact($organization_id, 9);
                                            $count_temp = 1;
                                            while ($homeTel = mysql_fetch_assoc($homeTels)) {
//                            print_r($homeTel);
                                                ?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h5>faxที่ทำงาน<?php echo $count_temp; ?></h5>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h6>
                                                            <?php
                                                            echo $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING'];
                                                            if ($homeTel['CONTACT_COMMENT'] != '')
                                                                echo " ต่อ " . $homeTel['CONTACT_COMMENT']
                                                                ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                                <?php
                                                $count_temp++;
                                            }
                                            if ($count_temp == 1) {
                                                ?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h5>faxที่ทำงาน</h5>
                                                    </div>
                                                    <div class="col-sm-6" style="margin-top: 10px">
                                                        <?php echo '-'; ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <!--เวป-->
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5>เว็บไซต์ที่ทำงาน</h5>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6>
                                                        <?php
                                                        $emails = get_person_contact($organization_id, 7);
                                                        $email = mysql_fetch_assoc($emails);
                                                        if ($email)
                                                            echo $email['CONTACT_STRING'];
                                                        else
                                                            echo '-';
                                                        ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!--email-->
                                        <div class="col-sm-6">
                                            <?php
                                            $mobileTels = get_person_contact($organization_id, 8);
                                            $count_temp = 1;
                                            while ($mobileTel = mysql_fetch_assoc($mobileTels)) {
//                            print_r($homeTel);
                                                ?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h5>E-mailที่ทำงาน<?php echo $count_temp; ?></h5>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h6><?php echo $mobileTel['CONTACT_STRING']; ?></h6>
                                                    </div>
                                                </div>
                                                <?php
                                                $count_temp++;
                                            }
                                            if ($count_temp == 1) {
                                                ?>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h5>E-mailที่ทำงาน</h5>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <h6><?php echo '-'; ?></h6>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </fieldset>
                                <?php
                                $count++;
                            }
                            ?>
                            <div class="row">
                                <div class="col-xs-4 col-xs-offset-8">
                                    <a class="btn btn-material-deeporange" role="button" style="margin-top: 0px" onClick="javascript:window.open('detail_organization.php?id=<?php echo $id ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=650,top=0,left=150 ')">ดูข้อมูลอาชีพ/ธุรกิจทั้งหมด</a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>


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
                                <input type="text" class="form-control" autofocus name="organization_comment">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <h5>ชื่อสถานที่ทำงาน</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" autofocus name="organization_name">
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
                                <input type="text" class="form-control" autofocus name="organization_num">
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
                                        $id_province = $row['PROVINCE_ID'];
                                        $data = $row['PROVINCE_NAME'];
                                        $data = str_replace(' ', '', $data);
                                        echo '<option value="' . $id_province . '">' . $data . '</option>';
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="col-xs-2">
                                <h5>รหัสไปรษณีย์</h5>
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" autofocus name="organization_zipcode" value="">
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
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><h4>ครอบครัว</h4></legend>

                        <!--                <div class="row">
                                            <div class="col-xs-4">
                                                <h4>ชื่อนามสกุล มารดา</h4>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" autofocus name="mom" value="">
                                            </div>
                                            <div class="col-xs-1">
                                                <h4>สถานะ</h4>
                                            </div>
                                            <div class="col-xs-4" style="margin-top: 10px;">
                                                <input type="checkbox" name="z" value="ยังไมีชีวิตอยู่">ยังมีชีวิตอยู่
                                                <input type="checkbox" name="z" value="เสียชีวิต" >เสียชีวิต
                                            </div>
                                        </div>-->
                        <div class="row">
                            <?php
                            if ($person['MOTHER_ID'] != 0) {
                                ?>
                                <div class="col-xs-3">
                                    <h5>ชื่อ-นามสกุลมารดา</h5>
                                </div>
                                <div class="col-xs-3" style="margin-top: 7px;">
                                    <?php echo get_person_name_string($person['MOTHER_ID']) . " " . get_person_surname_string($person['MOTHER_ID']); ?>
                                </div>
                                <div class="col-xs-1 col-xs-offset-1">
                                    <h5>สถานะ</h5>
                                </div>
                                <div class="col-xs-3" style="margin-top: 7px;">
                                    <input type="radio" name="mother_status" value="1" <?php if (get_status($person['MOTHER_ID']) == 1) echo "checked"; ?>>ยังมีชีวิตอยู่
                                    <input type="radio" name="mother_status" value="2"  <?php if (get_status($person['MOTHER_ID']) == 2) echo "checked"; ?>>เสียชีวิต
                                </div>
                                <div class="col-xs-1" style="margin-top: 7px;">
                                    <a role="button" style="margin-top: 0px" onClick="javascript:window.open('../../admin/view/edit_person_detail.php?id=<?php echo $person['MOTHER_ID'] ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=400,top=0,left=150 ')">แก้ไขข้อมูล</a>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-xs-3">
                                    <h5>ชื่อ-นามสกุลมารดา</h5>
                                </div>
                                <div class="col-xs-4">
                                    <input type="text" list="list_mother" class="mother_list form-control" name="mother" />
                                    <datalist id="list_mother" class="list_mother">

                                    </datalist>
                                </div>
                                <div class="col-xs-1 col-xs-offset-1">
                                    <h5>สถานะ</h5>
                                </div>
                                <div class="col-xs-3" style="margin-top: 5px;">
                                    <input type="radio" name="mother_status" value="1" >ยังมีชีวิตอยู่
                                    <input type="radio" name="mother_status" value="2" >เสียชีวิต
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="row">
                            <?php
                            if ($person['PARENT_ID'] != 0) {
                                ?>
                                <div class="col-xs-3">
                                    <h5>ชื่อ-นามสกุลบิดา</h5>
                                </div>
                                <div class="col-xs-3" style="margin-top: 7px;">
                                    <?php echo get_person_name_string($person['PARENT_ID']) . " " . get_person_surname_string($person['PARENT_ID']); ?>
                                </div>
                                <div class="col-xs-1 col-xs-offset-1">
                                    <h5>สถานะ</h5>
                                </div>
                                <div class="col-xs-3" style="margin-top: 7px;">
                                    <input type="radio" name="parent_status" value="1" <?php if (get_status($person['PARENT_ID']) == 1) echo "checked"; ?>>ยังมีชีวิตอยู่
                                    <input type="radio" name="parent_status" value="2"  <?php if (get_status($person['PARENT_ID']) == 2) echo "checked"; ?>>เสียชีวิต
                                </div>
                                <div class="col-xs-1" style="margin-top: 7px;">
                                    <a role="button" style="margin-top: 0px" onClick="javascript:window.open('../../admin/view/edit_person_detail.php?id=<?php echo $person['PARENT_ID'] ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=400,top=0,left=150 ')">แก้ไขข้อมูล</a>
                                </div>
                                <?php
                            } else {
                                ?>
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
                                    <input type="radio" name="parent_status" value="1" >ยังมีชีวิตอยู่
                                    <input type="radio" name="parent_status" value="2" >เสียชีวิต
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><h4>ที่อยู่บรรพบุรุษประเทศจีนเดิม</h4></legend>

                        <?php
                        if ($person['CHINAHOUSE_ID'] != 0) {
                            $chinahouses = get_chinahouse_data($person['CHINAHOUSE_ID']);
                            $chinahouse = mysql_fetch_assoc($chinahouses);
//                        print_r($chinahouse);
                            if ($chinahouse['CHINAHOUSE_VILLAGE_ID'] == 0) {
                                $chinahouse_village = give_china_data();
                            } else {
                                $chinahouse_villages = get_china($chinahouse['CHINAHOUSE_VILLAGE_ID']);
                                $chinahouse_village = mysql_fetch_assoc($chinahouse_villages);
                            }

                            if ($chinahouse['CHINAHOUSE_DISTRICT_ID'] == 0) {
                                $chinahouse_district = give_china_data();
                            } else {
                                $chinahouse_districts = get_china($chinahouse['CHINAHOUSE_DISTRICT_ID']);
                                $chinahouse_district = mysql_fetch_assoc($chinahouse_districts);
                            }

                            if ($chinahouse['CHINAHOUSE_AMPHUR_ID'] == 0) {
                                $chinahouse_amphur = give_china_data();
                            } else {
                                $chinahouse_amphurs = get_china($chinahouse['CHINAHOUSE_AMPHUR_ID']);
                                $chinahouse_amphur = mysql_fetch_assoc($chinahouse_amphurs);
                            }

                            if ($chinahouse['CHINAHOUSE_PROVINCE_ID'] == 0) {
                                $chinahouse_province = give_china_data();
                            } else {
                                $chinahouse_provinces = get_china($chinahouse['CHINAHOUSE_PROVINCE_ID']);
                                $chinahouse_province = mysql_fetch_assoc($chinahouse_provinces);
                            }
//                        $chinahouse_village;
//                        print_r($chinahouse_amphur);
                            ?>
                            <div class="row">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border"><h5>ที่อยู่เดิม</h5></legend>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <h5>ชื่อนามสกุลผู้ติดต่อ</h5>
                                        </div>
                                        <div class="col-xs-2" style="margin-top: 7px;">
                                            <?php
                                            if ($chinahouse['CHINAHOUSE_NAME'] == '')
                                                echo '-';
                                            else
                                                echo $chinahouse['CHINAHOUSE_NAME'];
                                            ?>
                                        </div>
                                        <div class="col-xs-2">
                                            <h5>ความสัมพันธ์</h5>
                                        </div>
                                        <div class="col-xs-2" style="margin-top: 7px;">
                                            <?php
                                            if ($chinahouse['CHINAHOUSE_LINK'] == '')
                                                echo '-';
                                            else
                                                echo $chinahouse['CHINAHOUSE_LINK'];
                                            ?>
                                        </div>
                                        <div class="col-xs-2">
                                            <h5>เบอร์ติดต่อ</h5>
                                        </div>
                                        <div class="col-xs-2" style="margin-top: 7px;">
                                            <?php
                                            if ($chinahouse['CHINAHOUSE_TEL'] == '')
                                                echo '-';
                                            else
                                                echo $chinahouse['CHINAHOUSE_TEL'];
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    if ($chinahouse_village['CHINA_STR'] != '' || $chinahouse_district['CHINA_STR'] != '' || $chinahouse_amphur['CHINA_STR'] != '' || $chinahouse_province['CHINA_STR'] != '') {
//                                    echo "1234";
                                        ?>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                地址 :
                                            </div>
                                            <div class="col-xs-8">
                                                <?php
                                                if ($chinahouse_village['CHINA_STR'] != '')
                                                    echo $chinahouse_village['CHINA_STR'];
                                                else
                                                    echo '- ';
                                                echo'村, ';

                                                if ($chinahouse_district['CHINA_STR'] != '')
                                                    echo $chinahouse_district['CHINA_STR'];
                                                else
                                                    echo '- ';
                                                echo'區, ';

                                                if ($chinahouse_amphur['CHINA_STR'] != '')
                                                    echo $chinahouse_amphur['CHINA_STR'];
                                                else
                                                    echo '- ';
                                                echo'镇, ';

                                                if ($chinahouse_province['CHINA_STR'] != '')
                                                    echo $chinahouse_province['CHINA_STR'];
                                                else
                                                    echo '- ';
                                                echo'省';
                                                ?>
                                            </div>
                                            <div class="col-xs-2">
                                                <a class="btn btn-material-orange" role="button" style="margin-top: 0px" onClick="javascript:window.open('../../admin/view/edit_chinahouse_form.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=350,top=150,left=150 ')">แก้ไขข้อมูลที่อยู่บรรพบุรุษที่จีน</a>
                                            </div>
                                        </div>
                                        <?php
                                    }
//                                if($chinahouse_village['CHINA_PINYIN'] != '' || $chinahouse_district['CHINA_PINYIN'] != '' || $chinahouse_amphur['CHINA_PINYIN'] != '' || $chinahouse_province['CHINA_PINYIN'] != ''){
//                                    echo "1234";
//                                }
                                    if ($chinahouse_village['CHINA_TH'] != '' || $chinahouse_district['CHINA_TH'] != '' || $chinahouse_amphur['CHINA_TH'] != '' || $chinahouse_province['CHINA_TH'] != '') {
//                                    echo "1234";
                                        ?>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                ภาษาไทย :
                                            </div>
                                            <div class="col-xs-8">
                                                <?php
                                                echo'หมู่บ้าน ';
                                                if ($chinahouse_village['CHINA_TH'] != '')
                                                    echo $chinahouse_village['CHINA_TH'];
                                                else
                                                    echo '- ';

                                                echo' ตำบล ';
                                                if ($chinahouse_district['CHINA_TH'] != '')
                                                    echo $chinahouse_district['CHINA_TH'];
                                                else
                                                    echo '- ';
//                                        echo'區, ';
                                                echo' อำเภอ ';
                                                if ($chinahouse_amphur['CHINA_TH'] != '')
                                                    echo $chinahouse_amphur['CHINA_TH'];
                                                else
                                                    echo '- ';
//                                        echo'镇, ';
                                                echo' จังหวัด ';
                                                if ($chinahouse_province['CHINA_TH'] != '')
                                                    echo $chinahouse_province['CHINA_TH'];
                                                else
                                                    echo '- ';
//                                        echo'省';
                                                ?>
                                            </div>

                                        </div>
                                        <?php
                                    }
                                    ?>
                                </fieldset>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>ที่อยู่ใหม่(ถ้ามีการเปลี่ยนแปลง)</h4>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>4.ที่อยู่บรรพบุรุษประเทศจีน</h4>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
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
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><h4>ชื่อนามสกุล ของพี่-น้องร่วมบิดา-มารดาเดียวกัน</h4></legend>
                        <?php
                        if ($person['PARENT_ID'] != 0 || $person['BROTHER_LIST'] != '') {
                            ?>
                            <div class="row">

                                <?php
                                $count_brother = 1;
                                $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $person['ID']);
                                while ($brother = mysql_fetch_assoc($brothers)) {
//                                    print_r($brother);
                                    ?>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <h5><?php echo $count_brother; ?>.ชื่อนามสกุล</h5>
                                        </div>
                                        <div class="col-xs-3" style="margin-top: 7px;">
                                            <?php echo get_person_name_string($brother['ID']) . " " . get_person_surname_string($brother['ID']); ?>
                                        </div>
                                        <div class="col-xs-1 col-xs-offset-0">
                                            <h5>วันเกิด</h5>
                                        </div>
                                        <div class="col-xs-1" style="margin-top: 10px;">
                                            <?php
                                            $date = date_create($brother['BIRTHDAY']);
                                            echo date_format($date, "m/d/Y");
                                            ?>
                                        </div>
                                        <div class="col-xs-1 col-xs-offset-1">
                                            <h5>สถานะ</h5>
                                        </div>
                                        <div class="col-xs-2" style="margin-top: 7px;">
                                            <?php
                                            if (get_status($brother['ID']) == 1) {
                                                echo "ยังมีชีวิตอยู่";
                                            } elseif (get_status($brother['ID']) == 2) {
                                                echo "เสียชีวิต";
                                            } else {
                                                echo "ไม่ระบุ";
                                            }
                                            ?>
                                        </div>
                                        <div class="col-xs-1" style="margin-top: 7px;">
                                            <a role="button" style="margin-top: 0px" onClick="javascript:window.open('../../admin/view/edit_person_detail.php?id=<?php echo $brother['ID'] ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=400,top=0,left=150 ')">แก้ไขข้อมูล</a>
                                        </div>
                                    </div>
                                    <?php
                                    $count_brother++;
                                }
                                if ($count_brother == 1) {
                                    ?>
                                    <div class="col-xs-6 col-xs-offset-4">
                                        <h4 class="text-danger">ไม่พบข้อมูลพี่น้อง</h4>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            <div class="row">
                                <div class="col-xs-12" ><h4>ชื่อนามสกุล ของพี่-น้องร่วมบิดา-มารดาเดียวกัน(เพิ่มเติม)</h4></div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-xs-12" ><h4>ชื่อนามสกุล ของพี่-น้องร่วมบิดา-มารดาเดียวกัน</h4></div>
                            </div>
                            <?php
                        }
                        ?>

                        <input type="text" name="count_bro" id="count_bro" value="0" hidden="">
                        <div class="brother" id="brother">
                            <div class="row">
                                <div class="col-xs-3">
                                    <h5>1.ชื่อนามสกุล</h5>
                                </div>
                                <div class="col-xs-4">
                                    <input type="text" class="namebro1 form-control" list="list_bro1" autofocus name="namebro1" value="" onkeypress="nextbro(this);" onkeyup="get_listData(this);" onchange="get_personData(this);">
                                    <datalist id="list_bro1" class="list_bro1">

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
                    </fieldset>
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><h4>6. ชื่อนามสกุล ของบุตร-ธิดา(เดิม)</h4></legend>
                        <?php
                        $query = "SELECT * FROM person WHERE PARENT_ID = $id OR MOTHER_ID = $id";
//                    echo $query;
                        $check = mysql_fetch_assoc(mysql_query($query));
//                    print_r ($check);
                        if ($check) {
                            ?>
                            <div class="row">

                                <?php
                                $childs = mysql_query($query);
                                $count = 1;
                                while ($child = mysql_fetch_assoc($childs)) {
//                                    print_r($child);
                                    ?>
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <h5><?php echo $count; ?>.ชื่อนามสกุล</h5>
                                        </div>
                                        <div class="col-xs-3" style="margin-top: 7px;">
                                            <?php echo get_person_name_string($child['ID']) . " " . get_person_surname_string($child['ID']); ?>
                                        </div>
                                        <div class="col-xs-1 col-xs-offset-0">
                                            <h5>วันเกิด</h5>
                                        </div>
                                        <div class="col-xs-1" style="margin-top: 10px;">
                                            <?php
                                            $date = date_create($child['BIRTHDAY']);
                                            echo date_format($date, "m/d/Y");
                                            ?>
                                        </div>
                                        <div class="col-xs-1 col-xs-offset-1">
                                            <h5>สถานะ</h5>
                                        </div>
                                        <div class="col-xs-2" style="margin-top: 7px;">
                                            <?php
                                            if (get_status($child['ID']) == 1) {
                                                echo "ยังมีชีวิตอยู่";
                                            } elseif (get_status($child['ID']) == 2) {
                                                echo "เสียชีวิต";
                                            } else {
                                                echo "ไม่ระบุ";
                                            }
                                            ?>
                                        </div>
                                        <div class="col-xs-1" style="margin-top: 7px;">
                                            <a role="button" style="margin-top: 0px" onClick="javascript:window.open('../../admin/view/edit_person_detail.php?id=<?php echo $child['ID'] ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=900,height=400,top=0,left=150 ')">แก้ไขข้อมูล</a>
                                        </div>
                                    </div>
                                    <?php
                                    $count++;
                                }
                                if ($count == 1) {
                                    ?>
                                    <div class="col-xs-6 col-xs-offset-4">
                                        <h4 class="text-danger">ไม่พบข้อมูลพี่น้อง</h4>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="row">
                                <div class="col-xs-12" ><h4>ชื่อนามสกุล ของพี่-น้องร่วมบิดา-มารดาเดียวกัน(เพิ่มเติม)</h4></div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-xs-12" ><h4>6. ชื่อนามสกุล ของบุตร-ธิดา</h4></div>
                            </div>
                            <?php
                        }
                        ?>
                        <input type="text" name="count_child" id="count_child" value="0" hidden="">
                        <div class="children" id="children">
                            <div class="row">
                                <div class="col-xs-3">
                                    <h5>1.ชื่อนามสกุล</h5>
                                </div>
                                <div class="col-xs-4">
                                    <input type="text" class="namechild1 form-control" list="list_child1" autofocus name="namechild1" value="" onkeypress="nextchild(this);" onkeyup="get_listData(this);" onchange="get_personData(this);">
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
                    </fieldset>
                </div>

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
                <div class="row" style="margin-top: 0px">
                    <div class="col-xs-2" style="margin-top:0">
                        <a class="btn btn-danger" role="button" onClick="del('<?php echo get_person_name_string($id) . " " . get_person_surname_string($id); ?>', '<?php echo $id; ?>')">ลบข้อมูล</a>
                    </div>

                    <div class="col-xs-2 col-xs-offset-4">
                        <a class="btn btn-danger" role="button" onClick="javascript
                                :window.close()">ยกเลิก</a>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-success" type="submit" name="search">บันทึก และ ลงทะเบียน</button>
                    </div>
                </div>
                <!--                <div class="row" style="margin-top: 0px">
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <a class="btn btn-danger" role="button" onClick="javascript:window.close()">ยกเลิก</a>
                                    </div>
                                    <div class="col-xs-4">
                                        <button class="btn btn-success" type="submit" name="search">บันทึก และ ลงทะเบียน</button>
                                    </div>
                                </div>-->

            </form>
        </div>
    </body>
</html>
