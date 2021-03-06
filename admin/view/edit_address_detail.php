<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
$id = $_GET['id'];
$addr_id = $_GET['addr_id'];
//echo $addr_id;
$type = $_GET['type'];
if (isset($_GET['p_id'])) {
    $person_id = $_GET['p_id'];
} else {
    $person_id = $id;
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
        <link href="../../css/fieldset.css" rel="stylesheet" type="text/css"/>
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
            $(document).ready(function () {
                $(".province").change(function ()
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
                                success: function (html)
                                {
                                    $(".amphur").html(html);
                                }
                            });
                    $(".district").html('<option selected="selected">เลือกอำเภอก่อน</option>');
                });
                $(".amphur").change(function ()
                {
                    var id = $(this).val();
                    var dataString = 'AMPHUR_ID=' + id;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
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
        <div class=" col-sm-12">
            <center>                
                <?php
                include '../../helper/db_connect.php';
                include '../../helper/helper.php';

                connect_database();

                $sql = mysql_query("SELECT * FROM `address` WHERE `ID`=$addr_id");
                $address = mysql_fetch_assoc($sql);
//                print_r($address);
                ?>
                <div class="row">
                    <h1>แก้ไขข้อมูลการติดต่อ 
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
                <form  action="../action/edit_address.php" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                    <input type="text" name="id" hidden="hidden" value="<?php echo $id; ?>">
                    <input type="text" name="addr_id" hidden="hidden" value="<?php echo $addr_id; ?>">
                    <input type="text" name="type" hidden="hidden" value="<?php echo $type; ?>">
                    <input type="text" name="p_id" hidden="hidden" value="<?php echo $person_id; ?>">
                    <div class="row">
                        <div class="col-xs-2">
                            <h5>ที่อยู่บ้าน</h5>
                        </div>
                        <div class="col-xs-2">
                            <h5>บ้านเลขที่</h5>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" autofocus name="addr_num" value="<?php echo $address["ADDRESS_NUM"]; ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>หมู่</h5>
                        </div>
                        <div class="col-xs-1">
                            <input type="text" class="form-control" autofocus name="addr_moo" value="<?php echo $address["ADDRESS_MOO"]; ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>หมู่บ้าน</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="addr_village" value="<?php echo $address["ADDRESS_VILLAGE"]; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                            <h5>ซอย</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="addr_alley" value="<?php echo $address["ADDRESS_ALLEY"]; ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>ถนน</h5>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" autofocus name="addr_road" value="<?php echo $address["ADDRESS_ROAD"]; ?>">
                        </div>
                        <div class="col-xs-1">
                            <h5>ตำบล</h5>
                        </div>
                        <div class="col-xs-3" style="margin-top: 5px">
                            <select name="addr_district" class="district form-control" placeholder="Your favorite pastry">
                                <?php
                                $sql = mysql_query("select DISTRICT_ID,DISTRICT_NAME from district where PROVINCE_ID=" . $address["ADDRESS_PROVINCE_ID"] . " and AMPHUR_ID=" . $address["ADDRESS_AMPHUR_ID"]);
                                while ($row = mysql_fetch_array($sql)) {
                                    $id = $row['DISTRICT_ID'];
                                    $data = $row['DISTRICT_NAME'];
                                    if ($id == $address["ADDRESS_DISTRICT_ID"]) {
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
                                $sql = mysql_query("select AMPHUR_ID,AMPHUR_NAME from amphur where PROVINCE_ID=" . $address["ADDRESS_PROVINCE_ID"]);
                                while ($row = mysql_fetch_array($sql)) {
                                    $id = $row['AMPHUR_ID'];
                                    $data = $row['AMPHUR_NAME'];
                                    if ($id == $address["ADDRESS_AMPHUR_ID"]) {
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
                                    if ($id == $address["ADDRESS_PROVINCE_ID"]) {
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
                        <div class="col-xs-2" style="margin-top: -5">
                            <input type="text" class="form-control" autofocus name="addr_zipcode" value="<?php echo $address["ADDRESS_ZIPCODE"]; ?>" maxlength="5">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-8">
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