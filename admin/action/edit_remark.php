<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$data_id = $_GET['id'];
if (isset($_POST['REMARK'])) {
    edit_remark($data_id, $_POST['REMARK']);
}
echo "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
