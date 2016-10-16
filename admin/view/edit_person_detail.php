<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
$id = $_GET['id'];
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
        <script>
            function del(data, id, table) {
                var string = "คุณต้องการลบ " + data;
                var r = confirm(string + "\n" + "ออกจากระบบ?");
                if (r === true) {
//                    add data to db
//                window.location = 'adding.php?code=' + code + '&department=' + department;
                    window.location = '../action/del.php?table=' + table + '&id=' + id;
                }
            }
            function check(id, data) {
                var string = "คุณต้องการเพิ่มชื่อจีนของ " + data;
                var r = confirm(string + "\n" + "สู่ระบบ?");
                if (r === true) {
                    window.location = '../action/checkparent.php?id=' + id + '&type=create';
                }
            }

            $(document).ready(function () {
                $("#list_gen").change(function () {
                    var gen_id = $(this).val();
                    var dataString = 'generation=' + gen_id;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    var res = html.split("/");
                                    $("#gen_pinyin").html(res[0]);
                                    $("#gen_th").html(res[1]);
                                }
                            });
                });
                $("#chinaname").change(function () {
                    var china_str = $(this).val();
                    var dataString = 'china_str=' + china_str;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {
                                    document.getElementById('chinaname_pinyin').value = html;
                                }
                            });
                });
            });
        </script>
    </head>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class=" col-sm-12">
            <center>                
                <?php
                include '../../helper/db_connect.php';
                include '../../helper/helper.php';

                connect_database();

                $persons = get_person_detial($id);
                $person = mysql_fetch_assoc($persons);
//                print_r($person);
                ?>
                <div class="row">
                    <h1>แก้ไขข้อมูลส่วนตัว 
                        <?php
//if($person['TITLE_ID'] != 0)
//                            echo get_person_title_string($person['TITLE_ID']) . ' ' . $person['NAME'] . '  ' . $person['SURNAME'];
//                        else
//                            echo $person['NAME'] . '  ' . $person['SURNAME'];
                        ?>
                    </h1>
                </div>
            </center> 
            <div class="well">
                <form  action="../action/edit_person.php" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                    <div class="row">
                        <h3>ข้อมูลส่วนตัว</h3>
                        <input type="text" name="id" hidden="hidden" value="<?php echo $id; ?>">
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
                                    if ($person["TITLE_ID"] == $rs["ID"])
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
                            <input type="text" class="form-control" autofocus name="name" required value="<?php echo get_person_name_string($id); ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>นามสกุล</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="surname" required value="<?php echo get_person_surname_string($id); ?>">
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
                        <div class="col-xs-3" style="margin: 5 0px" >
                            <select class="form-control" autofocus name="generation" id="list_gen">
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
                            <input type="text" class="form-control"autofocus id="chinaname" name="chinaname" value="<?php echo $chinaname['CHINANAME_NAME']; ?>" placeholder="ชื่อตัวอักษรจีน">
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
                            <input type="text" class="form-control"autofocus id="chinaname_pinyin" name="chinaname_pinyin" value="<?php echo $chinaname['CHINANAME_PINYIN']; ?>" placeholder="ชื่อตัวเสียง pinyin">
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
                            <input type="text" class="form-control"autofocus name="chinaname_thai" value="<?php echo $chinaname['CHINANAME_TH']; ?>" placeholder="ชื่อตัวสำเนียงไทย">
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <h5>รหัสบัตรประจำตัวประชาชน </h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="personalID" maxlength="13" width="20" value="<?php echo get_personalID($id) ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>สถานะ</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top:5px">
                            <input type="radio" name="status" value="1" <?php
                            if ($person['STATUS'] == 1) {
                                echo "checked";
                            }
                            ?>>ยังมีชีวิตอยู่
                            <input type="radio" name="status" value="/" <?php
                            if ($person['STATUS'] == 2) {
                                echo "checked";
                            }
                            ?>>เสียชีวิตแล้ว
                        </div>
                        <div class="col-xs-1">
                            <h5>เพศ</h5>
                        </div>
                        <div class="col-xs-2" style="margin-top:8px">
                            <input type="radio" name="gender" required value="1" <?php
                            if ($person["GENDER_ID"] == 1) {
                                echo "checked";
                            }
                            ?>>ชาย
                            <input type="radio" name="gender" value="2" <?php
                            if ($person["GENDER_ID"] == 2) {
                                echo "checked";
                            }
                            ?>>หญิง
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-2">
                            <h5>วันเกิด(ค.ศ.)</h5>
                        </div>
                        <div class="col-xs-5">
                            <input type="date" class="form-control" autofocus name="birthday" value="<?php echo $person['BIRTHDAY']; ?>">
                        </div>
                        <div class="col-xs-2">
                            <h5>สถานะภาพ</h5>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" id="select" style="margin-top: 5px" name="maritalstatus">
                                <?php
                                $sql = mysql_query("SELECT * FROM `maritalstatus` WHERE 1");
                                while ($rs = mysql_fetch_array($sql)) {
                                    if ($person["MARITALSTATUS_ID"] == $rs["ID"])
                                        echo "<option value='" . $rs["ID"] . "' selected='selected'>" . $rs["MARITALSTATUS_NAME"] . " </option>";
                                    else
                                        echo "<option value='" . $rs["ID"] . "'>" . $rs["MARITALSTATUS_NAME"] . " </option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <button class="btn btn-success" type="submit" name="search">บันทึก</button>
                        </div>    
                    </div>
                </form>
            </div>
    </body>
</html>