
<?php

function get_person_china_full_name($id, $type) {
    $chinaGenDatas = get_person_china_generation_name($id);
    $chinaGenData = mysql_fetch_assoc($chinaGenDatas);
    $chinaNameDatas = get_person_china_name($id);
    $chinaNameData = mysql_fetch_assoc($chinaNameDatas);
    $gender = get_gender($id);
    if ($type == 0 && $gender == 2) {
        return "林(" . $chinaGenData['GENERATION_NAME'] .")". $chinaNameData['CHINANAME_NAME'];
    } else if ($type == 1 && $gender == 2) {
        return "lin (" . $chinaGenData['GENERATION_PINYIN'] . ") " . $chinaNameData['CHINANAME_PINYIN'];
    } else if ($type == 2 && $gender == 2) {
        return "ลื้ม (" . $chinaGenData['GENERATION_TH'] . ") " . $chinaNameData['CHINANAME_TH'];
    }else if ($type == 0) {
        return "林" . $chinaGenData['GENERATION_NAME'] . $chinaNameData['CHINANAME_NAME'];
    } else if ($type == 1) {
        return "lin " . $chinaGenData['GENERATION_PINYIN'] . " " . $chinaNameData['CHINANAME_PINYIN'];
    } else if ($type == 2) {
        return "ลื้ม " . $chinaGenData['GENERATION_TH'] . " " . $chinaNameData['CHINANAME_TH'];
    }
}

function get_person_province_string($id, $type) {
    $addressDatas = get_person_all_address($id, $type);
    $addressData = mysql_fetch_assoc($addressDatas);
//    print_r($addressData);
    if ($addressData) {
        $showAddrs = get_address_data($addressData['ADDRESSLIST_ADDRESS_ID']);
        $showAddr = mysql_fetch_assoc($showAddrs);

        return get_province_string($showAddr['ADDRESS_PROVINCE_ID']);
    } else {
        return "-";
    }
}

function print_person_phone_string($id) {
    $hadData = false;
    $newline = false;
    $telmoreone = false;
    $mobilemoreone = false;
    $homeDatas = get_person_contact($id, 1);
    while ($homeData = mysql_fetch_assoc($homeDatas)) {
        $newline = true;
        $hadData = true;
        if ($telmoreone) {
            echo ",";
        }
        echo $homeData['CONTACT_ARER_CODE'] . $homeData['CONTACT_STRING'];
        $telmoreone = true;
    }
    if ($newline)
        echo "<br/>";
    $phoneDatas = get_person_contact($id, 2);
    while ($phoneData = mysql_fetch_assoc($phoneDatas)) {
        $hadData = true;
        if ($mobilemoreone) {
            echo ",";
        }
        echo $phoneData['CONTACT_ARER_CODE'] . $phoneData['CONTACT_STRING'];
        $mobilemoreone = true;
    }
    if (!$hadData)
        echo "-";
}

function give_china_data() {
    return array("CHINA_STR" => '', "CHINA_PINYIN" => '', "CHINA_TH" => '');
}

function give_addr() {
    return array("ADDRESS_NUM" => '', "ADDRESS_VILLAGE" => '', "ADDRESS_ALLEY" => '',
        "ADDRESS_MOO" => '', "ADDRESS_ROAD" => '', "ADDRESS_DISTRICT_ID" => 0,
        "ADDRESS_AMPHUR_ID" => 0, "ADDRESS_PROVINCE_ID" => 0, "ADDRESS_ZIPCODE" => '');
}

function cal_age($date) {
    $data = explode('-', $date);
    $today = getdate();
    if($data[0] != 0){
    return $today['year'] - $data[0];
    }else{
        return "";
    }
}

function give_tel() {
    return array("CONTACT_ARER_CODE" => '', "CONTACT_STRING" => '', "CONTACT_COMMENT" => '');
}

