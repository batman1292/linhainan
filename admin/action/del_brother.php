<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$id = $_GET['id'];
$brother_id = $_GET['b_id'];
$brothers = get_person_detial($brother_id);
$brother = mysql_fetch_assoc($brothers);
if($brother['PARENT_ID'] != 0){
    del_parent($brother_id);
}else{
    del_brother($id, $brother_id);
}
//del_parent($id);
echo "<script type='text/javascript'>";
echo "window.history.back();";
echo "</script>";
?>
