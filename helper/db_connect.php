<?php

date_default_timezone_set('Asia/Bangkok');

function connect_database() {
    $username = "root";
    $database = "linhainan";

    $conn = mysql_connect("localhost", $username, "");

    if (!$conn)
        die('Could not connect: ' . mysql_error());

    $db_selected = mysql_select_db($database, $conn);

    if (!$db_selected)
        die('Could not connect: ' . mysql_error());

    mysql_query("set NAMES utf8");
    date_default_timezone_set('Asia/Bangkok');
}

function getGenDetailByType($type) {
    $query = "SELECT * FROM generation WHERE GENERATION_TYPE = $type";
    return mysql_query($query);
}

function count_gen_data($id) {
    $query = "SELECT COUNT(*) FROM person WHERE GENERATION_ID = $id";
    return mysql_query($query);
}

function search_province_id($data) {
    $query = "SELECT PROVINCE_ID FROM province WHERE PROVINCE_NAME LIKE '%$data%'";
//    echo $query;
    $checks = mysql_query($query);
    $check = mysql_fetch_assoc($checks);
    if (!$check) {
        return 0;
    } else {
        $result = array();
        $query = "SELECT PROVINCE_ID FROM province WHERE PROVINCE_NAME LIKE '%$data%'";
        $checks = mysql_query($query);
        while ($check = mysql_fetch_assoc($checks)) {
            array_push($result, $check['PROVINCE_ID']);
        }
        return $result;
    }
}

function get_person_detial($id) {
    $query = "SELECT * FROM person WHERE ID = $id";
    return mysql_query($query);
}

function get_person_all_address($id, $type) {
    $query = "SELECT * FROM address LEFT JOIN addresslist ON address.ID = addresslist.ADDRESSLIST_ADDRESS_ID WHERE addresslist.ADDRESSLIST_OWNER_ID = $id AND addresslist.ADDRESSLIST_TYPE_ID = $type AND addresslist.ADDRESSLIST_THRU_DATE=''";
//    echo $query;
    return mysql_query($query);
}

function get_address_data($address_id) {
    $query = "SELECT * FROM address WHERE ID = $address_id";
//    echo $query;
    return mysql_query($query);
}

function get_person_contact($id, $type) {
    $query = "SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = $type AND CONTACT_THRU_DATE=''";
//    echo $query;
    return mysql_query($query);
}

function get_person_china_name($id) {
    $query = "SELECT * FROM chinaname LEFT JOIN person ON chinaname.ID = person.CHINANAME_ID WHERE person.ID = $id";
    return mysql_query($query);
}

function get_person_china_generation_name($id) {
    $query = "SELECT * FROM generation LEFT JOIN person ON generation.ID = person.GENERATION_ID WHERE person.ID = $id";

    return mysql_query($query);
}

function get_person_gender_string($gender_id) {
    $query = "SELECT GENDER_NAME FROM gender WHERE ID = $gender_id";
//    echo $query;
    $gender_strings = mysql_query($query);
    $gender_string = mysql_fetch_assoc($gender_strings);
    if ($gender_string) {
        return $gender_string['GENDER_NAME'];
    } else {
        return '-';
    }
}

function get_person_marital_string($marital_id) {
    $query = "SELECT MARITALSTATUS_NAME FROM maritalstatus WHERE ID = $marital_id";
    $marital_strings = mysql_query($query);
    $marital_string = mysql_fetch_assoc($marital_strings);
    if ($marital_string) {
        return $marital_string['MARITALSTATUS_NAME'];
    } else {
        return '-';
    }
}

function get_person_title_string($title_id) {
    $query = "SELECT TITLE_NAME FROM title WHERE ID = $title_id";
    $title_strings = mysql_query($query);
    $title_string = mysql_fetch_assoc($title_strings);
    if ($title_string) {
        return $title_string['TITLE_NAME'];
    } else {
        return '-';
    }
}

function get_district_string($district_id) {
    $query = "SELECT DISTRICT_NAME FROM district WHERE DISTRICT_ID = $district_id";
    $district_strings = mysql_query($query);
    $district_string = mysql_fetch_assoc($district_strings);
    if ($district_string) {
        return $district_string['DISTRICT_NAME'];
    } else {
        return '';
    }
}

function get_amphur_string($amphur_id) {
    $query = "SELECT AMPHUR_NAME FROM amphur WHERE AMPHUR_ID = $amphur_id";
    $amphur_strings = mysql_query($query);
    $amphur_string = mysql_fetch_assoc($amphur_strings);
    if ($amphur_string) {
        return $amphur_string['AMPHUR_NAME'];
    } else {
        return '';
    }
}

function get_province_string($province_id) {
    $query = "SELECT PROVINCE_NAME FROM province WHERE PROVINCE_ID = $province_id";
//    echo $query;
    $province_strings = mysql_query($query);
    $province_string = mysql_fetch_assoc($province_strings);
    if ($province_string) {
        return $province_string['PROVINCE_NAME'];
    } else {
        return '';
    }
}

function get_person_name_string($id) {
    $query = "SELECT PERSONNAME_NAME FROM personname WHERE PERSONNAME_OWNER_ID = $id AND PERSONNAME_THRU_DATE = ''";
//    echo $query;
    $province_strings = mysql_query($query);
    $province_string = mysql_fetch_assoc($province_strings);
    if ($province_string) {
        return $province_string['PERSONNAME_NAME'];
    } else {
        return '';
    }
}

function get_person_surname_string($id) {
    $query = "SELECT PERSONNAME_SURNAME FROM personname WHERE PERSONNAME_OWNER_ID = $id AND PERSONNAME_THRU_DATE = ''";
//    echo $query;
    $province_strings = mysql_query($query);
    $province_string = mysql_fetch_assoc($province_strings);
    if ($province_string) {
        return $province_string['PERSONNAME_SURNAME'];
    } else {
        return '';
    }
}

function get_person_chinaname_string($id) {
//    $query = "SELECT PERSONNAME_SURNAME FROM personname WHERE PERSONNAME_OWNER_ID = $id";
//    echo $query;
    $province_strings = get_person_china_name($id);
    $province_string = mysql_fetch_assoc($province_strings);
    if ($province_string) {
        return $province_string['CHINANAME_NAME'];
    } else {
        return '';
    }
}

function get_generation_detial($gen_id) {
    $query = "SELECT * FROM generation WHERE id = $gen_id";

    return mysql_query($query);
}

//12/4/2015 BVH
function get_person_organization($id) {
    $query = "SELECT * FROM organizationrole WHERE PERSON_ID = $id AND ORGANIZATIONROLE_THRU_DATE = ''";
    return mysql_query($query);
}

function get_organization_data($organization_id) {
    $query = "SELECT * FROM organization WHERE ID = $organization_id";
    return mysql_query($query);
}

function get_organization_type_string($organization_type_id) {
    $query = "SELECT * FROM organizationtype WHERE ID = $organization_type_id";
    $results = mysql_query($query);
    $result = mysql_fetch_assoc($results);
    return $result['ORGANIZATIONTYPE_NAME'];
}

//15/4/2015 BVH
function get_person_brother($parent_id, $b_list, $id) {
    if ($parent_id != 0) {
        $query = "SELECT * FROM person WHERE PARENT_ID = $parent_id AND ID != $id Order by `BIRTHDAY` ASC";
    } else {
        $blist = substr($b_list, 0, strlen($b_list) - 1);
        $query = "SELECT * FROM person WHERE ID IN ($blist) AND ID != $id Order by `BIRTHDAY` ASC";
    }
//    echo $query;
    return mysql_query($query);
}

//--------------------------------------------------------------------------------------------//
function get_province_id($name) {
    $sql = mysql_query("SELECT * FROM `province` WHERE `PROVINCE_NAME` LIKE '$name'");
    $id = "";
    while ($re = mysql_fetch_assoc($sql)) {
        $id = $re["PROVINCE_ID"];
    }
    return $id;
}

function get_amphur_id($name) {
    $sql = mysql_query("SELECT * FROM `amphur` WHERE `AMPHUR_NAME` LIKE '$name'");
    $id = "";
    while ($re = mysql_fetch_assoc($sql)) {
        $id = $re["AMPHUR_ID"];
    }
    return $id;
}

function get_district_id($name) {
    $sql = mysql_query("SELECT * FROM `district` WHERE `DISTRICT_NAME` LIKE '$name'");
    $id = "";
    while ($re = mysql_fetch_assoc($sql)) {
        $id = $re["DISTRICT_ID"];
    }
    return $id;
}

function get_gen_id($name) {
    $sql = mysql_query("SELECT * FROM `generation` WHERE `GENERATION_NAME` LIKE '$name'");
    $id = "";
    while ($re = mysql_fetch_assoc($sql)) {
        $id = $re["id"];
    }
    return $id;
}

function add_person($name, $surname, $birthday, $status, $gender, $maritalstatus, $title) {
//    echo $status;
    $time = date('Y-m-d H:i:s', time());
    $sql_person = "SELECT `PERSONNAME_OWNER_ID` FROM `personname` WHERE `PERSONNAME_NAME`='$name' and `PERSONNAME_SURNAME`='$surname'";
    $res = mysql_query($sql_person);
    $result_name = mysql_fetch_assoc($res);

    if (!$result_name) {
        $sql1 = "INSERT INTO `person` (`BIRTHDAY`, `STATUS`, `LASTUPDATE`,`GENDER_ID`, `MARITALSTATUS_ID`, `TITLE_ID`) VALUES ('$birthday', '$status', '$time', '$gender', '$maritalstatus', '$title')";
        mysql_query($sql1);
//        echo $sql1;
        $sql2 = mysql_query("SELECT * FROM `person` ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($sql2)) {
            $data_id = $row['ID'];
        }
        $sql_personname = "INSERT INTO `personname`(`PERSONNAME_OWNER_ID`, `PERSONNAME_NAME`, `PERSONNAME_SURNAME` , `PERSONNAME_FROM_DATE`) VALUES ('$data_id','$name','$surname','$time')";
        mysql_query($sql_personname);
        echo $sql_personname;
    } else {
        $res = mysql_query($sql_person);
        while ($row = mysql_fetch_assoc($res)) {
            $data_id = $row['PERSONNAME_OWNER_ID'];
        }
    }

    return $data_id;
}

function set_updatetime($id) {
    $time = date('Y-m-d H:i:s', time());
    $sql = "UPDATE `person` SET `LASTUPDATE`='$time' WHERE `ID`='$id'";
    mysql_query($sql);
}

