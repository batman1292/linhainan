<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/loading.css" rel="stylesheet" type="text/css"/> 
    <div class="row" style="margin-top: 20px" id="loading">
        <div class="col-xs-12">
            <div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>

        </div>
    </div>
    <?php
    /**
     * PHPExcel
     *
     * Copyright (C) 2006 - 2011 PHPExcel
     *
     * This library is free software; you can redistribute it and/or
     * modify it under the terms of the GNU Lesser General Public
     * License as published by the Free Software Foundation; either
     * version 2.1 of the License, or (at your option) any later version.
     *
     * This library is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
     * Lesser General Public License for more details.
     *
     * You should have received a copy of the GNU Lesser General Public
     * License along with this library; if not, write to the Free Software
     * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
     *
     * @category   PHPExcel
     * @package    PHPExcel
     * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
     * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
     * @version    1.7.6, 2011-02-27
     */
    /** Error reporting */
    header('Content-Type: text/html; charset=utf-8');
//    $quoted = sprintf('"%s"', addcslashes(basename($file), '"\\'));
//    $size = filesize($file);
//readfile("$filename");

    error_reporting(E_ERROR | E_PARSE);

    date_default_timezone_set('Asia/Bangkok');

    /** PHPExcel */
    require_once '/Classes/PHPExcel.php';
    include '/db_connect.php';
    include '/helper.php';
    connect_database();
    set_time_limit(0);
    mysql_query("set character_set_client='utf8'");
    mysql_query("set character_set_results='utf8'");

// Create new PHPExcel object
//    echo date('H:i:s') . " Create new PHPExcel object\n";
    $objPHPExcel = new PHPExcel();

// Set properties
//    echo date('H:i:s') . " Set properties\n";
    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");



//-------------------------------------------------------------------------//
// Add some data
//    echo date('H:i:s') . " Add some data\n";
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ลำดับที่')
            ->setCellValue('B1', 'คำนำหน้า')
            ->setCellValue('C1', 'ชื่อ')
            ->setCellValue('D1', 'นามสกุล')
            ->setCellValue('E1', 'สายรุ่นในตระกูล')
            ->setCellValue('F1', 'รุ่น')
            ->setCellValue('G1', 'ชื่อจีน')
            ->setCellValue('H1', 'ชื่อจีน(PINYIN)')
            ->setCellValue('I1', 'ชื่อจีน(ไทย)')
            ->setCellValue('J1', 'เพศ')
            ->setCellValue('K1', 'วันเกิด(ค.ศ.)')
            ->setCellValue('L1', 'สถานะภาพ')
            ->setCellValue('M1', 'บ้านเลขที่')
            ->setCellValue('N1', 'หมู่')
            ->setCellValue('O1', 'หมู่บ้าน')
            ->setCellValue('P1', 'ซอย')
            ->setCellValue('Q1', 'ถนน')
            ->setCellValue('R1', 'ตำบล')
            ->setCellValue('S1', 'อำเภอ')
            ->setCellValue('T1', 'จังหวัด')
            ->setCellValue('U1', 'รหัสไปรษณีย์')
            ->setCellValue('V1', 'เบอร์โทรศัพท์บ้าน')
            ->setCellValue('W1', 'เบอร์โทรศัทพ์มือถือ')
            ->setCellValue('X1', 'Email')
            ->setCellValue('Y1', 'Facebook')
            ->setCellValue('Z1', 'Line')
            ->setCellValue('AA1', 'ธุรกิจ')
            ->setCellValue('AB1', 'ประเภทธุรกิจ')
            ->setCellValue('AC1', 'ชื่อธุรกิจ')
            ->setCellValue('AD1', 'ตำแหน่งงาน')
            ->setCellValue('AE1', 'บ้านเลขที่ ที่ทำงาน')
            ->setCellValue('AF1', 'หมู่ ที่ทำงาน')
            ->setCellValue('AG1', 'หมู่บ้าน ที่ทำงาน')
            ->setCellValue('AH1', 'ซอย ที่ทำงาน')
            ->setCellValue('AI1', 'ถนน ที่ทำงาน')
            ->setCellValue('AJ1', 'ตำบล ที่ทำงาน')
            ->setCellValue('AK1', 'อำเภอ ที่ทำงาน')
            ->setCellValue('AL1', 'จังหวัด ที่ทำงาน')
            ->setCellValue('AM1', 'รหัสไปรษณีย์ ที่ทำงาน')
            ->setCellValue('AN1', 'เบอร์โทรศัพท์ ที่ทำงาน')
            ->setCellValue('AO1', 'fax ที่ทำงาน')
            ->setCellValue('AP1', 'เว็บไซต์ ที่ทำงาน')
            ->setCellValue('AQ1', 'Email ที่ทำงาน')
            ->setCellValue('AR1', 'ชื่อบิดา')
            ->setCellValue('AS1', 'พี่น้องร่วมสายเลือด')
            ->setCellValue('AT1', 'ชื่อนามสกุล บรรพบุรุษ')
            ->setCellValue('AU1', 'เบอร์ติดต่อ บรรพบุรุษ')
            ->setCellValue('AV1', 'หมู่บ้านบรรพบุรุษที่จีน ')
            ->setCellValue('AW1', 'ตำบลบรรพบุรุษที่จีน ')
            ->setCellValue('AX1', 'อำเภอบรรพบุรุษที่จีน')
            ->setCellValue('AY1', 'จังหวัดบรรพบุรุษที่จีน')
            ->setCellValue('AZ1', 'หมู่บ้านบรรพบุรุษที่จีน(ไทย)')
            ->setCellValue('BA1', 'ตำบลบรรพบุรุษที่จีน(ไทย)')
            ->setCellValue('BB1', 'อำเภอบรรพบุรุษที่จีน(ไทย)')
            ->setCellValue('BC1', 'จังหวัดบรรพบุรุษที่จีน(ไทย)')
            ->setCellValue('BD1', 'อัพเดทข้อมูลล่าสุด');

