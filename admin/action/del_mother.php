<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$id = $_GET['id'];
$parent_id = $_GET['p_id'];
$sql = "UPDATE `person` SET `MOTHER_ID`='0' WHERE `ID`='$id'";
mysql_query($sql);
echo "<script type='text/javascript'>";
echo "window.history.back();";
echo "</script>";
?>