function add_chinaname($data_id, $gen_id, $chinaname, $chinaname_pinyin, $chinaname_th) {
    echo $gen_id;
    if ($chinaname != '') {
        $sql_chinaname = "SELECT * FROM `chinaname` WHERE `CHINANAME_NAME`='$chinaname'";
        $res_chinaname = mysql_query($sql_chinaname);
        $result_chinaname = mysql_fetch_assoc($res_chinaname);
    }
    if (!$result_chinaname) {
        $sql_chinaname = "INSERT INTO `chinaname`( `CHINANAME_NAME`, CHINANAME_PINYIN, CHINANAME_TH) VALUES ('$chinaname', '$chinaname_pinyin', '$chinaname_th')";
        mysql_query($sql_chinaname);
        echo $sql_chinaname;
        $sql = mysql_query("SELECT * FROM `chinaname` ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($sql)) {
            $chinaname_id = $row['ID'];
        }
    } else {
        $res = mysql_query($sql_chinaname);
        while ($row = mysql_fetch_assoc($res)) {
            $chinaname_id = $row['ID'];
            if ($row['CHINANAME_PINYIN'] == '' && $chinaname_pinyin != '')
                mysql_query("UPDATE chinaname SET CHINANAME_PINYIN = '$chinaname_pinyin' WHERE ID = $chinaname_id");
            if ($row['CHINANAME_TH'] == '' && $chinaname_th != '')
                mysql_query("UPDATE chinaname SET CHINANAME_TH = '$chinaname_th' WHERE ID = $chinaname_id");
        }
    }

    mysql_query("UPDATE `person` SET `GENERATION_ID`='$gen_id',`CHINANAME_ID`='$chinaname_id' WHERE `ID` = $data_id");
    set_updatetime($data_id);
}

function add_brother_array($brother_array) {
    $b_array = $brother_array;
    $brother_list = "";
    foreach ($brother_array as $brother_id) {
//        echo $brother_id;
        $persons = get_person_detial($brother_id);
        $person = mysql_fetch_assoc($persons);
        if ($person['BROTHER_LIST'] != '') {
            $brother_list .= $person['BROTHER_LIST'];
        } else {
            $brother_list .= $brother_id . ",";
        }
    }
//    echo $brother_list;
    if ($brother_list == "") {
        $brother_list = implode(",", $b_array);
        $brother_list .= ",";
//        $b_array = $brother_array;
    } else {
        $b_array = explode(",", $brother_list);
        array_pop($b_array);
        array_unique($b_array);
    }
//    echo $brother_list;
//    print_r($b_array);
    foreach ($b_array as $value) {
        $sql = "UPDATE person SET BROTHER_LIST = '$brother_list' WHERE ID = $value";
//                echo $sql;
        mysql_query($sql);
        set_updatetime($value);
    }
}

function add_brother_list($brother_list) {
    $brother_array = explode(",", $brother_list);
    array_pop($brother_array);
    foreach ($brother_array as $brother_id) {
        $sql = "UPDATE person SET BROTHER_LIST = '$brother_list' WHERE ID = $brother_id";
//                echo $sql;
        mysql_query($sql);
        set_updatetime($brother_id);
    }
}

function _add_brother($data_id, $brother_list) {

    $sql_brother = "UPDATE `person` SET `BROTHER_LIST`='$brother_list' WHERE `ID`='$data_id'";
    mysql_query($sql_brother);
    set_updatetime($data_id);
}

function add_contact($data_id, $str, $comment, $type) {
    $time = date('Y-m-d H:i:s', time());
    if ($str != "") {
        //check phone
        if ($type == 1 || $type == 2 || $type == 6 || $type == 9) {
            if ($str{1} == 2) {
                $contact_area = substr($str, 0, 2);
                $contact_str = substr($str, 2);
            } else {
                $contact_area = substr($str, 0, 3);
                $contact_str = substr($str, 3);
            }
            $sql_contact = "SELECT * FROM `contact` WHERE `CONTACT_OWNER_ID`='$data_id' and `CONTACT_ARER_CODE`='$contact_area' and `CONTACT_STRING`='$contact_str' and `CONTACT_TYPE_ID`='$type' and `CONTACT_THRU_DATE`=''";
            $res_contact = mysql_query($sql_contact);
            $result_contact = mysql_fetch_assoc($res_contact);
            if (!$result_contact) {
                $sql_contact = "INSERT INTO `contact`(`CONTACT_OWNER_ID`, `CONTACT_ARER_CODE`, `CONTACT_STRING`, `CONTACT_COMMENT`, `CONTACT_TYPE_ID`, `CONTACT_FROM_DATE`) VALUES ('$data_id ','$contact_area','$contact_str','$comment','$type','$time')";
                mysql_query($sql_contact);
                set_updatetime($data_id);
            } else {
                if ($result_contact['CONTACT_COMMENT'] != $comment) {
                    $sql_contact_2 = "UPDATE `contact` SET `CONTACT_THRU_DATE`='$time' WHERE `ID`=" . $result_contact["ID"];
                    mysql_query($sql_contact_2);
                    $sql_contact_2 = "INSERT INTO `contact`(`CONTACT_OWNER_ID`, `CONTACT_ARER_CODE`, `CONTACT_STRING`, `CONTACT_COMMENT`, `CONTACT_TYPE_ID`, `CONTACT_FROM_DATE`) VALUES ('$data_id ','$contact_area','$contact_str','$comment','$type','$time')";
                    mysql_query($sql_contact_2);
                    set_updatetime($data_id);
                }
            }
        }
        //check email, FB, Line
        else {
            $sql_contact = "SELECT * FROM `contact` WHERE `CONTACT_OWNER_ID`='$data_id' and `CONTACT_STRING`='$str' and `CONTACT_TYPE_ID`='$type' and `CONTACT_THRU_DATE`=''";
            $res_contact = mysql_query($sql_contact);
            $result_contact = mysql_fetch_assoc($res_contact);
            if (!$result_contact) {
                $sql_contact = "INSERT INTO `contact`(`CONTACT_OWNER_ID`,`CONTACT_STRING`, `CONTACT_TYPE_ID`, `CONTACT_FROM_DATE`) VALUES ('$data_id','$str','$type','$time')";
                mysql_query($sql_contact);
                set_updatetime($data_id);
            }
        }
    }
}

function add_address($data_id, $num, $village, $alley, $moo, $road, $district_id, $amphur_id, $province_id, $zipcode, $type) {

    $time = date('Y-m-d H:i:s', time());
    $sql_address = "SELECT * FROM `address` WHERE `ADDRESS_NUM`='$num' and `ADDRESS_VILLAGE`='$village' and `ADDRESS_ALLEY`='$alley' and `ADDRESS_MOO`='$moo' and `ADDRESS_ROAD`='$road' and `ADDRESS_DISTRICT_ID`='$district_id' and `ADDRESS_AMPHUR_ID`='$amphur_id' and `ADDRESS_PROVINCE_ID`='$province_id' and `ADDRESS_ZIPCODE`='$zipcode'";
    $res_addr = mysql_query($sql_address);
    $result_addr = mysql_fetch_assoc($res_addr);

    if (!$result_addr) {
        $sql_address = "INSERT INTO `address`(`ADDRESS_NUM`, `ADDRESS_VILLAGE`, `ADDRESS_ALLEY`, `ADDRESS_MOO`, `ADDRESS_ROAD`, `ADDRESS_DISTRICT_ID`, `ADDRESS_AMPHUR_ID`, `ADDRESS_PROVINCE_ID`, `ADDRESS_ZIPCODE`) VALUES "
                . "('$num','$village','$alley','$moo','$road','$district_id','$amphur_id','$province_id','$zipcode')";
        mysql_query($sql_address);
        $sql = mysql_query("SELECT * FROM `address` ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($sql)) {
            $address_id = $row['ID'];
        }
    } else {
        $res = mysql_query($sql_address);
        while ($row = mysql_fetch_assoc($res)) {
            $address_id = $row['ID'];
        }
    }
//    if ($old_addr_id != $address_id) {
    $sql_addrlist = "INSERT INTO `addresslist`(`ADDRESSLIST_OWNER_ID`, `ADDRESSLIST_ADDRESS_ID`, `ADDRESSLIST_TYPE_ID`, `ADDRESSLIST_FROM_DATE`) VALUES ('$data_id','$address_id','$type','$time')";
    mysql_query($sql_addrlist);
//    }
    echo $sql_addrlist;

    if ($type == 1) {
        set_updatetime($data_id);
    }
}

function add_organization($data_id, $organizationtype, $organizationcomment, $organizationname, $organizationrole, $organization_num, $organization_village, $organization_alley, $organization_moo, $organization_road, $organization_district_id, $organization_amphur_id, $organization_province_id, $organization_zipcode) {
    $time = date('Y-m-d H:i:s', time());
    $sql_organization = "SELECT * FROM `organization` WHERE `ORGANIZATION_NAME`='$organizationname'";
    $res = mysql_query($sql_organization);
    $result_organization = mysql_fetch_assoc($res);
    if (!$result_organization) {
        $sql = "INSERT INTO `organization`(`ORGANIZATION_NAME`, `ORGANIZATION_TYPE_ID`, `ORGANIZATION_COMMENT`) VALUES ('$organizationname','$organizationtype','$organizationcomment')";
        mysql_query($sql);
        $sql = mysql_query("SELECT * FROM `organization` ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($sql)) {
            $organization_id = $row['ID'];
        }
    } else {
        $res = mysql_query($sql_organization);
        while ($row = mysql_fetch_assoc($res)) {
            print_r($row);
            $organization_id = $row['ID'];
        }
    }
    add_address($organization_id, $organization_num, $organization_village, $organization_alley, $organization_moo, $organization_road, $organization_district_id, $organization_amphur_id, $organization_province_id, $organization_zipcode, 2);

    //-------------organization role-------------------//
    $sql_oraganizationrole = "INSERT INTO `organizationrole`(`PERSON_ID`, `ORGANIZATION_ID`, `ORGANIZATION_ROLE`, `ORGANIZATIONROLE_FROM_DATE`) VALUES ('$data_id','$organization_id','$organizationrole','$time')";
    mysql_query($sql_oraganizationrole);
    set_updatetime($data_id);
    return $organization_id;
}

function add_parent($data_id, $parent_id, $parent_status) {
    $time = date('Y-m-d H:i:s', time());
    $sql = "UPDATE `person` SET `STATUS`='$parent_status' WHERE `ID`='$parent_id'";
    mysql_query($sql);
    $sql = "UPDATE `person` SET `PARENT_ID`='$parent_id' WHERE `ID`='$data_id'";
//    echo $sql;
    mysql_query($sql);
    set_updatetime($data_id);
}

function get_chinahouse_id($chinahouse, $chinahouse_th) {
    $chinahouse_id = -1;
    if ($chinahouse != '') {
        $sql_china = "SELECT * FROM `china` WHERE CHINA_STR='$chinahouse'";
        $res = mysql_query($sql_china);
        $result_china = mysql_fetch_assoc($res);

        if (!$result_china) {
            $sql = "INSERT INTO `china`(`CHINA_STR`, `CHINA_TH`) VALUES ('$chinahouse', '$chinahouse_th')";
            mysql_query($sql);
//            echo $sql;
            $sql = mysql_query("SELECT * FROM `china` ORDER BY id DESC LIMIT 1");
            while ($row = mysql_fetch_assoc($sql)) {
                $chinahouse_id = $row['ID'];
            }
        } else {
            $res = mysql_query($sql_china);
            while ($row = mysql_fetch_assoc($res)) {
                $chinahouse_id = $row['ID'];
            }

        }
    } else {
        $sql_china = "SELECT * FROM `china` WHERE CHINA_TH='$chinahouse_th'";
        $res = mysql_query($sql_china);
        $result_china = mysql_fetch_assoc($res);

        if (!$result_china) {
            $sql = "INSERT INTO `china`(`CHINA_STR`, `CHINA_TH`) VALUES ('$chinahouse', '$chinahouse_th')";
            mysql_query($sql);
//            echo $sql;
            $sql = mysql_query("SELECT * FROM `china` ORDER BY id DESC LIMIT 1");
            while ($row = mysql_fetch_assoc($sql)) {
                $chinahouse_id = $row['ID'];
            }
        } else {
            $res = mysql_query($sql_china);
            while ($row = mysql_fetch_assoc($res)) {
                $chinahouse_id = $row['ID'];
            }

        }
    }
		$sql = "UPDATE `china` SET `CHINA_STR`='$chinahouse' , `CHINA_TH`='$chinahouse_th' WHERE ID=$chinahouse_id";
		mysql_query($sql);

    	return $chinahouse_id;
}

