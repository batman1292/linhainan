<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$time = date("Y-m-d H:i:s", time());
$id = $_POST["id"];
$organization_id = $_POST["organization_id"];
//$addr_id = $_POST["addr_id"];
//$type =$_POST["type"];
if (isset($_POST["addr_num"]) || !empty($_POST["addr_zipcode"])) {
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
    $new_id = get_address_id($addr_num, $addr_village, $addr_alley, $addr_moo, $addr_road, $addr_district, $addr_amphur, $addr_province, $addr_zipcode);
    if ($addr_id != $new_id) {
        del_address($id, $addr_id, $type);
        add_address($id, $addr_num, $addr_village, $addr_alley, $addr_moo, $addr_road, $addr_district, $addr_amphur, $addr_province, $addr_zipcode, $type);
    }
}


if (isset($_POST["organizationtype"]) && !empty($_POST["organizationtype"]) && $organization_id != 0) {
    $organization_sql = get_organization($id, $organization_id);
    $organization = mysql_fetch_assoc($organization_sql);
    if ($_POST["organizationtype"] != $organization["ORGANIZATION_TYPE_ID"]) {
        $query = "UPDATE `organization` SET `ORGANIZATION_TYPE_ID`='" . $_POST['organizationtype'] . "' WHERE `ID`=$organization_id";
        mysql_query($query);
    }
}
if (isset($_POST["organization_comment"]) && !empty($_POST["organization_comment"]) && $organization_id != 0) {
    $organization_sql = get_organization($id, $organization_id);
    $organization = mysql_fetch_assoc($organization_sql);
    if ($_POST["organization_comment"] != $organization["ORGANIZATION_COMMENT"]) {
        $query = "UPDATE `organization` SET `ORGANIZATION_COMMENT`='" . $_POST['organization_comment'] . "' WHERE `ID`=$organization_id";
        mysql_query($query);
    }
}
if (isset($_POST["organization_name"]) && !empty($_POST["organization_name"]) && $organization_id != 0) {
    $organization_sql = get_organization($id, $organization_id);
    $organization = mysql_fetch_assoc($organization_sql);
    if ($_POST["organization_name"] != $organization["ORGANIZATION_NAME"]) {
        $query = "UPDATE `organization` SET `ORGANIZATION_NAME`='" . $_POST['organization_name'] . "' WHERE `ID`=$organization_id";
        mysql_query($query);
    }
}

$organization_sql = get_organization($id, $organization_id);
$organization = mysql_fetch_assoc($organization_sql);
if ($_POST["organization_role"] != $organization["ORGANIZATION_ROLE"] && !empty($_POST["organization_role"])) {
    echo $query = "UPDATE `organizationrole` SET `ORGANIZATIONROLE_THRU_DATE`='$time' WHERE `PERSON_ID`=$id AND `ORGANIZATION_ID`=$organization_id AND `ORGANIZATIONROLE_THRU_DATE`=''";
    mysql_query($query);
    if (!empty($_POST["organization_role"])) {
        echo $query = "INSERT INTO `organizationrole`(`PERSON_ID`, `ORGANIZATION_ID`, `ORGANIZATION_ROLE`, `ORGANIZATIONROLE_FROM_DATE`) VALUES ($id,$organization_id,'" . $_POST["organization_role"] . "','$time')";
        mysql_query($query);
    }
}

$homeTels = get_person_contact($organization_id, 6);
while ($homeTel = mysql_fetch_assoc($homeTels)) {
    $contact_fomat = split('[-]', $_POST["organization_tel" . $homeTel['ID']]);
    $contact_area = $contact_fomat[0];
    $contact_str = $contact_fomat[1];
    $comment = $_POST['organization_tel_comment' . $homeTel['ID']];
    echo $contact_str;
    if ($homeTel['CONTACT_ARER_CODE'] != $contact_area || $homeTel['CONTACT_STRING'] != $contact_str || $homeTel['CONTACT_COMMENT'] != $comment) {
        $str = format_contact_tel($contact_area, $contact_str);
        del_contact($homeTel['ID']);
        if (!empty($_POST["$str"]))
            add_contact($organization_id, $str, $comment, 6);
    }
}
//if (isset($_POST["organization_tel"]) && !empty($_POST["organization_tel"]) && $organization_id != 0) {
//    $organization_tel = $_POST["organization_tel"];
//    if (isset($_POST["organization_tel_comment"]) && !empty($_POST["organization_tel_comment"])) {
//        $organization_tel_comment = $_POST["organization_tel_comment"];
//        add_contact($organization_id, $organization_tel, $organization_tel_comment, 6);
//    } else {
//        add_contact($organization_id, $organization_tel, '', 6);
//    }
//}
$homeTels = get_person_contact($organization_id, 9);
while ($homeTel = mysql_fetch_assoc($homeTels)) {
    $contact_fomat = split('[-]', $_POST["organization_fax" . $homeTel['ID']]);
    $contact_area = $contact_fomat[0];
    $contact_str = $contact_fomat[1];
    $comment = $_POST['organization_fax_comment' . $homeTel['ID']];
    if ($homeTel['CONTACT_ARER_CODE'] != $contact_area || $homeTel['CONTACT_STRING'] != $contact_str || $homeTel['CONTACT_COMMENT'] != $comment) {
        $str = format_contact_tel($contact_area, $contact_str);
        del_contact($homeTel['ID']);
        if (!empty($_POST["$str"]))
            add_contact($organization_id, $str, $comment, 9);
    }
}
//if (isset($_POST["organization_fax"]) && !empty($_POST["organization_fax"]) && $organization_id != 0) {
//    $organization_fax = $_POST["organization_fax"];
//    if (isset($_POST["organization_fax_comment"]) && !empty($_POST["organization_fax_comment"])) {
//        $organization_fax_comment = $_POST["organization_fax_comment"];
//        add_contact($organization_id, $organization_fax, $organization_fax_comment, 9);
//    } else {
//        add_contact($organization_id, $organization_fax, '', 9);
//    }
//}
$emails = get_person_contact($organization_id, 8);
$email = mysql_fetch_assoc($emails);
if ($email) {
    if ($_POST["organization_mail"] != $email["CONTACT_STRING"]) {
        del_contact($email['ID']);
        if (!empty($_POST["organization_mail"]))
            add_contact($organization_id, $_POST["organization_mail"], '', 8);
    }
} else {
    if (!empty($_POST["organization_mail"])) {
        add_contact($organization_id, $_POST["organization_mail"], '', 8);
    }
}

$webs = get_person_contact($organization_id, 7);
$web = mysql_fetch_assoc($webs);
if ($web) {
    if ($_POST["organization_web"] != $web["CONTACT_STRING"]) {
        del_contact($web['ID']);
        if (!empty($_POST["organization_web"]))
            add_contact($organization_id, $_POST["organization_web"], '', 7);
    }
} else {
    if (!empty($_POST["organization_web"])) {
        add_contact($organization_id, $_POST["organization_web"], '', 7);
    }
}

set_updatetime($id);
header('Location:../view/detail_organization.php?id='.$id); // back page
?>