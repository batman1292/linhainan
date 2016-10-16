<?php
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}

include '../../helper/db_connect.php';
include '../../helper/helper.php';

connect_database();

if ($_GET['action'] == 'add') {
    $headder_str = "เพื่มข้อมูล";
    if ($_GET['type'] == 1) {
        $s_id = $_GET['s_id'];
        $p_id = 0;
        $a_id = 0;
        $headder_str .= "จังหวัดของภาค";
        if ($_GET['s_id'] == 1) {
            $headder_str .= 'กลาง';
//            $add_str .= 'กลาง';
        } else if ($_GET['s_id'] == 2) {
            $headder_str .= 'เหนือ';
//            $add_str .= 'เหนือ';
        } else if ($_GET['s_id'] == 3) {
            $headder_str .= 'ตะวันออกเฉียงเหนือ';
//            $add_str .= 'ตะวันออกเฉียงเหนือ';
        } else if ($_GET['s_id'] == 4) {
            $headder_str .= 'ตะวันออก';
//            $add_str .= 'ตะวันออก';
        } else if ($_GET['s_id'] == 5) {
            $headder_str .= 'ตะวันตก';
//            $add_str .= 'ตะวันตก';
        } else if ($_GET['s_id'] == 6) {
            $headder_str .= 'ใต้';
//            $add_str .= 'ใต้';
        }
    } else if ($_GET['type'] == 2) {
        $s_id = 0;
        $p_id = $_GET['p_id'];
        $a_id = 0;
        $headder_str .= "อำเภอ/เขต ของ จังหวัด" . get_province_string($p_id);
    } else if ($_GET['type'] == 3) {
        $s_id = 0;
        $p_id = $_GET['p_id'];
        $a_id = $_GET['a_id'];
        $headder_str .= "ตำบล/แขวง ของ อำเภอ/เขต " . get_amphur_string($a_id);
    }
    $current_data = 0;
} else {
    if ($_GET['type'] == 1) {
        $s_id = $_GET['s_id'];
        $p_id = $_GET['p_id'];
        $a_id = 0;
        $headder_str = "แก้ไขข้อมูลจังหวัด";
        $querys = get_province_string($p_id);
//        $query = mysql_fetch_assoc($querys);
//        print_r($querys);
    } else if ($_GET['type'] == 2) {
        $s_id = 0;
        $p_id = $_GET['p_id'];
        $a_id = $_GET['a_id'];
        $headder_str = "แก้ไขข้อมูลอำเภอ/เขต";
        $querys = get_amphur_string($a_id);
    } else if ($_GET['type'] == 3) {
        $s_id = 0;
        $p_id = $_GET['p_id'];
        $a_id = $_GET['a_id'];
        $d_id = $_GET['d_id'];
        $headder_str = "แก้ไขข้อมูลอำเภอ/เขต";
        $querys = get_district_string($d_id);
    }
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


        </script>
    </head>
    <body class="btn-danger">
        <!--<div class="container">-->
        <div class=" col-sm-12">
            <center>                
                <div class="row">
                    <h1>จัดการข้อมูลจังหวัด อำเภอ และ ตำบล</h1>
                </div>
            </center>
            <div class="well">
                <div class="row">
                    <h3><?php echo $headder_str; ?></h3>
                </div>
                <center>
                    <form  action="../action/province_system.php" method="Post" style="margin:10 10 10 10" enctype="multipart/form-data">
                        <input type="text" name="action" style="visibility:hidden"  value="<?php echo $_GET['action']; ?>">
                        <input type="text" name="type" style="visibility:hidden"  value="<?php echo $_GET['type']; ?>">
                        <!--<input type="text" name="current" style="visibility:hidden"  value="<?php echo $current_data; ?>">-->
                        <input type="text" name="s_id" style="visibility:hidden"  value="<?php echo $s_id; ?>">
                        <input type="text" name="p_id" style="visibility:hidden"  value="<?php echo $p_id; ?>">
                        <input type="text" name="a_id" style="visibility:hidden"  value="<?php echo $a_id; ?>">
                        <input type="text" name="d_id" style="visibility:hidden"  value="<?php echo $d_id; ?>">
                        <div class="row">
                            <div class="col-xs-3 col-xs-offset-3">
                                <?php
                                if ($_GET['type'] == 1) {
                                    echo "ชื่อจังหวัด";
                                } else if ($_GET['type'] == 2) {
                                    echo "ชื่ออำเภอ/เขต";
                                } else if ($_GET['type'] == 3) {
                                    echo "ชื่อตำบล/แขวง";
                                }
                                ?>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="form-control"  autofocus name="data_str" value="<?php
                                if ($_GET['action'] == "edit") {
                                    echo $querys;
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 col-xs-offset-4">
                                <?php
                                if ($_GET['type'] == 1) {
                                    ?>
                                    <a onClick="javascript:window.location.assign('setup_province_system.php?s_id=<?php echo $s_id; ?>&type=sector')"  role="button" class="btn btn-danger">ย้อนกลับ</a>
                                    <?php
                                } else if ($_GET['type'] == 2) {
                                    ?>
                                    <a onClick="javascript:window.location.assign('setup_province_system.php?s_id=<?php echo $s_id; ?>&p_id=<?php echo $p_id; ?>&type=province')" role="button" class="btn btn-danger">ย้อนกลับ</a>
                                    <?php
                                } else if ($_GET['type'] == 3) {
                                    ?>
                                    <a onClick="javascript:window.location.assign('setup_province_system.php?a_id=<?php echo $a_id; ?>&p_id=<?php echo $p_id; ?>&s_id=<?php echo $s_id; ?>&type=amphur')" role="button" class="btn btn-danger">ย้อนกลับ</a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-xs-2">
                                <button class="btn btn-success" type="submit" style="margin-top: 10px" name="save">บันทึก</button> 
                            </div>
                        </div>
                    </form>
                </center>
            </div>
        </div>
    </body>
</html>