function get_chinahouse_th_id($chinahouse_th) {
    $sql_china = "SELECT * FROM `china` WHERE `CHINA_TH`='$chinahouse_th'";
    $res = mysql_query($sql_china);
    $result_china = mysql_fetch_assoc($res);

    if (!$result_china) {
        $sql = "INSERT INTO `china`(`CHINA_TH`) VALUES ('$chinahouse_th')";
        mysql_query($sql);
        $sql = mysql_query("SELECT * FROM `china` ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($sql)) {
            $chinahouse_id = $row['ID'];
        }
    } else {
        $res = mysql_query($sql_china);
        while ($row = mysql_fetch_assoc($res)) {
            $chinahouse_id = $row['ID'];
        }
    }
    return $chinahouse_id;
}

function chinahouse($data_id, $china_name, $china_village_id, $china_amphur_id, $china_district_id, $china_province_id, $china_tel, $china_link) {

    $sql_china = "SELECT * FROM `chinahouse` WHERE `CHINAHOUSE_NAME`='$china_name' and `CHINAHOUSE_VILLAGE_ID`='$china_village_id' and `CHINAHOUSE_DISTRICT_ID`='$china_district_id' and `CHINAHOUSE_AMPHUR_ID`='$china_amphur_id' and `CHINAHOUSE_PROVINCE_ID`='$china_province_id'";
    $res = mysql_query($sql_china);
    $result_china = mysql_fetch_assoc($res);
//    echo $sql_china;
    if (!$result_china) {
        $sql = "INSERT INTO `chinahouse`(`CHINAHOUSE_NAME`, `CHINAHOUSE_VILLAGE_ID`, `CHINAHOUSE_DISTRICT_ID`, `CHINAHOUSE_AMPHUR_ID`, `CHINAHOUSE_PROVINCE_ID`, `CHINAHOUSE_LINK`, `CHINAHOUSE_TEL`) VALUES ('$china_name','$china_village_id','$china_district_id','$china_amphur_id','$china_province_id','$china_link', '$china_tel')";
//        echo $sql;
        mysql_query($sql);
        $sql2 = mysql_query("SELECT * FROM `chinahouse` ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($sql2)) {
            $chinahouse_id = $row['ID'];
        }
        set_updatetime($data_id);
    } else {
        $res = mysql_query($sql_china);
        while ($row = mysql_fetch_assoc($res)) {

            $chinahouse_id = $row['ID'];
        }
        $sql = "UPDATE `chinahouse` SET `CHINAHOUSE_NAME` = '$chinahouse_name', `CHINAHOUSE_ WHERE `CHINAHOUSE_ID`='$chinahouse_id'";
        mysql_query($sql);
    }
    $sql = "UPDATE `person` SET `CHINAHOUSE_ID`='$chinahouse_id' WHERE `ID`='$data_id'";
    mysql_query($sql);
    set_updatetime($data_id);
}

//19/4/2015
function get_chinahouse_data($chinahouse_id) {
    $query = "SELECT * FROM chinahouse WHERE ID = $chinahouse_id";
    return mysql_query($query);
}

function get_china($china_id) {
    $query = "SELECT * FROM china WHERE ID = $china_id";
    return mysql_query($query);
}

//------------------------------------------------------------------------------//
//jay 20/4/58
function edit_personname($id, $name, $surname) {
    $time = date('Y-m-d H:i:s', time());
    $sql_del = "UPDATE `personname` SET `PERSONNAME_THRU_DATE`='$time' WHERE `PERSONNAME_OWNER_ID`='$id' and `PERSONNAME_THRU_DATE`=''";
//    echo $sql_del;
    mysql_query($sql_del);
    $sql_personname = "INSERT INTO `personname`(`PERSONNAME_OWNER_ID`, `PERSONNAME_NAME`, `PERSONNAME_SURNAME`,`PERSONNAME_FROM_DATE`) VALUES ('$id','$name','$surname','$time')";
    echo $sql_personname;
    mysql_query($sql_personname);
    $sql = mysql_query("SELECT * FROM `personname` ORDER BY id DESC LIMIT 1");

    set_updatetime($id);
}

function get_address_id($num, $village, $alley, $moo, $road, $district_id, $amphur_id, $province_id, $zipcode) {
    $sql_address = "SELECT * FROM `address` WHERE `ADDRESS_NUM`='$num' and `ADDRESS_VILLAGE`='$village' and `ADDRESS_ALLEY`='$alley' and `ADDRESS_MOO`='$moo' and `ADDRESS_ROAD`='$road' and `ADDRESS_DISTRICT_ID`='$district_id' and `ADDRESS_AMPHUR_ID`='$amphur_id' and `ADDRESS_PROVINCE_ID`='$province_id' and `ADDRESS_ZIPCODE`='$zipcode'";
    $res_addr = mysql_query($sql_address);
    $result_addr = mysql_fetch_assoc($res_addr);
    if (!$result_addr) {
        return 0;
    } else {
        $res = mysql_query($sql_address);
        while ($row = mysql_fetch_assoc($res)) {
            return $row['ID'];
        }
    }
}

function get_organization_id($organizationtype, $organization_name) {
    $sql_address = "SELECT * FROM `organization` WHERE `ORGANIZATION_NAME`=$organization_name AND `ORGANIZATION_TYPE_ID`=$organizationtype";
    $res_addr = mysql_query($sql_address);
    $result_addr = mysql_fetch_assoc($res_addr);
    if (!$result_addr) {
        return 0;
    } else {
        $res = mysql_query($sql_address);
        while ($row = mysql_fetch_assoc($res)) {
            return $row['ID'];
        }
    }
}

function del_address($id, $addr_id, $type) {
    $time = date('Y-m-d H:i:s', time());
    $sql_del = "UPDATE `addresslist` SET `ADDRESSLIST_THRU_DATE`='$time' WHERE `ADDRESSLIST_OWNER_ID`='$id' and `ADDRESSLIST_ADDRESS_ID`='$addr_id' and `ADDRESSLIST_TYPE_ID`='$type' and `ADDRESSLIST_THRU_DATE`='' ";
//    echo $sql_del;
    mysql_query($sql_del);
    set_updatetime($id);
}

function format_contact_tel($area, $str) {
    $tel_fin = "";
    for ($i = 0; $i < strlen($str); $i++) {
        $tel_fin .= $str{$i};
        if ($i == 2) {
            $tel_fin .= "-";
        }
    }
    return $area . "-" . $tel_fin;
}

function del_contact($id) {
    $time = date('Y-m-d H:i:s', time());
    $sql_del = "UPDATE `contact` SET `CONTACT_THRU_DATE`='$time' WHERE `ID`='$id'";
    mysql_query($sql_del);
    set_updatetime($id);
}

//function get_person_organization_all($person_id) {
//    $query = "SELECT * FROM address
//            LEFT JOIN organizationrole ON organizationrole.PERSON_ID=$person_id
//            LEFT JOIN organization ON organization.ID=organizationrole.ORGANIZATION_ID
//            LEFT JOIN organizationtype ON organizationtype.ID=organization.ORGANIZATION_TYPE_ID
//            LEFT JOIN addresslist ON address.ID = addresslist.ADDRESSLIST_ADDRESS_ID
//            WHERE
//            organizationrole.ORGANIZATIONROLE_THRU_DATE='' AND
//            addresslist.ADDRESSLIST_OWNER_ID = organization.ID AND addresslist.ADDRESSLIST_TYPE_ID = 2 AND addresslist.ADDRESSLIST_THRU_DATE=''";
//    return mysql_query($query);
//}
function get_organization($person_id, $organization_id) {
    $query = "SELECT * FROM address
            LEFT JOIN organizationrole ON organizationrole.PERSON_ID=$person_id
            LEFT JOIN organization ON organization.ID=$organization_id
            LEFT JOIN organizationtype ON organizationtype.ID=organization.ORGANIZATION_TYPE_ID
            LEFT JOIN addresslist ON address.ID = addresslist.ADDRESSLIST_ADDRESS_ID
            WHERE
            organizationrole.ORGANIZATION_ID=$organization_id AND organizationrole.ORGANIZATIONROLE_THRU_DATE='' AND
            addresslist.ADDRESSLIST_OWNER_ID = organization.ID AND addresslist.ADDRESSLIST_TYPE_ID = 2 AND addresslist.ADDRESSLIST_THRU_DATE=''";
//    echo $query;
    return mysql_query($query);
}

//------------------------------------------------------------------------------//
//jay 21/4/58
function get_person_organization_all($person_id) {
    $query = "SELECT * FROM organization
            LEFT JOIN organizationrole ON organizationrole.PERSON_ID=$person_id
            LEFT JOIN organizationtype ON organizationtype.ID=organization.ORGANIZATION_TYPE_ID
            WHERE
            organizationrole.ORGANIZATIONROLE_THRU_DATE='' AND organization.ID=organizationrole.ORGANIZATION_ID";
    return mysql_query($query);
}

function get_organization_detail($organization_id) {
    $query = "SELECT * FROM organization
            LEFT JOIN organizationtype ON organizationtype.ID=organization.ORGANIZATION_TYPE_ID
            WHERE
            organization.ID=$organization_id";
    return mysql_query($query);
}

// Jay 26-04-2015--------------------------------------------------------------------//
function edit_title($id, $title) {
    $query = mysql_query("SELECT * FROM `person` WHERE ID=$id");
    $data = mysql_fetch_assoc($query);
    if ($data['TITLE_ID'] != $title) {
        mysql_query("UPDATE `person` SET `TITLE_ID`='$title' WHERE `ID`='$id'");
        set_updatetime($id);
    }
}

function edit_gender($id, $gender) {
    $query = mysql_query("SELECT * FROM `person` WHERE ID=$id");
    $data = mysql_fetch_assoc($query);
    if ($data['GENDER_ID'] != $gender) {
        mysql_query("UPDATE `person` SET `GENDER_ID`='$gender' WHERE `ID`='$id'");
        set_updatetime($id);
    }
}

function edit_birthday($id, $birthday) {
    $query = mysql_query("SELECT * FROM `person` WHERE ID=$id");
    $data = mysql_fetch_assoc($query);
    if ($data['BIRTHDAY'] != $birthday) {
        mysql_query("UPDATE `person` SET `BIRTHDAY`='$birthday' WHERE `ID`='$id'");
        set_updatetime($id);
    }
}

