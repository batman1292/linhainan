<html>
    <head>
        <meta charset="utf-8">
        <link href="../css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-3.3.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="css/bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet" type="text/css"/>-->
        <link href=../"css/bootstrap-material-design-master/dist/css/material.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet" type="text/css"/>
        <script src="../helper/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="../helper/jquery-latest.js" type="text/javascript"></script>
        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();

                document.body.innerHTML = originalContents;
            }
            $(document).ready(function () {
                //                alert('loaded');
                window.printDiv("print_div");
                // do other things
//                return false;
//                window.close();
            });
        </script>
<style>

            @media print
            {
                #pageHeader{
                    overflow:visible;
                    top: 0;
                }

                #content {
                    /*page-break-before: always;*/

                    page-break-inside: avoid;
                }


            }
            @page :left {
                @top-left {
                    content: "Cascading Style Sheets";
                }
            }
        </style>
    </head>
    <body>
        <?php
        $id = $_GET['id'];

        include '../helper/db_connect.php';
        include '../helper/helper.php';
        connect_database();
        $persons = get_person_detial($id);
        $person = mysql_fetch_assoc($persons);
//    print_r($person);
        if ($person['CHINANAME_ID'] == 0) {
            $chinaname = '';
        } else {
            $chinaname = get_person_china_full_name($id, 0);
        }

        $homeAddrs = get_person_all_address($id, 1);
        $checkHome = mysql_fetch_assoc(get_person_all_address($id, 1));
        if ($checkHome) {
            $homeAddr = mysql_fetch_assoc($homeAddrs);
        } else {
            $homeAddr = give_addr();
        }

        $homeTels = get_person_contact($person['ID'], 1);
        $checkHomeTel = mysql_fetch_assoc(get_person_contact($id, 1));
        if ($checkHomeTel) {
            $homeTel = mysql_fetch_assoc($homeTels);
            if ($homeTel['CONTACT_COMMENT'] == '') {
                $homePhoneSting = $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING'];
            } else {
                $homePhoneSting = $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING'] . 'ต่อ' . $homeTel['CONTACT_COMMENT'];
            }
        } else {
            $homePhoneSting = '';
        }

        $mobileTels = get_person_contact($person['ID'], 2);
        $checkMobileTel = mysql_fetch_assoc(get_person_contact($id, 2));
        if ($checkMobileTel) {
            $mobileTel = mysql_fetch_assoc($mobileTels);
        } else {
            $mobileTel = give_tel();
        }

        $emails = get_person_contact($id, 3);
        $checkEmail = mysql_fetch_assoc(get_person_contact($id, 3));
        if ($checkEmail) {
            $email = mysql_fetch_assoc($emails);
        } else {
            $email = array("CONTACT_STRING" => '');
        }

        $lines = get_person_contact($id, 5);
        $checkLine = mysql_fetch_assoc(get_person_contact($id, 5));
        if ($checkLine) {
            $line = mysql_fetch_assoc($lines);
        } else {
            $line = array("CONTACT_STRING" => '');
        }

        $facebooks = get_person_contact($id, 4);
        $checkFB = mysql_fetch_assoc(get_person_contact($id, 4));
        if ($checkFB) {
            $facebook = mysql_fetch_assoc($facebooks);
        } else {
            $facebook = array("CONTACT_STRING" => '');
        }

        $organization_ids = get_person_organization($person["ID"]);
        $organization_id = mysql_fetch_assoc($organization_ids);
        if ($organization_id) {
            $organization_ids = get_person_organization($person["ID"]);
            $organization_id = mysql_fetch_assoc($organization_ids);
//                                print_r($organization_id);
            $organization_datas = get_organization_data($organization_id['ORGANIZATION_ID']);
            $organization_data = mysql_fetch_assoc($organization_datas);

            $org_type = $organization_data['ORGANIZATION_TYPE_ID'];

            $org_comment = $organization_data['ORGANIZATION_COMMENT'];

            $org_name = $organization_data['ORGANIZATION_NAME'];

            $org_role = $organization_id['ORGANIZATION_ROLE'];

            $organization_addrs = get_person_all_address($organization_id['ORGANIZATION_ID'], 2);
            $org_addr = mysql_fetch_assoc($organization_addrs);

            $organization_phones = get_person_contact($organization_id['ORGANIZATION_ID'], 6);
            $organization_phone = mysql_fetch_assoc($organization_phones);
            if ($organization_phone) {
                $organization_phones = get_person_contact($organization_id['ORGANIZATION_ID'], 6);
                $organization_phone = mysql_fetch_assoc($organization_phones);
                if ($organization_phone['CONTACT_COMMENT'] == '') {
                    $org_phone_string = $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING'];
                } else {
                    $org_phone_string = $homeTel['CONTACT_ARER_CODE'] . '-' . $homeTel['CONTACT_STRING'] . 'ต่อ' . $homeTel['CONTACT_COMMENT'];
                }
            } else {
                $org_phone_string = '';
            }

            $organization_webs = get_person_contact($organization_id['ORGANIZATION_ID'], 7);
            $org_web = mysql_fetch_assoc($organization_webs);
            if ($org_web) {
                $organization_webs = get_person_contact($organization_id['ORGANIZATION_ID'], 7);
                $org_web = mysql_fetch_assoc($organization_webs);
            } else {
                $org_web = array("CONTACT_STRING" => '');
            }

            $organization_mails = get_person_contact($organization_id['ORGANIZATION_ID'], 8);
            $org_mail = mysql_fetch_assoc($organization_mails);
            if ($org_mail) {
                $organization_mails = get_person_contact($organization_id['ORGANIZATION_ID'], 8);
                $org_mail = mysql_fetch_assoc($organization_mails);
            } else {
                $org_mail = array("CONTACT_STRING" => '');
            }
        } else {
            $org_type = 0;
            $org_comment = '';
            $org_name = '';
            $org_role = '';
            $org_addr = give_addr();
            $org_phone_string = '';
            $org_fax_string = '';
            $org_web = array("CONTACT_STRING" => '');
            $org_mail = array("CONTACT_STRING" => '');
        }

        if ($person['PARENT_ID'] != 0) {
            $parent_string = get_person_name_string($person['PARENT_ID']) . " " . get_person_surname_string($person['PARENT_ID']);
            $parents = get_person_detial($person['PARENT_ID']);
            $parent = mysql_fetch_assoc($parents);
            $parent_status = $parent['STATUS'];
        } else {
            $parent_string = '';
            $parent_status = 0;
        }

        if ($person['MOTHER_ID'] != 0) {
            $mother_string = get_person_name_string($person['MOTHER_ID']) . " " . get_person_surname_string($person['MOTHER_ID']);
            $mothers = get_person_detial($person['MOTHER_ID']);
            $mother = mysql_fetch_assoc($mothers);
            $mother_status = $mother['STATUS'];
        } else {
            $mother_string = '';
            $mother_status = 0;
        }

        if ($person['CHINAHOUSE_ID'] != 0) {
            $chinahouses = get_chinahouse_data($person['CHINAHOUSE_ID']);
            $chinahouse = mysql_fetch_assoc($chinahouses);
//                        print_r($chinahouse);
            $chinahouse_name = $chinahouse['CHINAHOUSE_NAME'];
            $chinahouse_tel = $chinahouse['CHINAHOUSE_TEL'];
            $chinahouse_link = $chinahouse['CHINAHOUSE_LINK'];
            if ($chinahouse['CHINAHOUSE_VILLAGE_ID'] == 0) {
                $chinahouse_village_string = '';
            } else {
                $chinahouse_villages = get_china($chinahouse['CHINAHOUSE_VILLAGE_ID']);
                $chinahouse_village = mysql_fetch_assoc($chinahouse_villages);
                $chinahouse_village_string = $chinahouse_village['CHINA_STR'] . '/' . $chinahouse_village['CHINA_TH'];
            }

            if ($chinahouse['CHINAHOUSE_DISTRICT_ID'] == 0) {
                $chinahouse_district_string = '';
            } else {
                $chinahouse_districts = get_china($chinahouse['CHINAHOUSE_DISTRICT_ID']);
                $chinahouse_district = mysql_fetch_assoc($chinahouse_districts);
                $chinahouse_district_string = $chinahouse_district['CHINA_STR'] . '/' . $chinahouse_district['CHINA_TH'];
            }

            if ($chinahouse['CHINAHOUSE_AMPHUR_ID'] == 0) {
                $chinahouse_amphur_string = '';
            } else {
                $chinahouse_amphurs = get_china($chinahouse['CHINAHOUSE_AMPHUR_ID']);
                $chinahouse_amphur = mysql_fetch_assoc($chinahouse_amphurs);
                $chinahouse_amphur_string = $chinahouse_amphur['CHINA_STR'] . '/' . $chinahouse_amphur['CHINA_TH'];
            }

            if ($chinahouse['CHINAHOUSE_PROVINCE_ID'] == 0) {
                $chinahouse_province_string = '';
            } else {
                $chinahouse_provinces = get_china($chinahouse['CHINAHOUSE_PROVINCE_ID']);
                $chinahouse_province = mysql_fetch_assoc($chinahouse_provinces);
                $chinahouse_province_string = $chinahouse_province['CHINA_STR'] . '/' . $chinahouse_province['CHINA_TH'];
            }
        } else {
            $chinahouse_name = '';
            $chinahouse_tel = '';
            $chinahouse_village_string = '';
            $chinahouse_district_string = '';
            $chinahouse_amphur_string = '';
            $chinahouse_province_string = '';
            $chinahouse_link = '';
        }
        ?>
        <div class="bs-component">
            <!--<a class="btn btn-danger" role="button" style="margin-top: 0px" onClick="javascript:window.history.back();">ย้อนกลับ</a>-->
            <div id="print_div">
                <div class="row">
                    <div class="col-xs-3">
                        <h4>1.ข้อมูลส่วนตัว </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4" style="margin-top:2px">
                        <h6>ชื่อ-นามสกุลกรุณาระบุคำนำหน้านาม</h6>
                    </div>
                    <div class="col-xs-1" style="margin-top:2px">
                        <h6>เพศ</h6>
                    </div>
                    <div class="col-xs-2" style="margin-top:7px">
                        <input type="checkbox" name="gender" value="1"  <?php if ($person["GENDER_ID"] == 1) echo "checked"; ?> >ชาย
                        <input type="checkbox" name="gender" value="2" <?php if ($person["GENDER_ID"] == 2) echo "checked"; ?>>หญิง
                    </div>
                    <div class="col-xs-2">
                        <h6>เลขบัตรประชาชน</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php if ($person['PERSONALID'] != '')
                                    echo get_personalID($id);
                                else {
                                    echo '-';
                                } ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>ไทย</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . ' ' . get_person_surname_string($id); ?>">
                    </div>
                    <!--                    <div class="col-xs-2">
                                            <h6>ชื่อจีน(ถ้ามี)</h6>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" value="<?php echo $chinaname; ?>">
                                        </div>-->

                </div>
                <?php
                $chinanames = get_person_china_name($id);
                $chinaname = mysql_fetch_assoc($chinanames);
