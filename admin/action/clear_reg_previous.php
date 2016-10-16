<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$sql = "UPDATE `register` SET `REGISTER_THRU_DATE`=now() WHERE `REGISTER_THRU_DATE` = ''";
$result = mysql_query($sql);
header('Location:' . $_SERVER['HTTP_REFERER']);
?>