//
//// Write data from MySQL result
    $strSQL = "SELECT * FROM `person` 
LEFT JOIN title ON title.ID = person.TITLE_ID
LEFT JOIN gender ON gender.ID = person.GENDER_ID
LEFT JOIN generation ON generation.ID = person.GENERATION_ID
LEFT JOIN personname ON personname.PERSONNAME_OWNER_ID = person.ID
LEFT JOIN chinaname ON chinaname.ID = person.CHINANAME_ID
WHERE 
personname.PERSONNAME_THRU_DATE = ''";
    $objQuery = mysql_query($strSQL);
    $i = 2;
    $count = 1;
    while ($person = mysql_fetch_assoc($objQuery)) {
//        print_r($person);
        $id = $person['PERSONNAME_OWNER_ID'];
        $addr = "";
        if ($person['STATUS'] == 1)
            $status = "ยังมีชีวิตอยู่";
        elseif ($person['STATUS'] == 2)
            $status = "เสียชีวิตแล้ว";
        else
            $status = "";
        
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $count++);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $person["TITLE_NAME"]);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $person["PERSONNAME_NAME"]);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $person["PERSONNAME_SURNAME"]);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $person["GENERATION_TYPE"]);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $person["GENERATION_NAME"]);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $person["CHINANAME_NAME"]);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $person["CHINANAME_PINYIN"]);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $person["CHINANAME_TH"]);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $person["GENDER_NAME"]);
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, display_birthday ($person["BIRTHDAY"]));
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $status);
//------ที่อยู่-------//
        $addrs = mysql_query("SELECT * FROM address "
                . "LEFT JOIN addresslist ON address.ID = addresslist.ADDRESSLIST_ADDRESS_ID "
                . "WHERE addresslist.ADDRESSLIST_OWNER_ID = $id AND addresslist.ADDRESSLIST_TYPE_ID = 1 AND addresslist.ADDRESSLIST_THRU_DATE='' "
                . "ORDER BY addresslist.ADDRESSLIST_FROM_DATE LIMIT 1");
        $addr = mysql_fetch_assoc($addrs);

        $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $addr["ADDRESS_NUM"]);
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $addr["ADDRESS_MOO"]);
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $addr["ADDRESS_VILLAGE"]);
        $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $addr["ADDRESS_ALLEY"]);
        $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $addr["ADDRESS_ROAD"]);
        $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, get_district_string($addr["ADDRESS_DISTRICT_ID"]));
        $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, get_amphur_string($addr["ADDRESS_AMPHUR_ID"]));
        $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, get_province_string($addr["ADDRESS_PROVINCE_ID"]));
        $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $addr["ADDRESS_ZIPCODE"]);
