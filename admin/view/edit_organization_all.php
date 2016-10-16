<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
$id = $_GET['id'];
$organization_id = $_GET["organization_id"];
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
            function autoTab2(obj, typeCheck) {

                if (typeCheck == 1) {
                    if (obj.value.length >= 2) {
                        if (obj.value.charAt(1) == "2") {
                            var pattern = new String("__-___-____"); // กำหนดรูปแบบในนี้
                        } else {
                            var pattern = new String("___-___-___"); // กำหนดรูปแบบในนี้
                        }
                    }
                    var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
                } else {
                    var pattern = new String("___-___-____"); // กำหนดรูปแบบในนี้
                    var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้					
                }
                var returnText = new String("");
                var obj_l = obj.value.length;
                var obj_l2 = obj_l - 1;
                for (i = 0; i < pattern.length; i++) {
                    if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                        returnText += obj.value + pattern_ex;
                        obj.value = returnText;
                    }
                }
                if (obj_l >= pattern.length) {
                    obj.value = obj.value.substr(0, pattern.length);
                }
            }
            $(document).ready(function() {
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
            });
        </script>
    </head>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class=" col-sm-10">
            <center>                
                <?php
                include '../../helper/db_connect.php';
                include '../../helper/helper.php';

                connect_database();
                $organizationAddrs = get_organization($id,$organization_id);
                $organizationAddr = mysql_fetch_assoc($organizationAddrs);
