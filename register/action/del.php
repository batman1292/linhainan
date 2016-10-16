<?php

include '../../helper/db_connect.php';
connect_database();
//$table = $_GET['table'];
$id = $_GET['id'];
$data = $_GET['data'];
$search_type = $_GET['option'];
$sql = "DELETE FROM person WHERE id=$id";
$result = mysql_query($sql);
$time = date('Y-m-d H:i:s', time());
$sql = "UPDATE `register` SET `REGISTER_THRU_DATE`= '$time'  WHERE `REGISTER_OWNER_ID`=$id";
//echo $sql;
mysql_query($sql);
if ($search_type == "form") {
    echo "<script type='text/javascript'>";
    echo "window.close();";
    echo "</script>";
} else {
    header("Location: ../index.php?data=$data&option=$search_type&search=");
}
?>