//----เบอร์โทรศัพท์----//        
        $tels = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = 1 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $tel = mysql_fetch_assoc($tels);
        $tel_res = "";
        if (!empty($tel)) {
            $tel_res = $tel["CONTACT_ARER_CODE"] . "-" . $tel["CONTACT_STRING"];
            if (!empty($tel['CONTACT_COMMENT'])) {
                $tel_res .= "ต่อ " . $tel['CONTACT_COMMENT'];
            }
        }
        $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $tel_res);
//-----เบอร์มือถือ-----//
        $moblies = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = 2 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $moblie = mysql_fetch_assoc($moblies);
        $moblie_res = "";
        if (!empty($moblie))
            $moblie_res = $moblie["CONTACT_ARER_CODE"] . "-" . $moblie["CONTACT_STRING"];
        $objPHPExcel->getActiveSheet()->setCellValue('W' . $i, $moblie_res);
//-----Enail--------//
        $emails = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = 3 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $email = mysql_fetch_assoc($emails);
        $objPHPExcel->getActiveSheet()->setCellValue('X' . $i, $email['CONTACT_STRING']);
//-----Facebook--------//
        $fbs = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = 4 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $fb = mysql_fetch_assoc($fbs);
        $objPHPExcel->getActiveSheet()->setCellValue('Y' . $i, $fb['CONTACT_STRING']);
//-----Line--------//
        $lines = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $id AND CONTACT_TYPE_ID = 4 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $line = mysql_fetch_assoc($lines);
        $objPHPExcel->getActiveSheet()->setCellValue('Z' . $i, $line['CONTACT_STRING']);

