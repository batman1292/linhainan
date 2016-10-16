<?php
include '../../helper/db_connect.php';
connect_database();
$id = $_GET['id'];
if (isset($_POST["parent"]) && !empty($_POST["parent"])) {
    $iparr = split("\ ", $_POST["parent"]);
    $parent_name = $iparr[0];
    $parent_surname = $iparr[1];
    $parent_status = $_POST["parent_status"];
    $parent_id = add_person($parent_name, $parent_surname, '', '', '', '', '');
    add_child($id, $parent_id, $parent_status);
//    $persons = get_person_detial($id);
//    $person = mysql_fetch_assoc($persons);
//    if($person['BROTHER_LIST'] != ''){
//        $brother_array = explode(',', $person['BROTHER_LIST']);
//        foreach ($brother_array as $brother){
//            if($brother != $id){
//                add_parent($brother, $parent_id, $parent_status);
//                clear_brother_list($brother);
//            }
//        }
//    }
//    clear_brother_list($id);
}
echo "<script type='text/javascript'>";
echo "alert('เพิ่มข้อมูลเรียบร้อย');";
echo "window.close();";
echo "</script>";
?>