function get_addr_string($addr) {
    $addr_string = $addr['ADDRESS_NUM'];

    if ($addr['ADDRESS_MOO'] != '')
        $addr_string .= ' หมู่' . $addr['ADDRESS_MOO'];

    if ($addr['ADDRESS_VILLAGE'] != '')
        $addr_string .= ' ' . $addr['ADDRESS_VILLAGE'];

    if ($addr['ADDRESS_ALLEY'] != '')
        $addr_string .= ' ซ.' . $addr['ADDRESS_ALLEY'];

    if ($addr['ADDRESS_ROAD'] != '')
        $addr_string .= ' ถ.' . $addr['ADDRESS_ROAD'];

    $addr_string .= get_district_string($addr['ADDRESS_DISTRICT_ID']) . ' ' . get_amphur_string($addr['ADDRESS_AMPHUR_ID']) . ' ' . get_province_string($addr['ADDRESS_PROVINCE_ID']) . ' ' . $addr['ADDRESS_ZIPCODE'];

    return $addr_string;
}

function check_gen_id($person, $index) {
    if ($person['PARENT_ID'] == 0 && $person['BROTHER_LIST'] == '') {
        return 0;
    } else {
        if ($person['PARENT_ID'] != 0) {
            $parent_id = $person['PARENT_ID'];
            $parents = get_person_detial($parent_id);
            $parent = mysql_fetch_assoc($parents);
            if ($parent['GENERATION_ID'] == 0) {
                $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $person['ID']);
                while ($brother = mysql_fetch_assoc($brothers)) {
                    if ($brother['GENERATION_ID'] != 0) {
                        $gen_id = $brother['GENERATION_ID'];
                        return $gen_id + $index;
                    }
                }
                if ($parent['PARENT_ID'] == 0 && $parent['BROTHER_LIST'] == '') {
                    return 0;
                } else {
                    return 1;
                }
            } else {
                $gen_id = $parent['GENERATION_ID'] + 1;
                return $gen_id + $index;
            }
        } else {
            $has_parent = false;
            $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $person['ID']);
            while ($brother = mysql_fetch_assoc($brothers)) {
                if ($brother['PARENT_ID'] != 0) {
                    $has_parent = true;
                    add_parent_id($person['ID'], $brother['PARENT_ID']);
                }
                if ($brother['GENERATION_ID'] != 0) {
                    $gen_id = $brother['GENERATION_ID'];
                    return $gen_id + $index;
                }
            }
            if ($has_parent) {
                return 1;
            } else {
                return 0;
            }
        }
    }
}

//3/5/58 BVH
function get_full_chinahouse_string($chinahouse_id, $type) {
    $chinahouses = get_chinahouse_data($chinahouse_id);
    $chinahouse = mysql_fetch_assoc($chinahouses);
    $chinahouse_villages = get_china($chinahouse['CHINAHOUSE_VILLAGE_ID']);
    $chinahouse_village = mysql_fetch_assoc($chinahouse_villages);

    $chinahouse_districts = get_china($chinahouse['CHINAHOUSE_DISTRICT_ID']);
    $chinahouse_district = mysql_fetch_assoc($chinahouse_districts);

    $chinahouse_amphurs = get_china($chinahouse['CHINAHOUSE_AMPHUR_ID']);
    $chinahouse_amphur = mysql_fetch_assoc($chinahouse_amphurs);

    $chinahouse_provinces = get_china($chinahouse['CHINAHOUSE_PROVINCE_ID']);
    $chinahouse_province = mysql_fetch_assoc($chinahouse_provinces);
    $result_string = '';
    if ($type == 'china') {
        if ($chinahouse_village['CHINA_STR'] == '') {
            $result_string .= '-';
        } else {
            $result_string .= $chinahouse_village['CHINA_STR'];
        }
        $result_string .= '村, ';
        if ($chinahouse_district['CHINA_STR'] == '') {
            $result_string .= '-';
        } else {
            $result_string .= $chinahouse_district['CHINA_STR'];
        }
        $result_string .= '區, ';
        if ($chinahouse_amphur['CHINA_STR'] == '') {
            $result_string .= '-';
        } else {
            $result_string .= $chinahouse_amphur['CHINA_STR'];
        }
        $result_string .= '镇, ';
        if ($chinahouse_province['CHINA_STR'] == '') {
            $result_string .= '-';
        } else {
            $result_string .= $chinahouse_province['CHINA_STR'];
        }
        $result_string .= '省';
    } else {

        $result_string .= 'หมู่บ้าน ';
        if ($chinahouse_village['CHINA_TH'] == '') {
            $result_string .= '-';
        } else {
            $result_string .= $chinahouse_village['CHINA_TH'];
        }

        $result_string .= ' ตำบล ';
        if ($chinahouse_district['CHINA_TH'] == '') {
            $result_string .= '-';
        } else {
            $result_string .= $chinahouse_district['CHINA_TH'];
        }

        $result_string .= ' อำเภอ  ';
        if ($chinahouse_amphur['CHINA_TH'] == '') {
            $result_string .= '-';
        } else {
            $result_string .= $chinahouse_amphur['CHINA_TH'];
        }

        $result_string .= ' มลฑล/จังหวัด  ';
        if ($chinahouse_province['CHINA_TH'] == '') {
            $result_string .= '-';
        } else {
            $result_string .= $chinahouse_province['CHINA_TH'];
        }
    }
    return $result_string;
}

