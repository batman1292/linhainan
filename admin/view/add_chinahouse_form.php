<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$ses_user_id = $_SESSION['ses_user_id'];
if (!isset($ses_user_id)) {
    header("Location: ../index.php?error=3");
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
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="btn-material-red">
        <div class="bs-component">
            <form class="form-horizontal well" action="../action/add_chinahouse.php?id=<?php echo $id; ?>" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
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