function edit_maritalstatus($id, $maritalstatus) {
    $query = mysql_query("SELECT * FROM `person` WHERE ID=$id");
    $data = mysql_fetch_assoc($query);
    if ($data['MARITALSTATUS_ID'] != $maritalstatus) {
        mysql_query("UPDATE `person` SET `MARITALSTATUS_ID`='$maritalstatus' WHERE `ID`='$id'");
        set_updatetime($id);
    }
}

function edit_status($id, $status) {
    $query = mysql_query("SELECT * FROM `person` WHERE ID=$id");
    $data = mysql_fetch_assoc($query);
    if ($data['STATUS'] != $status) {
        mysql_query("UPDATE `person` SET `STATUS`='$status' WHERE `ID`='$id'");
        set_updatetime($id);
    }
}

function del_old_address($id, $type) {
    $homeAddrs = get_person_all_address($id, $type);
    while ($homeAddr = mysql_fetch_assoc($homeAddrs)) {
        del_address($id, $homeAddrs['ID'], $type);
    }
}

function del_old_contact($id, $type) {
    $contacts = get_person_contact($id, $type);
    while ($contact = mysql_fetch_assoc($contacts)) {
        del_contact($contact['ID']);
    }
}

function del_organization($id, $organization_id) {
    $time = date('Y-m-d H:i:s', time());
    $sql_del = "UPDATE `organizationrole` SET `ORGANIZATIONROLE_THRU_DATE`='$time' WHERE `PERSON_ID`=$id AND `ORGANIZATION_ID`=$organization_id";
    mysql_query($sql_del);
    set_updatetime($id);
}

function del_old_organization($id) {
    $organizationAddrs = get_person_organization_all($id);
    while ($organizationAddr = mysql_fetch_assoc($organizationAddrs)) {
        del_organization($id, $organizationAddr['ORGANIZATION_ID']);
        set_updatetime($id);
    }
}

function get_picture($id) {
    $sql = mysql_query("SELECT * FROM `picture` WHERE `PICTURE_OWNER_ID`=$id AND `PICTURE_THRU_DATE`=''");
    if (!$sql) {
        return 0;
    } else {
        $pic = mysql_query("SELECT * FROM `picture` WHERE `PICTURE_OWNER_ID`=$id AND `PICTURE_THRU_DATE`=''");
        $picture = mysql_fetch_assoc($pic);
        return $picture['PICTURE_NAME'];
    }
}

function del_picture($id) {
    $time = date('Y-m-d H:i:s', time());
    $query = "UPDATE `picture` SET `PICTURE_THRU_DATE`='$time' WHERE `PICTURE_OWNER_ID`=$id AND `PICTURE_THRU_DATE`=''";
    mysql_query($query);
    set_updatetime($id);
}

function del_person($id) {
    //-----------del chinaname-------------------//
    $persons = get_person_detial($id);
    $person = mysql_fetch_assoc($persons);
    $check_chinaname = mysql_query("SELECT * FROM `chinaname` WHERE  `ID`=" . $person["CHINANAME_ID"]);
    if ($check_chinaname) {
        if ($check_chinaname['CHINANAME_NAME'] == '' && $check_chinaname['CHINANAME_PINYIN'] == '') {
            $del_chinaname = "DELETE FROM `chinaname` WHERE `ID`=$id";
        }
    }
    //-----------del contact--------------------//
    $del_contact = "DELETE FROM `contact` WHERE `ID`=$id";
    mysql_query($del_contact);

    //----------del_picture--------------------//
    $sql = mysql_query("SELECT * FROM `picture` WHERE `PICTURE_OWNER_ID`=$id");
    while ($picture = mysql_fetch_assoc($sql)) {
        $dir = "../../picture";
        foreach (glob($dir . "/*") as $filename) {
            if (is_file($filename)) {
                if ($filename == $dir . "/" . $picture['PICTURE_NAME']) {
                    unlink($filename);
                    echo "del$filename";
                }
            }
        }
    }

    //-----------del person--------------------//
    $del_person = "DELETE FROM `person` WHERE `ID`=$id";
    mysql_query($del_person);
}

//26/4/2558 0:40 BVH
function add_parent_id($id, $parent_id) {
    $sql = "UPDATE `person` SET `PARENT_ID`='$parent_id' WHERE `ID`='$id'";
    mysql_query($sql);
    set_updatetime($id);
}

//4/5/58 BVH
function add_chinahouse($id, $chinahouse_id) {
    $sql = "UPDATE `person` SET `CHINAHOUSE_ID`='$chinahouse_id' WHERE `ID`='$id'";
    mysql_query($sql);
}

//5/5/58 BVH
function del_parent($id) {
    $sql = "UPDATE `person` SET `PARENT_ID`='0' WHERE `ID`='$id'";
    mysql_query($sql);
}

function del_chinahouse($id) {
    $sql = "UPDATE `person` SET `CHINAHOUSE_ID`='0' WHERE `ID`='$id'";
    mysql_query($sql);
}

//-----jay5/5/58 -------------------------------
function get_last_update($id) {
    $sql = "SELECT * FROM `person` WHERE `ID`=$id";
    $query = mysql_query($sql);
    $result = mysql_fetch_assoc($query);
    return $result["LASTUPDATE"];
}

//6/5/58 BVH
function get_china_srting($china_id, $type) {
    $chinas = get_china($china_id);
    $china = mysql_fetch_assoc($chinas);
    if ($type == 'china') {
        return $china['CHINA_STR'];
    } else if ($type == 'thai') {
        return $china['CHINA_TH'];
    }
}

function clear_brother_list($id) {
    $sql = "UPDATE `person` SET `BROTHER_LIST`='' WHERE `ID`='$id'";
    mysql_query($sql);
}

//8/5/2558 BVH
function del_brother($id, $brother_id) {
    $persons = get_person_detial($id);
    $person = mysql_fetch_assoc($persons);
    $brother_array = explode(",", $person['BROTHER_LIST']);
    array_pop($brother_array);
    $key = array_search($brother_id, $brother_array);
    if ($key !== false) {
        unset($brother_array[$key]);
    }
    $brother_list = implode(",", $brother_array);
    $brother_list .= ",";
    foreach ($brother_array as $value) {
        $sql = "UPDATE person SET BROTHER_LIST = '$brother_list' WHERE ID = $value";
//                echo $sql;
        mysql_query($sql);
        set_updatetime($value);
    }
    clear_brother_list($brother_id);
}

function get_org($id, $org_id) {
    $query = "SELECT * FROM organization LEFT JOIN organizationrole ON organizationrole.PERSON_ID=$id WHERE organization.ID = $org_id AND ORGANIZATIONROLE_THRU_DATE = ''";
//    echo $query;
    return mysql_query($query);
}

function register($id, $number, $follower, $year) {
//    $time = date('Y-m-d H:i:s', time());
    $time = $year . "-mm-dd HH:ii:ss";
    $sql = "SELECT * FROM `register` WHERE `REGISTER_OWNER_ID`=$id and `REGISTER_THRU_DATE`=''";
    $re = mysql_query($sql);
    $result = mysql_fetch_assoc($re);
    if ($result) {
        $sql = "UPDATE `register` SET `REGISTER_FOLLOWER`=$follower , `REGISTER_NUMBER`=$number WHERE `REGISTER_OWNER_ID`=$id and `REGISTER_THRU_DATE`=''";
        mysql_query($sql);
    } else {
        $sql = "INSERT INTO `register`(`REGISTER_OWNER_ID`, `REGISTER_NUMBER`, `REGISTER_FOLLOWER`, `REGISTER_FROM_DATE`) VALUES ('$id','$number','$follower','$time')";
        mysql_query($sql);
    }
    set_updatetime($id);
}

