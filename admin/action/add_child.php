<script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script> 
<script src="../../css/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$data_id = $_GET['id'];
$count_child = $_POST['count_child'];

if ($count_child > 0) {
    for ($i = 1; $i <= $count_child; $i++) {

        if (isset($_POST["namechild$i"]) && !empty($_POST["namechild$i"])) {
            echo $_POST["namechild$i"];
            $iparr = split("\ ", $_POST["namechild$i"]);
            $namechild_name = $iparr[0];
            $namechild_surname = $iparr[1];
            $child_status = $_POST["child" . $i . "_status"];
            $child_bday = $_POST["child" . $i . "_bday"];
            $namechild_id = add_person($namechild_name, $namechild_surname, $child_bday, $child_status, '', '', '');
            $child_relation = $_POST['child' . $i . '_relation'];
            add_child($data_id, $namechild_id, $child_relation);
        }
    }
}

echo "<script type='text/javascript'>";
//echo "alert('เพิ่มข้อมูลเรียบร้อย');";
echo "$(document).ready(function() {";
echo "sweetAlert('เพิ่มข้อมูลเรียบร้อย','', 'success');";
echo "});";
echo "window.close();";
echo "</script>";
?>