function check_chinahouse($person) {
    if($person['CHINAHOUSE_ID'] != 0){
        return $person['CHINAHOUSE_ID'];
    }else if ($person['PARENT_ID'] == 0 && $person['BROTHER_LIST'] == '') {
        return 0;
    } else {
        if ($person['PARENT_ID'] != 0) {
            $parent_id = $person['PARENT_ID'];
            $parents = get_person_detial($parent_id);
            $parent = mysql_fetch_assoc($parents);
            if ($parent['CHINAHOUSE_ID'] == 0) {
                $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $person['ID']);
                while ($brother = mysql_fetch_assoc($brothers)) {
                    if ($brother['CHINAHOUSE_ID'] != 0) {

                        return $brother['CHINAHOUSE_ID'];
                    }
                }
                if ($parent['PARENT_ID'] == 0 && $parent['BROTHER_LIST'] == '') {
                    return 0;
                } else {
                    return 1;
                }
            } else {
                return $parent['CHINAHOUSE_ID'];
            }
        } else {
            $has_parent = false;
            $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $person['ID']);
            while ($brother = mysql_fetch_assoc($brothers)) {
                if ($brother['PARENT_ID'] != 0) {
                    $has_parent = true;
                    add_parent_id($person['ID'], $brother['PARENT_ID']);
                }
                if ($brother['CHINAHOUSE_ID'] != 0) {
                    return $brother['CHINAHOUSE_ID'];
                }
            }
            if ($has_parent) {
                return 1;
            } else {
                return 0;
            }
        }
    }
}

//---------J 3/7/58----------------------------------------//
function print_person_remark($id) {
    $remark = get_remark_all($id);
    if ($remark) {
        if (strlen($remark) > 24) {
            echo '<div class="tooltip" >' . substr($remark, 0, 24) . '...<span class="classic">' . $remark . '</span></div>';
        } else {
            echo $remark;
        }
    } else {
        echo "-";
    }
}

