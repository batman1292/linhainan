<script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script> 
<script src="../../css/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$data_id = $_GET['id'];
$count_bro = $_POST['count_bro'];

 $brother_array = array();
    array_push($brother_array, $data_id);
    
    $brother_list = "$data_id,";
    $has_brother = false;
    if ($count_bro > 0) {
        for ($i = 1; $i <= $count_bro; $i++) {
            if (isset($_POST["namebro$i"]) && !empty($_POST["namebro$i"])) {
                $iparr = split("\ ", $_POST["namebro$i"]);
                $namebro_name = $iparr[0];
                $namebro_surname = $iparr[1];
                $bro_status = $_POST["bro" . $i . "_status"];
                $bro_bday = $_POST["bro" . $i . "_bday"];
                $namebro1_id = add_person($namebro_name, $namebro_surname, $bro_bday, $bro_status, '', '', '');

                $brother_list .= "$namebro1_id,";
                array_push($brother_array, $namebro1_id);
                $has_brother = true;
            }
        }
    }
    if ($has_brother) {
        if (isset($_POST["parent"]) && !empty($_POST["parent"])) {
            foreach ($brother_array as $brother_id) {
                add_parent($brother_id, $parent_id, $parent_status);
            }
        } else {
            add_brother_array($brother_array);
//        add_brother_list($brother_list);
        }
    }
    
set_updatetime($id);
echo "<script type='text/javascript'>";
echo "$(document).ready(function() {";
echo "sweetAlert('เพิ่มข้อมูลเรียบร้อย','', 'success');";
echo "});";
echo "window.close();";
echo "</script>";
?>