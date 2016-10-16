<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
include '../../helper/db_connect.php';
include '../../helper/helper.php';

connect_database();
$id = $_GET['id'];
$persons = get_person_detial($id);
$person = mysql_fetch_assoc($persons);
$personname = get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . ' ' . get_person_surname_string($id);
$chinahouses = get_chinahouse_data($person['CHINAHOUSE_ID']);
$chinahouse = mysql_fetch_assoc($chinahouses);
//print_r($chinahouse);
//
//$chinahouse_villages = get_china($chinahouse['CHINAHOUSE_VILLAGE_ID']);
//$chinahouse_village = mysql_fetch_assoc($chinahouse_villages);
//
//$chinahouse_districts = get_china($chinahouse['CHINAHOUSE_DISTRICT_ID']);
//$chinahouse_district = mysql_fetch_assoc($chinahouse_districts);
//
//$chinahouse_amphurs = get_china($chinahouse['CHINAHOUSE_AMPHUR_ID']);
//$chinahouse_amphur = mysql_fetch_assoc($chinahouse_amphurs);
//
//$chinahouse_provinces = get_china($chinahouse['CHINAHOUSE_PROVINCE_ID']);
//$chinahouse_province = mysql_fetch_assoc($chinahouse_provinces);
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
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            function printContent(el) {
                var restorepage = document.body.innerHTML;
                var printcontent = document.getElementById(el).innerHTML;
                document.body.innerHTML = printcontent;
                window.print();
                document.body.innerHTML = restorepage;
            }
        </script>
    </head>
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
                <?php
                print_menu(4)
                ?>
<!--            </ul>
        </div>-->
        <div class=" col-xs-9" id="print_div">
            <!--<div id="">-->
            <div class="row">
                <div class="col-xs-12 col-xs-offset-0" >
                    <center>
                    <h1>ที่อยู่บรรพบุรุษของ<?php echo $personname; ?></h1>    
                    </center>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 well">
                    <div class="row">
                        <div class="col-xs-3">
                            <h3>ผู้ที่ติดต่อได้ : </h3>
                        </div>
                        <div class="col-xs-3">
                            <h3>
                                <?php
                                if ($chinahouse['CHINAHOUSE_NAME'] == '')
                                    echo '-';
                                else
                                    echo $chinahouse['CHINAHOUSE_NAME'];
                                ?>
                            </h3>
                        </div>
                        <div class="col-xs-3">
                            <h3>เบอร์ติดต่อ : </h3>
                        </div>
                        <div class="col-xs-3">
                            <h3>
                                <?php
                                if ($chinahouse['CHINAHOUSE_TEL'] == '')
                                    echo '-';
                                else
                                    echo $chinahouse['CHINAHOUSE_TEL'];
                                ?>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <h3>地址 : </h3>
                        </div>
                        <div class="col-xs-10">
                            <h3><?php echo get_full_chinahouse_string($person['CHINAHOUSE_ID'], 'china'); ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <h3>ภาษาไทย </h3>
                        </div>
                        <div class="col-xs-10">
                            <h3><?php echo get_full_chinahouse_string($person['CHINAHOUSE_ID'], 'thai'); ?></h3>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-xs-3 col-xs-offset-4">
                            <!--<a class="btn btn-material-teal" role="button" style="margin-top: -10px" onclick="javascript:window.open('../../print/chinaaddr.php?id=<?php echo $id; ?>', '', 'nenuber=no,toorlbar=no,location=no,scrollbars=no, status=no,resizable=no,width=800,height=650,top=0,left=150 ')">พิมพ์ที่อยู่</a>-->
                            <a class="btn btn-material-teal" role="button" style="margin-top: -10px" onclick="printContent('print_div')">พิมพ์ที่อยู่</a>

                        </div>
                        <div class="col-xs-3 ">
                            <!--                            <a href="../../print/chinaaddr.php"></a>-->
                            <a class="btn btn-material-red" role="button" style="margin-top: -10px" onClick="javascript:window.location.assign('ancestorsaddr.php')">ย้อนกลับ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>