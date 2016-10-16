<?php

//
error_reporting(E_ERROR | E_PARSE);
include '../helper/db_connect.php';
connect_database();
$time = date('Y-m-d H:i:s', time());
$data_id;
//print_r($_POST);
$count_bro = $_POST['count_bro'];
$count_child = $_POST['count_child'];

$bro1_bday = $_POST['bro1_bday'];
$bro2_bday = $_POST['bro2_bday'];
$bro3_bday = $_POST['bro3_bday'];
$bro4_bday = $_POST['bro4_bday'];
$bro5_bday = $_POST['bro5_bday'];
$bro6_bday = $_POST['bro6_bday'];

$child1_bday = $_POST['child1_bday'];
$child2_bday = $_POST['child2_bday'];
$child3_bday = $_POST['child3_bday'];
$child4_bday = $_POST['child4_bday'];
$child5_bday = $_POST['child5_bday'];
$child6_bday = $_POST['child6_bday'];

$chinahouse_link = $_POST['CHINAHOUSE_LINK'];

if (isset($_POST["name"]) && isset($_POST["surname"]) && !empty($_POST["name"])) {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $title = "";
    $gender = "";
    $birthday = "";
    $maritalstatus = "";
    $personalID = "";
    $status = 0;
    if (isset($_POST["title"]) && !empty($_POST["title"]))
        $title = $_POST["title"];

    if (isset($_POST["gender"]) && !empty($_POST["gender"]))
        $gender = $_POST["gender"];
    if (isset($_POST["status"]) && !empty($_POST["status"]))
        $status = $_POST["status"];
    if (isset($_POST["birthday"]) && !empty($_POST["birthday"]))
        $birthday = $_POST["birthday"];
    if (isset($_POST["maritalstatus"]) && !empty($_POST["maritalstatus"]))
        $maritalstatus = $_POST["maritalstatus"];
    $data_id = add_person($name, $surname, $birthday, $status, $gender, $maritalstatus, $title);
    if (isset($_POST["personalID"]) && !empty($_POST["personalID"])) {
        $personalID = $_POST["personalID"];
        add_personalID($data_id, $personalID);
    }
    //------------------------------------------------------------------------------------------//
    if (!empty($_POST["chinaname"]) || !empty($_POST["chinaname_pinyin"]) || !empty($_POST["chinaname_thai"])) {
        $gen_id = $_POST["generation"];
        $chinaname = $_POST["chinaname"];
        $chinaname_pinyin = $_POST['chinaname_pinyin'];
        $chinaname_th = $_POST['chinaname_thai'];
//        echo $gen_id;
        add_chinaname($data_id, $gen_id, $chinaname, $chinaname_pinyin, $chinaname_th);
    }


    //-------------------------------------------------------------------------------------------///

    if (isset($_POST["parent"]) && !empty($_POST["parent"])) {
        $iparr = split("\ ", $_POST["parent"]);
        $parent_name = $iparr[0];
        $parent_surname = $iparr[1];
        $parent_status = $_POST["parent_status"];
        $parent_id = add_person($parent_name, $parent_surname, '', $parent_status, '', '', '');
        add_parent($data_id, $parent_id, $parent_status);
    }
    if (isset($_POST["mother"]) && !empty($_POST["mother"])) {
        $iparr = split("\ ", $_POST["mother"]);
        $mother_name = $iparr[0];
        $mother_surname = $iparr[1];
        $mother_status = $_POST["mother_status"];
        $mother_id = add_person($mother_name, $mother_surname, '', $mother_status, '', '', '');
        add_mother($data_id, $mother_id, $mother_status);
    }

    //-------------------------------------add bro--------------------------------------------//   
    $brother_array = array();
    array_push($brother_array, $data_id);
    $brother_list = "$data_id,";
    $has_brother = false;
    if ($count_bro > 0) {
        for ($i = 1; $i <= $count_bro; $i++) {
            if (isset($_POST["namebro$i"]) && !empty($_POST["namebro$i"])) {
                $iparr = split("\ ", $_POST["namebro$i"]);
                $namebro_name = $iparr[0];
                $namebro_surname = $iparr[1];
                $bro_status = $_POST["bro" . $i . "_status"];
                $bro_bday = $_POST["bro" . $i . "_bday"];
                $namebro1_id = add_person($namebro_name, $namebro_surname, $bro_bday, $bro_status, '', '', '');
                $brother_list .= "$namebro1_id,";
                array_push($brother_array, $namebro1_id);
                $has_brother = true;
            }
        }
    }
    if ($has_brother) {
        if (isset($_POST["parent"]) && !empty($_POST["parent"])) {
            foreach ($brother_array as $brother_id) {
                add_parent($brother_id, $parent_id, $parent_status);
            }
        } else {
            add_brother_array($brother_array);
//        add_brother_list($brother_list);
        }
    }

    //-------------------------------------add chlid--------------------------------------------//   
    if ($count_child > 0) {
        for ($i = 1; $i <= $count_child; $i++) {
            if (isset($_POST["namechild$i"]) && !empty($_POST["namechild$i"])) {
                $iparr = split("\ ", $_POST["namechild$i"]);
                $namechild_name = $iparr[0];
                $namechild_surname = $iparr[1];
                $child_status = $_POST["child".$i."_status"];
                $child_bday = $_POST["child".$i."_bday"];
                $namechild_id = add_person($namechild_name, $namechild_surname, $child_bday, $child_status, '', '', '');
                $child_relation = $_POST['child'.$i.'_relation'];
                add_child($data_id, $namechild_id, $child_relation);
            }
        }
    }
    //------------------------------------------------------------------------------------------//           
    if (isset($_POST["tel"]) && !empty($_POST["tel"])) {
        $tel = $_POST["tel"];
        if (isset($_POST["tel_comment"]) && !empty($_POST["tel_comment"])) {
            $tel_comment = $_POST["tel_comment"];
            add_contact($data_id, $tel, $tel_comment, 1);
        } else {
            add_contact($data_id, $tel, "", 1);
        }
    }
    if (isset($_POST["moblie"]) && !empty($_POST["moblie"])) {
        $moblie = $_POST["moblie"];
        add_contact($data_id, $moblie, '', 2);
    }
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = $_POST["email"];
        add_contact($data_id, $email, '', 3);
    }
    if (isset($_POST["line"]) && !empty($_POST["line"])) {
        $line = $_POST["line"];
        add_contact($data_id, $line, '', 4);
    }
    if (isset($_POST["facebook"]) && !empty($_POST["facebook"])) {
        $facebook = $_POST["facebook"];
        add_contact($data_id, $facebook, '', 5);
    }
    if (!empty($_POST["addr_num"]) && !empty($_POST["addr_zipcode"])) {
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
        add_address($data_id, $addr_num, $addr_village, $addr_alley, $addr_moo, $addr_road, $addr_district, $addr_amphur, $addr_province, $addr_zipcode, 1);
    }
    //-------------------------//
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
        add_organization($data_id, $organizationtype, $organization_comment, $organization_name, $organization_role, $organization_num, $organization_village, $organization_alley, $organization_moo, $organization_road, $organization_district_id, $organization_amphur_id, $organization_province_id, $organization_zipcode);
    }

    $organization_ids = get_person_organization($data_id);
    $organization_id = mysql_fetch_assoc($organization_ids);
    $o_id = $organization_id['ORGANIZATION_ID'];

    if (isset($_POST["organization_tel"]) && !empty($_POST["organization_tel"])) {
        $organization_tel = $_POST["organization_tel"];
        if (isset($_POST["organization_tel_comment"]) && !empty($_POST["organization_tel_comment"])) {
            $organization_tel_comment = $_POST["organization_tel_comment"];
            add_contact($o_id, $organization_tel, $organization_tel_comment, 6);
        } else {
            add_contact($o_id, $organization_tel, '', 6);
        }
    }

    if (isset($_POST["organization_fax"]) && !empty($_POST["organization_fax"])) {
        $organization_fax = $_POST["organization_fax"];
        if (isset($_POST["organization_fax_comment"]) && !empty($_POST["organization_fax_comment"])) {
            $organization_fax_comment = $_POST["organization_fax_comment"];
            add_contact($o_id, $organization_fax, $organization_fax_comment, 9);
        } else {
            add_contact($o_id, $organization_fax, '', 9);
        }
    }

    if (isset($_POST["organization_web"]) && !empty($_POST["organization_web"])) {
        $organization_web = $_POST["organization_web"];
        add_contact($o_id, $organization_web, '', 7);
    }
    if (isset($_POST["organization_mail"]) && !empty($_POST["organization_mail"])) {
        $organization_mail = $_POST["organization_mail"];
        add_contact($o_id, $organization_mail, '', 8);
    }

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
        chinahouse($data_id, $chinahouse_name, $chinahouse_village_id, $chinahouse_amphur_id, $chinahouse_district_id, $chinahouse_province_id, $chinahouse_tel, $chinahouse_link);
    }

    if (isset($_FILES["picture"])) {
        $time = date('Y-m-d H:i:s', time());
        $target_dir = "../picture/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
//        echo "รูป " . $target_file;
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
//            echo "The file " . basename($_FILES["picture"]["name"]) . " has been uploaded.";
        } else {
//            echo "Sorry, there was an error uploading your file.";
        }
    }

    $remark = $_POST["remark_id"];
    edit_remark($data_id, $remark);
//    set_remark($data_id,$remark);
    $follower = $_POST["follower"];
    if (empty($_POST['runnum'])) {
        $runnum = create_run_number();
    } else {
        $runnum = $_POST['runnum'];
    }
    $reg_year = $_POST['reg_year'];
    register($data_id, $runnum, $follower, $reg_year);
}
echo "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
?>