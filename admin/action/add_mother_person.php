<script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script> 
<script src="../../css/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$id = $_GET['id'];
if (isset($_POST["mother"]) && !empty($_POST["mother"])) {
    $iparr = split("\ ", $_POST["mother"]);
    $parent_name = $iparr[0];
    $parent_surname = $iparr[1];
    $parent_status = $_POST["mother_status"];
    $parent_id = add_person($parent_name, $parent_surname, '', $parent_status, '', '', '');
    add_mother($id, $parent_id, $parent_status);
}
echo "<script type='text/javascript'>";
//echo "alert('เพิ่มข้อมูลเรียบร้อย');";
echo "$(document).ready(function() {";
echo "sweetAlert('เพิ่มข้อมูลเรียบร้อย','', 'success');";
echo "});";
echo "window.close();";
echo "</script>";
?>