//                print_r($organizationAddr);
                ?>
                <div class="row">
                    <h1>เพิ่มข้อมูลสถานที่ทำงาน
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
                <form  action="../action/edit_organization.php" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                    <input type="text" name="id" hidden="hidden" value="<?php echo $id; ?>">
                    <input type="text" name="organization_id" hidden="hidden" value="<?php echo $organization_id; ?>">
                    <div class="row">
                        <div class="col-xs-1">
                            <h5>ธุรกิจ</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5">
                            <select class="form-control" autofocus name="organizationtype" >
                                <?php
                                $sql = mysql_query("SELECT * FROM `organizationtype` WHERE 1");
                                while ($rs = mysql_fetch_array($sql)) {
                                    if ($organizationAddr['ORGANIZATION_TYPE_ID'] == $rs["ID"])
                                        echo "<option value='" . $rs["ID"] . "' selected>" . $rs["ORGANIZATIONTYPE_NAME"] . " </option>";
                                    else
                                        echo "<option value='" . $rs["ID"] . "'>" . $rs["ORGANIZATIONTYPE_NAME"] . " </option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <h5>ประเภทธุรกิจหลัก</h5>
                        </div>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" autofocus name="organization_comment" value="<?php echo $organizationAddr['ORGANIZATION_COMMENT'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <h5>ชื่อสถานที่ทำงาน</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="organization_name" value="<?php echo $organizationAddr['ORGANIZATION_NAME'] ?>">
                        </div>
                        <div class="col-xs-2">
                            <h5>ตำแหน่งงาน</h5>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" autofocus name="organization_role"  value="<?php echo $organizationAddr['ORGANIZATION_ROLE'] ?>">
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
                            <input type="text" class="form-control" autofocus name="organization_num"  value="<?php echo $organizationAddr['ADDRESS_NUM'] ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>หมู่</h5>
                        </div>
                        <div class="col-xs-1">
                            <input type="text" class="form-control" autofocus name="organization_moo"  value="<?php echo $organizationAddr['ADDRESS_MOO'] ?>">
                        </div>
                        <div class="col-xs-2">
                            <h5>หมู่บ้าน</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="organization_village"  value="<?php echo $organizationAddr['ADDRESS_VILLAGE'] ?>">
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
                            <input type="text" class="form-control" autofocus name="organization_alley"  value="<?php echo $organizationAddr['ADDRESS_ALLEY'] ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>ถนน</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="organization_road"  value="<?php echo $organizationAddr['ADDRESS_ROAD'] ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>ตำบล</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px">

                            <select name="organization_district" class="district form-control" placeholder="Your favorite pastry">
                                  <?php
                                $sql = mysql_query("select DISTRICT_ID,DISTRICT_NAME from district where PROVINCE_ID=" . $organizationAddr["ADDRESS_PROVINCE_ID"] . " and AMPHUR_ID=" . $organizationAddr["ADDRESS_AMPHUR_ID"]);
                                while ($row = mysql_fetch_array($sql)) {
                                    $id = $row['DISTRICT_ID'];
                                    $data = $row['DISTRICT_NAME'];
                                    if ($id == $organizationAddr['ADDRESS_DISTRICT_ID']) {
                                        echo '<option value="' . $id . '" selected ="selected">' . $data . '</option>';
                                    } else {
                                        echo '<option value="' . $id . '">' . $data . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                            <h5>อำเภอ</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px">
                            <select name="addr_amphur" class="amphur form-control" placeholder="Your favorite pastry">>
                                <?php
                                $sql = mysql_query("select AMPHUR_ID,AMPHUR_NAME from amphur where PROVINCE_ID=" . $organizationAddr["ADDRESS_PROVINCE_ID"]);
                                while ($row = mysql_fetch_array($sql)) {
                                    $id = $row['AMPHUR_ID'];
                                    $data = $row['AMPHUR_NAME'];
                                    if ($id == $organizationAddr['ADDRESS_AMPHUR_ID']) {
                                        echo '<option value="' . $id . '" selected ="selected">' . $data . '</option>';
                                    } else {
                                        echo '<option value="' . $id . '">' . $data . '</option>';
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="col-xs-1">
                            <h5>จังหวัด</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px">
                            <select name="addr_province" class="province form-control" placeholder="Your favorite pastry">>
                                <option selected="selected" value="">--เลือกจังหวัด--</option>
                                <?php
                                $sql = mysql_query("select PROVINCE_ID,PROVINCE_NAME from province where 1");
                                while ($row = mysql_fetch_array($sql)) {
                                    $id = $row['PROVINCE_ID'];
                                    $data = $row['PROVINCE_NAME'];
                                    if ($id == $organizationAddr["ADDRESS_PROVINCE_ID"]) {
                                        echo '<option value="' . $id . '" selected ="selected">' . $data . '</option>';
                                    } else {
                                        echo '<option value="' . $id . '">' . $data . '</option>';
                                    }
                                }
                                ?>
                            </select> 

                        </div>
                        <div class="col-xs-2">
                            <h5>รหัสไปรษณีย์</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="organization_zipcode" value="<?php echo $organizationAddr['ADDRESS_ZIPCODE'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <?php
                                    $homeTels = get_person_contact($organization_id, 6);
                                    $homeTel = mysql_fetch_assoc($homeTels)
                                        ?>
                        <div class="col-xs-1">
                            <h5>โทรศัพท์</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="organization_tel" onkeyup="autoTab2(this, 1)" value="<?php if($homeTel){echo $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING'];} ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>ต่อ</h5>
                        </div>
                        <div class="col-xs-1">
                            <input type="text" class="form-control" autofocus name="organization_tel_comment" value="<?php echo $homeTel['CONTACT_COMMENT']; ?>">
                        </div>
                        <?php
                                    $homeTels = get_person_contact($organization_id, 9);
                                    $homeTel = mysql_fetch_assoc($homeTels)
                                        ?>
                        <div class="col-xs-1">
                            <h5>Fax</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="organization_fax" onkeyup="autoTab2(this, 1)" value="<?php if($homeTel){echo $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING'];} ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>ต่อ</h5>
                        </div>
                        <div class="col-xs-1">
                            <input type="text" class="form-control" autofocus name="organization_fax_comment" value="<?php echo $homeTel['CONTACT_COMMENT']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <?php
                                    $homeTels = get_person_contact($organization_id, 7);
                                    $homeTel = mysql_fetch_assoc($homeTels)
                                        ?>
                        <div class="col-xs-1">
                            <h5>website</h5>
                        </div>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" autofocus name="organization_web" value="<?php echo $homeTel['CONTACT_STRING']; ?>">
                        </div>
                        <?php
                                    $homeTels = get_person_contact($organization_id, 8);
                                    $homeTel = mysql_fetch_assoc($homeTels)
                                        ?>
                        <div class="col-xs-1">
                            <h5>Email</h5>
                        </div>
                        <div class="col-xs-5">
                            <input type="email" class="form-control" autofocus name="organization_mail" value="<?php echo $homeTel['CONTACT_STRING']; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2">
                            <a class="btn btn-material-orange" role="button" onClick="history.go(-1);
                                    return true;">ย้อนกลับ</a>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-success" type="submit" name="search">บันทึก</button>
                        </div>    
                    </div>
                </form>
            </div>
    </body>
</html>