<script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script> 
<script src="../../css/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$ses_user_id = $_SESSION['ses_user_id'];
if ($ses_user_id == "") {
    header("Location: ../../index.php?error=3");
}
?>
<html>
    <meta charset="utf-8">
    <script src="../../helper/jquery-latest.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
        <link href="../../css/menu.css" rel="stylesheet" type="text/css"/>
    <script>
        $(document).onload(function() {
//            alert('กำลังประมวลผล \\n\\ กรุณารอซักครู่');
        });
    </script>
</html>
<?php
include '../../helper/db_connect.php';
connect_database();
$id = $_GET['id'];
$check = $_GET['type'];
$parent_id = $_GET['p_id'];
add_parent_id($id, $parent_id);
echo "<script type='text/javascript'>";
//echo "alert('เพิ่มข้อมูลบิดาสำเร็จ');";
echo "$(document).ready(function() {";
echo "sweetAlert('เพิ่มข้อมูลบิดาสำเร็จ','', 'success');";
echo "});";
echo "window.location.assign('checkparent.php?id=$id&type=$check')";
echo "</script>";
?>