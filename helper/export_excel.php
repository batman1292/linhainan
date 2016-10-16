<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ERROR | E_PARSE);
ob_start();
include '/db_connect.php';
connect_database();
set_time_limit(0);
mysql_query("set character_set_client='utf8'");
mysql_query("set character_set_results='utf8'");





$data = array();

$strSQL = "SELECT * FROM `person` 
LEFT JOIN title ON title.ID = person.TITLE_ID
LEFT JOIN gender ON gender.ID = person.GENDER_ID
LEFT JOIN generation ON generation.ID = person.GENERATION_ID
LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID
LEFT JOIN chinaname ON chinaname.ID = person.CHINANAME_ID
WHERE 
personname.PERSONNAME_THRU_DATE = ''";

$objQuery = mysql_query($strSQL);
$count = 1;
while ($person = mysql_fetch_assoc($objQuery)) {
    $id = $person['PERSONNAME_OWNER_ID'];
    $addr = "";
    if ($person['STATUS'] == 1)
        $status = "ยังมีชีวิตอยู่";
    elseif ($person['STATUS'] == 2)
        $status = "เสียชีวิตแล้ว";


//-----------ที่อยู่-----------------//
    $addrs = mysql_query("SELECT * FROM address "
            . "LEFT JOIN addresslist ON address.ID = addresslist.ADDRESSLIST_ADDRESS_ID "
            . "WHERE addresslist.ADDRESSLIST_OWNER_ID = $id AND addresslist.ADDRESSLIST_TYPE_ID = 1 AND addresslist.ADDRESSLIST_THRU_DATE='' "
            . "ORDER BY addresslist.ADDRESSLIST_FROM_DATE LIMIT 1");
    if (!empty($addrs)) {
        $addr = mysql_fetch_assoc($addrs);
    }
//----เบอร์โทรศัพท์----//        
    $tels = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = 1 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
    $tel = mysql_fetch_assoc($tels);
    $tel_res = "";
    if (!empty($tel)) {
        $tel_res = $tel["CONTACT_ARER_CODE"] . $tel["CONTACT_STRING"];
        if (!empty($tel['CONTACT_COMMENT'])) {
            $tel_res .= "ต่อ " . $tel['CONTACT_COMMENT'];
        }
    }
    //-----เบอร์มือถือ-----//
    $moblies = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = 2 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
    $moblie = mysql_fetch_assoc($moblies);
    $moblie_res = "";
    if (!empty($moblie))
        $moblie_res = $moblie["CONTACT_ARER_CODE"] . $moblie["CONTACT_STRING"];
    //-----Enail--------//
    $emails = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = 3 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
    $email = mysql_fetch_assoc($emails);
    if (!empty($email))
        $email_res = $email['CONTACT_STRING'];

    //-----Facebook--------//
    $fbs = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = 4 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
    $fb = mysql_fetch_assoc($fbs);
    if (!empty($fb))
        $fb_res = $fb['CONTACT_STRING'];
    //-----Line--------//
    $lines = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = 4 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
    $line = mysql_fetch_assoc($lines);
    if (!empty($line))
        $line_res = $line['CONTACT_STRING'];

    //-----ธุรกิจที่ทำงาน--//
    $sql_organization = mysql_query("SELECT * FROM organization
            LEFT JOIN organizationrole ON organizationrole.PERSON_ID=$id
            LEFT JOIN organizationtype ON organizationtype.ID=organization.ORGANIZATION_TYPE_ID
            WHERE
            organizationrole.ORGANIZATIONROLE_THRU_DATE='' AND organization.ID=organizationrole.ORGANIZATION_ID
            ORDER BY organizationrole.ORGANIZATIONROLE_FROM_DATE LIMIT 1");
    $organization = mysql_fetch_assoc($sql_organization);
    if (!empty($organization)) {
        $organization_id = $organization["ORGANIZATION_ID"];

        //-----ที่อยู่ที่ทำงาน---//
        $sql_addr_org = mysql_query("SELECT * FROM address "
                . "LEFT JOIN addresslist ON address.ID = addresslist.ADDRESSLIST_ADDRESS_ID "
                . "WHERE addresslist.ADDRESSLIST_OWNER_ID = $organization_id AND addresslist.ADDRESSLIST_TYPE_ID = 2 AND addresslist.ADDRESSLIST_THRU_DATE='' "
                . "ORDER BY addresslist.ADDRESSLIST_FROM_DATE LIMIT 1");
        if (!empty($sql_addr_org))
            $org_addr = mysql_fetch_assoc($sql_addr_org);

        //----เบอร์โทรศัพท์ ที่ทำงาน----//        
        $org_tels = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $organization_id AND CONTACT_TYPE_ID = 6 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $org_tel = mysql_fetch_assoc($org_tels);
        $org_tel_res = "";
        if (!empty($org_tel)) {
            $org_tel_res = $org_tel["CONTACT_ARER_CODE"] . $org_tel["CONTACT_STRING"];
            if (!empty($org_tel['CONTACT_COMMENT'])) {
                $org_tel_res .= "ต่อ " . $org_tel['CONTACT_COMMENT'];
            }
        }
//----fax ที่ทำงาน----//        
        $org_faxs = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $organization_id AND CONTACT_TYPE_ID = 9 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $org_fax = mysql_fetch_assoc($org_faxs);
        $org_fax_res = "";
        if (!empty($org_fax)) {
            $org_fax_res = $org_fax["CONTACT_ARER_CODE"] . $org_fax["CONTACT_STRING"];
            if (!empty($org_fax['CONTACT_COMMENT'])) {
                $org_fax_res .= "ต่อ " . $org_fax['CONTACT_COMMENT'];
            }
        }
//-----web ที่ทำงาน--------//
        $org_webs = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $organization_id AND CONTACT_TYPE_ID = 7 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $org_web = mysql_fetch_assoc($org_webs);
        if (!empty($org_web))
            $org_web_res = $org_web['CONTACT_STRING'];
//-----Email ที่ทำงาน--------//
        $org_emails = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $organization_id AND CONTACT_TYPE_ID = 8 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $org_email = mysql_fetch_assoc($org_emails);
        if (!empty($org_email))
            $org_email_res = $org_email['CONTACT_STRING'];
    }
    $temp = array(
        "ลำดับที่" => $count++,
        "คำนำหน้า" => $person["TITLE_NAME"],
        "ชื่อ" => $person["PERSONNAME_NAME"],
        "นามสกุล" => $person["PERSONNAME_SURNAME"],
        "สายรุ่นในตระกูล" => $person["GENERATION_TYPE"],
        "รุ่น" => $person["GENERATION_NAME"],
        "ชื่อจีน" => $person["CHINANAME_NAME"],
        "ชื่อจีน(PINYIN)" => $person["CHINANAME_PINYIN"],
        "ชื่อจีน(ไทย)" => $person["CHINANAME_TH"],
        "เพศ" => $person["GENDER_NAME"],
        "วันเกิด" => $person["BIRTHDAY"],
        "สถานะภาพ" => $status,
        "บ้านเลขที่" => $addr["ADDRESS_NUM"],
        "หมู่" => $addr["ADDRESS_MOO"],
        "หมู่บ้าน" => $addr["ADDRESS_VILLAGE"],
        "ซอย" => $addr["ADDRESS_ALLEY"],
        "ถนน" => $addr["ADDRESS_ROAD"],
        "ตำบล" => get_district_string($addr["ADDRESS_DISTRICT_ID"]),
        "อำเภอ" => get_amphur_string($addr["ADDRESS_AMPHUR_ID"]),
        "จังหวัด" => get_province_string($addr["ADDRESS_PROVINCE_ID"]),
        "รหัสไปรษณีย์" => $addr["ADDRESS_ZIPCODE"],
        "เบอร์โทรศัพท์บ้าน" => $tel_res,
        "เบอร์โทรศัทพ์มือถือ" => $moblie_res,
        "Email" => $email_res,
        "Facebook" => $fb_res,
        "Line" => $line_res,
        "ธุรกิจ" => $organization['ORGANIZATIONTYPE_NAME'],
        "ประเภทธุรกิจ" => $organization['ORGANIZATION_COMMENT'],
        "ชื่อธุรกิจ" => $organization['ORGANIZATION_NAME'],
        "ตำแหน่งงาน" => $organization['ORGANIZATION_ROLE'],
        "บ้านเลขที่ ที่ทำงาน" => $org_addr["ADDRESS_NUM"],
        "หมู่ ที่ทำงาน" => $org_addr["ADDRESS_MOO"],
        "หมู่บ้าน ที่ทำงาน" => $org_addr["ADDRESS_VILLAGE"],
        "ซอย ที่ทำงาน" => $org_addr["ADDRESS_ALLEY"],
        "ถนน ที่ทำงาน" => $org_addr["ADDRESS_ROAD"],
        "ตำบล ที่ทำงาน" => get_district_string($org_addr["ADDRESS_DISTRICT_ID"]),
        "อำเภอ ที่ทำงาน" => get_amphur_string($org_addr["ADDRESS_AMPHUR_ID"]),
        "จังหวัด ที่ทำงาน" => get_province_string($org_addr["ADDRESS_PROVINCE_ID"]),
        "รหัสไปรษณีย์ ที่ทำงาน" => $org_addr["ADDRESS_ZIPCODE"],
        "เบอร์โทรศัพท์ ที่ทำงาน" => $org_tel_res,
        "fax ที่ทำงาน" => $org_fax_res,
        "เว็บไซต์ ที่ทำงาน" => $org_web_res,
        "Email ที่ทำงาน" => $org_email_res,
//    "ชื่อบิดา"
//    "พี่น้องร่วมสายเลือด"
//    "ชื่อนามสกุล บรรพบุรุษ"
//    "เบอร์ติดต่อ บรรพบุรุษ"
//    "ตำบลบรรพบุรุษที่จีน"
//    "อำเภอบรรพบุรุษที่จีน"
//    "จังหวัดบรรพบุรุษที่จีน"
//    "หมู่บ้านบรรพบุรุษที่จีน(ไทย)"
//    "ตำบลบรรพบุรุษที่จีน(ไทย)"
//    "อำเภอบรรพบุรุษที่จีน(ไทย)"
//    "จังหวัดบรรพบุรุษที่จีน(ไทย)"
        "อัพเดทข้อมูลล่าสุด" => $person['LASTUPDATE']
    );
    array_push($data, $temp);
    if ($count > 10)
        break;
}

print_r($data);

//exit();

function cleanData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}

// filename for download
$filename = "website_data_" . date('Ymd') . ".xls";



$flag = false;
foreach ($data as $row) {
    if (!$flag) {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\r\n";
}
//header("Content-Disposition: attachment; filename=\"$filename\"");
//header("Content-Type: application/vnd.ms-excel");
ob_end_flush();
exit;
