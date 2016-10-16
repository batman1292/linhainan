<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$id =$_GET["id"];
del_picture($id);
header('Location:' . $_SERVER['HTTP_REFERER']);
//echo "<script type='text/javascript'>";
//echo "window.close();";
//echo "</script>";
?>

