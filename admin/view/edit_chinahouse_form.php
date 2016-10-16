<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if (!isset($ses_user_id)) {
    header("Location: ../index.php?error=3");
}
include '../../helper/db_connect.php';
include '../../helper/helper.php';

connect_database();

$id = $_GET['id'];
$persons = get_person_detial($id);
$person = mysql_fetch_assoc($persons);
$chinahouses = get_chinahouse_data($person['CHINAHOUSE_ID']);
$chinahouse = mysql_fetch_assoc($chinahouses);
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
    </head>
    <body class="btn-material-red">
        <div class="bs-component">
            <form class="form-horizontal well" action="../action/edit_chinahouse.php?id=<?php echo $id; ?>" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <h2>เพิ่มข้อมูลที่อยู่บรรพบุรุษที่ประเทศจีน</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h5>ชื่อนามสกุล</h5>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_NAME" value="<?php echo $chinahouse['CHINAHOUSE_NAME']; ?>">
                    </div>
                    <div class="col-xs-2">
                        <h5>เบอร์ติดต่อ</h5>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_TEL" value="<?php echo $chinahouse['CHINAHOUSE_TEL']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h5>ความสัมพันธ์</h5>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_LINK" value="<?php echo $chinahouse['CHINAHOUSE_LINK']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-5"><h5><strong>อักษรจีน</h5></strong></div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_VILLAGE" value="<?php echo get_china_srting($chinahouse['CHINAHOUSE_VILLAGE_ID'], 'china'); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h5>村</h5>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_DISTRICT" value="<?php echo get_china_srting($chinahouse['CHINAHOUSE_DISTRICT_ID'], 'china'); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h5>區</h5>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_AMPHUR" value="<?php echo get_china_srting($chinahouse['CHINAHOUSE_AMPHUR_ID'], 'china'); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h5>镇</h5>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_PROVINCE" value="<?php echo get_china_srting($chinahouse['CHINAHOUSE_PROVINCE_ID'], 'china'); ?>">
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
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_VILLAGE_TH" value="<?php echo get_china_srting($chinahouse['CHINAHOUSE_VILLAGE_ID'], 'thai'); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h5>ตำบล</h5>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_DISTRICT_TH" value="<?php echo get_china_srting($chinahouse['CHINAHOUSE_DISTRICT_ID'], 'thai'); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h5>อำเภอ</h5>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_AMPHUR_TH" value="<?php echo get_china_srting($chinahouse['CHINAHOUSE_AMPHUR_ID'], 'thai'); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h5>จังหวัด</h5>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" autofocus name="CHINAHOUSE_PROVINCE_TH" value="<?php echo get_china_srting($chinahouse['CHINAHOUSE_PROVINCE_ID'], 'thai'); ?>">
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