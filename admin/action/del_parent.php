<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$id = $_GET['id'];
$parent_id = $_GET['p_id'];
del_parent($id);
echo "<script type='text/javascript'>";
echo "window.history.back();";
echo "</script>";
?>
