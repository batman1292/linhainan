<?php

include '../helper/db_connect.php';
connect_database();
$time = date('Y-m-d H:i:s', time());
//print_r($_POST);

$id = $_GET["id"];

$persons = get_person_detial($id);
$person = mysql_fetch_assoc($persons);
//print_r($person);
//----------------------------------new name----------------------------//
$new_name = $_POST["name"];
$new_surname = $_POST["surname"];
$old_name = get_person_name_string($id);
$old_surname = get_person_surname_string($id);
$gen_id = $person['GENERATION_ID'];
$parent_id = $person['PARENT_ID'];
$chinahouse_link = $_POST['CHINAHOUSE_LINK'];

if ($new_name != $old_name || $new_surname != $old_surname) {
    edit_personname($id, $new_name, $new_surname);
}
//-----------------------------------china name-------------------------//
if (!empty($_POST["chinaname"]) || !empty($_POST["chinaname_pinyin"]) || !empty($_POST["chinaname_thai"])) {
    echo "8;pppp";
    $gen_id = $_POST["generation"];
//    print_r($_POST);
    $chinaname = $_POST["chinaname"];
    $chinaname_pinyin = $_POST['chinaname_pinyin'];
    $chinaname_th = $_POST['chinaname_thai'];
    add_chinaname($id, $gen_id, $chinaname, $chinaname_pinyin, $chinaname_th);
}
//
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
if (!empty($_POST["addr_num"]) && !empty($_POST["addr_zipcode"])) {
    del_old_address($id, 1);
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
    edit_address($id, $addr_num, $addr_village, $addr_alley, $addr_moo, $addr_road, $addr_district, $addr_amphur, $addr_province, $addr_zipcode, 1);
}
//
if (isset($_POST["tel"]) && !empty($_POST["tel"])) {
    del_old_contact($id, 1);
    $tel = $_POST["tel"];
    if (isset($_POST["tel_comment"]) && !empty($_POST["tel_comment"])) {
        $tel_comment = $_POST["tel_comment"];
        add_contact($id, $tel, $tel_comment, 1);
    } else {
        add_contact($id, $tel, "", 1);
    }
}
if (isset($_POST["moblie"]) && !empty($_POST["moblie"])) {
    del_old_contact($id, 2);
    $moblie = $_POST["moblie"];
    add_contact($id, $moblie, '', 2);
}
if (isset($_POST["email"]) && !empty($_POST["email"])) {
    del_old_contact($id, 3);
    $email = $_POST["email"];
    add_contact($id, $email, '', 3);
}
if (isset($_POST["line"]) && !empty($_POST["line"])) {
    del_old_contact($id, 4);
    $line = $_POST["line"];
    add_contact($id, $line, '', 4);
}
if (isset($_POST["facebook"]) && !empty($_POST["facebook"])) {
    del_old_contact($id, 5);
    $facebook = $_POST["facebook"];
    add_contact($id, $facebook, '', 5);
}
//
//if (!empty($_POST["organization_name"]) || !empty($_POST["organization_num"]) || !empty($_POST["organization_comment"])) {
//    del_old_organization($id);
//    $organizationtype = "";
//    $organization_comment = "";
//    $organization_name = "";
//    $organization_role = "";
//    $organization_num = "";
//    $organization_moo = "";
//    $organization_village = "";
//    $organization_alley = "";
//    $organization_road = "";
//    $organization_amphur_id = 0;
//    $organization_district_id = 0;
//    $organization_province_id = 0;
//    $organization_zipcode = "";
//    if (isset($_POST["organizationtype"]) && !empty($_POST["organizationtype"]))
//        $organizationtype = $_POST["organizationtype"];
//    if (isset($_POST["organization_comment"]) && !empty($_POST["organization_comment"]))
//        $organization_comment = $_POST["organization_comment"];
//    if (isset($_POST["organization_name"]) && !empty($_POST["organization_name"]))
//        $organization_name = $_POST["organization_name"];
//    if (isset($_POST["organization_role"]) && !empty($_POST["organization_role"]))
//        $organization_role = $_POST["organization_role"];
//    if (isset($_POST["organization_num"]) && !empty($_POST["organization_num"]))
//        $organization_num = $_POST["organization_num"];
//    if (isset($_POST["organization_moo"]) && !empty($_POST["organization_moo"]))
//        $organization_moo = $_POST["organization_moo"];
//    if (isset($_POST["organization_village"]) && !empty($_POST["organization_village"]))
//        $organization_village = $_POST["organization_village"];
//    if (isset($_POST["organization_alley"]) && !empty($_POST["organization_alley"]))
//        $organization_alley = $_POST["organization_alley"];
//    if (isset($_POST["organization_road"]) && !empty($_POST["organization_road"]))
//        $organization_road = $_POST["organization_road"];
//    if (isset($_POST["organization_amphur"]) && !empty($_POST["organization_amphur"]))
//        $organization_amphur_id = $_POST["organization_amphur"];
//    if (isset($_POST["organization_district"]) && !empty($_POST["organization_district"]))
//        $organization_district_id = $_POST["organization_district"];
//    if (isset($_POST["organization_province"]) && !empty($_POST["organization_province"]))
//        $organization_province_id = $_POST["organization_province"];
//    if (isset($_POST["organization_zipcode"]) && !empty($_POST["organization_zipcode"]))
//        $organization_zipcode = $_POST["organization_zipcode"];
//    add_organization($id, $organizationtype, $organization_comment, $organization_name, $organization_role, $organization_num, $organization_village, $organization_alley, $organization_moo, $organization_road, $organization_district_id, $organization_amphur_id, $organization_province_id, $organization_zipcode);
//}
//
$organization_ids = get_person_organization($id);
$organization_id = mysql_fetch_assoc($organization_ids);
$o_id = $organization_id['ORGANIZATION_ID'];
if (!empty($_POST["organization_name"]) || !empty($_POST["organization_comment"])) {
    if (isset($_POST["organization_comment"]) && !empty($_POST["organization_comment"]))
        $organization_comment = $_POST["organization_comment"];
    if (isset($_POST["organization_name"]) && !empty($_POST["organization_name"]))
        $organization_name = $_POST["organization_name"];
    edit_organization($id, $o_id, $organization_name, $_POST["organizationtype"], $organization_comment);
}

