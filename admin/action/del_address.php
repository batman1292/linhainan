<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$id =$_GET["id"];
$addr_id = $_GET["addr_id"];
$type = $_GET['type'];

del_address($id,$addr_id,$type);
header('Location:' . $_SERVER['HTTP_REFERER']); 
?>

