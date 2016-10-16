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
$gen_id = $_GET['id'];
$generation;
if($action == 2){
    $generation = $_GET['gen'];
    $gens = get_favorite_id($gen_id);
    $gen = mysql_fetch_assoc($gens);
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
                            echo "เพิ่มข้อมูล ";
                        }else{
                            echo "แก้ไขข้อมูล ";
                        }
                        ?>
                    </h1>
                </div>
                <div class="well">
                    <form  action="../action/fevoritname.php" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                        <input type="text" name="action" id="data_id" style="visibility:hidden"  value="<?php echo $action; ?>">
                        <input type="text" name="gen_id" id="data_id" style="visibility:hidden"  value="<?php  echo $gen_id; ?>">
                        <input type="text" name="gen" id="data_id" style="visibility:hidden"  value="<?php  echo $generation; ?>">
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-4">
                                <h4>อักษรจีน</h4>
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" required autofocus name="gen_name" value="<?php if($action == 2){ echo $gen['FAVORITE_NAME']; }?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-4">
                                <h4>pinyin</h4>
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" autofocus name="gen_pinyin" value="<?php if($action == 2){ echo $gen['FAVORITE_PINYIN']; }?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-4">
                                <h4>อักษรไทย</h4>
                            </div>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" autofocus name="gen_th" value="<?php if($action == 2){ echo $gen['FAVORITE_TH']; }?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-4">
                                <a onClick="javascript:window.location.assign('setup_fevoritname.php?')" role="button" class="btn btn-danger">ย้อนกลับ</a>
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