<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$time = date("Y-m-d H:i:s", time());
$id = $_POST["id"];
$organization_id = 0;
if (!empty($_POST["organization_name"]) || !empty($_POST["organization_num"]) || !empty($_POST["organization_comment"])) {

    $organizationtype = "";
    $organization_comment = "";
    $organization_name = "";
    $organization_role = "";
    $organization_num = "";
    $organization_moo = "";
    $organization_village = "";
    $organization_alley = "";
    $organization_road = "";
    $organization_amphur_id = 0;
    $organization_district_id = 0;
    $organization_province_id = 0;
    $organization_zipcode = "";
    if (isset($_POST["organizationtype"]) && !empty($_POST["organizationtype"]))
        $organizationtype = $_POST["organizationtype"];
    if (isset($_POST["organization_comment"]) && !empty($_POST["organization_comment"]))
        $organization_comment = $_POST["organization_comment"];
    if (isset($_POST["organization_name"]) && !empty($_POST["organization_name"]))
        $organization_name = $_POST["organization_name"];
    if (isset($_POST["organization_role"]) && !empty($_POST["organization_role"]))
        $organization_role = $_POST["organization_role"];
    if (isset($_POST["organization_num"]) && !empty($_POST["organization_num"]))
        $organization_num = $_POST["organization_num"];
    if (isset($_POST["organization_moo"]) && !empty($_POST["organization_moo"]))
        $organization_moo = $_POST["organization_moo"];
    if (isset($_POST["organization_village"]) && !empty($_POST["organization_village"]))
        $organization_village = $_POST["organization_village"];
    if (isset($_POST["organization_alley"]) && !empty($_POST["organization_alley"]))
        $organization_alley = $_POST["organization_alley"];
    if (isset($_POST["organization_road"]) && !empty($_POST["organization_road"]))
        $organization_road = $_POST["organization_road"];
    if (isset($_POST["organization_amphur"]) && !empty($_POST["organization_amphur"]))
        $organization_amphur_id = $_POST["organization_amphur"];
    if (isset($_POST["organization_district"]) && !empty($_POST["organization_district"]))
        $organization_district_id = $_POST["organization_district"];
    if (isset($_POST["organization_province"]) && !empty($_POST["organization_province"]))
        $organization_province_id = $_POST["organization_province"];
    if (isset($_POST["organization_zipcode"]) && !empty($_POST["organization_zipcode"]))
        $organization_zipcode = $_POST["organization_zipcode"];
    $organization_id = add_organization($id, $organizationtype, $organization_comment, $organization_name, $organization_role, $organization_num, $organization_village, $organization_alley, $organization_moo, $organization_road, $organization_district_id, $organization_amphur_id, $organization_province_id, $organization_zipcode);
}
//echo $organization_id;
if (isset($_POST["organization_tel"]) && !empty($_POST["organization_tel"]) && $organization_id != 0) {
   // echo $organization_tel = $_POST["organization_tel"];
    if (isset($_POST["organization_tel_comment"]) && !empty($_POST["organization_tel_comment"])) {
        $organization_tel_comment = $_POST["organization_tel_comment"];
        add_contact($organization_id, $organization_tel, $organization_tel_comment, 6);
    } else {
        add_contact($organization_id, $organization_tel, '', 6);
    }
}
if (isset($_POST["organization_mail"]) && !empty($_POST["organization_mail"]) && $organization_id != 0) {
    $organization_mail = $_POST["organization_mail"];
    add_contact($organization_id, $organization_mail, '', 8);
}
if (isset($_POST["organization_web"]) && !empty($_POST["organization_web"]) && $organization_id != 0) {
    $organization_web = $_POST["organization_web"];
    add_contact($organization_id, $organization_web, '', 7);
}
if (isset($_POST["organization_fax"]) && !empty($_POST["organization_fax"]) && $organization_id != 0) {
    $organization_fax = $_POST["organization_fax"];
    if (isset($_POST["organization_fax_comment"]) && !empty($_POST["organization_fax_comment"])) {
        $organization_fax_comment = $_POST["organization_fax_comment"];
        add_contact($organization_id, $organization_fax, $organization_fax_comment, 9);
    } else {
        add_contact($organization_id, $organization_fax, '', 9);
    }
}

echo "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
?>