//                    print_r($chinaname);
                $gen_detials = get_person_china_generation_name($id);
                $gen_detial = mysql_fetch_assoc($gen_detials);
//                    print_r($gen_detial);
                ?>
                <div class="row">
                    <div class="col-xs-2">
                        <h5>ชื่อจีน 林</h5>
                    </div>
                    <div class="col-xs-1">
                        <h5>รุ่น</h5> 
                    </div>
                    <div class="col-xs-3" style="margin: 5 0px">
                        <input type="text" class="form-control"autofocus name="chinaname" value="<?php echo $gen_detial['GENERATION_NAME']; ?>" placeholder="">
                    </div>
                    <div class="col-xs-1">
                        <h5>ชื่อ</h5> 
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control"autofocus name="chinaname" value="<?php echo $chinaname['CHINANAME_NAME']; ?>" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h5>เสียง pinyin lin</h5>
                    </div>
                    <div class="col-xs-1">
                        <h5>รุ่น</h5> 
                    </div>
                    <div class="col-xs-3" >
                        <input type="text" class="form-control"autofocus name="chinaname_thai" value="<?php echo $gen_detial['GENERATION_PINYIN']; ?>" placeholder="">

                    </div>
                    <div class="col-xs-1">
                        <h5>ชื่อ</h5> 
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control"autofocus name="chinaname_pinyin" value="<?php echo $chinaname['CHINANAME_PINYIN']; ?>" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h5>คำอ่านไทย หลิน</h5>
                    </div>
                    <div class="col-xs-1">
                        <h5>รุ่น</h5> 
                    </div>
                    <div class="col-xs-3" >
                        <input type="text" class="form-control"autofocus name="chinaname_thai" value="<?php echo $gen_detial['GENERATION_TH']; ?>" placeholder="">

                    </div>
                    <div class="col-xs-1">
                        <h5>ชื่อ</h5> 
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control"autofocus name="chinaname_thai" value="<?php echo $chinaname['CHINANAME_TH']; ?>" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>วันเกิด(ค.ศ.)</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" value="<?php echo display_birthday($person['BIRTHDAY']); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>อายุ</h6>
                    </div>
                    <div class="col-xs-1">
                        <input type="text" class="form-control" value="<?php echo cal_age($person['BIRTHDAY']); ?>">
                    </div>
                    <div class="col-xs-2">
                        <h6>ปี สถานภาพ</h6>
                    </div>
                    <div class="col-xs-4" style="margin-top:7px">
                        <input type="checkbox" name="gender" value="1" <?php if ($person["MARITALSTATUS_ID"] == 1) echo "checked"; ?> >โสด
                        <input type="checkbox" name="gender" value="2" <?php if ($person["MARITALSTATUS_ID"] == 2) echo "checked"; ?> >สมรส
                        <input type="checkbox" name="gender" value="3" <?php if ($person["MARITALSTATUS_ID"] == 3) echo "checked"; ?> >หย่าร้าง
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>ที่อยู่บ้าน</h6>
                    </div>  
                    <div class="col-xs-2">
                        <h6>บ้านเลขที่</h6>
                    </div>  
                    <div class="col-xs-2">
                        <input type="text" class="form-control" value="<?php echo ($homeAddr['ADDRESS_NUM']); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>หมู่</h6>
                    </div>
                    <div class="col-xs-1">
                        <input type="text" class="form-control" value="<?php echo ($homeAddr['ADDRESS_MOO']); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>หมู่บ้าน</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo ($homeAddr['ADDRESS_VILLAGE']); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>ซอย</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo ($homeAddr['ADDRESS_ALLEY']); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>ถนน</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo ($homeAddr['ADDRESS_ROAD']); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>ตำบล</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo get_district_string($homeAddr['ADDRESS_DISTRICT_ID']) ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>อำเภอ</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo get_amphur_string($homeAddr['ADDRESS_AMPHUR_ID']) ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>จังหวัด</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo get_province_string($homeAddr['ADDRESS_PROVINCE_ID']) ?>">
                    </div>
                    <div class="col-xs-2">
                        <h6>รหัสไปรษณีย์</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" value="<?php echo ($homeAddr['ADDRESS_ZIPCODE']); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>โทรศัทพ์บ้าน</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php echo $homePhoneSting; ?>">
                    </div>
                    <div class="col-xs-2">
                        <h6>เบอร์มือถือ</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php echo $mobileTel['CONTACT_ARER_CODE'] . '-' . $mobileTel['CONTACT_STRING']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>e-mail</h6>
                    </div>
                    <div class="col-xs-6">
                        <input type="email" class="form-control" value="<?php echo ($email['CONTACT_STRING']); ?>">
                    </div>
		</div>
		<div class="row">
                    <div class="col-xs-1">
                        <h6>facebook</h6>
                    </div>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" value="<?php echo ($line['CONTACT_STRING']); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>lineID</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo ($facebook['CONTACT_STRING']); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <h4>2.อาชีพ/ธุรกิจหลัก</h4>
                    </div>
                    <div class="col-xs-9" style="margin-top:7px">
                        <input type="checkbox" name="gender" value="1" <?php if ($org_type == 1) echo "checked"; ?> >รับราชการ 
                        <input type="checkbox" name="gender" value="2" <?php if ($org_type == 2) echo "checked"; ?> >รัฐวิสาหกิจ 
                        <input type="checkbox" name="gender" value="3" <?php if ($org_type == 3) echo "checked"; ?> >เอกชน 
                        <input type="checkbox" name="gender" value="4" <?php if ($org_type == 4) echo "checked"; ?> >นักเรียน / นักศึกษา 
                        <input type="checkbox" name="gender" value="5" <?php if ($org_type == 5) echo "checked"; ?> >อิสระ 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <h6>ประเภทธุรกิจหลัก</h6>
                    </div>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" value="<?php echo $org_comment; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>ชื่อที่ทำงาน</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php echo $org_name; ?>">
                    </div>
                    <div class="col-xs-2">
                        <h6>ตำแหน่งงาน</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control"  value="<?php echo $org_role; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <h6>ที่อยู่ที่ทำงาน</h6>
                    </div>  
                    <div class="col-xs-2">
                        <h6>เลขที่</h6>
                    </div>  
                    <div class="col-xs-2">
                        <input type="text" class="form-control" value="<?php echo ($org_addr['ADDRESS_NUM']); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>หมู่</h6>
                    </div>
                    <div class="col-xs-1">
                        <input type="text" class="form-control" value="<?php echo ($org_addr['ADDRESS_MOO']); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>หมู่บ้าน</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo ($org_addr['ADDRESS_VILLAGE']); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>ซอย</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo ($org_addr['ADDRESS_ALLEY']); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>ถนน</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo ($org_addr['ADDRESS_ROAD']); ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>ตำบล</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo get_district_string($org_addr['ADDRESS_DISTRICT_ID']) ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>อำเภอ</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo get_amphur_string($org_addr['ADDRESS_AMPHUR_ID']) ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>จังหวัด</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo get_province_string($org_addr['ADDRESS_PROVINCE_ID']) ?>">
                    </div>
                    <div class="col-xs-2">
                        <h6>รหัสไปรษณีย์</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type="text" class="form-control" value="<?php echo ($org_addr['ADDRESS_ZIPCODE']); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>โทรศัพท์</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="email" class="form-control" value="<?php echo $org_phone_string; ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>website</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo $org_web['CONTACT_STRING']; ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>mail</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo $org_mail['CONTACT_STRING']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10">
                        <h4>3.ครอบครัว</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        ชื่อ-นามสกุล บิดา
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php echo $parent_string; ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>สถานะ</h6>
                    </div>
                    <div class="col-xs-4" style="margin-top:7px">
                        <input type="checkbox" name="gender" value="1" <?php if ($parent_status == 1) echo "checked"; ?> >ยังมีชีวิตอยู่
                        <input type="checkbox" name="gender" value="2" <?php if ($parent_status == 2) echo "checked"; ?> >เสียชีวิตแล้ว
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        ชื่อ-นามสกุล มารดา
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php echo $mother_string; ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>สถานะ</h6>
                    </div>
                    <div class="col-xs-4" style="margin-top:7px">
                        <input type="checkbox" name="gender" value="1" <?php if ($mother_status == 1) echo "checked"; ?> >ยังมีชีวิตอยู่
                        <input type="checkbox" name="gender" value="2" <?php if ($mother_status == 2) echo "checked"; ?> >เสียชีวิตแล้ว
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10">
                        <h4>4.ที่อยู่บรรพบุรุษประเทศจีน</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1">
                        <h6>ชื่อนามสกุล</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo $chinahouse_name; ?>">
                    </div>
                    <div class="col-xs-2">
                        <h6>ความสัมพันธ์</h6>
                    </div>
                    <div class="col-xs-2">
                        <input type='text' class="form-control" autofocus name='CHINAHOUSE_LINK' value="<?php echo $chinahouse_link; ?>">
                    </div>
                    <div class="col-xs-1">
                        <h6>เบอร์ติดต่อ</h6>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" class="form-control" value="<?php echo $chinahouse_tel; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1 col-xs-offset-0">
                        <h6>หมู่บ้าน</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php echo $chinahouse_village_string; ?>">
                    </div>
                    <div class="col-xs-1 col-xs-offset-1">
                        <h6>ตำบล</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php echo $chinahouse_district_string; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-1 col-xs-offset-0">
                        <h6>อำเภอ</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php echo $chinahouse_amphur_string; ?>">
                    </div>
                    <div class="col-xs-1 col-xs-offset-1">
                        <h6>มลฑล/จังหวัด</h6>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" value="<?php echo $chinahouse_province_string; ?>">
                    </div>
                </div>
    		<br>
