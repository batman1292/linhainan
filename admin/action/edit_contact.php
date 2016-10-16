<?php
error_reporting(E_ERROR | E_PARSE);
include '../../helper/db_connect.php';
connect_database();
$time = date("Y-m-d H:i:s", time());
$id = $_POST["id"];
$homeTels = get_person_contact($id, 1);
while ($homeTel = mysql_fetch_assoc($homeTels)) {
//    echo $homeTel['ID'] . " = " . $_POST["tel" . $homeTel['ID']];
    $contact_fomat = split('[-]', $_POST["tel" . $homeTel['ID']]);
    $contact_area = $contact_fomat[0];
    $contact_str = $contact_fomat[1];
    $comment = $_POST['tel_comment' . $homeTel['ID']];
    if ($homeTel['CONTACT_ARER_CODE'] != $contact_area || $homeTel['CONTACT_STRING'] != $contact_str || $homeTel['CONTACT_COMMENT'] != $comment) {
        $str = format_contact_tel($contact_area, $contact_str);
        del_contact($homeTel['ID']);
        if (!empty($_POST["$str"]))
            add_contact($id, $str, $comment, 1);
    }
}

$mobileTels = get_person_contact($id, 2);
while ($mobileTel = mysql_fetch_assoc($mobileTels)) {
    $contact_fomat = split('[-]', $_POST["moblie" . $mobileTel['ID']]);
    $contact_area = $contact_fomat[0];
    $contact_str = $contact_fomat[1];
    if ($mobileTel['CONTACT_ARER_CODE'] != $contact_area || $mobileTel['CONTACT_STRING'] != $contact_str) {
        $str = format_contact_tel($contact_area, $contact_str);
        del_contact($mobileTel['ID']);
        if (!empty($_POST["$str"]))
            add_contact($id, $str, '', 2);
    }
}

$emails = get_person_contact($id, 3);
$email = mysql_fetch_assoc($emails);
if ($email) {
    if ($_POST["email"] != $email["CONTACT_STRING"]) {
        del_contact($email['ID']);
        if (!empty($_POST["email"]))
            add_contact($id, $_POST["email"], '', 3);
    }
} else {
    if (!empty($_POST["email"])) {
        add_contact($id, $_POST["email"], '', 3);
    }
}

$fbs = get_person_contact($id, 5);
$fb = mysql_fetch_assoc($fbs);
if ($fb) {
    if ($_POST["facebook"] != $fb["CONTACT_STRING"]) {
        del_contact($fb['ID']);
        if (!empty($_POST["facebook"]))
            add_contact($id, $_POST["facebook"], '', 5);
    }
} else {
    if (!empty($_POST["facebook"])) {
        add_contact($id, $_POST["facebook"], '', 5);
    }
}

$lines = get_person_contact($id, 4);
$line = mysql_fetch_assoc($lines);
if ($line) {
    if ($_POST["line"] != $line["CONTACT_STRING"]) {
        del_contact($line['ID']);
        if (!empty($_POST["line"]))
            add_contact($id, $_POST["line"], '', 4);
    }
} else {
    if (!empty($_POST["line"])) {
        add_contact($id, $_POST["line"], '', 4);
    }
}

set_updatetime($id);
echo "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
?>