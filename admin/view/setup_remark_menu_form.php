<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
include '../../helper/db_connect.php';
include '../../helper/helper.php';

connect_database();
$action = $_GET['action'];
if($action == 2){
    $id = $_GET['id'];
    $remarks = get_remark_detail($id);
    $remark = mysql_fetch_assoc($remarks);
//    print_r($gen);
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
    </head>
    <body class="btn-danger">
        <div class=" col-sm-12">
            <center>    
                <div class="row">
                    <h1>
                        <?php
                        if($action == 1){
                            echo "เพิ่มข้อมูลหมายเหตุ";
                        }else{
                            echo "แก้ไขข้อมูลหมายเหตุ ";
                        }
                        ?>
                    </h1>
                </div>
                <div class="well">
                    <form  action="../action/remark_menu.php" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                        <input type="text" name="action" id="data_id" style="visibility:hidden"  value="<?php echo $action; ?>">
                        <input type="text" name="remark_id" id="data_id" style="visibility:hidden"  value="<?php if($action == 2){ echo $id; }?>">
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-4">
                                <h4>รายละเอียด</h4>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" required autofocus name="remark_name" value="<?php if($action == 2){ echo $remark['REMARK_NAME']; }?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-4">
                                <a onClick="javascript:window.location.assign('setup_remark_menu.php')" role="button" class="btn btn-danger">ย้อนกลับ</a>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-success" type="submit" style="margin-top: 10px" name="save">บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </center>
        </div>
    </body>
</html>