//-----ธุรกิจที่ทำงาน--//
        $sql_organization = mysql_query("SELECT * FROM organization
            LEFT JOIN organizationrole ON organizationrole.PERSON_ID=$id
            LEFT JOIN organizationtype ON organizationtype.ID=organization.ORGANIZATION_TYPE_ID
            WHERE
            organizationrole.ORGANIZATIONROLE_THRU_DATE='' AND organization.ID=organizationrole.ORGANIZATION_ID
            ORDER BY organizationrole.ORGANIZATIONROLE_FROM_DATE LIMIT 1");
        $organization = mysql_fetch_assoc($sql_organization);
        $organization_id = $organization["ORGANIZATION_ID"];
//        print_r($organization);
        $objPHPExcel->getActiveSheet()->setCellValue('AA' . $i, $organization['ORGANIZATIONTYPE_NAME']);
        $objPHPExcel->getActiveSheet()->setCellValue('AB' . $i, $organization['ORGANIZATION_COMMENT']);
        $objPHPExcel->getActiveSheet()->setCellValue('AC' . $i, $organization['ORGANIZATION_NAME']);
        $objPHPExcel->getActiveSheet()->setCellValue('AD' . $i, $organization['ORGANIZATION_ROLE']);
//-----ที่อยู่ที่ทำงาน---//
        $sql_addr_org = mysql_query("SELECT * FROM address "
                . "LEFT JOIN addresslist ON address.ID = addresslist.ADDRESSLIST_ADDRESS_ID "
                . "WHERE addresslist.ADDRESSLIST_OWNER_ID = $organization_id AND addresslist.ADDRESSLIST_TYPE_ID = 2 AND addresslist.ADDRESSLIST_THRU_DATE='' "
                . "ORDER BY addresslist.ADDRESSLIST_FROM_DATE LIMIT 1");
        $org_addr = mysql_fetch_assoc($sql_addr_org);
//        print_r($org_addr);
        $objPHPExcel->getActiveSheet()->setCellValue('AE' . $i, $org_addr["ADDRESS_NUM"]);
        $objPHPExcel->getActiveSheet()->setCellValue('AF' . $i, $org_addr["ADDRESS_MOO"]);
        $objPHPExcel->getActiveSheet()->setCellValue('AG' . $i, $org_addr["ADDRESS_VILLAGE"]);
        $objPHPExcel->getActiveSheet()->setCellValue('AH' . $i, $org_addr["ADDRESS_ALLEY"]);
        $objPHPExcel->getActiveSheet()->setCellValue('AI' . $i, $org_addr["ADDRESS_ROAD"]);
        $objPHPExcel->getActiveSheet()->setCellValue('AJ' . $i, get_district_string($org_addr["ADDRESS_DISTRICT_ID"]));
        $objPHPExcel->getActiveSheet()->setCellValue('AK' . $i, get_amphur_string($org_addr["ADDRESS_AMPHUR_ID"]));
        $objPHPExcel->getActiveSheet()->setCellValue('AL' . $i, get_province_string($org_addr["ADDRESS_PROVINCE_ID"]));
        $objPHPExcel->getActiveSheet()->setCellValue('AM' . $i, $org_addr["ADDRESS_ZIPCODE"]);
//----เบอร์โทรศัพท์ ที่ทำงาน----//        
        $tels = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $organization_id AND CONTACT_TYPE_ID = 6 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $tel = mysql_fetch_assoc($tels);
        $tel_res = "";
        if (!empty($tel)) {
            $tel_res = $tel["CONTACT_ARER_CODE"] . "-" . $tel["CONTACT_STRING"];
            if (!empty($tel['CONTACT_COMMENT'])) {
                $tel_res .= "ต่อ " . $tel['CONTACT_COMMENT'];
            }
        }
        $objPHPExcel->getActiveSheet()->setCellValue('AN' . $i, $tel_res);
//----fax ที่ทำงาน----//        
        $tels = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $organization_id AND CONTACT_TYPE_ID = 9 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $tel = mysql_fetch_assoc($tels);
        $tel_res = "";
        if (!empty($tel)) {
            $tel_res = $tel["CONTACT_ARER_CODE"] . "-" . $tel["CONTACT_STRING"];
            if (!empty($tel['CONTACT_COMMENT'])) {
                $tel_res .= "ต่อ " . $tel['CONTACT_COMMENT'];
            }
        }
        $objPHPExcel->getActiveSheet()->setCellValue('AO' . $i, $tel_res);
//-----web ที่ทำงาน--------//
        $fbs = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $organization_id AND CONTACT_TYPE_ID = 8 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $fb = mysql_fetch_assoc($fbs);
        $objPHPExcel->getActiveSheet()->setCellValue('AP' . $i, $fb['CONTACT_STRING']);
//-----Email ที่ทำงาน--------//
        $fbs = mysql_query("SELECT * FROM contact WHERE CONTACT_OWNER_ID = $organization_id AND CONTACT_TYPE_ID = 7 AND CONTACT_THRU_DATE='' ORDER BY CONTACT_FROM_DATE LIMIT 1");
        $fb = mysql_fetch_assoc($fbs);
        $objPHPExcel->getActiveSheet()->setCellValue('AQ' . $i, $fb['CONTACT_STRING']);
//-----บิดา----------------//
        if (!empty($person["PARENT_ID"])) {
            $parent = get_person_name_string($person["PARENT_ID"]) . " " . get_person_surname_string($person["PARENT_ID"]);
            $objPHPExcel->getActiveSheet()->setCellValue('AR' . $i, $parent);
        }
//----พี่น้อง---------------//
        if (!empty($person["BROTHER_LIST"])) {
            $brother = "";
            $bro_list = (get_person_brother($person["PARENT_ID"], $person["BROTHER_LIST"], $id));
            while ($brother_list = mysql_fetch_assoc($bro_list)) {
//                print_r($brother_list);
                if ($brother_list['STATUS'] == 1)
                    $brother_status = "ยังมีชีวิตอยู่";
                elseif ($brother_list['STATUS'] == 0)
                    $brother_status = "เสียชีวิตแล้ว";
                $brother .= get_person_name_string($brother_list["ID"]) . " " . get_person_surname_string($brother_list["ID"]) . "/" . $brother_status . ",";
            }
            $brother = substr($brother, 0, strlen($brother) - 1);
            $objPHPExcel->getActiveSheet()->setCellValue('AS' . $i, $brother);
        }
//----บรรพบุรุษ-----------//
        $china_houses = mysql_fetch_assoc(get_chinahouse_data($person["CHINAHOUSE_ID"]));
        $china_vallage = mysql_fetch_assoc(get_china($china_houses['CHINAHOUSE_VILLAGE_ID']));
        $china_district = mysql_fetch_assoc(get_china($china_houses['CHINAHOUSE_DISTRICT_ID']));
        $china_amphur = mysql_fetch_assoc(get_china($china_houses['CHINAHOUSE_AMPHUR_ID']));
        $china_provice = mysql_fetch_assoc(get_china($china_houses['CHINAHOUSE_PROVINCE_ID']));

        $objPHPExcel->getActiveSheet()->setCellValue('AT' . $i, $china_houses['CHINAHOUSE_NAME']);
        $objPHPExcel->getActiveSheet()->setCellValue('AU' . $i, $china_houses['CHINAHOUSE_TEL']);
        $objPHPExcel->getActiveSheet()->setCellValue('AV' . $i, $china_vallage['CHINA_STR']);
        $objPHPExcel->getActiveSheet()->setCellValue('AW' . $i, $china_district['CHINA_STR']);
        $objPHPExcel->getActiveSheet()->setCellValue('AX' . $i, $china_amphur['CHINA_STR']);
        $objPHPExcel->getActiveSheet()->setCellValue('AY' . $i, $china_provice['CHINA_STR']);
        $objPHPExcel->getActiveSheet()->setCellValue('AZ' . $i, $china_vallage['CHINA_TH']);
        $objPHPExcel->getActiveSheet()->setCellValue('BA' . $i, $china_district['CHINA_TH']);
        $objPHPExcel->getActiveSheet()->setCellValue('BB' . $i, $china_amphur['CHINA_TH']);
        $objPHPExcel->getActiveSheet()->setCellValue('BC' . $i, $china_provice['CHINA_TH']);

//----อัพเดทล่าสุด--------//
        $objPHPExcel->getActiveSheet()->setCellValue('BD' . $i, $person['LASTUPDATE']);
        $i++;
    }

    //---------------------------------------//
//    mysql_close($objConnect);
//
// Rename sheet
//    echo date('H:i:s') . " Rename sheet\n";
    $objPHPExcel->getActiveSheet()->setTitle('ข้อมูลสมาชิกมูลนิธิ');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
//    echo date('H:i:s') . " Write to Excel2007 format\n";
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $strFileName = "linhainan.xlsx";
    $objWriter->save($strFileName);


// Echo memory peak usage
//    echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";
// Echo done
//    echo date('H:i:s') . " Done writing file.\r\n";
    echo "<script type='text/javascript'>";
    echo "window.location = 'openExcel.php';";
//    echo "window.close();";
    echo "</script>";
    ?>
</html>