function get_register($id) {
    $sql = "SELECT * FROM `register` WHERE `REGISTER_OWNER_ID`=$id and `REGISTER_THRU_DATE`=''";
    $re = mysql_query($sql);
    $result = mysql_fetch_assoc($re);
    if ($result) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function get_num_register() {
    $number = 0;
    $sql = "SELECT * FROM `register` WHERE  `REGISTER_THRU_DATE` =''";
    $re = mysql_query($sql);
    if (!empty($re)) {
        while ($result = mysql_fetch_assoc($re)) {
            $number += 1;
        }
    }
    return $number;
}

function get_follower($id) {
    $follower = 0;
    $sql = "SELECT * FROM `register` WHERE `REGISTER_OWNER_ID`=$id and `REGISTER_THRU_DATE`=''";
    $re = mysql_query($sql);
    $result = mysql_fetch_assoc($re);
    if ($result) {
        return $result['REGISTER_FOLLOWER'];
    } else {
        return 0;
    }
}

function get_numall_register() {
    $number = 0;
    $sql = "SELECT * FROM `register` WHERE  `REGISTER_THRU_DATE` =''";
    $re = mysql_query($sql);
    if (!empty($re)) {
        while ($result = mysql_fetch_assoc($re)) {
            $number += 1;
            $number += $result['REGISTER_FOLLOWER'];
        }
    }
    return $number;
}

function get_running_number($id) {
    $sql = "SELECT * FROM `register` WHERE `REGISTER_OWNER_ID`=$id and `REGISTER_THRU_DATE`=''";
    $re = mysql_query($sql);
    $result = mysql_fetch_assoc($re);
    if ($result) {
        return $result['REGISTER_NUMBER'];
    } else {
        return 0;
    }
}

function get_reg_year_list() {
    $year = array();
    $query = "SELECT * FROM register ORDER BY REGISTER_FROM_DATE ASC";
    $results = mysql_query($query);
    $result = mysql_fetch_assoc($results);
    $data = explode('-', $result['REGISTER_FROM_DATE']);
    array_push($year, $data[0]);
    while (1) {
        $data[0] ++;
        $query = "SELECT * FROM register WHERE REGISTER_FROM_DATE LIKE '%$data[0]%' ORDER BY REGISTER_FROM_DATE ASC";
        $checks = mysql_query($query);
        $check = mysql_fetch_assoc($checks);
        if (!$check) {
            break;
        } else {
            $results = mysql_query($query);
            $result = mysql_fetch_assoc($results);
//            $data = explode('-', $result['REGISTER_FROM_DATE']);
            $data = explode('-', $result['REGISTER_FROM_DATE']);
            array_push($year, $data[0]);
        }
    }
    return $year;
}

function count_reg_by_year($year) {
    $query = "SELECT COUNT(*) FROM register WHERE REGISTER_FROM_DATE LIKE '%$year%'";
    return mysql_query($query);
}

function search_reg_by_year($year) {
    $query = "SELECT * FROM register WHERE REGISTER_FROM_DATE LIKE '%$year%' ORDER BY REGISTER_NUMBER ASC";
    return $query;
}

//11/5/2558 BVH
function get_gen_detial($gen_id) {
    $query = "SELECT * FROM generation WHERE ID = $gen_id";
    return mysql_query($query);
}

function get_generation_person($gen_id) {
    return "SELECT * FROM person WHERE GENERATION_ID = $gen_id";
}

//13/5/2558 BVH
function edit_address($data_id, $num, $village, $alley, $moo, $road, $district_id, $amphur_id, $province_id, $zipcode, $type) {

    $addrs = mysql_query("SELECT * FROM addresslist WHERE ADDRESSLIST_OWNER_ID = $data_id AND ADDRESSLIST_THRU_DATE = ''");
    $addr = mysql_fetch_assoc($addrs);
    $old_addr_id = 0;
    if ($addr) {
        $old_addr_id = $addr['ADDRESSLIST_ADDRESS_ID'];
    }
    $time = date('Y-m-d H:i:s', time());
    $sql_address = "SELECT * FROM `address` WHERE `ADDRESS_NUM`='$num' and `ADDRESS_VILLAGE`='$village' and `ADDRESS_ALLEY`='$alley' and `ADDRESS_MOO`='$moo' and `ADDRESS_ROAD`='$road' and `ADDRESS_DISTRICT_ID`='$district_id' and `ADDRESS_AMPHUR_ID`='$amphur_id' and `ADDRESS_PROVINCE_ID`='$province_id' and `ADDRESS_ZIPCODE`='$zipcode'";
    $res_addr = mysql_query($sql_address);
    $result_addr = mysql_fetch_assoc($res_addr);

    if (!$result_addr) {
        $sql_address = "INSERT INTO `address`(`ADDRESS_NUM`, `ADDRESS_VILLAGE`, `ADDRESS_ALLEY`, `ADDRESS_MOO`, `ADDRESS_ROAD`, `ADDRESS_DISTRICT_ID`, `ADDRESS_AMPHUR_ID`, `ADDRESS_PROVINCE_ID`, `ADDRESS_ZIPCODE`) VALUES "
                . "('$num','$village','$alley','$moo','$road','$district_id','$amphur_id','$province_id','$zipcode')";
        mysql_query($sql_address);
        $sql = mysql_query("SELECT * FROM `address` ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($sql)) {
            $address_id = $row['ID'];
        }
    } else {
        $res = mysql_query($sql_address);
        while ($row = mysql_fetch_assoc($res)) {
            $address_id = $row['ID'];
        }
    }
//echo $old_addr_id;
//echo $address_id;
    if ($old_addr_id != $address_id) {
        $sql_del = "UPDATE `addresslist` SET `ADDRESSLIST_THRU_DATE`='$time' WHERE `ADDRESSLIST_ADDRESS_ID`='$old_addr_id' and `ADDRESSLIST_THRU_DATE`=''";
//    echo $sql_del;
        mysql_query($sql_del);
        $sql_addrlist = "INSERT INTO `addresslist`(`ADDRESSLIST_OWNER_ID`, `ADDRESSLIST_ADDRESS_ID`, `ADDRESSLIST_TYPE_ID`, `ADDRESSLIST_FROM_DATE`) VALUES ('$data_id','$address_id','$type','$time')";
        mysql_query($sql_addrlist);
    }
    echo $sql_addrlist;
    if ($type == 1) {
        set_updatetime($data_id);
    }
}

function edit_organization_role($data_id, $org_id, $org_role) {
    $time = date('Y-m-d H:i:s', time());
    $sql_del = "UPDATE `organizationrole` SET `ORGANIZATIONROLE_THRU_DATE`='$time' WHERE `ORGANIZATION_ID`='$org_id' and `PERSON_ID`='$data_id'";
//    echo $sql_del;
    mysql_query($sql_del);
    $sql_oraganizationrole = "INSERT INTO `organizationrole`(`PERSON_ID`, `ORGANIZATION_ID`, `ORGANIZATION_ROLE`, `ORGANIZATIONROLE_FROM_DATE`) VALUES ('$data_id','$org_id','$org_role','$time')";
    mysql_query($sql_oraganizationrole);
}

function edit_organization_address($data_id, $num, $village, $alley, $moo, $road, $district_id, $amphur_id, $province_id, $zipcode, $type) {

    $addrs = mysql_query("SELECT * FROM addresslist WHERE ADDRESSLIST_OWNER_ID = $data_id AND ADDRESSLIST_THRU_DATE = '' AND ADDRESSLIST_TYPE_ID=2");
    $addr = mysql_fetch_assoc($addrs);
    $old_addr_id = 0;
    if ($addr) {
        $old_addr_id = $addr['ADDRESSLIST_ADDRESS_ID'];
    }
    $time = date('Y-m-d H:i:s', time());
    $sql_address = "SELECT * FROM `address` WHERE `ADDRESS_NUM`='$num' and `ADDRESS_VILLAGE`='$village' and `ADDRESS_ALLEY`='$alley' and `ADDRESS_MOO`='$moo' and `ADDRESS_ROAD`='$road' and `ADDRESS_DISTRICT_ID`='$district_id' and `ADDRESS_AMPHUR_ID`='$amphur_id' and `ADDRESS_PROVINCE_ID`='$province_id' and `ADDRESS_ZIPCODE`='$zipcode'";
    $res_addr = mysql_query($sql_address);
    $result_addr = mysql_fetch_assoc($res_addr);

    if (!$result_addr) {
        $sql_address = "INSERT INTO `address`(`ADDRESS_NUM`, `ADDRESS_VILLAGE`, `ADDRESS_ALLEY`, `ADDRESS_MOO`, `ADDRESS_ROAD`, `ADDRESS_DISTRICT_ID`, `ADDRESS_AMPHUR_ID`, `ADDRESS_PROVINCE_ID`, `ADDRESS_ZIPCODE`) VALUES "
                . "('$num','$village','$alley','$moo','$road','$district_id','$amphur_id','$province_id','$zipcode')";
        mysql_query($sql_address);
        $sql = mysql_query("SELECT * FROM `address` ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($sql)) {
            $address_id = $row['ID'];
        }
    } else {
        $res = mysql_query($sql_address);
        while ($row = mysql_fetch_assoc($res)) {
            $address_id = $row['ID'];
        }
    }
    echo $old_addr_id;
    echo $address_id;
    if ($old_addr_id != $address_id) {
        $sql_del = "UPDATE `addresslist` SET `ADDRESSLIST_THRU_DATE`='$time' WHERE `ADDRESSLIST_ADDRESS_ID`='$old_addr_id' and `ADDRESSLIST_THRU_DATE`=''";
        echo $sql_del;
        mysql_query($sql_del);
        $sql_addrlist = "INSERT INTO `addresslist`(`ADDRESSLIST_OWNER_ID`, `ADDRESSLIST_ADDRESS_ID`, `ADDRESSLIST_TYPE_ID`, `ADDRESSLIST_FROM_DATE`) VALUES ('$data_id','$address_id','$type','$time')";
        mysql_query($sql_addrlist);
    }
    echo $sql_addrlist;
    if ($type == 1) {
        set_updatetime($data_id);
    }
}

function edit_organization($data_id, $org_id, $org_name, $org_type, $org_comment) {
    $time = date('Y-m-d H:i:s', time());
//    echo
    $query = "SELECT * FROM organization WHERE ORGANIZATION_NAME = '$org_name' AND ORGANIZATION_TYPE_ID = $org_type AND ORGANIZATION_COMMENT = '$org_comment'";
    echo $query;
    $res = mysql_query($query);
    $result_organization = mysql_fetch_assoc($res);
    if (!$result_organization) {
        $sql = "INSERT INTO `organization`(`ORGANIZATION_NAME`, `ORGANIZATION_TYPE_ID`, `ORGANIZATION_COMMENT`) VALUES ('$org_name','$org_type','$org_comment')";
        mysql_query($sql);
        $sql = mysql_query("SELECT * FROM `organization` ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($sql)) {
            $organization_id = $row['ID'];
        }
    } else {
        $res = mysql_query($query);
        while ($row = mysql_fetch_assoc($res)) {
            print_r($row);
            $organization_id = $row['ID'];
        }
    }
    echo "++++++++++++++";
    echo $organization_id;
    echo $org_id;
    echo "--------------";
    if ($organization_id != $org_id) {
//        $sql_del = "UPDATE `organizationrole` SET `ORGANIZATION_ID`='$organization_id' WHERE `ORGANIZATION_ID`='$org_id' and `PERSON_ID`='$data_id' AND ORGANIZATIONROLE_THRU_DATE=''";
////    echo $sql_del;
//        mysql_query($sql_del);
        $query = "SELECT * FROM organizationrole WHERE ORGANIZATION_ID = $org_id AND ORGANIZATIONROLE_THRU_DATE = '' AND PERSON_ID=$data_id";
        $o_orgs = mysql_query($query);
//        echo $query;
        $o_org = mysql_fetch_assoc($o_orgs);
        $o_org_role = '';
        if ($o_org) {
            $o_org_role = $o_org['ORGANIZATION_ROLE'];
        }
        echo $o_org_role;
        $time = date('Y-m-d H:i:s', time());
        $sql_oraganizationrole = "INSERT INTO `organizationrole`(`PERSON_ID`, `ORGANIZATION_ID`, `ORGANIZATION_ROLE`, `ORGANIZATIONROLE_FROM_DATE`) VALUES ('$data_id','$organization_id','$o_org_role','$time')";
        mysql_query($sql_oraganizationrole);
        $sql_del = "UPDATE `organizationrole` SET `ORGANIZATIONROLE_THRU_DATE`='$time' WHERE `ORGANIZATION_ID`='$org_id' and `PERSON_ID`='$data_id'";
//    echo $sql_del;
        mysql_query($sql_del);

        $query = "SELECT * FROM addresslist WHERE ADDRESSLIST_OWNER_ID = $org_id AND ADDRESSLIST_THRU_DATE = '' AND ADDRESSLIST_TYPE_ID=2";
        $o_addrs = mysql_query($query);
//        echo $query;
        $o_addr = mysql_fetch_assoc($o_addrs);
        $o_addr_id = 0;
        if ($o_addr) {
            $o_addr_id = $o_addr['ADDRESSLIST_ADDRESS_ID'];
            $sql_oraganizationrole = "INSERT INTO `addresslist`(`ADDRESSLIST_OWNER_ID`, `ADDRESSLIST_ADDRESS_ID`, `ADDRESSLIST_TYPE_ID`, `ADDRESSLIST_FROM_DATE`) VALUES ('$organization_id','$o_addr_id','2','$time')";
            mysql_query($sql_oraganizationrole);
            $sql_del = "UPDATE `addresslist` SET `ADDRESSLIST_THRU_DATE`='$time' WHERE `ADDRESSLIST_OWNER_ID`='$org_id' and `ADDRESSLIST_TYPE_ID`='2'";
//    echo $sql_del;
            mysql_query($sql_del);
        }
//        echo $o_org_role;
        //tel
        $sql_del = "UPDATE `contact` SET `CONTACT_OWNER_ID`='$organization_id' WHERE `CONTACT_OWNER_ID`='$org_id' and `CONTACT_TYPE_ID`='6'";
//    echo $sql_del;
        mysql_query($sql_del);

        $sql_del = "UPDATE `contact` SET `CONTACT_OWNER_ID`='$organization_id' WHERE `CONTACT_OWNER_ID`='$org_id' and `CONTACT_TYPE_ID`='7'";
//    echo $sql_del;
        mysql_query($sql_del);
        $sql_del = "UPDATE `contact` SET `CONTACT_OWNER_ID`='$organization_id' WHERE `CONTACT_OWNER_ID`='$org_id' and `CONTACT_TYPE_ID`='8'";
//    echo $sql_del;
        mysql_query($sql_del);
        $sql_del = "UPDATE `contact` SET `CONTACT_OWNER_ID`='$organization_id' WHERE `CONTACT_OWNER_ID`='$org_id' and `CONTACT_TYPE_ID`='8'";
//    echo $sql_del;
        mysql_query($sql_del);
        set_updatetime($data_id);
        return $organization_id;
    }
}

//function set_remark($id, $remark) {
//    $sql = "UPDATE `person` SET `REMARK_ID`='$remark' WHERE ID = $id";
//    mysql_query($sql);
//    set_updatetime($id);
//}
//BVH 16/11/2015
function get_all_person_detial() {
    $query = "SELECT * FROM person LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID ORDER BY PERSONNAME_NAME";
    return mysql_query($query);
}

function count_all_person_detial() {
    $query = "SELECT COUNT(*) FROM person";
    return mysql_query($query);
}

//BVH 17/11/2015
function search_between_data($start, $end, $type) {
    if ($type == 1) {
        $query = "SELECT REGISTER_OWNER_ID FROM register WHERE (REGISTER_NUMBER BETWEEN $start AND $end) AND REGISTER_THRU_DATE = ''";
    } else {
        $query = "SELECT PERSONNAME_OWNER_ID FROM personname WHERE PERSONNAME_NAME BETWEEN '$start' AND '$end'";
    }
//    echo $query;
    return $query;
}

function search_reg_between_data($start, $end, $type, $year) {
    if ($type == 1) {
        $query = "SELECT REGISTER_OWNER_ID FROM register WHERE (REGISTER_NUMBER BETWEEN $start AND $end) AND REGISTER_FROM_DATE LIKE '%$year%'";
    } else {
        $query = "SELECT register.REGISTER_OWNER_ID FROM register LEFT JOIN personname ON register.REGISTER_OWNER_ID = personname.PERSONNAME_OWNER_ID WHERE (personname.PERSONNAME_NAME BETWEEN '$start' AND '$end') AND register.REGISTER_FROM_DATE LIKE '%$year%'";
    }
//    echo $query;
    return $query;
}

//25/11/2015
function get_all_remark() {
    $query = "SELECT * FROM remark";
    return mysql_query($query);
}

//27/11/2015
function get_all_gen() {
    $query = "SELECT * FROM generation";
    return mysql_query($query);
}

function get_gen_by_type($type) {
    $query = "SELECT * FROM generation WHERE GENERATION_TYPE = $type";
    return mysql_query($query);
}

//function get_remark_detail($id) {
//    $query = "SELECT * FROM remark WHERE ID = $id";
////    echo $query;
//    return mysql_query($query);
//}
//
//function get_remark($id) {
//    $remark = '';
//    $sql = "SELECT `REMARK_ID` FROM `person` WHERE `ID` = $id";
//    $res = mysql_query($sql);
////    echo $sql;
//    while ($row = mysql_fetch_assoc($res)) {
////        print_r($row);
//        $remarks = get_remark_detail($row['REMARK_ID']);
//        $remark_array = mysql_fetch_assoc($remarks);
//        $remark = $remark_array['REMARK_NAME'];
////        echo $remark;
//    }
//    return $remark;
//}
//--------------J 24-11-58
function add_personalID($data_id, $personalID) {
    $sql = "UPDATE `person` SET `PersonalID`='$personalID' WHERE ID = $data_id";
    mysql_query($sql);
    set_updatetime($data_id);
}

function get_personalID($data_id) {
    $personalID = '';
    $sql = "SELECT `PERSONALID` FROM `person` WHERE `ID` = $data_id";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        $personalID = $row['PERSONALID'];
    }
    return $personalID;
}

