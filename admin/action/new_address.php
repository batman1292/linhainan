<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$time = date("Y-m-d H:i:s", time());
$id = $_POST["id"];
$type = $_POST["type"];
if (!empty($_POST['p_id'])) {
    $person_id = $_POST['p_id'];
}
if (!empty($_POST["addr_num"]) || !empty($_POST["addr_zipcode"])) {
    $addr_num = "";
    $addr_village = "";
    $addr_alley = "";
    $addr_moo = "";
    $addr_road = "";
    $addr_amphur = "";
    $addr_district = "";
    $addr_province = "";
    $addr_zipcode = "";
    if (isset($_POST["addr_num"]) && !empty($_POST["addr_num"]))
        $addr_num = $_POST["addr_num"];
    if (isset($_POST["addr_village"]) && !empty($_POST["addr_village"]))
        $addr_village = $_POST["addr_village"];
    if (isset($_POST["addr_alley"]) && !empty($_POST["addr_alley"]))
        $addr_alley = $_POST["addr_alley"];
    if (isset($_POST["addr_moo"]) && !empty($_POST["addr_moo"]))
        $addr_moo = $_POST["addr_moo"];
    if (isset($_POST["addr_road"]) && !empty($_POST["addr_road"]))
        $addr_road = $_POST["addr_road"];
    if (isset($_POST["addr_amphur"]) && !empty($_POST["addr_amphur"]))
        $addr_amphur = $_POST["addr_amphur"];
    if (isset($_POST["addr_district"]) && !empty($_POST["addr_district"]))
        $addr_district = $_POST["addr_district"];
    if (isset($_POST["addr_province"]) && !empty($_POST["addr_province"]))
        $addr_province = $_POST["addr_province"];
    if (isset($_POST["addr_zipcode"]) && !empty($_POST["addr_zipcode"]))
        $addr_zipcode = $_POST["addr_zipcode"];
    add_address($id, $addr_num, $addr_village, $addr_alley, $addr_moo, $addr_road, $addr_district, $addr_amphur, $addr_province, $addr_zipcode, $type);
}
if ($type == 2) {
    echo "<script type='text/javascript'>";
    echo "window.location = '../view/detail_organization.php?id=' + $person_id;";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "window.close();";
    echo "</script>";
}
?>