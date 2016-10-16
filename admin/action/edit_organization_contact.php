<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$time = date("Y-m-d H:i:s", time());
$id = $_POST["id"];
$organization_id = $_POST["organization_id"];

if (!empty($_POST["organization_tel"])) {
    if (strlen($_POST['organization_tel']) == 11) {
        $contact_fomat = split('[-]', $_POST["organization_tel"]);
        $contact_area = $contact_fomat[0];
        $contact_str = $contact_fomat[1] . $contact_fomat[2];
//        $str = format_contact_tel($contact_area, $contact_str);
//        $comment = $_POST['organization_tel_comment'];
//        add_contact($organization_id, $str, $comment, 6);
    } else {
        $contact_fomat = split('[-]', $_POST["organization_tel"]);
        $contact_area = $contact_fomat[0];
        $contact_str = $contact_fomat[1];
//        $str = format_contact_tel($contact_area, $contact_str);
    }
    $str = format_contact_tel($contact_area, $contact_str);
    $comment = $_POST['organization_tel_comment'];
    $count = 1;
    $homeTels = get_person_contact($organization_id, 6);
    while ($homeTel = mysql_fetch_assoc($homeTels)) {
//        $contact_fomat = split('[-]', $_POST["organization_tel" . $homeTel['ID']]);
//        $contact_area = $contact_fomat [0];
//        $contact_str = $contact_fomat[1];
//        $comment = $_POST['organization_tel_comment'];
//        echo $contact_str;
        if ($homeTel['CONTACT_ARER_CODE'] != $contact_area || $homeTel['CONTACT_STRING'] != $contact_str || $homeTel['CONTACT_COMMENT'] != $comment) {
            $str = format_contact_tel($contact_area, $contact_str);
            del_contact($homeTel['ID']);
            if ($str != '') {
                add_contact($organization_id, $str, $comment, 6);
            }
        }
    }
    if ($count == 1) {
        add_contact($organization_id, $str, $comment, 6);
    }
}

if (!empty($_POST['organization_fax'])) {
    if (strlen($_POST['organization_fax']) == 11) {
        $contact_fomat = split('[-]', $_POST["organization_fax" . $homeTel['ID']]);
        $contact_area = $contact_fomat[0];
        $contact_str = $contact_fomat[1]. $contact_fomat[2];
    } else {
        $contact_fomat = split('[-]', $_POST["organization_fax" . $homeTel['ID']]);
        $contact_area = $contact_fomat[0];
        $contact_str = $contact_fomat[1];
    }
    $comment = $_POST['organization_fax_comment'];
    $str = format_contact_tel($contact_area, $contact_str);
    $homeTels = get_person_contact($organization_id, 9);
    $count = 1;
    while ($homeTel = mysql_fetch_assoc($homeTels)) {
        if ($homeTel['CONTACT_ARER_CODE'] != $contact_area || $homeTel['CONTACT_STRING'] != $contact_str || $homeTel['CONTACT_COMMENT'] != $comment) {
            $str = format_contact_tel($contact_area, $contact_str);
            del_contact($homeTel['ID']);
            if ($str != '') {
                add_contact($organization_id, $str, $comment, 9);
            }
        }
        $count++;
    }
    if ($count == 1) {
        add_contact($organization_id, $str, $comment, 9);
    }
}
//if (isset($_POST["organization_fax"]) && !empty($_POST["organization_fax"]) && $organization_id != 0) {
//    $organization_fax = $_POST["organization_fax"];
//    if (isset($_POST["organization_fax_comment"]) && !empty($_POST["organization_fax_comment"])) {
//        $organization_fax_comment = $_POST["organization_fax_comment"];
//        add_contact($organization_id, $organization_fax, $organ
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
echo "<script type='text/javascript'>";
echo "window.location = '../view/detail_organization.php?id=' + $id;";
echo "</script>";
?>