if (!empty($_POST["organization_num"])) {
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
    edit_organization_address($o_id, $organization_num, $organization_village, $organization_alley, $organization_moo, $organization_road, $organization_district_id, $organization_amphur_id, $organization_province_id, $organization_zipcode, 2);
}

if (isset($_POST["organization_role"]) && !empty($_POST["organization_role"])) {
    $organization_role = $_POST["organization_role"];
    edit_organization_role($id, $o_id, $organization_role);
}
if (isset($_POST["organization_tel"]) && !empty($_POST["organization_tel"])) {
    del_old_contact($o_id, 6);
    $organization_tel = $_POST["organization_tel"];
    if (isset($_POST["organization_tel_comment"]) && !empty($_POST["organization_tel_comment"])) {
        $organization_tel_comment = $_POST["organization_tel_comment"];
        add_contact($o_id, $organization_tel, $organization_tel_comment, 6);
    } else {
        add_contact($o_id, $organization_tel, '', 6);
    }
}

if (isset($_POST["organization_fax"]) && !empty($_POST["organization_fax"])) {
    del_old_contact($o_id, 9);
    $organization_fax = $_POST["organization_fax"];
    if (isset($_POST["organization_fax_comment"]) && !empty($_POST["organization_fax_comment"])) {
        $organization_fax_comment = $_POST["organization_fax_comment"];
        add_contact($o_id, $organization_fax, $organization_fax_comment, 9);
    } else {
        add_contact($o_id, $organization_fax, '', 9);
    }
}

if (isset($_POST["organization_web"]) && !empty($_POST["organization_web"])) {
    del_old_contact($o_id, 8);
    $organization_web = $_POST["organization_web"];
    add_contact($o_id, $organization_web, '', 8);
}
if (isset($_POST["organization_mail"]) && !empty($_POST["organization_mail"])) {
    del_old_contact($o_id, 7);
    $organization_mail = $_POST["organization_mail"];
    add_contact($o_id, $organization_mail, '', 7);
}

if (isset($_POST["chinahouse_name"]) || !empty($_POST["CHINAHOUSE_VILLAGE"]) || !empty($_POST["CHINAHOUSE_VILLAGE_TH"]) || !empty($_POST["CHINAHOUSE_DISTRICT"]) || !empty($_POST["CHINAHOUSE_DISTRICT_TH"])) {
//        echo "1234";
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

    chinahouse($id, $chinahouse_name, $chinahouse_village_id, $chinahouse_amphur_id, $chinahouse_district_id, $chinahouse_province_id, $chinahouse_tel, $chinahouse_link);
}

