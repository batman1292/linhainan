<script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script> 
<script src="../../css/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
if (isset($_GET['action'])) {
    $gen_id = $_GET['id'];
    $sql = "DELETE FROM `generation` WHERE ID=$gen_id";
    $result = mysql_query($sql);
//    header("Location: ../view/manage_table.php?table=$table");
    echo "<script type='text/javascript'>";
    echo "alert('ลบข้อมูลสำเร็จ');";
    echo "window.location.assign('../view/setup_gen_menu.php');";
    echo "</script>";
} else {

    print_r($_POST);
    $type = $_POST['gen_type'];
    $gen_name = $_POST['gen_name'];
    $gen_id = $_POST['gen_id'];
    $gen_pinyin = $_POST['gen_pinyin'];
    $gen_th = $_POST['gen_th'];
    if (isset($_POST['gen_index'])) {
        $gen_index = $_POST['gen_index'];
    } else {
        $gen_index = 0;
    }

//add
    if ($_POST['action'] == 1) {
        $sql = "INSERT INTO `generation`( `GENERATION_TYPE`, `GENERATION_INDEX`, `GENERATION_NAME`, `GENERATION_PINYIN`, `GENERATION_TH`) VALUES ('$type', '$gen_index', '$gen_name', '$gen_pinyin', '$gen_th')";
        $result = mysql_query($sql);
        echo "<script type='text/javascript'>";
//        echo "alert('เพิ่มข้อมูลสำเร็จ');";
        echo "$(document).ready(function() {";
        echo "sweetAlert('เพิ่มข้อมูลสำเร็จ','', 'success');";
        echo "});";
        echo "window.location.assign('../view/setup_gen_menu.php');";
        echo "</script>";
    } //edit
    else if ($_POST['action'] == 2) {
        $sql = "UPDATE `generation` SET `GENERATION_TYPE`='$type', `GENERATION_INDEX`='$gen_index', `GENERATION_NAME`='$gen_name', `GENERATION_PINYIN`='$gen_pinyin', `GENERATION_TH`='$gen_th' WHERE `ID`='$gen_id'";
        mysql_query($sql);
        echo "<script type='text/javascript'>";
//        echo "alert('แก้ไขข้อมูลสำเร็จ');";
        echo "$(document).ready(function() {";
        echo "sweetAlert('แก้ไขข้อมูลสำเร็จ','', 'success');";
        echo "});";
        echo "window.location.assign('../view/setup_gen_menu.php');";
        echo "</script>";
    }
}

