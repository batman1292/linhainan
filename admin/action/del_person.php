<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
echo $id =$_GET["id"];
del_person($id);
header('Location:' . $_SERVER['HTTP_REFERER']);
?>