function add_mother($data_id, $mother_id, $mother_status) {
    $time = date('Y-m-d H:i:s', time());
    $sql = "UPDATE `person` SET `STATUS`='$mother_status' WHERE `ID`='$mother_id'";
    mysql_query($sql);
    $sql = "UPDATE `person` SET `MOTHER_ID`='$mother_id' WHERE `ID`='$data_id'";
    echo $sql;
    mysql_query($sql);
    set_updatetime($data_id);
}

function search_data_chinaname_default() {
    $query = "SELECT PERSONNAME_OWNER_ID FROM personname LEFT JOIN person ON personname.PERSONNAME_OWNER_ID = person.ID WHERE person.CHINANAME_ID = 0";
    return $query;
}

function get_remark($id) {
    $mark = "-";
    $sql = "SELECT * FROM `person` WHERE `ID` = $id";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        $mark = $row['REMARK'];
    }
    return $mark;
}

function get_remark_all($id) {
    $remark = "";
    $checkaddr = FALSE;
    $sql = "SELECT * FROM `person` WHERE `ID` = $id";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        if ($row['REMARK'] != '') {
            $remark .= $row['REMARK'] . "</br>";
        }
        if ($row['CHINANAME_ID'] == 0) {
            $remark .= "ไม่มีชื่อจีน" . "</br>";
        }
        if ($row['PARENT_ID'] == 0 && $row['MOTHER_ID'] == 0) {
            $remark .="ไม่มีข้อมูลบิดา มารดา" . "</br>";
        }
        if ($row['STATUS'] == 0) {
            $remark .= "ไม่ระบุสถานะ" . "</br>";
        }
    }
    $sql = "SELECT * FROM `addresslist` WHERE `ADDRESSLIST_OWNER_ID`=$id AND `ADDRESSLIST_THRU_DATE` = ''";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        $checkaddr = TRUE;
    }
    $sql = "SELECT * FROM `contact` WHERE `CONTACT_OWNER_ID`=$id AND `CONTACT_THRU_DATE`=''";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        $checkaddr = TRUE;
    }
    if (!$checkaddr) {
        $remark .="ข้อมูลการติดต่อไม่สมบูรณ์" . "</br>";
    }

    return substr($remark, 0, strlen($remark) - 5);
}

function get_remark_list() {
    $remarklist = "";
    $query = "SELECT * FROM remark WHERE 1";
    $res = mysql_query($query);
    while ($row = mysql_fetch_assoc($res)) {
        $remarklist .= "<option value=" . $row['REMARK_NAME'] . ">" . $row['ID'] . "</option>";
    }
    return $remarklist;
}

function edit_remark($id, $mark) {
    $sql = "UPDATE `person` SET `REMARK`='$mark' WHERE `ID`=$id";
    mysql_query($sql);
    set_updatetime($id);
}

function get_num_follower() {
    $total = 0;
    $sql = "SELECT SUM(`REGISTER_FOLLOWER`) AS Total FROM register WHERE REGISTER_THRU_DATE =''";
    $res = mysql_query($sql);
    if (mysql_num_rows($res) != 0) {
        while ($row = mysql_fetch_assoc($res)) {
            $total = $row['Total'];
        }
    }
    return $total;
}

function create_run_number() {
    $runingnumber = 0;
    $sql = "SELECT `REGISTER_NUMBER` FROM `register` WHERE `REGISTER_THRU_DATE`='' Order by `REGISTER_NUMBER` DESC limit 1";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        $runingnumber = $row['REGISTER_NUMBER'];
    }
    return $runingnumber + 1;
}

//BVH 8/12/2015
function get_person_by_status($status) {
    $sql = "SELECT * FROM person WHERE STATUS = $status";
    return $sql;
}

function count_person_by_status($status) {
    $sql = "SELECT COUNT(*) FROM person WHERE STATUS = $status";
    return mysql_query($sql);
}

function get_person_by_gen_type($gen_type) {
    $sql = "SELECT * FROM person LEFT JOIN generation ON person.GENERATION_ID = generation.ID WHERE generation.GENERATION_TYPE = $gen_type";
    return $sql;
}

function count_person_by_gen_type($gen_type) {
    $sql = "SELECT COUNT(*) FROM person LEFT JOIN generation ON person.GENERATION_ID = generation.ID WHERE generation.GENERATION_TYPE = $gen_type";
    return mysql_query($sql);
}

function get_person_by_provice_id($provice) {
    $query = "SELECT addresslist.ADDRESSLIST_OWNER_ID FROM addresslist LEFT JOIN address ON addresslist.ADDRESSLIST_ADDRESS_ID = address.ID WHERE address.ADDRESS_PROVINCE_ID IN ($provice)";
    return $query;
}

function count_person_by_provice_id($provice) {
    $query = "SELECT COUNT(*) FROM addresslist LEFT JOIN address ON addresslist.ADDRESSLIST_ADDRESS_ID = address.ID WHERE address.ADDRESS_PROVINCE_ID = $provice";
    return mysql_query($query);
}

//10/12/2015
function add_child($data_id, $child_id, $status) {
    echo $status;
    $time = date('Y-m-d H:i:s', time());
    if ($status == 1) {
        $parent_str = 'PARENT_ID';
    } else if ($status == 2) {
        $parent_str = 'MOTHER_ID';
    }
    $sql = "UPDATE `person` SET `$parent_str`='$data_id' WHERE `ID`='$child_id'";
    echo $sql;
    mysql_query($sql);
    set_updatetime($child_id);
    set_updatetime($data_id);
}

function del_child($id, $parent_id) {

    $sql = "UPDATE `person` SET `$parent_id`='0' WHERE `ID`='$id'";
    mysql_query($sql);
}

