<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$time = date("Y-m-d H:i:s", time());
$id = $_POST["id"];



$persons = get_person_detial($id);
$person = mysql_fetch_assoc($persons);
//----------------------------------new name----------------------------//
$old_name = get_person_name_string($id);
$old_surname = get_person_surname_string($id);
$new_name = $_POST["name"];
$new_surname = $_POST["surname"];
if ($new_name != $old_name || $new_surname != $old_surname) {
    edit_personname($id, $new_name, $new_surname);
}
//-----------------------------------china name-------------------------//
if (!empty($_POST["chinaname"]) || !empty($_POST["chinaname_pinyin"]) || !empty($_POST["chinaname_thai"])) {
    $gen_id = $_POST["generation"];
    $chinaname = $_POST["chinaname"];
    $chinaname_pinyin = $_POST['chinaname_pinyin'];
    $chinaname_th = $_POST['chinaname_thai'];
    add_chinaname($id, $gen_id, $chinaname, $chinaname_pinyin, $chinaname_th);
}

if (isset($_POST["title"]) && !empty($_POST["title"])) {
    $title = $_POST["title"];
    edit_title($id, $title);
}
if (isset($_POST["gender"]) && !empty($_POST["gender"])) {
    $gender = $_POST["gender"];
    edit_gender($id, $gender);
}
if (isset($_POST["birthday"]) && !empty($_POST["birthday"])) {
    $birthday = $_POST["birthday"];
    edit_birthday($id, $birthday);
}
if (isset($_POST["maritalstatus"]) && !empty($_POST["maritalstatus"])) {
    $maritalstatus = $_POST["maritalstatus"];
    edit_maritalstatus($id, $maritalstatus);
}
if (isset($_POST["status"]) && !empty($_POST["status"])) {
    $status = $_POST["status"];
    edit_status($id, $status);
}
if (isset($_POST["personalID"]) && !empty($_POST["personalID"])) {
    $personalID = $_POST["personalID"];
    add_personalID($id, $personalID);
}

echo "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
?>