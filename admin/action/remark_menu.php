<script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script> 
<script src="../../css/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
if (isset($_GET['action'])) {
    $remark_id = $_GET['id'];
    $sql = "DELETE FROM `remark` WHERE ID=$remark_id";
    $result = mysql_query($sql);
//    header("Location: ../view/manage_table.php?table=$table");
    echo "<script type='text/javascript'>";
    echo "alert('ลบข้อมูลสำเร็จ');";
    echo "window.location.assign('../view/setup_remark_menu.php');";
    echo "</script>";
} else {

    $remark_name = $_POST['remark_name'];
    $remark_id = $_POST['remark_id'];

//add
    if ($_POST['action'] == 1) {
        $sql = "INSERT INTO `remark`( `REMARK_NAME`) VALUES ('$remark_name')";
        $result = mysql_query($sql);
        echo "<script type='text/javascript'>";
//        echo "alert('เพิ่มข้อมูลสำเร็จ');";
        echo "$(document).ready(function() {";
        echo "sweetAlert('เพิ่มข้อมูลสำเร็จ','', 'success');";
        echo "});";
        echo "window.location.assign('../view/setup_remark_menu.php');";
        echo "</script>";
    } //edit
    else if ($_POST['action'] == 2) {
        $sql = "UPDATE `remark` SET `REMARK_NAME`='$remark_name' WHERE `ID`='$remark_id'";
        mysql_query($sql);
        echo "<script type='text/javascript'>";
//        echo "alert('แก้ไขข้อมูลสำเร็จ');";
        echo "$(document).ready(function() {";
        echo "sweetAlert('แก้ไขข้อมูลสำเร็จ','', 'success');";
        echo "});";
        echo "window.location.assign('../view/setup_remark_menu.php');";
        echo "</script>";
    }
}