<br>
                <?php
                if ($person['PARENT_ID'] != 0 || $person['BROTHER_LIST'] != '') {
                    ?>
                    <div class="row">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border"><h4>5. ชื่อนามสกุล ของพี่-น้องร่วมบิดา-มารดาเดียวกัน(เดิม)</h4></legend>
                            <?php
                            $count_brother = 1;
                            $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $person['ID']);
                            while ($brother = mysql_fetch_assoc($brothers)) {
//                                    print_r($brother);
                                ?>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <h5><?php echo $count_brother; ?>.ชื่อนามสกุล</h5>
                                    </div>
                                    <div class="col-xs-3" style="margin-top: 7px;">
                                        <?php echo get_person_name_string($brother['ID']) . " " . get_person_surname_string($brother['ID']); ?>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-0">
                                        <h5>วันเกิด</h5>
                                    </div>
                                    <div class="col-xs-1" style="margin-top: 10px;">
                                        <?php
                                        $date = date_create($brother['BIRTHDAY']);
                                        echo date_format($date, "m/d/Y");
                                        ?>
                                    </div>
                                    <div class="col-xs-1 col-xs-offset-1">
                                        <h5>สถานะ</h5>
                                    </div>
                                    <div class="col-xs-2" style="margin-top: 7px;">
                                        <?php
                                        if (get_status($brother['ID']) == 1) {
                                            echo "ยังมีชีวิตอยู่";
                                        } elseif (get_status($brother['ID']) == 2) {
                                            echo "เสียชีวิต";
                                        } else {
                                            echo "ยังมีชีวิตอยู่";
                                        }
                                        ?>
        <!--                                            <input type="radio" name="parent_status<?php //echo $count_brother;               ?>" value="1" <?php //if(get_status($brother['ID'])==1)echo "checked";                ?>>ยังมีชีวิตอยู่
                                            <input type="radio" name="parent_status<?php //echo $count_brother;               ?>" value="2" <?php //if(get_status($brother['ID'])==2)echo "checked";                ?>>เสียชีวิต-->
                                    </div>  
                                </div>
                                <?php
                                $count_brother++;
                            }
                            ?>
                        </fieldset>
                    </div>
                    <div class="row">
                        <div class="col-xs-12" ><h4>ชื่อนามสกุล ของพี่-น้องร่วมบิดา-มารดาเดียวกัน(เพิ่มเติม)</h4></div>
                    </div>
                    <?php
                    for ($i = 6; $i >= ($count_brother - 1); $i--) {
                        if($count_brother != 2 || $i != 1){
                        ?>
                        <div class="row">
                            <div class="col-xs-3" style="margin-left: 5px;">
                                <h5>ชื่อนามสกุล</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="namebro1 form-control" list="list_bro1" autofocus name="namebro1" value="">
                                <datalist id="list_bro1" class="list_bro1">

                                </datalist> 
                            </div>
                            <div class="col-xs-2">
                                <h5>วันเกิด(ค.ศ.)</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" autofocus name="bro1_bday" id="bro1_bday" value="" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-1" style="margin-left: 5px;">
                                <h5>สถานะ</h5>
                            </div>
                            <div class="col-xs-3" style="margin-top: 7px;">
                                <input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                                <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต
                            </div>
                        </div>
                        <?php
                        }
                    }
                } else {
                    ?>
                    <div class="row">
                        <div class="col-xs-12" ><h4>5. ชื่อนามสกุล ของพี่-น้องร่วมบิดา-มารดาเดียวกัน</h4></div>
                    </div>
                    <?php
                    for ($i = 1; $i <= 6; $i++) {
                        ?>
                        <div class="row">
                            <div class="col-xs-3" style="margin-left: 15px;">
                                <h5>ชื่อนามสกุล</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="namebro1 form-control" list="list_bro1" autofocus name="namebro1" value="">
                                <datalist id="list_bro1" class="list_bro1">

                                </datalist> 
                            </div>
                            <div class="col-xs-2">
                                <h5>วันเกิด(ค.ศ.)</h5>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="form-control" autofocus name="bro1_bday" id="bro1_bday" value="" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-1" style="margin-left: 15px;">
                                <h5>สถานะ</h5>
                            </div>
                            <div class="col-xs-3" style="margin-top: 7px;">
                                <input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                                <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

                <!--                <div class="row">
                                    <div class="col-xs-3">
                                        <h5>1.ชื่อนามสกุล</h5>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="namebro1 form-control" list="list_bro1" autofocus name="namebro1" value="">
                                        <datalist id="list_bro1" class="list_bro1">
                
                                        </datalist> 
                                    </div>
                                    <div class="col-xs-2">
                                        <h5>วันเกิด(ค.ศ.)</h5>
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="text" class="form-control" autofocus name="bro1_bday" id="bro1_bday" value="" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-1 col-xs-offset-0">
                                        <h5>สถานะ</h5>
                                    </div>
                                    <div class="col-xs-3" style="margin-top: 7px;">
                                        <input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                                        <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="col-xs-3">
                                        <h5>2.ชื่อนามสกุล</h5>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="namebro2 form-control" list="list_bro2" autofocus name="namebro2" value="">
                
                                    </div>
                                    <div class="col-xs-2">
                                        <h5>วันเกิด(ค.ศ.)</h5>
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="text" class="form-control" autofocus name="bro2_bday" id="bro2_bday">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-1 col-xs-offset-0">
                                        <h5>สถานะ</h5>
                                    </div>
                                    <div class="col-xs-3" style="margin-top: 7px;">
                                        <input type="radio" name="bro2_status" value="1" id="bro2_status1">ยังมีชีวิตอยู่
                                        <input type="radio" name="bro2_status" value="2" id="bro2_status2">เสียชีวิต
                                    </div>
                                </div>-->
                <!--                    <div class="row">
                                        <div class="col-xs-3">
                                            <h5>3.ชื่อนามสกุล</h5>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="namebro3 form-control" list="list_bro3" autofocus name="namebro3" value="">
                                            <datalist id="list_bro3" class="list_bro3">
                
                                            </datalist> 
                                        </div>
                                        <div class="col-xs-2">
                                            <h5>วันเกิด(ค.ศ.)</h5>
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" autofocus name="bro3_bday" id="bro3_bday">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1 col-xs-offset-0">
                                            <h5>สถานะ</h5>
                                        </div>
                                        <div class="col-xs-3" style="margin-top: 7px;">
                                            <input type="radio" name="bro3_status" value="1" id="bro3_status1">ยังมีชีวิตอยู่
                                            <input type="radio" name="bro3_status" value="2" id="bro3_status2">เสียชีวิต
                                        </div>
                                    </div>-->
                <!--                    <div class="row">
                                        <div class="col-xs-3">
                                            <h5>4.ชื่อนามสกุล</h5>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="namebro4 form-control" list="list_bro4" autofocus name="namebro4" value="">
                                        </div>
                                        <div class="col-xs-2">
                                            <h5>วันเกิด(ค.ศ.)</h5>
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" autofocus name="bro4_bday" id="bro4_bday">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1 col-xs-offset-0">
                                            <h5>สถานะ</h5>
                                        </div>
                                        <div class="col-xs-3" style="margin-top: 7px;">
                                            <input type="radio" name="bro4_status" value="1" id="bro4_status1">ยังมีชีวิตอยู่
                                            <input type="radio" name="bro4_status" value="2" id="bro4_status2">เสียชีวิต
                                        </div>
                                    </div>-->
                <?php
                $query = "SELECT * FROM person WHERE PARENT_ID = $id OR MOTHER_ID = $id";
//                    echo $query;
                $check = mysql_fetch_assoc(mysql_query($query));
//                    print_r ($check);
                if ($check) {
                    ?>
                    <div class="row">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border"><h4>6. ชื่อนามสกุล ของบุตร-ธิดา(เดิม)</h4></legend>
                            <?php
                            $childs = mysql_query($query);
                            $count = 1;
                            while ($child = mysql_fetch_assoc($childs)) {
//                                    print_r($child);
                                ?>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <h5><?php echo $count; ?>.ชื่อนามสกุล</h5>
                                    </div>
                                    <div class="col-xs-3" style="margin-top: 7px;">
                                        <?php echo get_person_name_string($child['ID']) . " " . get_person_surname_string($child['ID']); ?>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-0">
                                        <h5>วันเกิด(ค.ศ.)</h5>
                                    </div>
                                    <div class="col-xs-1" style="margin-top: 10px;">
                                        <?php
                                        $date = date_create($child['BIRTHDAY']);
                                        echo date_format($date, "m/d/Y");
                                        ?>
                                    </div>
                                    <div class="col-xs-1 col-xs-offset-1">
                                        <h5>สถานะ</h5>
                                    </div>
                                    <div class="col-xs-2" style="margin-top: 7px;">
                                        <?php
                                        if (get_status($child['ID']) == 1) {
                                            echo "ยังมีชีวิตอยู่";
                                        } elseif (get_status($child['ID']) == 2) {
                                            echo "เสียชีวิต";
                                        } else {
                                            echo "ยังมีชีวิตอยู่";
                                        }
                                        ?>
        <!--                                            <input type="radio" name="parent_status<?php //echo $count_brother;              ?>" value="1" <?php //if(get_status($brother['ID'])==1)echo "checked";               ?>>ยังมีชีวิตอยู่
                                            <input type="radio" name="parent_status<?php //echo $count_brother;               ?>" value="2" <?php //if(get_status($brother['ID'])==2)echo "checked";                ?>>เสียชีวิต-->
                                    </div>  
                                </div>
                                <?php
                                $count++;
                            }
                            ?>
                        </fieldset>
                    </div>
                    <div class="row">
                        <div class="col-xs-12" ><h4>ชื่อนามสกุล ของบุตร-ธิดา(เพิ่มเติม)</h4></div>
                        <?php
                        for ($i = 6; $i >= ($count - 1); $i--) {
                            if($count != 2 || $i != 1){
                            ?>
                            <div class="row">
                                <div class="col-xs-3" style="margin-left: 15px;">
                                    <h5>ชื่อนามสกุล</h5>
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" class="namebro1 form-control" list="list_bro1" autofocus name="namebro1" value="">
                                    <datalist id="list_bro1" class="list_bro1">

                                    </datalist> 
                                </div>
                                <div class="col-xs-2">
                                    <h5>วันเกิด(ค.ศ.)</h5>
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" class="form-control" autofocus name="bro1_bday" id="bro1_bday" value="" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-1" style="margin-left: 15px;">
                                    <h5>สถานะ</h5>
                                </div>
                                <div class="col-xs-3" style="margin-top: 7px;">
                                    <input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต
                                </div>
                                <div class="col-xs-2 col-xs-offset-0">
                                    <h5>ความสัมพันธ์</h5>
                                </div>
                                <div class="col-xs-2" style="margin-top: 7px;">
                                    <input type="radio" name="child<?php echo $i; ?>_relation" value="1" id="child3_relation1" <?php if ($person["GENDER_ID"] == 1) echo "checked"; ?>>บิดา
                                    <input type="radio" name="child<?php echo $i; ?>_relation" value="2" id="child3_relation2" <?php if ($person["GENDER_ID"] == 2) echo "checked"; ?>>มารดา
                                </div>
                            </div>
                            <?php 
                            }   
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="col-xs-12" ><h4>6. ชื่อนามสกุล ของบุตร-ธิดา</h4></div>
                        <?php
                        for ($i = 1; $i <= 6; $i++) {
                            ?>
                            <div class="row">
                                <div class="col-xs-3" style="margin-left: 15px;">
                                    <h5>ชื่อนามสกุล</h5>
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" class="namebro1 form-control" list="list_bro1" autofocus name="namebro1" value="">
                                    <datalist id="list_bro1" class="list_bro1">

                                    </datalist> 
                                </div>
                                <div class="col-xs-2">
                                    <h5>วันเกิด(ค.ศ.)</h5>
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" class="form-control" autofocus name="bro1_bday" id="bro1_bday" value="" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-1" style="margin-left: 15px;">
                                    <h5>สถานะ</h5>
                                </div>
                                <div class="col-xs-3" style="margin-top: 7px;">
                                    <input type="radio" name="bro1_status" value="1" id="bro1_status1">ยังมีชีวิตอยู่
                                    <input type="radio" name="bro1_status" value="2" id="bro1_status2">เสียชีวิต
                                </div>
                                <div class="col-xs-2 col-xs-offset-0">
                                    <h5>ความสัมพันธ์</h5>
                                </div>
                                <div class="col-xs-2" style="margin-top: 7px;">
                                    <input type="radio" name="child<?php echo $i; ?>_relation" value="1" id="child3_relation1" <?php if ($person["GENDER_ID"] == 1) echo "checked"; ?>>บิดา
                                    <input type="radio" name="child<?php echo $i; ?>_relation" value="2" id="child3_relation2" <?php if ($person["GENDER_ID"] == 2) echo "checked"; ?>>มารดา
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <!--                    <div class="row">
                                        <div class="col-xs-3">
                                            <h5>3.ชื่อนามสกุล</h5>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="namechild3 form-control" list="list_child3" autofocus name="namechild3" value="">
                                            <datalist id="list_child3" class="list_child3">
                
                                            </datalist> 
                                        </div>
                                        <div class="col-xs-2">
                                            <h5>วันเกิด(ค.ศ.)</h5>
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" autofocus name="child3_bday" id="child3_bday">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1 col-xs-offset-0">
                                            <h5>สถานะ</h5>
                                        </div>
                                        <div class="col-xs-3" style="margin-top: 7px;">
                                            <input type="radio" name="child3_status" value="1" id="child3_status1">ยังมีชีวิตอยู่
                                            <input type="radio" name="child3_status" value="2" id="child3_status2">เสียชีวิต
                                        </div>
                                        <div class="col-xs-2 col-xs-offset-0">
                                            <h5>ความสัมพันธ์</h5>
                                        </div>
                                        <div class="col-xs-2" style="margin-top: 7px;">
                                            <input type="radio" name="child3_relation" value="1" id="child3_relation1" <?php if ($person["GENDER_ID"] == 1) echo "checked"; ?>>บิดา
                                            <input type="radio" name="child3_relation" value="2" id="child3_relation2" <?php if ($person["GENDER_ID"] == 2) echo "checked"; ?>>มารดา
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <h5>4.ชื่อนามสกุล</h5>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="namechild4 form-control" list="list_child4" autofocus name="namechild4" value="">
                                            <datalist id="list_child4" class="list_child4">
                
                                            </datalist> 
                                        </div>
                                        <div class="col-xs-2">
                                            <h5>วันเกิด(ค.ศ.)</h5>
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" autofocus name="child4_bday" id="child4_bday">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1 col-xs-offset-0">
                                            <h5>สถานะ</h5>
                                        </div>
                                        <div class="col-xs-3" style="margin-top: 7px;">
                                            <input type="radio" name="child4_status" value="1" id="child4_status1">ยังมีชีวิตอยู่
                                            <input type="radio" name="child4_status" value="2" id="child4_status2">เสียชีวิต
                                        </div>
                                        <div class="col-xs-2 col-xs-offset-0">
                                            <h5>ความสัมพันธ์</h5>
                                        </div>
                                        <div class="col-xs-2" style="margin-top: 7px;">
                                            <input type="radio" name="child4_relation" value="1" id="child4_relation1" <?php if ($person["GENDER_ID"] == 1) echo "checked"; ?>>บิดา
                                            <input type="radio" name="child4_relation" value="2" id="child4_relation2" <?php if ($person["GENDER_ID"] == 2) echo "checked"; ?>>มารดา
                                        </div>
                                    </div>-->
            </div>
            <?php
            if (isset($_GET['page'])) {
//            echo "q123";
                ?>
                <div class="row" style="margin-top: 0px">
                    <div class="col-xs-2 col-xs-offset-10">
                        <a class="btn btn-danger" role="button" onClick="javascript
                                    :window.history.back()">ย้อนกลับ</a>
                    </div>
                </div><?php
            }
            ?>
            <div class="row">
                <div class="col-xs-1" style="margin-top:10">
                    <h6>หมายเหตุ</h6>
                </div>
                <div class="col-xs-3" style="margin-top:10">
                    <!--<input type="text" name="remark" class="form-control" autofocus value="<?php // echo print_person_remark($id);         ?>">-->
                </div>
                <div class="col-xs-3" style="margin-top:10">
                    <h6>running number</h6>
                </div>
                <div class="col-xs-1" style="margin-top:10">
                    <input type="text" name="remark" class="form-control" autofocus>
                </div>
            </div>

        </div>
    </body>
</html>