//5-12-2015
function search_data($data, $type) {
//    $query = "";
    if ($type == 1) {
        $query = "SELECT PERSONNAME_OWNER_ID FROM personname WHERE (PERSONNAME_NAME LIKE '%$data%' OR PERSONNAME_SURNAME LIKE '%$data%') AND PERSONNAME_THRU_DATE = '' ORDER BY PERSONNAME_NAME ";
    } else if ($type == 2) {
//        echo strlen($data);
        if (strlen($data) == 3) {
            $query = "SELECT person.ID FROM person "
                    . "LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID "
                    . "LEFT JOIN generation ON person.GENERATION_ID = generation.ID  "
                    . "WHERE chinaname.CHINANAME_NAME LIKE '%$data%' OR chinaname.CHINANAME_PINYIN LIKE '%$data%' OR chinaname.CHINANAME_TH LIKE '%$data%' OR "
                    . "generation.GENERATION_NAME LIKE '%$data%' OR generation.GENERATION_PINYIN LIKE '%$data%' OR generation.GENERATION_TH LIKE '%$data%' ORDER BY  person.ID  ";
//            echo $query;
        } else if (strlen($data) == 6) {
            $gen = substr($data, 0, 3);
            $name = substr($data, 3, 6);
//            echo $gen;
//            echo "<br/>";
//            echo $name;
            $query = "SELECT person.ID FROM person "
                    . "LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID "
                    . "LEFT JOIN generation ON person.GENERATION_ID = generation.ID  "
                    . "WHERE (chinaname.CHINANAME_NAME LIKE '%$name%' OR chinaname.CHINANAME_PINYIN LIKE '%$name%' OR chinaname.CHINANAME_TH LIKE '%$name%') AND "
                    . "(generation.GENERATION_NAME LIKE '%$gen%' OR generation.GENERATION_PINYIN LIKE '%$gen%' OR generation.GENERATION_TH LIKE '%$gen%') ORDER BY PERSONNAME_NAME ";
        }
    } else if ($type == 3) {
        if (search_province_id($data) == 0) {
            $query = "SELECT * FROM province WHERE PROVINCE_ID = 0";
        } else {
            $provice = implode(",", search_province_id($data));
            $query = "SELECT addresslist.ADDRESSLIST_OWNER_ID FROM addresslist "
                    . "LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = addresslist.ADDRESSLIST_OWNER_ID "
                    . "LEFT JOIN address ON addresslist.ADDRESSLIST_ADDRESS_ID = address.ID "
                    . "WHERE address.ADDRESS_PROVINCE_ID IN ($provice) ORDER BY PERSONNAME_NAME ";
        }
    } else if ($type == 4) {
        if (strlen($data) == 10) {
            $arer_code = substr($data, 0, 3);
            $string = substr($data, 3, 7);
//            echo $arer_code;
//            echo $string;
            $query = "SELECT CONTACT_OWNER_ID FROM contact "
                    . "LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "WHERE CONTACT_ARER_CODE LIKE '%$arer_code%' AND CONTACT_STRING LIKE '%$string%' AND CONTACT_TYPE_ID IN (1,2) "
                    . "ORDER BY PERSONNAME_NAME ";
        } else if (strlen($data) == 9) {
            $check_code = substr($data, 0, 2);
            if ($check_code == "02") {
                $arer_code = substr($data, 0, 2);
                $string = substr($data, 3, 7);
            } else {
                $arer_code = substr($data, 0, 3);
                $string = substr($data, 3, 6);
            }
//            echo $arer_code;
//            echo "<br/>";
//            echo $string;
            $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "WHERE CONTACT_ARER_CODE LIKE '%$arer_code%' AND CONTACT_STRING LIKE '%$string%' AND CONTACT_TYPE_ID IN (1,2) ORDER BY PERSONNAME_NAME ";
        } else {
            if ($data[0] == 0 && strlen($data) < 4) {
                $field = "CONTACT_ARER_CODE";
            } else {
                $field = "CONTACT_STRING";
            }
//        echo $field;
            $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "WHERE $field LIKE '%$data%' AND CONTACT_TYPE_ID IN (1,2) ORDER BY PERSONNAME_NAME ";
        }
    } else if ($type == 5) {
        $query = "SELECT ID FROM person LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID "
                . "WHERE PERSONALID LIKE '%$data%' ORDER BY PERSONNAME_NAME ";
    } else if ($type == 6) {
        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                . "WHERE CONTACT_STRING LIKE '%$data%' AND CONTACT_TYPE_ID = 4 ORDER BY PERSONNAME_NAME ";
    } else if ($type == 7) {
        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                . "WHERE CONTACT_STRING LIKE '%$data%' AND CONTACT_TYPE_ID = 5 ORDER BY PERSONNAME_NAME ";
    }
//    echo $query;
    return $query;
//    $query .= "LIMIT $start, $end";
//    echo $query;
//    return mysql_query($query);
}

function search_data_chinaname($data, $type) {
    if ($type == 1) {
        $query = "SELECT PERSONNAME_OWNER_ID FROM personname LEFT JOIN person ON personname.PERSONNAME_OWNER_ID = person.ID "
                . "WHERE (PERSONNAME_NAME LIKE '%$data%' OR PERSONNAME_SURNAME LIKE '%$data%') AND person.CHINANAME_ID = 0 ORDER BY PERSONNAME_NAME ";
    } else if ($type == 2) {
        $query = "SELECT person.ID FROM person LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID WHERE chinaname.CHINANAME_NAME LIKE '%$data%' OR chinaname.CHINANAME_PINYIN LIKE '%$data%' OR chinaname.CHINANAME_TH LIKE '%$data%'";
    } else if ($type == 3) {
        if (search_province_id($data) == 0) {
            $query = "SELECT * FROM province WHERE PROVINCE_ID = 0";
        } else {
            $provice = implode(",", search_province_id($data));
            $query = "SELECT addresslist.ADDRESSLIST_OWNER_ID FROM addresslist LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = addresslist.ADDRESSLIST_OWNER_ID "
                    . "LEFT JOIN address ON addresslist.ADDRESSLIST_ADDRESS_ID = address.ID RIGHT JOIN person ON addresslist.ADDRESSLIST_OWNER_ID = person.ID "
                    . "WHERE address.ADDRESS_PROVINCE_ID IN ($provice) AND person.CHINANAME_ID = 0 ORDER BY PERSONNAME_NAME ";
        }
    } else if ($type == 4) {
        if (strlen($data) == 10) {
            $arer_code = substr($data, 0, 3);
            $string = substr($data, 3, 7);
//            echo $arer_code;
//            echo $string;
            $query = "SELECT CONTACT_OWNER_ID FROM contact "
                    . "LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID "
                    . "WHERE CONTACT_ARER_CODE LIKE '%$arer_code%' AND CONTACT_STRING LIKE '%$string%' AND CONTACT_TYPE_ID IN (1,2) AND person.CHINANAME_ID = 0 ORDER BY PERSONNAME_NAME ";
        } else if (strlen($data) == 9) {
            $check_code = substr($data, 0, 2);
            if ($check_code == "02") {
                $arer_code = substr($data, 0, 2);
                $string = substr($data, 3, 7);
            } else {
                $arer_code = substr($data, 0, 3);
                $string = substr($data, 3, 6);
            }
//            echo $arer_code;
//            echo "<br/>";
//            echo $string;
            $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID"
                    . "LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID "
                    . "WHERE CONTACT_ARER_CODE LIKE '%$arer_code%' AND CONTACT_STRING LIKE '%$string%' AND CONTACT_TYPE_ID IN (1,2) AND person.CHINANAME_ID = 0"
                    . " ORDER BY PERSONNAME_NAME ";
        } else {
            if ($data[0] == 0 && strlen($data) < 4) {
                $field = "CONTACT_ARER_CODE";
            } else {
                $field = "CONTACT_STRING";
            }
//        echo $field;
            $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID  "
                    . "WHERE $field LIKE '%$data%' AND CONTACT_TYPE_ID IN (1,2) AND person.CHINANAME_ID = 0"
                    . " ORDER BY PERSONNAME_NAME ";
        }
//            $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID WHERE $field LIKE '%$data%' AND CONTACT_TYPE_ID IN (1,2) AND person.CHINANAME_ID = 0";
//        }
    } else if ($type == 5) {
        $query = "SELECT ID FROM person LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID "
                . "WHERE PERSONALID LIKE '%$data%' AND CHINANAME_ID = 0 ORDER BY PERSONNAME_NAME ";
    } else if ($type == 6) {
        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                . "LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID "
                . "WHERE contact.CONTACT_STRING LIKE '%$data%' AND contact.CONTACT_TYPE_ID = 4 AND person.CHINANAME_ID = 0 ORDER BY PERSONNAME_NAME ";
    } else if ($type == 7) {
        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                . "LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID "
                . "WHERE contact.CONTACT_STRING LIKE '%$data%' AND contact.CONTACT_TYPE_ID = 5 AND person.CHINANAME_ID = 0 ORDER BY PERSONNAME_NAME ";
    }
//    echo $query;
    return $query;
//    $query .= "LIMIT $start, $end";
//    echo $query;
//    return mysql_query($query);
}

function search_data_parent($data, $type, $id) {
    if ($type == 1) {
        $query = "SELECT PERSONNAME_OWNER_ID FROM personname "
                . "LEFT JOIN person ON personname.PERSONNAME_OWNER_ID = person.ID "
                . "WHERE (PERSONNAME_NAME LIKE '%$data%' OR PERSONNAME_SURNAME LIKE '%$data%') AND person.ID != $id ORDER BY PERSONNAME_NAME ";
    } else if ($type == 2) {
        if (strlen($data) == 3) {
            $query = "SELECT person.ID FROM person LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID "
                    . "LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID "
                    . "LEFT JOIN generation ON person.GENERATION_ID = generation.ID  "
                    . "WHERE chinaname.CHINANAME_NAME LIKE '%$data%' OR chinaname.CHINANAME_PINYIN LIKE '%$data%' OR chinaname.CHINANAME_TH LIKE '%$data%' OR "
                    . "generation.GENERATION_NAME LIKE '%$data%' OR generation.GENERATION_PINYIN LIKE '%$data%' OR generation.GENERATION_TH LIKE '%$data%' AND person.ID != $id ORDER BY PERSONNAME_NAME ";
//            echo $query;
        } else if (strlen($data) == 6) {
            $gen = substr($data, 0, 3);
            $name = substr($data, 3, 6);
//            echo $gen;
//            echo "<br/>";
//            echo $name;
            $query = "SELECT person.ID FROM person "
                    . "LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID "
                    . "LEFT JOIN generation ON person.GENERATION_ID = generation.ID  "
                    . "WHERE (chinaname.CHINANAME_NAME LIKE '%$name%' OR chinaname.CHINANAME_PINYIN LIKE '%$name%' OR chinaname.CHINANAME_TH LIKE '%$name%') AND "
                    . "(generation.GENERATION_NAME LIKE '%$gen%' OR generation.GENERATION_PINYIN LIKE '%$gen%' OR generation.GENERATION_TH LIKE '%$gen%') AND person.ID != $id ORDER BY PERSONNAME_NAME ";
        }
//        $query = "SELECT person.ID FROM person LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID WHERE chinaname.CHINANAME_NAME LIKE '%$data%' OR chinaname.CHINANAME_PINYIN LIKE '%$data%' OR chinaname.CHINANAME_TH LIKE '%$data%'";
    } else if ($type == 3) {
        if (search_province_id($data) == 0) {
            $query = "SELECT * FROM province WHERE PROVINCE_ID = 0";
        } else {
            $provice = implode(",", search_province_id($data));
            $query = "SELECT addresslist.ADDRESSLIST_OWNER_ID FROM addresslist "
                    . "LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = addresslist.ADDRESSLIST_OWNER_ID "
                    . "LEFT JOIN address ON addresslist.ADDRESSLIST_ADDRESS_ID = address.ID "
                    . "RIGHT JOIN person ON addresslist.ADDRESSLIST_OWNER_ID = person.ID "
                    . "WHERE address.ADDRESS_PROVINCE_ID IN ($provice) AND person.ID != $id ORDER BY PERSONNAME_NAME ";
        }
    } else if ($type == 4) {
        if (strlen($data) == 10) {
            $arer_code = substr($data, 0, 3);
            $string = substr($data, 3, 7);
//            echo $arer_code;
//            echo $string;
            $query = "SELECT CONTACT_OWNER_ID FROM contact "
                    . "LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID "
                    . "WHERE CONTACT_ARER_CODE LIKE '%$arer_code%' AND CONTACT_STRING LIKE '%$string%' AND CONTACT_TYPE_ID IN (1,2) AND person.ID != $id ORDER BY PERSONNAME_NAME ";
        } else if (strlen($data) == 9) {
            $check_code = substr($data, 0, 2);
            if ($check_code == "02") {
                $arer_code = substr($data, 0, 2);
                $string = substr($data, 3, 7);
            } else {
                $arer_code = substr($data, 0, 3);
                $string = substr($data, 3, 6);
            }
//            echo $arer_code;
//            echo "<br/>";
//            echo $string;
            $query = "SELECT CONTACT_OWNER_ID FROM contact "
                    . "LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID "
                    . "WHERE CONTACT_ARER_CODE LIKE '%$arer_code%' AND CONTACT_STRING LIKE '%$string%' AND CONTACT_TYPE_ID IN (1,2) AND person.ID != $id ORDER BY PERSONNAME_NAME ";
        } else {
            if ($data[0] == 0 && strlen($data) < 4) {
                $field = "CONTACT_ARER_CODE";
            } else {
                $field = "CONTACT_STRING";
            }
//        echo $field;
            $query = "SELECT CONTACT_OWNER_ID FROM contact "
                    . "LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID "
                    . "WHERE $field LIKE '%$data%' AND CONTACT_TYPE_ID IN (1,2) AND person.ID != $id ORDER BY PERSONNAME_NAME ";
        }
//        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID WHERE $field LIKE '%$data%' AND CONTACT_TYPE_ID IN (1,2) AND person.ID != $id";
    } else if ($type == 5) {
        $query = "SELECT ID FROM person LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID "
                . "WHERE PERSONALID LIKE '%$data%' AND ID != $id ORDER BY PERSONNAME_NAME ";
    } else if ($type == 6) {
        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                . "LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID "
                . "WHERE contact.CONTACT_STRING LIKE '%$data%' AND contact.CONTACT_TYPE_ID = 4 AND person.ID != $id ORDER BY PERSONNAME_NAME ";
    } else if ($type == 7) {
        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                . "LEFT JOIN person ON contact.CONTACT_OWNER_ID = person.ID "
                . "WHERE contact.CONTACT_STRING LIKE '%$data%' AND contact.CONTACT_TYPE_ID = 5 AND person.ID != $id ORDER BY PERSONNAME_NAME ";
    }
//    echo $query;
    return $query;
//    $query .= "LIMIT $start, $end";
//    echo $query;
//    return mysql_query($query);
}

