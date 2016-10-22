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
    </head>
    <body>
        <div class="bs-component">
            <!--<a class="btn btn-danger" role="button" style="margin-top: 0px" onClick="javascript:window.history.back();">ย้อนกลับ</a>-->
            <div id="print_div">
                <?php
                /*
                 * To change this license header, choose License Headers in Project Properties.
                 * To change this template file, choose Tools | Templates
                 * and open the template in the editor.
                 */
                $start_data = $_GET['start_data'];
                $end_data = $_GET['end_data'];
                $search_type = $_GET['search_type'];
                $year = $_GET['year'];

                include '../helper/db_connect.php';
                include '../helper/helper.php';
                connect_database();

                // if ($search_type == 1) {
                //     $query = "SELECT REGISTER_OWNER_ID FROM register "
                //             . "LEFT JOIN personname ON register.REGISTER_OWNER_ID = personname.PERSONNAME_OWNER_ID "
                //             . "WHERE (REGISTER_NUMBER BETWEEN $start_data AND $end_data) AND REGISTER_FROM_DATE LIKE '%$year%' ORDER BY PERSONNAME_NAME";
                // } else {
                //     $query = "SELECT register.REGISTER_OWNER_ID FROM register "
                //             . "LEFT JOIN personname ON register.REGISTER_OWNER_ID = personname.PERSONNAME_OWNER_ID "
                //             . "WHERE (personname.PERSONNAME_NAME BETWEEN '$start_data' AND '$end_data') AND register.REGISTER_FROM_DATE LIKE '%$year%' ORDER BY PERSONNAME_NAME";
                // }
                $query = search_between_data($start_data, $end_data, $search_type);
                ?>
                <div class="row">
                    <div class="col-xs-1">
                        ID
                    </div>
                    <div class="col-xs-3">
                        ชื่อ-นามสกุล
                    </div>
                    <div class="col-xs-2">
                        ชื่อจีน
                    </div>
                    <div class="col-xs-1">
                        เพศ
                    </div>
                    <div class="col-xs-2">
                        วันเกิด(คศ.)
                    </div>
                    <div class="col-xs-1">
                        อายุ
                    </div>
                    <div class="col-xs-2">
                        สถานภาพ
                    </div>
                    <div class="col-xs-3">
                        เลขบัตรประจำตัวประชาชน
                    </div>
                </div>
                <!--//                echo "ID ชื่อ-นามสกุล ชื่อจีน เพศ วันเกิด(คศ.) อายุ สถานภาพ เลขบัตรประจำตัวประชาชน";-->

                <div class="row">
                    <div class="col-xs-2">
                        โทรศัพท์บ้าน
                    </div>
                    <div class="col-xs-2">
                        โทรศัพท์มือถือ
                    </div>
                    <div class="col-xs-2">
                        e-mail
                    </div>
                    <div class="col-xs-2">
                        facebook
                    </div>
                    <div class="col-xs-2">
                        lineID
                    </div>
                </div>
                <!--echo "โทรศัพท์บ้าน โทรศัพท์มือถือ e-mail facebook lineID";-->
                <!--echo "<br/>";-->
                <div class="row">
                    <div class="col-xs-2">
                        ที่อยู่
                    </div>
                </div>

                <!--echo "ที่อยู่";-->
                <div class="row">
                    <div class="col-xs-1">
                        อาชีพ
                    </div>
                    <div class="col-xs-2">
                        ประเภทธุรกิจ
                    </div>
                    <div class="col-xs-2">
                        สถานที่ทำงาน
                    </div>
                    <div class="col-xs-1">
                        ตำแหน่ง
                    </div>
                    <div class="col-xs-2">
                        โทรศัพท์ที่ทำงาน
                    </div>
                    <div class="col-xs-2">
                        website
                    </div>
                    <div class="col-xs-2">
                        e-mail
                    </div>
                </div>
                <!--                                echo "<br/>";
                                                echo "อาชีพ ประเภทธุรกิจ สถานที่ทำงาน ตำแหน่ง โทรศัพท์ที่ทำงาน website e-mail";-->
                <!--echo "<br/>";-->
                <div class="row">
                    <div class="col-xs-12">
                        ที่อยู่
                    </div>
                </div>
                <!--                                echo "ที่อยู่";
                                                echo "<br/>";-->
                <div class="row">
                    <div class="col-xs-3">
                        ชื่อ-สกุลมารดา
                    </div>
                    <div class="col-xs-3">
                        สถานภาพ
                    </div>
                    <div class="col-xs-3">
                        ชื่อ-สกุลบิดา
                    </div>
                    <div class="col-xs-3">
                        สถานะภาพ
                    </div>
                </div>
                <!--                                echo "ชื่อ-สกุลมารดา สถานภาพ ชื่อ-สกุลบิดา สถานะภาพ";
                                                echo "<br/>";-->
                <div class="row">
                    <div class="col-xs-4">
                        ชื่อ-สกุลบรรพบุรุษที่ประเทศจีน
                    </div>
                    <div class="col-xs-4">
                        ความสัมพันธ์
                    </div>
                    <div class="col-xs-4">
                        เบอร์โทรศัพท์
                    </div>
                </div>
                <!--                echo "ชื่อ-สกุลบรรพบุรุษที่ประเทศจีน ความสัมพันธ์ เบอร์โทรศัพท์";
                                echo "<br/>";-->
                <div class="row">
                    <div class="col-xs-12">
                        ที่อยู่
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        ชื่อ-สกุลพี่น้อง
                    </div>
                    <div class="col-xs-4">
                        ชื่อจีน
                    </div>
                    <div class="col-xs-4">
                        วันเกิด(คศ.)
                    </div>
                </div>
                <!--                echo "ที่อยู่";
                                echo "<br/>";-->
                <!--                echo "ชื่อ-สกุลพี่น้อง1 ชื่อจีน วันเกิด(คศ.)";
                                echo "<br/>";
                                echo "ชื่อ-สกุลพี่น้อง2 ชื่อจีน วันเกิด(คศ.)";
                                echo "<br/>";
                                echo "ชื่อ-สกุลพี่น้อง3 ชื่อจีน วันเกิด(คศ.)";
                                echo "<br/>";
                                echo "ชื่อ-สกุลพี่น้อง4 ชื่อจีน วันเกิด(คศ.)";
                                echo "<br/>";-->

                <?php
                $serach_persons = mysql_query($query);
                while ($serach_person = mysql_fetch_row($serach_persons)) {
                    $id = $serach_person[0];
                    $persons = get_person_detial($id);
                    $person = mysql_fetch_assoc($persons);

                    if ($person['CHINANAME_ID'] == 0) {
                        $chinaname = '-';
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
                        $homePhoneSting = '-';
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

                    $lines = get_person_contact($id, 4);
                    $checkLine = mysql_fetch_assoc(get_person_contact($id, 4));
                    if ($checkLine) {
                        $line = mysql_fetch_assoc($lines);
                    } else {
                        $line = array("CONTACT_STRING" => '');
                    }

                    $facebooks = get_person_contact($id, 5);
                    $checkFB = mysql_fetch_assoc(get_person_contact($id, 5));
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
                    $runnum = get_running_number($id);
                    ?>
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col-xs-1">
                            <?php echo $id; ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . ' ' . get_person_surname_string($id); ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo $chinaname; ?>
                        </div>
                        <div class="col-xs-1">
                            <?php
                            if ($person["GENDER_ID"] == 1) {
                                echo "ช";
                            } else if ($person["GENDER_ID"] == 2) {
                                echo "ญ";
                            }
                            ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo display_birthday($person['BIRTHDAY']); ?>
                        </div>
                        <div class="col-xs-1">
                            <?php echo cal_age($person['BIRTHDAY']); ?>
                        </div>
                        <div class="col-xs-2">
                            <?php
                            if ($person["MARITALSTATUS_ID"] == 1) {
                                echo "โสด";
                            } else if ($person["MARITALSTATUS_ID"] == 2) {
                                echo "แต่งานแล้ว";
                            } else if ($person["MARITALSTATUS_ID"] == 3) {
                                echo "หย่าร้าง";
                            }
                            ?>
                        </div>
                        <div class="col-xs-3">
                            <?php
                            if ($person['PERSONALID'] != '') {
                                echo get_personalID($id);
                            } else {
                                echo '-';
                            }
                            ?>
                        </div>
                    </div>
                    <?php
//                    echo $id . " ";
//                    echo get_person_title_string($person['TITLE_ID']) . ' ' . get_person_name_string($id) . ' ' . get_person_surname_string($id) . " ";
//                    echo $chinaname . " ";
//                    if ($person["GENDER_ID"] == 1) {
//                        echo "ช";
//                    } else if ($person["GENDER_ID"] == 2) {
//                        echo "ญ";
//                    }
//                    echo " ";
//                    echo display_birthday($person['BIRTHDAY']);
//                    echo " ";
//                    echo cal_age($person['BIRTHDAY']);
//                    echo " ";
//                    if ($person["MARITALSTATUS_ID"] == 1) {
//                        echo "โสด";
//                    } else if ($person["MARITALSTATUS_ID"] == 2) {
//                        echo "แต่งานแล้ว";
//                    } else if ($person["MARITALSTATUS_ID"] == 3) {
//                        echo "หย่าร้าง";
//                    }
//                    if ($person['PERSONALID'] != '') {
//                        echo get_personalID($id);
//                    } else {
//                        echo '-';
//                    }
//                    echo "<br/>";
                    ?>
                    <div class="row">
                        <div class="col-xs-2">
                            <?php echo $homePhoneSting; ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo $mobileTel['CONTACT_ARER_CODE'] . '-' . $mobileTel['CONTACT_STRING']; ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo ($email['CONTACT_STRING']); ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo ($facebook['CONTACT_STRING']); ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo ($line['CONTACT_STRING']); ?>
                        </div>
                    </div>
                    <?php
//                    echo $homePhoneSting;
//                    echo " ";
//                    echo $mobileTel['CONTACT_ARER_CODE'] . '-' . $mobileTel['CONTACT_STRING'];
//                    echo " ";
//                    echo ($email['CONTACT_STRING']);
//                    echo " ";
//                    echo ($line['CONTACT_STRING']);
//                    echo " ";
//                    echo ($facebook['CONTACT_STRING']);
//                    echo " ";
//                    echo "<br/>";
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo ($homeAddr['ADDRESS_NUM']);
                            echo " ";
                            echo ($homeAddr['ADDRESS_MOO']);
                            echo " ";
                            echo ($homeAddr['ADDRESS_VILLAGE']);
                            echo " ";
                            echo ($homeAddr['ADDRESS_ALLEY']);
                            echo " ";
                            echo ($homeAddr['ADDRESS_ROAD']);
                            echo " ";
                            echo get_district_string($homeAddr['ADDRESS_DISTRICT_ID']);
                            echo " ";
                            echo get_amphur_string($homeAddr['ADDRESS_AMPHUR_ID']);
                            echo " ";
                            echo get_province_string($homeAddr['ADDRESS_PROVINCE_ID']);
                            echo " ";
                            echo ($homeAddr['ADDRESS_ZIPCODE']);
                            ?>
                        </div>

                    </div>
                    <?php
//                    echo ($homeAddr['ADDRESS_NUM']);
//                    echo " ";
//                    echo ($homeAddr['ADDRESS_MOO']);
//                    echo " ";
//                    echo ($homeAddr['ADDRESS_VILLAGE']);
//                    echo " ";
//                    echo ($homeAddr['ADDRESS_ALLEY']);
//                    echo " ";
//                    echo ($homeAddr['ADDRESS_ROAD']);
//                    echo " ";
//                    echo get_district_string($homeAddr['ADDRESS_DISTRICT_ID']);
//                    echo " ";
//                    echo get_amphur_string($homeAddr['ADDRESS_AMPHUR_ID']);
//                    echo " ";
//                    echo get_province_string($homeAddr['ADDRESS_PROVINCE_ID']);
//                    echo " ";
//                    echo ($homeAddr['ADDRESS_ZIPCODE']);
//                    echo "<br/>";
                    ?>
                    <div class="row">
                        <div class="col-xs-1">
                            <?php
                            if ($org_type == 1) {
                                echo "รับราชการ";
                            } else if ($org_type == 2) {
                                echo "รัฐวิสาหกิจ";
                            } else if ($org_type == 3) {
                                echo "เอกชน";
                            } else if ($org_type == 4) {
                                echo "นักเรียน/นักศึกษา";
                            } else if ($org_type == 5) {
                                echo "อิสระ";
                            } else {
                                echo " ";
                            }
                            ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo $org_comment; ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo $org_name; ?>
                        </div>
                        <div class="col-xs-1">
                            <?php echo $org_role; ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo $org_phone_string; ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo $org_web['CONTACT_STRING']; ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo $org_mail['CONTACT_STRING']; ?>
                        </div>
                    </div>
                    <?php
//                    if ($org_type == 1) {
//                        echo "รับราชการ";
//                    } else if ($org_type == 2) {
//                        echo "รัฐวิสาหกิจ";
//                    } else if ($org_type == 3) {
//                        echo "เอกชน";
//                    } else if ($org_type == 4) {
//                        echo "นักเรียน/นักศึกษา";
//                    } else if ($org_type == 5) {
//                        echo "อิสระ";
//                    } else {
//                        echo " ";
//                    }
//                    echo " ";
//                    echo $org_comment;
//                    echo " ";
//                    echo $org_name;
//                    echo " ";
//                    echo $org_role;
//                    echo " ";
//                    echo $org_phone_string;
//                    echo " ";
//                    echo $org_web['CONTACT_STRING'];
//                    echo " ";
//                    echo $org_mail['CONTACT_STRING'];
//                    echo "<br/>";
//        echo ($org_addr['ADDRESS_NUM']);
                    ?>

                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo ($org_addr['ADDRESS_NUM']);
                            echo " ";
                            echo ($org_addr['ADDRESS_MOO']);
                            echo " ";
                            echo ($org_addr['ADDRESS_VILLAGE']);
                            echo " ";
                            echo ($org_addr['ADDRESS_ALLEY']);
                            echo " ";
                            echo ($org_addr['ADDRESS_ROAD']);
                            echo " ";
                            echo get_district_string($org_addr['ADDRESS_DISTRICT_ID']);
                            echo " ";
                            echo get_amphur_string($org_addr['ADDRESS_AMPHUR_ID']);
                            echo " ";
                            echo get_province_string($org_addr['ADDRESS_PROVINCE_ID']);
                            echo " ";
                            echo ($org_addr['ADDRESS_ZIPCODE']);
                            ?>
                        </div>

                    </div>
                    <?php
//                        echo ($org_addr['ADDRESS_NUM']);
//                        echo " ";
//                        echo ($org_addr['ADDRESS_MOO']);
//                        echo " ";
//                        echo ($org_addr['ADDRESS_VILLAGE']);
//                        echo " ";
//                        echo ($org_addr['ADDRESS_ALLEY']);
//                        echo " ";
//                        echo ($org_addr['ADDRESS_ROAD']);
//                        echo " ";
//                        echo get_district_string($org_addr['ADDRESS_DISTRICT_ID']);
//                        echo " ";
//                        echo get_amphur_string($org_addr['ADDRESS_AMPHUR_ID']);
//                        echo " ";
//                        echo get_province_string($org_addr['ADDRESS_PROVINCE_ID']);
//                        echo " ";
//                        echo ($org_addr['ADDRESS_ZIPCODE']);
//                    echo "<br/>";
                    ?>
                    <div class="row">
                        <div class="col-xs-3">
                            <?php echo $mother_string; ?>
                        </div>
                        <div class="col-xs-3">
                            <?php
                            if ($mother_status == 1) {
                                echo "ยังมีชีวิตอยู่";
                            } else if ($mother_status == 2) {
                                echo "เสียชีวิตแล้ว";
                            } else {
                                echo " ";
                            }
                            ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $parent_string; ?>
                        </div>
                        <div class="col-xs-3">
                            <?php
                            if ($parent_status == 1) {
                                echo "ยังมีชีวิตอยู่";
                            } else if ($parent_status == 2) {
                                echo "เสียชีวิตแล้ว";
                            } else {
                                echo " ";
                            }
                            ?>
                        </div>
                    </div>
                    <?php
//                    echo $parent_string;
//                    echo " ";
//                    if ($parent_status == 1) {
//                        echo "ยังมีชีวิตอยู่";
//                    } else if ($parent_status == 2) {
//                        echo "เสียชีวิตแล้ว";
//                    } else {
//                        echo "ไม่ระบุ";
//                    }
//                    echo $mother_string;
//                    echo " ";
//                    if ($mother_status == 1) {
//                        echo "ยังมีชีวิตอยู่";
//                    } else if ($mother_status == 2) {
//                        echo "เสียชีวิตแล้ว";
//                    } else {
//                        echo "ไม่ระบุ";
//                    }
//                    echo "<br/>";
//                    echo "<br/>";
                    ?>
                    <div class="row">
                        <div class="col-xs-4">
                            <?php echo $chinahouse_name; ?>
                        </div>
                        <div class="col-xs-4">
                            <?php echo $chinahouse_link; ?>
                        </div>
                        <div class="col-xs-4">
                            <?php echo $chinahouse_tel; ?>
                        </div>
                    </div>
                    <?php
//                    echo $chinahouse_name;
//                    echo " ";
//                    echo $chinahouse_link;
//                    echo " ";
//                    echo $chinahouse_tel;
//                    echo "<br/>";
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            echo $chinahouse_village_string;
                            echo " ";
                            echo $chinahouse_district_string;
                            echo " ";
                            echo $chinahouse_amphur_string;
                            echo " ";
                            echo $chinahouse_province_string;
                            ?>
                        </div>
                    </div>
                    <?php
//                    echo $chinahouse_village_string;
//                    echo " ";
//                    echo $chinahouse_district_string;
//                    echo " ";
//                    echo $chinahouse_amphur_string;
//                    echo " ";
//                    echo $chinahouse_province_string;

                    if ($person['PARENT_ID'] != 0 || $person['BROTHER_LIST'] != '') {

                        $brothers = get_person_brother($person['PARENT_ID'], $person['BROTHER_LIST'], $person['ID']);
                        while ($brother = mysql_fetch_assoc($brothers)) {
                            ?>
                            <div class="row">
                                <div class="col-xs-4">
                                    <?php echo get_person_name_string($brother['ID']) . " " . get_person_surname_string($brother['ID']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php
                                    if ($brother['CHINANAME_ID'] == 0) {
                                        $bro_chinaname = '';
                                    } else {
                                        $bro_chinaname = get_person_china_full_name($brother['ID'], 0);
                                    }
                                    echo $bro_chinaname;
                                    ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php
                                    if ($brother['STATUS'] == 1) {
                                        echo "ยังมีชีวิตอยู่";
                                    } else if ($brother['STATUS'] == 2) {
                                        echo "เสียชีวิตแล้ว";
                                    } else {
                                        echo "ไม่ระบุ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
//                            echo get_person_name_string($brother['ID']) . " " . get_person_surname_string($brother['ID']);
//                            echo " ";
//                            if ($brother['CHINANAME_ID'] == 0) {
//                                $bro_chinaname = '';
//                            } else {
//                                $bro_chinaname = get_person_china_full_name($brother['ID'], 0);
//                            }
//                            echo $bro_chinaname;
//                            echo " ";
//                            if ($brother['STATUS'] == 1) {
//                                echo "ยังมีชีวิตอยู่";
//                            } else if ($brother['STATUS'] == 2) {
//                                echo "เสียชีวิตแล้ว";
//                            } else {
//                                echo "ไม่ระบุ";
//                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
