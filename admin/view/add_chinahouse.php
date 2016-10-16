<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
?>
<html>
    <head>
        <title>ไทยนำ-ลิมป์์ศรีสวัสดิ์</title>
        <meta charset="utf-8">
        <link href="../../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href=../../"css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script>      
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <script src="../../css/sweetalert/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
        <script>
            function check(id) {
                window.location = '../action/checkparent.php?id=' + id + '&type=create';
            }
            function chooseName(chinaname, pinyin, thai) {
                document.getElementById("chinaname").value = chinaname;
                document.getElementById("chinaname_pinyin").value = pinyin;
                document.getElementById("chinaname_thai").value = thai;
            }
            jQuery(document).ready(function ($) {
                $('#waypointsTable tr').hover(function () {
                    $(this).addClass('hover');
                }, function () {
                    $(this).removeClass('hover');
                });
                $('#generation').change(function ()
                {
                    var get_id = $(this).val();
                    var dataString = 'get_favorite_name=' + get_id;
                    $.ajax
                            ({
                                type: "POST",
                                url: "../../helper/ajax_update.php",
                                data: dataString,
                                cache: false,
                                success: function (html)
                                {

                                    $("table#waypointsTable tbody").html(html);
                                }
                            });
                });
            });

        </script>
        <style>
            .hover { background-color:Gray; cursor:pointer ;}
        </style>
    </head>
    <?php
    include '../../helper/db_connect.php';
    include '../../helper/helper.php';

    connect_database();
    $id = $_GET['id'];
    if (isset($_GET['gen_id'])) {
        $gen_id = $_GET['gen_id'];
    } else {
        $gen_id = 0;
    }
    $persons = get_person_detial($id);
    $person = mysql_fetch_assoc($persons);
    if (isset($_POST['search'])) {
        $id = $_GET['id'];
        if (isset($_POST["chinahouse_name"]) || !empty($_POST["CHINAHOUSE_VILLAGE"]) || !empty($_POST["CHINAHOUSE_VILLAGE_TH"]) || !empty($_POST["CHINAHOUSE_DISTRICT"]) || !empty($_POST["CHINAHOUSE_DISTRICT_TH"])) {
            $chinahouse_name = "";

            $chinahouse_village_id = 0;
            $chinahouse_amphur_id = 0;
            $chinahouse_district_id = 0;
            $chinahouse_province_id = 0;
            $chinahouse_tel = "";
            if (isset($_POST["CHINAHOUSE_NAME"]) && !empty($_POST["CHINAHOUSE_NAME"]))
                $chinahouse_name = $_POST["CHINAHOUSE_NAME"];

            if ((isset($_POST["CHINAHOUSE_VILLAGE"]) && !empty($_POST["CHINAHOUSE_VILLAGE"])) || (isset($_POST["CHINAHOUSE_VILLAGE_TH"]) && !empty($_POST["CHINAHOUSE_VILLAGE_TH"])))
                $chinahouse_village_id = get_chinahouse_id($_POST["CHINAHOUSE_VILLAGE"], $_POST["CHINAHOUSE_VILLAGE_TH"]);

            if ((isset($_POST["CHINAHOUSE_AMPHUR"]) && !empty($_POST["CHINAHOUSE_AMPHUR"])) || (isset($_POST["CHINAHOUSE_AMPHUR_TH"]) && !empty($_POST["CHINAHOUSE_AMPHUR_TH"])))
                $chinahouse_amphur_id = get_chinahouse_id($_POST["CHINAHOUSE_AMPHUR"], $_POST["CHINAHOUSE_AMPHUR_TH"]);

            if ((isset($_POST["CHINAHOUSE_DISTRICT"]) && !empty($_POST["CHINAHOUSE_DISTRICT"])) || (isset($_POST["CHINAHOUSE_DISTRICT_TH"]) && !empty($_POST["CHINAHOUSE_DISTRICT_TH"])))
                $chinahouse_district_id = get_chinahouse_id($_POST["CHINAHOUSE_DISTRICT"], $_POST["CHINAHOUSE_DISTRICT_TH"]);

            if ((isset($_POST["CHINAHOUSE_PROVINCE"]) && !empty($_POST["CHINAHOUSE_PROVINCE"])) || (isset($_POST["CHINAHOUSE_PROVINCE_TH"]) && !empty($_POST["CHINAHOUSE_PROVINCE_TH"])))
                $chinahouse_province_id = get_chinahouse_id($_POST["CHINAHOUSE_PROVINCE"], $_POST["CHINAHOUSE_PROVINCE_TH"]);

            if (isset($_POST["CHINAHOUSE_TEL"]) && !empty($_POST["CHINAHOUSE_TEL"]))
                $chinahouse_tel = $_POST["CHINAHOUSE_TEL"];


            if (isset($_POST["CHINAHOUSE_DISTRICT_TH"]) && !empty($_POST["CHINAHOUSE_DISTRICT"]))
                $chinahouse_district_id = get_chinahouse_id($_POST["CHINAHOUSE_DISTRICT"]);
            if (isset($_POST["CHINAHOUSE_PROVINCE_TH"]) && !empty($_POST["CHINAHOUSE_PROVINCE_TH"]))
                $chinahouse_province_id = get_chinahouse_id($_POST["CHINAHOUSE_PROVINCE"]);

            chinahouse($id, $chinahouse_name, $chinahouse_village_id, $chinahouse_amphur_id, $chinahouse_district_id, $chinahouse_province_id, $chinahouse_tel);
        }
        echo "<script type='text/javascript'>";
//echo "alert('เพิ่มข้อมูลเรียบร้อย');";
        echo "$(document).ready(function() {";
        echo "sweetAlert('เพิ่มข้อมูลเรียบร้อย','', 'success');";
        echo "});";
        echo "window.close();";
        echo "</script>";
    }
    ?>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class= "bs-component" style="margin-bottom: -20px">
            <div class="navbar navbar-material-orange">
                <div class="navbar-header">
                    <a class="navbar-brand">ระบบจัดการฐานข้อมูลสมาชิกมูลนิธิไทยนำ-ลิมป์์ศรีสวัสดิ์</a>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../../logout.php">ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--        <div class=" col-xs-3 btn-material-brown">
                    <h3 class="mdi-navigation-menu"> เมนู</h3>
                    <ul class="nav nav-pills nav-stacked" >-->
        <?php print_menu(4); ?>
        <!--            </ul>
                </div>-->
        <div class=" col-xs-9">
            <center>
                <div class="row">
                    <div class="col-xs-12 col-xs-offset-0">
                        <h2>เพิ่มข้อมูลที่อยู่บรรพบุรุษที่ประเทศจีนของ  <?php
                            if ($person['TITLE_ID'] != 0)
                                echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . " " . get_person_surname_string($id);
                            else
                                echo get_person_name_string($id) . " " . get_person_surname_string($id);
                            ?>  </h2>
                    </div>
                </div>
            </center>
            <div class="col-xs-10 col-xs-offset-1 well">
                <form class="form-horizontal" action="add_chinahouse.php?id=<?php echo $id; ?>" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                    <!--                <div class="row">
                                        <div class="col-xs-8 col-xs-offset-2">
                                            <h2>เพิ่มข้อมูลที่อยู่บรรพบุรุษที่ประเทศจีน</h2>
                                        </div>
                                    </div>-->
                    <div class="row">
                        <div class="col-xs-2">
                            <h5>ชื่อนามสกุล</h5>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_NAME" value="">
                        </div>
                        <div class="col-xs-2">
                            <h5>เบอร์ติดต่อ</h5>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" autofocus name="CHINAHOUSE_TEL" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2"><h5><strong>อักษรจีน</h5></strong></div>
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
                    <div class="row" style="margin-top: 0px">
                        <div class="col-xs-4 col-xs-offset-6">
                            <a class="btn btn-danger" role="button" style="width: 175px;" onClick="window.location.href = 'ancestorsaddr.php'">ย้อนกลับ</a>
                        </div>
                        <div class="col-xs-2">
                            <button class="btn btn-success" type="submit" name="search">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </body>
</html>