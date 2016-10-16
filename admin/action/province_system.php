<script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script> 
<script src="../../css/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
if (isset($_GET['action'])) {
    if ($_GET['type'] == 1) {
        $id = $_GET['id'];
        $data = $_GET['data'];
        $sql = "DELETE FROM `province` WHERE PROVINCE_ID=$id";
        $result = mysql_query($sql);
//    header("Location: ../view/manage_table.php?table=$table");
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลสำเร็จ');";
        echo "window.location.assign('../view/setup_province_system.php?s_id=$data&type=sector');";
        echo "</script>";
    } else if ($_GET['type'] == 2) {
        $id = $_GET['id'];
        $data = $_GET['data'];
        $sql = "DELETE FROM `amphur` WHERE AMPHUR_ID=$id";
        $result = mysql_query($sql);
//    header("Location: ../view/manage_table.php?table=$table");
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลสำเร็จ');";
        echo "window.location.assign('../view/setup_province_system.php?s_id=0&p_id=$data&type=province');";
        echo "</script>";
    } else if ($_GET['type'] == 3) {
        $id = $_GET['id'];
        $data = $_GET['data'];
        $p_id = $_GET['p_id'];
        $sql = "DELETE FROM `district` WHERE DISTRICT_ID=$id";
        $result = mysql_query($sql);
//    header("Location: ../view/manage_table.php?table=$table");
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลสำเร็จ');";
        echo "window.location.assign('../view/setup_province_system.php?a_id=$data&p_id=$p_id&s_id=0&type=amphur');";
        echo "</script>";
    }
} else {
    print_r($_POST);
    $data_str = $_POST['data_str'];
    $s_id = $_POST['s_id'];
    $p_id = $_POST['p_id'];
    $a_id = $_POST['a_id'];
    $d_id = $_POST['d_id'];
    if ($_POST['action'] == "add") {
//        echo "123";
        if ($_POST['type'] == 1) {
            $sql = "INSERT INTO `province`( `PROVINCE_SECTOR_ID`, `PROVINCE_NAME`) VALUES ('$s_id', '$data_str')";
            $result = mysql_query($sql);
//            echo "456";
            echo "<script type='text/javascript'>";
            echo "alert('เพิ่มข้อมูลสำเร็จ');";
//            echo "$(document).ready(function() {";
//            echo "sweetAlert('เพิ่มข้อมูลจังหวัดสำเร็จ,'', 'success');";
//            echo "});";
            echo "window.location.assign('../view/setup_province_system.php?s_id=$s_id&type=sector');";
            echo "</script>";
        } else if ($_POST['type'] == 2) {
            $sql = "INSERT INTO `amphur`( `PROVINCE_ID`, `AMPHUR_NAME`) VALUES ('$p_id', '$data_str')";
            $result = mysql_query($sql);
            echo "<script type='text/javascript'>";
            echo "alert('เพิ่มข้อมูลสำเร็จ');";
//            echo "$(document).ready(function() {";
//            echo "sweetAlert('เพิ่มข้อมูลอำเภอ/เขตสำเร็จ,'', 'success');";
//            echo "});";
            echo "window.location.assign('../view/setup_province_system.php?s_id=0&p_id=$p_id&type=province');";
            echo "</script>";
        } else if ($_POST['type'] == 3) {
            $sql = "INSERT INTO `district`( `PROVINCE_ID`, `AMPHUR_ID`, `DISTRICT_NAME`) VALUES ('$p_id', '$a_id', '$data_str')";
            $result = mysql_query($sql);
            echo "<script type='text/javascript'>";
            echo "alert('เพิ่มข้อมูลสำเร็จ');";
//            echo "$(document).ready(function() {";
//            echo "sweetAlert('เพิ่มข้อมูลตำบล/แขวงสำเร็จ,'', 'success');";
//            echo "});";
            echo "window.location.assign('../view/setup_province_system.php?a_id=$a_id&p_id=$p_id&s_id=$s_id&type=amphur');";
            echo "</script>";
        }
    } else {
        if ($_POST['type'] == 1) {
            $sql = "UPDATE `province` SET `PROVINCE_NAME`='$data_str' WHERE `PROVINCE_ID`='$p_id'";
            mysql_query($sql);
            echo "<script type='text/javascript'>";
//        echo "alert('แก้ไขข้อมูลสำเร็จ');";
            echo "$(document).ready(function() {";
            echo "sweetAlert('แก้ไขข้อมูลสำเร็จ','', 'success');";
            echo "});";
            echo "window.location.assign('../view/setup_province_system.php?s_id=$s_id&type=sector');";
            echo "</script>";
        } else if ($_POST['type'] == 2) {
            $sql = "UPDATE `amphur` SET `AMPHUR_NAME`='$data_str' WHERE `AMPHUR_ID`='$a_id'";
            echo $sql;
            mysql_query($sql);
            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
//            echo "$(document).ready(function() {";
//            echo "sweetAlert('แก้ไขข้อมูลสำเร็จ','', 'success');";
//            echo "});";
            echo "window.location.assign('../view/setup_province_system.php?s_id=0&p_id=$p_id&type=province');";
            echo "</script>";
        } else if ($_POST['type'] == 3) {
            $sql = "UPDATE `district` SET `DISTRICT_NAME`='$data_str' WHERE `DISTRICT_ID`='$d_id'";
            echo $sql;
//            $sql = "INSERT INTO `district`( `PROVINCE_ID`, `AMPHUR_ID`, `DISTRICT_NAME`) VALUES ('$p_id', '$a_id', '$data_str')";
            $result = mysql_query($sql);
            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขข้อมูลสำเร็จ');";
//            echo "$(document).ready(function() {";
//            echo "sweetAlert('เพิ่มข้อมูลตำบล/แขวงสำเร็จ,'', 'success');";
//            echo "});";
            echo "window.location.assign('../view/setup_province_system.php?a_id=$a_id&p_id=$p_id&s_id=$s_id&type=amphur');";
            echo "</script>";
        }
    }
}
?>