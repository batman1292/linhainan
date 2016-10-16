<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$time = date("Y-m-d H:i:s", time());
$id = $_POST["id"];
$organization_id = $_POST["organization_id"];
$organization_role = $_POST["organization_role"];

$organization_type = $_POST["organizationtype"];
$organization_comment = $_POST["organization_comment"];
$organization_name = $_POST["organization_name"];

$organizations = get_organization_detail($organization_id);
$organization = mysql_fetch_assoc($organizations);
if ($organization['ORGANIZATION_NAME'] != $organization_name || $organization['ORGANIZATION_TYPE_ID'] != $organization_type || $organization['ORGANIZATION_COMMENT'] != $organization_comment) {
//    echo $query = "UPDATE `organizationrole` SET `ORGANIZATIONROLE_THRU_DATE`='$time' WHERE `PERSON_ID`=$id AND `ORGANIZATION_ID`=$organization_id AND `ORGANIZATIONROLE_THRU_DATE`=''";
//    mysql_query($query);
    $sql = "INSERT INTO `organization`(`ORGANIZATION_NAME`, `ORGANIZATION_TYPE_ID`, `ORGANIZATION_COMMENT`) VALUES ('$organization_name','$organization_type','$organization_comment')";
    mysql_query($sql);
    $sql = mysql_query("SELECT * FROM `organization` ORDER BY id DESC LIMIT 1");
    while ($row = mysql_fetch_assoc($sql)) {
        $organization_id = $row['ID'];
    }
}
if ($organization_id == $_POST['organization_id']) {
    $organizationroles = get_organization($person_id, $organization_id);
    $organizationrole = mysql_fetch_assoc($organizationroles);
    if ($organizationrole['ORGANIZATION_ROLE'] != $organization_role) {
        echo $query = "UPDATE `organizationrole` SET `ORGANIZATIONROLE_THRU_DATE`='$time' WHERE `PERSON_ID`=$id AND `ORGANIZATION_ID`=$organization_id AND `ORGANIZATIONROLE_THRU_DATE`=''";
        mysql_query($query);
        echo $query = "INSERT INTO `organizationrole`(`PERSON_ID`, `ORGANIZATION_ID`, `ORGANIZATION_ROLE`, `ORGANIZATIONROLE_FROM_DATE`) VALUES ($id,$organization_id,'" . $_POST["organization_role"] . "','$time')";
        mysql_query($query);
    }
} else {
    $org_id = $_POST['organization_id'];
    echo $query = "UPDATE `organizationrole` SET `ORGANIZATIONROLE_THRU_DATE`='$time' WHERE `PERSON_ID`=$id AND `ORGANIZATION_ID`=$org_id AND `ORGANIZATIONROLE_THRU_DATE`=''";
    mysql_query($query);
    echo $query = "INSERT INTO `organizationrole`(`PERSON_ID`, `ORGANIZATION_ID`, `ORGANIZATION_ROLE`, `ORGANIZATIONROLE_FROM_DATE`) VALUES ($id,$organization_id,'" . $_POST["organization_role"] . "','$time')";
    mysql_query($query);
}
echo "<script type='text/javascript'>";
echo "window.location = '../view/detail_organization.php?id=' + $id;";
echo "</script>";
?>