function print_menu($page_select) {
    $manage_person = "";
    $print = "";
    $creatname = "";
    $ancestoraddr = "";
    $register_day = "";
    $exportexcel = "";
    $family_tree = "";
    $export_sql = "";
    $setting = "";
    if ($page_select == 1)
        $manage_person = 'class="active"';
    else if ($page_select == 2)
        $print = 'class="active"';
    else if ($page_select == 3)
        $creatname = 'class="active"';
    else if ($page_select == 4)
        $ancestoraddr = 'class="active"';
    else if ($page_select == 5)
        $register_day = 'class="active"';
    else if ($page_select == 6)
        $exportexcel = 'class="active"';
    else if ($page_select == 7)
        $family_tree = 'class="active"';
    else if ($page_select == 8)
        $export_sql = 'class="active"';
    else if ($page_select == 9)
        $setting = 'class="active"';
//    $menu = '<li ><h4><a href="../index.php" class="mdi-action-home" style="color:white"> จำนวนสมาชิกและสถิติ</a></h4></li>';
//    $menu .= '<li ' . $manage_person .  '><h4><a href="manage_person_table.php" class="mdi-file-cloud" style="color:white"> ทะเบียนฐานข้อมูลสมาชิก</a></h4></li>';
//    $menu .= '<li ' . $exportexcel .    '><h4><a href="export_excel.php" class="mdi-action-flip-to-front" style="color:white"> Export Excel</a></h4></li>';
//    $menu .= '<li ' . $print .          '><h4><a href="print.php" class="mdi-action-find-in-page" style="color:white"> พิมพ์ข้อมูล</a></h4></li>';
//    $menu .= '<li ' . $creatname .      '><h4><a href="createname.php" class="mdi-action-translate" style="color:white"> สร้างชื่อจีน</a></h4></li>';
//    $menu .= '<li ' . $ancestoraddr .   '><h4><a href="ancestorsaddr.php" class="mdi-maps-navigation" style="color:white"> ค้นหาที่อยู่บรรพบุรุษที่ประเทศจีน</a></h4></li>';
//    $menu .= '<li ' . $register_day .   '><h4><a href="register_day.php" class="mdi-action-assessment" style="color:white"> ดูข้อมูลคนมาร่วมงานประจำปี</a></h4></li>';
//    $menu .= '<li ' . $family_tree .    '><h4><a href = "serach_family_tree.php" class="mdi-social-people" style="color:white"> Family Tree</a></h4></li>';
//    $menu .= '<li ' . $export_sql .     '><h4><a href="export_sql.php" class="mdi-action-backup" style="color:white"> สำรองฐานข้อมูล </a></h4></li>'
//            . '<li>&nbsp;</li>';


    $menu = '    <ul id="sidebar" class=" col-xs-3 nav nav-pills nav-stacked" style="max-width: 400px;">
            <li><a href="../index.php"style="color: white"><span class="glyphicon glyphicon-stats" style="font-size:130%;">   จำนวนสมาชิกและสถิติ</a></span></li>
                        <ul>
                <li><h4><a href="../index.php?tab=stat" style="color: white"> สถิติ</a></h4></li>
                <li><h4><a href="../index.php?tab=provice"" style="color: white" >สมาชิกที่อยู่แต่ละจังหวัด</a></h4></li>
                <li><h4><a href="../index.php?tab=gen" style="color: white" >จำนวนแต่ละลำดับรุ่น</a></h4></li> 
            </ul>
            <li ' . $manage_person . '><a href="manage_person_table.php" style="color: white"><span class="glyphicon glyphicon-user" style="font-size:130%;"> ทะเบียนฐานข้อมูลสมาชิก</a></span>  </li>
            <li ' . $exportexcel . '><a href="export_excel.php" style="color: white"><span class="glyphicon glyphicon-export" style="font-size:130%;"> Export Excel</a></span> </li>
            <li ' . $print . '><a href="print.php" style="color: white"><span class="glyphicon glyphicon-print" style="font-size:130%;"> พิมพ์ข้อมูล</a></span></li>
            <li ' . $creatname . '><a href="createname.php" style="color: white"><span class="glyphicon glyphicon-pencil" style="font-size:130%;">  สร้างชื่อจีน</a></span></li>
            <li ' . $ancestoraddr . '><a href="ancestorsaddr.php" style="color: white"><span class="glyphicon glyphicon-home" style="font-size:130%;">   ค้นหาที่อยู่บรรพบุรุษที่ประเทศจีน</a></span></li>
            <li ' . $register_day . '><a href="register_day.php" style="color: white"><span class="glyphicon glyphicon-comment" style="font-size:130%;">   ข้อมูลผู้มาร่วมงานประจำปี</a></span></li>
            <li ' . $family_tree . '><a href="serach_family_tree.php" style="color: white"><span class="glyphicon glyphicon-earphone" style="font-size:130%;">   Family Tree</a></span></li>
            <li ' . $export_sql . '><a href="export_sql.php"><span class="glyphicon glyphicon-inbox" style="font-size:130%;">  สำรองฐานข้อมูล</a></span> </li>
            <li ' . $setting . '><a href="setting.php"><span class="glyphicon glyphicon-cog"  style="font-size:130%;"> จัดการระบบ</a></span> </li>
        </ul>';
    echo $menu;
}

function display_birthday($bday) {
    if ($bday != '') {
        $data = explode('-', $bday);
        return $data[2] . "/" . $data[1] . "/" . $data[0];
    } else {
        return '';
    }
}

function display_gen() {
    
}

?>