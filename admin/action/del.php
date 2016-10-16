<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$table = $_GET['table'];
$id = $_GET['id'];
$in_data = $_GET['data'];
$type = $_GET['option'];
del_person($id);
//$result = mysql_query($sql);
header("Location: ../view/manage_person_table.php?data=$in_data&option=$type&search=");
?>

