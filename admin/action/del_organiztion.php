<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$id =$_GET["id"];
$organization_id = $_GET["organization_id"];

del_organization($id, $organization_id);
header('Location:' . $_SERVER['HTTP_REFERER']); 
?>

