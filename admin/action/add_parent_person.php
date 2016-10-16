<script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script> 
<script src="../../css/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$id = $_GET['id'];
if (isset($_POST["parent"]) && !empty($_POST["parent"])) {
    $iparr = split("\ ", $_POST["parent"]);
    $parent_name = $iparr[0];
    $parent_surname = $iparr[1];
    $parent_status = $_POST["parent_status"];
    $parent_id = add_person($parent_name, $parent_surname, '', $parent_status, '', '', '');
    add_parent($id, $parent_id, $parent_status);
    $persons = get_person_detial($id);
    $person = mysql_fetch_assoc($persons);
    if($person['BROTHER_LIST'] != ''){
        $brother_array = explode(',', $person['BROTHER_LIST']);
        foreach ($brother_array as $brother){
            if($brother != $id){
                add_parent($brother, $parent_id, $parent_status);
                clear_brother_list($brother);
            }
        }
    }
    clear_brother_list($id);
    
}
echo "<script type='text/javascript'>";
//echo "alert('เพิ่มข้อมูลเรียบร้อย');";
echo "$(document).ready(function() {";
echo "sweetAlert('เพิ่มข้อมูลเรียบร้อย','', 'success');";
echo "});";
echo "window.close();";
echo "</script>";
?>