function search_ancestorsaddr($data, $type) {
    if ($type == 1) {
        $query = "SELECT PERSONNAME_OWNER_ID FROM personname LEFT JOIN person ON personname.PERSONNAME_OWNER_ID = person.ID WHERE (PERSONNAME_NAME LIKE '%$data%' OR PERSONNAME_SURNAME LIKE '%$data%') ORDER BY PERSONNAME_NAME";
    } else if ($type == 2) {
        if (strlen($data) == 3) {
            $query = "SELECT person.ID FROM person LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID "
                    . "LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID "
                    . "LEFT JOIN generation ON person.GENERATION_ID = generation.ID  "
                    . "WHERE chinaname.CHINANAME_NAME LIKE '%$data%' OR chinaname.CHINANAME_PINYIN LIKE '%$data%' OR chinaname.CHINANAME_TH LIKE '%$data%' OR "
                    . "generation.GENERATION_NAME LIKE '%$data%' OR generation.GENERATION_PINYIN LIKE '%$data%' OR generation.GENERATION_TH LIKE '%$data%' ORDER BY PERSONNAME_NAME ";
//            echo $query;
        } else if (strlen($data) == 6) {
            $gen = substr($data, 0, 3);
            $name = substr($data, 3, 6);
//            echo $gen;
//            echo "<br/>";
//            echo $name;
            $query = "SELECT person.ID FROM person "
                    . "LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID "
                    . "LEFT JOIN generation ON person.GENERATION_ID = generation.ID  "
                    . "WHERE (chinaname.CHINANAME_NAME LIKE '%$name%' OR chinaname.CHINANAME_PINYIN LIKE '%$name%' OR chinaname.CHINANAME_TH LIKE '%$name%') AND "
                    . "(generation.GENERATION_NAME LIKE '%$gen%' OR generation.GENERATION_PINYIN LIKE '%$gen%' OR generation.GENERATION_TH LIKE '%$gen%') ORDER BY PERSONNAME_NAME ";
        }
//        $query = "SELECT person.ID FROM person LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID LEFT JOIN chinaname ON person.CHINANAME_ID = chinaname.ID WHERE (chinaname.CHINANAME_NAME LIKE '%$data%' OR chinaname.CHINANAME_PINYIN LIKE '%$data%' OR chinaname.CHINANAME_TH LIKE '%$data%') ";
    } else if ($type == 3) {
        if (search_province_id($data) == 0) {
            $query = "SELECT * FROM province WHERE PROVINCE_ID = 0";
        } else {
            $provice = implode(",", search_province_id($data));
            $query = "SELECT addresslist.ADDRESSLIST_OWNER_ID FROM addresslist "
                    . "LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = addresslist.ADDRESSLIST_OWNER_ID "
                    . "LEFT JOIN address ON addresslist.ADDRESSLIST_ADDRESS_ID = address.ID "
                    . "WHERE address.ADDRESS_PROVINCE_ID IN ($provice) ORDER BY PERSONNAME_NAME ";
        }
    } else if ($type == 4) {
        if (strlen($data) == 10) {
            $arer_code = substr($data, 0, 3);
            $string = substr($data, 3, 7);
//            echo $arer_code;
//            echo $string;
            $query = "SELECT CONTACT_OWNER_ID FROM contact "
                    . "LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "WHERE CONTACT_ARER_CODE LIKE '%$arer_code%' AND CONTACT_STRING LIKE '%$string%' AND CONTACT_TYPE_ID IN (1,2) "
                    . "ORDER BY PERSONNAME_NAME ";
        } else if (strlen($data) == 9) {
            $check_code = substr($data, 0, 2);
            if ($check_code == "02") {
                $arer_code = substr($data, 0, 2);
                $string = substr($data, 3, 7);
            } else {
                $arer_code = substr($data, 0, 3);
                $string = substr($data, 3, 6);
            }
//            echo $arer_code;
//            echo "<br/>";
//            echo $string;
            $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "WHERE CONTACT_ARER_CODE LIKE '%$arer_code%' AND CONTACT_STRING LIKE '%$string%' AND CONTACT_TYPE_ID IN (1,2) ORDER BY PERSONNAME_NAME ";
        } else {
            if ($data[0] == 0 && strlen($data) < 4) {
                $field = "CONTACT_ARER_CODE";
            } else {
                $field = "CONTACT_STRING";
            }
//        echo $field;
            $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                    . "WHERE $field LIKE '%$data%' AND CONTACT_TYPE_ID IN (1,2) ORDER BY PERSONNAME_NAME ";
        }
    } else if ($type == 5) {
        $query = "SELECT ID FROM person LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID "
                . "WHERE PERSONALID LIKE '%$data%' ORDER BY PERSONNAME_NAME ";
    } else if ($type == 6) {
        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                . "WHERE CONTACT_STRING LIKE '%$data%' AND CONTACT_TYPE_ID = 4 ORDER BY PERSONNAME_NAME ";
    } else if ($type == 7) {
        $query = "SELECT CONTACT_OWNER_ID FROM contact LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = contact.CONTACT_OWNER_ID "
                . "WHERE CONTACT_STRING LIKE '%$data%' AND CONTACT_TYPE_ID = 5 ORDER BY PERSONNAME_NAME ";
    }
//    echo $query;
    return $query;
//    $query .= "LIMIT $start, $end";
//    echo $query;
//    return mysql_query($query);
}

function DateThai($strDate) {
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

function get_status($id) {
    $query = "SELECT * FROM person WHERE ID=$id";
    $res = mysql_query($query);
    while ($row = mysql_fetch_assoc($res)) {
        return $row['STATUS'];
    }
    return "";
}

function set_status($id, $status) {
    $time = date('Y-m-d H:i:s', time());
    $sql = "UPDATE `person` SET `STATUS`='$status' WHERE `ID`='$id'";
    mysql_query($sql);
    set_updatetime($id);
}

function get_favorite_name($gen_id) {
    return mysql_query("SELECT * FROM `favorite` WHERE `FAVORITE_GEN_ID`=$gen_id");
}

function get_favorite_id($id) {
    return mysql_query("SELECT * FROM `favorite` WHERE `ID`=$id");
}

function add_favorite_name($gen_id, $name, $pinyin, $th) {
    $res = mysql_query("SELECT * FROM `favorite` WHERE `FAVORITE_GEN_ID`=$gen_id AND `FAVORITE_NAME`='$name'");
    while ($row = mysql_fetch_assoc($res)) {
        return "";
    }
    $sql = "INSERT INTO `favorite`( `FAVORITE_GEN_ID`, `FAVORITE_NAME`, `FAVORITE_PINYIN`, `FAVORITE_TH`) VALUES ( '$gen_id', '$name', '$pinyin', '$th')";
    mysql_query($sql);
}

//BVH 3/1/2016
function count_person_by_provice_sector_id($provice) {
    $query = "SELECT COUNT(*) FROM addresslist "
            . "LEFT JOIN address ON addresslist.ADDRESSLIST_ADDRESS_ID = address.ID "
            . "LEFT JOIN province ON address.ADDRESS_PROVINCE_ID = province.PROVINCE_ID "
            . "WHERE province.PROVINCE_SECTOR_ID = $provice";
//    echo $query;
    return mysql_query($query);
}

function get_province_id_by_province_sector_id($sector_id){
    $query = "SELECT * FROM province WHERE PROVINCE_SECTOR_ID = $sector_id Order by `PROVINCE_NAME` ASC";
    return mysql_query($query);
}

function get_person($name, $surname) {
    $time = date('Y-m-d H:i:s', time());
    $sql_person = "SELECT `PERSONNAME_OWNER_ID` FROM `personname` WHERE `PERSONNAME_NAME`='$name' and `PERSONNAME_SURNAME`='$surname'";
    $res = mysql_query($sql_person);
    $result_name = mysql_fetch_assoc($res);

    if (!$result_name) {
        $data_id = -1;
    } else {
        $res = mysql_query($sql_person);
        while ($row = mysql_fetch_assoc($res)) {
            $data_id = $row['PERSONNAME_OWNER_ID'];
        }
    }

    return $data_id;
}

function get_gender($id) {
    $sql = "SELECT GENDER_ID FROM person WHERE ID = $id";
    $res = mysql_query($sql);
    $result = mysql_fetch_assoc($res);
    return $result['GENDER_ID'];
}

function count_province_by_province_sector_id($sector_id){
    $query = "SELECT COUNT(*) FROM province WHERE PROVINCE_SECTOR_ID = $sector_id ";
    return mysql_query($query);
}

function get_amphur_id_by_province_id($provice_id){
    $query = "SELECT * FROM amphur WHERE PROVINCE_ID = $provice_id Order by `AMPHUR_NAME` ASC";
//    echo $query;
    return mysql_query($query);
}
function get_district_id_by_province_id($amphur_id){
    $query = "SELECT * FROM district WHERE AMPHUR_ID = $amphur_id Order by `DISTRICT_NAME` ASC";
//    echo $query;
    return mysql_query($query);
}


?>