if (isset($_POST["mother"]) && !empty($_POST["mother"])) {
    $iparr = split("\ ", $_POST["mother"]);
    $mother_name = $iparr[0];
    $mother_surname = $iparr[1];
    $mother_status = $_POST["mother_status"];
    $mother_id = add_person($mother_name, $mother_surname, '', $mother_status, '', '', '');
    add_mother($id, $mother_id, $mother_status);
//    $persons = get_person_detial($id);
//    $person = mysql_fetch_assoc($persons);
//    if ($person['BROTHER_LIST'] != '') {
//        $brother_array = explode(',', $person['BROTHER_LIST']);
//        foreach ($brother_array as $brother) {
//            if ($brother != $id) {
//                add_parent($brother, $parent_id, $parent_status);
//                clear_brother_list($brother);
//            }
//        }
//    }
//    clear_brother_list($id);
}
if (isset($_POST["parent"]) && !empty($_POST["parent"])) {
    $iparr = split("\ ", $_POST["parent"]);
    $parent_name = $iparr[0];
    $parent_surname = $iparr[1];
    $parent_status = $_POST["parent_status"];
    $parent_id = add_person($parent_name, $parent_surname, '', $parent_status, '', '', '');
    add_parent($id, $parent_id, $parent_status);
    $persons = get_person_detial($id);
    $person = mysql_fetch_assoc($persons);
    if ($person['BROTHER_LIST'] != '') {
        $brother_array = explode(',', $person['BROTHER_LIST']);
        foreach ($brother_array as $brother) {
            if ($brother != $id) {
                add_parent($brother, $parent_id, $parent_status);
                clear_brother_list($brother);
            }
        }
    }
    clear_brother_list($id);
//    $change_parent = true;
}

$brother_array = array();
array_push($brother_array, $id);
$brother_list = "$id,";
$has_brother = false;
if (isset($_POST["namebro1"]) && !empty($_POST["namebro1"])) {
    $iparr = split("\ ", $_POST["namebro1"]);
    $namebro1_name = $iparr[0];
    $namebro1_surname = $iparr[1];
    $bro1_bday = $_POST["bro1_bday"];
    $bro1_status = $_POST["bro1_status"];
    $namebro1_id = add_person($namebro1_name, $namebro1_surname, $bro1_bday, '', '', '', '');
    $brother_list .= "$namebro1_id,";
    array_push($brother_array, $namebro1_id);
    $has_brother = true;
}
if (isset($_POST["namebro2"]) && !empty($_POST["namebro2"])) {
    $iparr = split("\ ", $_POST["namebro2"]);
    $namebro2_name = $iparr[0];
    $namebro2_surname = $iparr[1];
    $bro2_bday = $_POST["bro2_bday"];
    $bro2_status = $_POST["bro2_status"];
    $namebro2_id = add_person($namebro2_name, $namebro2_surname, $bro2_bday, $bro2_status, '', '', '');
    $brother_list .= "$namebro2_id,";
    array_push($brother_array, $namebro2_id);
    $has_brother = true;
}
if (isset($_POST["namebro3"]) && !empty($_POST["namebro3"])) {
    $iparr = split("\ ", $_POST["namebro3"]);
    $namebro3_name = $iparr[0];
    $namebro3_surname = $iparr[1];
    $bro3_bday = $_POST["bro3_bday"];
    $bro3_status = $_POST["bro3_status"];
    $namebro3_id = add_person($namebro3_name, $namebro3_surname, $bro3_bday, $bro3_status, '', '', '');
    $brother_list .= "$namebro3_id,";
    array_push($brother_array, $namebro3_id);
    $has_brother = true;
}
if (isset($_POST["namebro4"]) && !empty($_POST["namebro4"])) {
    $iparr = split("\ ", $_POST["namebro4"]);
    $namebro4_name = $iparr[0];
    $namebro4_surname = $iparr[1];
    $bro4_bday = $_POST["bro4_bday"];
    $bro4_status = $_POST["bro4_status"];
    $namebro4_id = add_person($namebro4_name, $namebro4_surname, $bro4_bday, $bro4_status, '', '', '');
    $brother_list .= "$namebro4_id,";
    array_push($brother_array, $namebro4_id);
    $has_brother = true;
}
$parents = get_person_detial($parent_id);
$parent = mysql_fetch_array($parents);
// echo $parent_id;s
if ($has_brother) {
    if ($parent_id != 0) {
        echo "123";
        foreach ($brother_array as $brother_id) {
            add_parent($brother_id, $parent_id, $parent['STATUS']);
        }
    } else {
        echo "qwe";
        add_brother_array($brother_array);
//        add_brother_list($brother_list);
    }
}

