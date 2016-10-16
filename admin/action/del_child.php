<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$id = $_GET['id'];
$parent_id = $_GET['p_id'];
$childs = get_person_detial($parent_id);
$child = mysql_fetch_assoc($childs);
print_r($child);
if($child['MOTHER_ID'] == $id){
    $type = "MOTHER_ID";
}else if($child['PARENT_ID'] == $id){
    $type = "PARENT_ID";
}
del_child($parent_id, $type);
echo "<script type='text/javascript'>";
echo "window.history.back();";
echo "</script>";
