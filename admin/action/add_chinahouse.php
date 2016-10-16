<script src="../../helper/jquery-1.11.1.min.js" type="text/javascript"></script> 
<script src="../../css/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/sweetalert/sweetalert.css">
<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
error_reporting(E_ERROR | E_PARSE);
$id = $_GET['id'];
if (isset($_POST["chinahouse_name"]) || !empty($_POST["CHINAHOUSE_VILLAGE"]) || !empty($_POST["CHINAHOUSE_VILLAGE_TH"]) || !empty($_POST["CHINAHOUSE_DISTRICT"]) || !empty($_POST["CHINAHOUSE_DISTRICT_TH"])) {
    $chinahouse_name = "";

    $chinahouse_village_id = 0;
    $chinahouse_amphur_id = 0;
    $chinahouse_district_id = 0;
    $chinahouse_province_id = 0;
    $chinahouse_tel = "";
    if (isset($_POST["CHINAHOUSE_NAME"]) && !empty($_POST["CHINAHOUSE_NAME"]))
        $chinahouse_name = $_POST["CHINAHOUSE_NAME"];

    if ((isset($_POST["CHINAHOUSE_VILLAGE"]) && !empty($_POST["CHINAHOUSE_VILLAGE"])) || (isset($_POST["CHINAHOUSE_VILLAGE_TH"]) && !empty($_POST["CHINAHOUSE_VILLAGE_TH"])))
        $chinahouse_village_id = get_chinahouse_id($_POST["CHINAHOUSE_VILLAGE"], $_POST["CHINAHOUSE_VILLAGE_TH"]);

    if ((isset($_POST["CHINAHOUSE_AMPHUR"]) && !empty($_POST["CHINAHOUSE_AMPHUR"])) || (isset($_POST["CHINAHOUSE_AMPHUR_TH"]) && !empty($_POST["CHINAHOUSE_AMPHUR_TH"])))
        $chinahouse_amphur_id = get_chinahouse_id($_POST["CHINAHOUSE_AMPHUR"], $_POST["CHINAHOUSE_AMPHUR_TH"]);

    if ((isset($_POST["CHINAHOUSE_DISTRICT"]) && !empty($_POST["CHINAHOUSE_DISTRICT"])) || (isset($_POST["CHINAHOUSE_DISTRICT_TH"]) && !empty($_POST["CHINAHOUSE_DISTRICT_TH"])))
        $chinahouse_district_id = get_chinahouse_id($_POST["CHINAHOUSE_DISTRICT"], $_POST["CHINAHOUSE_DISTRICT_TH"]);

    if ((isset($_POST["CHINAHOUSE_PROVINCE"]) && !empty($_POST["CHINAHOUSE_PROVINCE"])) || (isset($_POST["CHINAHOUSE_PROVINCE_TH"]) && !empty($_POST["CHINAHOUSE_PROVINCE_TH"])))
        $chinahouse_province_id = get_chinahouse_id($_POST["CHINAHOUSE_PROVINCE"], $_POST["CHINAHOUSE_PROVINCE_TH"]);

    if (isset($_POST["CHINAHOUSE_TEL"]) && !empty($_POST["CHINAHOUSE_TEL"]))
        $chinahouse_tel = $_POST["CHINAHOUSE_TEL"];


    if (isset($_POST["CHINAHOUSE_DISTRICT_TH"]) && !empty($_POST["CHINAHOUSE_DISTRICT"]))
        $chinahouse_district_id = get_chinahouse_id($_POST["CHINAHOUSE_DISTRICT"]);
    if (isset($_POST["CHINAHOUSE_PROVINCE_TH"]) && !empty($_POST["CHINAHOUSE_PROVINCE_TH"]))
        $chinahouse_province_id = get_chinahouse_id($_POST["CHINAHOUSE_PROVINCE"]);

    chinahouse($id, $chinahouse_name, $chinahouse_village_id, $chinahouse_amphur_id, $chinahouse_district_id, $chinahouse_province_id, $chinahouse_tel);
}
echo "<script type='text/javascript'>";
//echo "alert('เพิ่มข้อมูลเรียบร้อย');";
echo "$(document).ready(function() {";
echo "sweetAlert('เพิ่มข้อมูลเรียบร้อย','', 'success');";
echo "});";
echo "window.close();";
echo "</script>";
?>