//-------------------------------------add chlid--------------------------------------------//   
if (isset($_POST["namechild1"]) && !empty($_POST["namechild1"])) {
    $iparr = split("\ ", $_POST["namechild1"]);
    $namechild1_name = $iparr[0];
    $namechild1_surname = $iparr[1];
    $child1_status = $_POST["child1_status"];
    $namechild1_id = add_person($namechild1_name, $namechild1_surname, $child1_bday, $child1_status, '', '', '');
    $child1_relation = $_POST['child1_relation'];
    echo $namechild1_id;
    add_child($id, $namechild1_id, $child1_relation);
}
if (isset($_POST["namechild2"]) && !empty($_POST["namechild2"])) {
    $iparr = split("\ ", $_POST["namechild2"]);
    $namechild2_name = $iparr[0];
    $namechild2_surname = $iparr[1];
    $child2_status = $_POST["child2_status"];
    $namechild2_id = add_person($namechild2_name, $namechild2_surname, $child2_bday, $child2_status, '', '', '');
    $child2_relation = $_POST['child2_relation'];
    add_child($id, $namechild2_id, $child2_relation);
}
if (isset($_POST["namechild3"]) && !empty($_POST["namechild3"])) {
    $iparr = split("\ ", $_POST["namebro3"]);
    $namechild3_name = $iparr[0];
    $namechild3_surname = $iparr[1];
    $child3_status = $_POST["child3_status"];
    $namechild3_id = add_person($namechild3_name, $namechild3_surname, $child3_bday, $child3_status, '', '', '');
    $child3_relation = $_POST['child3_relation'];
    add_child($id, $namechild3_id, $child3_relation);
}
if (isset($_POST["namechild4"]) && !empty($_POST["namechild4"])) {
    $iparr = split("\ ", $_POST["namebro4"]);
    $namechild4_name = $iparr[0];
    $namechild4_surname = $iparr[1];
    $child4_status = $_POST["child4_status"];
    $namechild4_id = add_person($namechild4_name, $namechild4_surname, $child4_bday, $child4_status, '', '', '');
    $child4_relation = $_POST['child4_relation'];
    add_child($id, $namechild4_id, $child4_relation);
}
//
//
if (isset($_FILES["picture"])) {
    $time = date('Y-m-d H:i:s', time());
    $target_dir = "../picture/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    echo "รูป " . $target_file;
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        $sql = "SELECT * FROM `picture` WHERE `PICTURE_OWNER_ID`='$id'";
        $res = mysql_query($sql);
        $result_name = mysql_fetch_assoc($res);
        if (!$result_name) {
            $sql = "INSERT INTO `picture`( `PICTURE_OWNER_ID`, `PICTURE_NAME`, `PICTURE_FROM_DATE`) VALUES ('$id','" . basename($_FILES["picture"]["name"]) . "','$time')";
            mysql_query($sql);
        } else {
            $sql = "UPDATE `picture` SET `PICTURE_THRU_DATE`='$time' WHERE `PICTURE_OWNER_ID`='$id' AND `PICTURE_THRU_DATE`=''";
            mysql_query($sql);
            $sql = "INSERT INTO `picture`( `PICTURE_OWNER_ID`, `PICTURE_NAME`, `PICTURE_FROM_DATE`) VALUES ('$id','" . basename($_FILES["picture"]["name"]) . "','$time')";
            mysql_query($sql);
        }
        set_updatetime($id);
        echo "The file " . basename($_FILES["picture"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$follower = $_POST["follower"];

if (empty($_POST['runnum'])) {
    $runnum = create_run_number();
} else {
    $runnum = $_POST['runnum'];
}

$reg_year = $_POST['reg_year'];
register($id, $runnum, $follower, $reg_year);

if (isset($_POST['status'])) {
    edit_status($id, $_POST['status']);
}
if (isset($_POST['REMARK'])) {
    edit_remark($id, $_POST['REMARK']);
}

echo "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
?>